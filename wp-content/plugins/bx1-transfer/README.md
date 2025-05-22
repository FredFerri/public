Facebook
========
Créer une application FB.
N'oublier pas d'ajouter une plate-forme pour le site web.

YouTube
=======
Dans la gestion des projets API de Google (https://console.developers.google.com/apis/credentials), créer un projet pour le site si cela n'a pas encore été fait.
Ajouter ensuite un nouvel identifiant de type "ID clients OAuth 2.0".
Dans la configuration de cet identifiant, indiquez l'adresse de votre site comme "Origines JavaScript autorisées"
et la page "/wp-content/plugins/bx1-transfer/php/bx1-transfer-youtube.php" comme "URI de redirection autorisés".
Vérifier que la bibliothèque "YouTube Data API v3" est activée.

Wordpress
=========
Créer le fichier "wp-config-bx1-transfer.json" avec la structure ci-dessous.
Remplacer les valeurs entre accolades par les paramètes de la configuration serveur ou de vos comptes YouTube ou Facebook.
  {
    "videos_directory_path":"{chemin vers le répertoire physique où sont stockés les vidéos sur le serveur. Ne pas mettre "/" à la fin.}",
    "youtube":{
      "client_id":"{Id client du compte YouTube}",
      "client_secret":"{Clé secrète du compte YouTube}"
    },
    "facebook":{
      "app_id":"{Id de l'application Facebook}",
      "app_secret":"{Clé secrète associée à l'application Facebook}"
    }
  }


Pour que l'upload fonctionne, il ne faut pas de .htpwd devant.
Si la communication se fait en HTTPS, un certificat SSL valide est requis.
