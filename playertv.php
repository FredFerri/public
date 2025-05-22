<html lang="en">
<head>
	<title> BX1 - TV Live</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
</head>
<body>
<?php
$usevimeo=0; //$usevimeo=0; pour activer Wowza - $usevimeo=1; Pour activer Vimeo
$vimeolink="https://vimeo.com/event/4208796/embed/1a4fedd6b1";
//include_once ("includes/headertv.inc.php");
	if($usevimeo == 1 && $vimeolink != ""){
		?>
		<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="<?php echo $vimeolink; ?>" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>
	<?php
	}
	else{ 
	  ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jwplayer.com/libraries/Neb1cMqn.js" ></script>
<div id="videoLive"></div>
<script>
	document.addEventListener("gestcomVideo", function(e) {
		jwplayer("videoLive").setup({
		  playlist: [{
			  "sources": [{
				  "file": "rtmps://59959724487e3.streamlock.net:443/stream/live"
			  }, {
				  "file": "https://59959724487e3.streamlock.net:443/stream/live/playlist.m3u8", type:"mp4"
			  }]
		  }],
		  primary: 'html5',
		  width: '100%',
		  aspectratio: '16:9',
		  autostart: true,
		  androidhls: true,
		  localization: {
					   loadingAd : 'Chargement de la publicité',
					   liveBroadcast : 'Direct'
				},
		  advertising: {
				  client: 'vast',
				  admessage: 'Cette publicité se termine dans xx secondes',
				  skipmessage: 'Continuer vers l\'article dans XX secondes',
				  skiptext: 'Continuer',
				  skipoffset: 5,
				  schedule: {
						  adbreak1: {
							offset: "pre",
							tag: e.detail.vastUrl
						  }             
				  }
				}
		})
	});
  </script>
<?php 
	}
	//include_once ("includes/footertv.inc.php");
?>
<script src="https://gestcom.divercom.be/w/bx1/30" async defer></script>
</body>
</html>
