<?php

/**
 * Template Name: Player Audio Mobile (App)
 *
 *
 * @package BX1
 */
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header(); 
?>
 <style>
     .news__article{
        padding-top: 15px;
     }
     .titremireRadio{
        margin-bottom: 15px;
     }
     .sideFil .titremireRadio, .news .titremireRadio{
        font-weight: bold;
        text-transform: uppercase;
        font-size: 1.2em;
        background-color:#e2237a;
        color:#FFF;
        text-align: center;
        display: block;
        border-radius:5px;
     }
     #captionLive{
        background-color: #EE217C;
        width: 390px!important;
        height: 40px;
        line-height: 10px;
        padding-left: 10px;
        color: #FFF;
        font-size: 16px;
        overflow: hidden;
        font-family: sys-tt, sans-serif;
        font-weight: 600;
        font-style: normal;
    }
 </style>
<script src="https://player.bx1plus.be/assets/js/getsoundtitle.inc.js"></script>
<link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
 <div style="margin-bottom: 10px;">
 </div>
 <section class="news news--grille"> 
    <article class="news__article ">
        <span class="titremireRadio" >Vous écoutez BX1+ &ndash; Radio de Bruxelles</span>
        <div id='radioLive' style="height: 100%;">Loading the player...</div>
        <div  class="playerctrl" id="captionLive" data-aspect="audio"></div>
    </article>
 </section>
  <script type='text/javascript'>
    var $ = jQuery.noConflict();
       jwplayer("radioLive").setup({
        playlist: [{
            sources: [{
                "file": "https://59959724487e3.streamlock.net:443/radioaudio/aac:live.aac/playlist.m3u8", "type":"hls"
            },{
                "file": "rmtps://59959724487e3.streamlock.net:443/radioaudio/live.aac", "type":"mp3"
            }]
        }],
        primary: 'html5',
        width: 400,
        height: 30,
        autostart: true,
        androidhls: true,
        mute:false,
        volume: 100,
        allowFullscreen: false,
        localization: {
            liveBroadcast : 'vous écoutez BX1+ en Direct'
        }
    });
  </script>
<p><strong>Les émissions et chroniques de BX1+ sont disponibles en podcast sur une multitude de plateformes. Découvrez les principaux flux de podcasts auxquels vous pouvez vous abonner !</strong>
<h1>Les émissions</h1>
<h2>Les Acteurs de Bruxelles</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-acteurs-de-bruxelles/id1485709380"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/1ozLpnW9GWARLMiYtX1ztK"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/Les-Acteurs-de-Bruxelles-p1270056/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485709380"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485709380/bx1-acteurs-de-bruxelles"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>Toujours + d'Actu</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-toujours-dactu/id1485748743"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/7ci8kpaKolOWBQeXvhSOpY"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/Always-more-News-p1270098/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485748743"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485748743/bx1-toujours-dactu"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>Bruxelles vit !</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-bruxelles-vit/id1485755687"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/6GkDUx7hjNwhV7XzIr5tH4"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/Brussels-lives-p1270123/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485755687"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485755687/bx1-bruxelles-vit"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>Podcast +</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-podcast/id1485748320"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/2pp54CFVdjp7Ka9gkYi60f"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/Podcast--p1270104/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485748320"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485748320/bx1-podcast"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h1>Les chroniques</h1>
<h2>L'édito de Fabrice Grosfilley</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-l%C3%A9dito/id1485746476"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/51LUCBvAxBjvFMLpyj8N9f"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/The-editorial-of-Fabrice-Grosfilley-p1270120/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485746476"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485746476/bx1-l-dito"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>L'invité politique</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-linvit%C3%A9-politique/id1485746778"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/4G7AfFRViIW6Vdl6GXuini"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/The-political-guest-of-Toujours--dActu-p1270114/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/mn4w83y4"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485746778/bx1-l-invit-politique"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>Le 12h30</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-le-12h30/id1485748195"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/6Bj3z8rMvX4mrdRjiUiyaG"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/The-12h30-of-BX1--p1270111/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485748195"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485748195/bx1-le-12h30"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>Le face à face</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-le-face-%C3%A0-face/id1485746499"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/2LWsX1UizIcO5Wo6QS1wzN"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/The-face-to-face-of-BX1--p1270119/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485746499"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485746499/bx1-le-face-face"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>Micro ouvert</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-micro-ouvert/id1485748110"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/7qM6fYvFkWxlFIffxcNLaW"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/Open-microphone-p1270106/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485748110"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485746499/bx1-le-face-face"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<h2>L'invité culture</h2>
<a href="https://podcasts.apple.com/be/podcast/bx1-linvit%C3%A9-culture/id1485746767"><img class="alignleft wp-image-400469" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Apple-Podcasts-415x106.jpg" alt="" width="200" height="51" /></a><a href="https://open.spotify.com/show/0GslVLtb7dxMKqiuHsLAd8"><img class="alignleft wp-image-400472" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Spotify-Podcast.png" alt="" width="200" height="48" /></a><a href="https://tunein.com/podcasts/Podcasts/The-guest-culture-of-Forever--News-p1270116/"><img class="alignleft wp-image-400473" src="https://bx1.be/wp-content/uploads/2019/11/Logo-TuneIn.png" alt="" width="200" height="52" /></a><a href="https://pca.st/itunes/1485746767"><img class="alignnone wp-image-400471" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Pocket-Podcasts.png" alt="" width="200" height="56" /></a><a href="https://overcast.fm/itunes1485748110/bx1-micro-ouvert"><img class="alignleft wp-image-400470" src="https://bx1.be/wp-content/uploads/2019/11/Logo-Overcast.png" alt="" width="200" height="53" /></a>
<?php get_footer(); ?>