<!doctype html>
<html>
  <head>
  	<title>Upload d'une vidéo sur un compte Facebook</title>
		<style type="text/css">
		  .error { color:red; border:1px solid red; padding:5px; font-weight:bold; font-size:1.5em; }
		  .uploaded { color:green; border:1px solid green; padding:5px; font-weight:bold; font-size:1.5em; }
		  .auth { padding:5px 10px; background:#0085ba; border-color:#0073aa #006799 #006799; -webkit-box-shadow: 0 1px 0 #006799; box-shadow:0 1px 0 #006799; color: #fff; text-decoration:none; text-shadow:0 -1px 1px #006799,1px 0 1px #006799,0 1px 1px #006799,-1px 0 1px #006799; }
		</style>
  </head>
  <body>
  	<h1>Upload d'une vidéo sur un compte Facebook</h1>
<?php
  // Récupération de la configuration de Facebook
  $config = array();
  if ($config_file = file_get_contents("../../../../wp-config-bx1-transfer.json")) {
    $config = json_decode($config_file, true);
  }
  // Le fichier de configuration configuration est manquant
  if (empty($config) || count($config) <= 0) {
    ?><p class="error">Le fichier de configuration Facebook n'est pas à la racine du site.</p><?php
  }
  // Les librairies sont manquantes ou pas à la bonne place.
  elseif (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    ?><p class="error">Les librairies utilisées pour l'upload des vidéos sur Facebook sont manquantes.</p><?php
  }
  else {
    if (!session_id()) {
      session_start();
    }

    $video_name = $video_title = $video_desc = null;
    if (!empty($_REQUEST['video'])) { // L'user vient de cliquer sur le bouton "Uploader sur Facebook".
      $video_name = $_REQUEST['video'];
      $video_title = isset($_REQUEST['title']) ? $_REQUEST['title'] : null;
      $video_desc = isset($_REQUEST['desc']) ? $_REQUEST['desc'] : null;
    }
    elseif (!empty($_SESSION['facebook_video'])) { // L'user vient de s'authentifier au près de Google.
      $video_name = $_SESSION['facebook_video'];
      $video_title = isset($_SESSION['facebook_title']) ? $_SESSION['facebook_title'] : null;
      $video_desc = isset($_SESSION['facebook_desc']) ? $_SESSION['facebook_desc'] : null;
    }

    if (empty($video_name)) { // Pas de vidéo à uploader.
      ?><p class="error">Aucune vidéo à uploader n'a été détectée.</p><?php
    }
    else {
      require_once __DIR__ . '/../vendor/autoload.php';

      // Ajouter en session les infos sur la vidéo à uploader
      // afin de les récupérer après l'authentification aux services Google.
      $_SESSION['facebook_video'] = $video_name;
      $_SESSION['facebook_title'] = $video_title;
      $_SESSION['facebook_desc'] = $video_desc;

    	?><p>Vidéo à uploader : <strong><?php echo $video_name; ?>.mp4</strong></p><?php
    	?><p>Titre de la vidéo : <strong><?php echo $video_title; ?></strong></p><?php
    	?><p>Description de la vidéo : <strong><?php echo $video_desc; ?></strong></p><?php

      $fb = new \Facebook\Facebook([
        'app_id' => $config['facebook']['app_id'],
        'app_secret' => $config['facebook']['app_secret'],
        'default_graph_version' => 'v2.2',
      ]);

      if (empty($_SESSION['fb_access_token'])) {
        $helper = $fb->getRedirectLoginHelper();
        if (isset($_GET['state'])) {
          $helper->getPersistentDataHandler()->set('state', $_GET['state']);
        }
        try {
          $accessToken = $helper->getAccessToken();
        }
        catch (\Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          ?><p class="error">Graph a retourné une erreur : <code><?php print sprintf('%s', htmlspecialchars($e->getMessage())); ?></code></p><?php
          ?><p><a href="#" onclick="javascript:window.close();">Fermer</a></p><?php
          exit;
        }
        catch (\Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          ?><p class="error">Le SDK de Facebook a retourné une erreur : <code><?php print sprintf('%s', htmlspecialchars($e->getMessage())); ?></code></p><?php
          ?><p><a href="#" onclick="javascript:window.close();">Fermer</a></p><?php
          exit;
        }

        if (!isset($accessToken)) { // Formulaire d'authentification
          $protocol = isset($_SERVER["HTTPS"]) ? 'https://' : 'http://';
          $redirect = filter_var($protocol . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'], FILTER_SANITIZE_URL);
          $permissions = array("publish_actions","publish_pages");
          $loginUrl = $helper->getLoginUrl($redirect, $permissions);
          ?><div class="error">
          	<h3>Authentification nécessaire</h3>
          	<p>Afin d'uploader la vidéo sur Facebook, vous devez d'abord vous identifier avec le compte Facebook sur lequel vous souhaitez publier la vidéo.</p>
          	<p><a href="<?php print htmlspecialchars($loginUrl); ?>" class="auth">S'authentifier</a><p>
          </div><?php
        }
        else { // Callback après l'authentification
          // The OAuth 2.0 client handler helps us manage access tokens
          $oAuth2Client = $fb->getOAuth2Client();

          // Get the access token metadata from /debug_token
          $tokenMetadata = $oAuth2Client->debugToken($accessToken);
          // Validation (these will throw FacebookSDKException's when they fail)
          $tokenMetadata->validateAppId($config['facebook']['app_id']);
          $tokenMetadata->validateExpiration();

          if (!$accessToken->isLongLived()) {
            // Exchanges a short-lived access token for a long-lived one
            try {
              $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            }
            catch (Facebook\Exceptions\FacebookSDKException $e) {
              ?><p class="error">Erreur lors de l'obtention d'un jeton d'accès à longue durée de vie : <code><?php sprintf('%s', htmlspecialchars($helper->getMessage())); ?></code></p><?php
              ?><p><a href="#" onclick="javascript:window.close();">Fermer</a></p><?php
              exit;
            }
          }

          $_SESSION['fb_access_token'] = (string) $accessToken;
        }
      }

      if (!empty($_SESSION['fb_access_token'])) {
       try {
          $videoPath = $config['videos_directory_path'] . "/" . $video_name . '.mp4';
          $data = [
            'title' => $video_title,
            'description' => $video_desc,
          ];
          $response = $fb->uploadVideo('me', $videoPath, $data, $_SESSION['fb_access_token']);
          ?><div class="uploaded"><?php
          ?><p>La vidéo a été uploadée.</p><?php
          ?><p>Son identifiant sur Facebook est <em><?php print printf('%s', $response['video_id']); ?></em>.<?php
          ?></div><?php
        }
        catch (Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          ?><p class="error">Graph a retourné une erreur : <code><?php print sprintf('%s', htmlspecialchars($e->getMessage())); ?></code></p><?php
        }
        catch (Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          ?><p class="error">Le SDK de Facebook a retourné une erreur : <code><?php print sprintf('%s', htmlspecialchars($e->getMessage())); ?></code></p><?php
        }
      }
    }
  }
?>
  	<p><a href="#" onclick="javascript:window.close();">Fermer</a></p>
  </body>
</html>
