<!doctype html>
<html>
  <head>
  	<title>Upload d'une vidéo sur un compte YouTube</title>
		<style type="text/css">
		  .error { color:red; border:1px solid red; padding:5px; font-weight:bold; font-size:1.5em; }
		  .uploaded { color:green; border:1px solid green; padding:5px; font-weight:bold; font-size:1.5em; }
		  .auth { padding:5px 10px; background:#0085ba; border-color:#0073aa #006799 #006799; -webkit-box-shadow: 0 1px 0 #006799; box-shadow:0 1px 0 #006799; color: #fff; text-decoration:none; text-shadow:0 -1px 1px #006799,1px 0 1px #006799,0 1px 1px #006799,-1px 0 1px #006799; }
		</style>
  </head>
  <body>
  	<h1>Upload d'une vidéo sur un compte YouTube</h1>
<?php
  // Récupération de la configuration de YouTube
  $config = array();
  if ($config_file = file_get_contents("../../../../wp-config-bx1-transfer.json")) {
    $config = json_decode($config_file, true);
  }
  // Le fichier de configuration configuration est manquant
  if (empty($config) || count($config) <= 0) {
    ?><p class="error">Le fichier de configuration YouTube n'est pas à la racine du site.</p><?php
  }
  // Les librairies sont manquantes ou pas à la bonne place.
  elseif (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    ?><p class="error">Les librairies Google utilisées pour l'upload des vidéos sur YouTube sont manquantes.</p><?php
  }
  else {
    session_start();

    $video_name = $video_title = $video_desc = null;
    if (!empty($_REQUEST['video'])) { // L'user vient de cliquer sur le bouton "Uploader sur YouTube".
      $video_name = $_REQUEST['video'];
      $video_title = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
      $video_desc = isset($_REQUEST['desc']) ? $_REQUEST['desc'] : null;
    }
    elseif (!empty($_SESSION['youtube_video'])) { // L'user vient de s'authentifier au près de Google.
      $video_name = $_SESSION['youtube_video'];
      $video_title = isset($_SESSION['youtube_title']) ? $_SESSION['youtube_title'] : null;
      $video_desc = isset($_SESSION['youtube_desc']) ? $_SESSION['youtube_desc'] : null;
    }

    if (empty($video_name)) { // Pas de vidéo à uploader.
      ?><p class="error">Aucune vidéo à uploader n'a été détectée.</p><?php
    }
    else {
      require_once __DIR__ . '/../vendor/autoload.php';

      // Ajouter en session les infos sur la vidéo à uploader
      // afin de les récupérer après l'authentification aux services Google.
      $_SESSION['youtube_video'] = $video_name;
      $_SESSION['youtube_title'] = $video_title;
      $_SESSION['youtube_desc'] = $video_desc;

    	?><p>Vidéo à uploader : <strong><?php echo $video_name; ?>.mp4</strong></p><?php
    	?><p>Titre de la vidéo : <strong><?php echo $video_title; ?></strong></p><?php
    	?><p>Description de la vidéo : <strong><?php echo $video_desc; ?></strong></p><?php

      $client = new Google_Client();
      $client->setClientId($config['youtube']['client_id']);
      $client->setClientSecret($config['youtube']['client_secret']);
      $client->setScopes('https://www.googleapis.com/auth/youtube');
      $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
      $redirect = filter_var($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
      $client->setRedirectUri($redirect);

      // Define an object that will be used to make all API requests.
      $youtube = new Google_Service_YouTube($client);

      // Check if an auth token exists for the required scopes
      $tokenSessionKey = 'token-' . $client->prepareScopes();
      if (isset($_GET['code'])) {
        if (strval($_SESSION['state']) !== strval($_GET['state'])) {
          ?><p class="error">L'état de session lors du transfert ne correspond plus... La vidéo n'a pu être uploadée.</p><?php
          ?><p><a href="#" onclick="javascript:window.close();">Fermer</a></p><?php
          die('The session state did not match.');
        }

        $client->fetchAccessTokenWithAuthCode($_GET['code']);
        $_SESSION[$tokenSessionKey] = $client->getAccessToken();
        header('Location: ' . $redirect);
      }

      if (isset($_SESSION[$tokenSessionKey])) {
        $client->setAccessToken($_SESSION[$tokenSessionKey]);
      }

      // Check to ensure that the access token was successfully acquired.
      if ($client->getAccessToken()) {
        try {
          // Create an asset resource and set its snippet metadata and type.
          $snippet = new Google_Service_YouTube_VideoSnippet();
          $snippet->setTitle($video_title);
          $snippet->setDescription($video_desc);

          // Numeric video category. See https://developers.google.com/youtube/v3/docs/videoCategories/list
          $snippet->setCategoryId("25"); // News & politics

          // Set the video's status to "public". Valid statuses are "public", "private" and "unlisted".
          $status = new Google_Service_YouTube_VideoStatus();
          $status->privacyStatus = "public";

          // Associate the snippet and status objects with a new video resource.
          $video = new Google_Service_YouTube_Video();
          $video->setSnippet($snippet);
          $video->setStatus($status);

          // Specify the size of each chunk of data, in bytes. Set a higher value for
          // reliable connection as fewer chunks lead to faster uploads. Set a lower
          // value for better recovery on less reliable connections.
          $chunkSizeBytes = 1 * 1024 * 1024;

          // Setting the defer flag to true tells the client to return a request which can be called
          // with ->execute(); instead of making the API call immediately.
          $client->setDefer(true);

          // Create a request for the API's videos.insert method to create and upload the video.
          $insertRequest = $youtube->videos->insert("status,snippet", $video);

          // Create a MediaFileUpload object for resumable uploads.
          $media = new Google_Http_MediaFileUpload(
              $client,
              $insertRequest,
              'video/*',
              null,
              true,
              $chunkSizeBytes
          );
          $videoPath = $config['videos_directory_path'] . "/" . $video_name . '.mp4';
          $media->setFileSize(filesize($videoPath));

          // Read the media file and upload it chunk by chunk.
          $status = false;
          $handle = fopen($videoPath, "rb");
          while (!$status && !feof($handle)) {
            $chunk = fread($handle, $chunkSizeBytes);
            $status = $media->nextChunk($chunk);
          }

          fclose($handle);

          // If you want to make other calls after the file upload, set setDefer back to false
          $client->setDefer(false);

          ?><div class="uploaded"><?php
          ?><p>La vidéo a été uploadée.</p><?php
          ?><p>Son identifiant sur YouTube est <em><?php print sprintf('%s', $status['id']); ?></em>.<?php
          ?></div><?php
        }
        catch (Google_Service_Exception $e) {
          ?><p class="error">Une erreur d'un service Google s'est produite : <code><?php print sprintf('%s', htmlspecialchars($e->getMessage())); ?></code></p><?php
        }
        catch (Google_Exception $e) {
          ?><p class="error">Une erreur s'est produite : <code><?php print sprintf('%s', htmlspecialchars($e->getMessage())); ?></code></p><?php
        }

        $_SESSION[$tokenSessionKey] = $client->getAccessToken();
      }
      else {
        // If the user hasn't authorized the app, initiate the OAuth flow
        $state = mt_rand();
        $client->setState($state);
        $_SESSION['state'] = $state;

        $authUrl = $client->createAuthUrl();
        ?><div class="error"><?php
        ?><h3>Authentification nécessaire</h3><?php
        ?><p>Afin d'uploader la vidéo sur YouTube, vous devez d'abord vous identifier avec le compte YouTube sur lequel la vidéo doit être uploadée.</p><?php
        ?><p><a href="<?php print $authUrl; ?>" class="auth">S'authentifier</a><p><?php
        ?></div><?php
      }
    }
  }
?>
  	<p><a href="#" onclick="javascript:window.close();">Fermer</a></p>
  </body>
</html>
