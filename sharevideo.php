<?php
	$video 	=	$_GET['videofile'];
	if(!isset($video) || empty($video))
		{
			echo 'No video';
		}
?>
<html>
	<head>
		<title>BX1 - Video Share</title>
		<script src="/js/jwplayer/jwplayer.js"></script>
  		<script>jwplayer.key = "uV+9Z88Ot1pSaRYTCyutEuffNeCwl8SCX1R0uQ==";</script>
  		<script src="http://content.jwplatform.com/libraries/Neb1cMqn.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>
	<body>
	<div class="container">
		<div class="row">
			<div class="col-md-3 hidden-xs hidden-sm">&nbsp;</div>
			<div class="col-md-6 text-center"><a href="http://bx1.be/"><img src="/img/BX1_logo.jpg"></a><br><br></div>
			<div class="col-md-3 hidden-xs hidden-sm">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 hidden-xs hidden-sm">&nbsp;</div>
			<div class="col-md-6"><div id="video"></div></div>
			<div class="col-md-3 hidden-xs hidden-sm">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-3 hidden-xs hidden-sm">&nbsp;</div>
			<div class="col-md-6 text-center"><br><br>&copy; Tous droits réservés à BX1</div>
			<div class="col-md-3 hidden-xs hidden-sm">&nbsp;</div>
		</div>
    </div>
		
		<script>
            jwplayer("video").setup({
              sources: [{
                  file: "rtmp://62.210.248.77:1935/vod/mp4:" + "<?php echo $video; ?>" + ".mp4"},{
                  file: "http://62.210.248.77:1935/vod/mp4:" + "<?php echo $video; ?>" + ".mp4" + "/playlist.m3u8"
              }],
              primary: "html5",
              width: "100%",
              aspectratio: "16:9",
              androidhls: true
            });
         </script>
	</body>
</html>