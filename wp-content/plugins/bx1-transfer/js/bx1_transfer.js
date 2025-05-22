var $ = jQuery.noConflict();

$(function(){
  $('#bx1_share_youtube').click(function(event) {
    var video_name = '';
    if ($('[name="wpcf[video-name-news]"]').length > 0) {
      video_name = $('[name="wpcf[video-name-news]"]').val();
    }
    else if ($('[name="wpcf[nom-du-fichier-video]"]').length > 0) {
      video_name = $('[name="wpcf[nom-du-fichier-video]"]').val();
    }
    if (!video_name) {
      alert("Un nom de vidéo doit être spéficiée pour pouvoir l'uploader sur YouTube.");
      return;
    }

    var title = $('[name="post_title"]').val();
    var desc = $('#sample-permalink a').attr('href');
   
    var window_url = location.protocol + "//" + window.location.hostname + "/wp-content/plugins/bx1-transfer/php/bx1-transfer-youtube.php";  
    var mapForm = document.createElement("form");
    mapForm.target = "Map";
    mapForm.method = "post";
    mapForm.action = window_url;

    var videoInput = document.createElement("input");
    videoInput.type = "hidden";
    videoInput.name = "video";
    videoInput.value = video_name;
    mapForm.appendChild(videoInput);
    
    var titleInput = document.createElement("input");
    titleInput.type = "hidden";
    titleInput.name = "title";
    titleInput.value = $('[name="post_title"]').val();
    mapForm.appendChild(titleInput);
    
    var descInput = document.createElement("input");
    descInput.type = "hidden";
    descInput.name = "desc";
    descInput.value = $('#sample-permalink a').attr('href');
    mapForm.appendChild(descInput);

    document.body.appendChild(mapForm);
    map = window.open("", "Map", "status=0,title=0,height=600,width=800,scrollbars=1");

    if (map) {
      mapForm.submit();
    }
    else {
      alert("Vous devez autoriser les popups pour pouvoir uploader une vidéo sur YouTube.");
    }
  });
    
  $('#bx1_share_facebook').click(function(event) {
    var video_name = '';
    if ($('[name="wpcf[video-name-news]"]').length > 0) {
      video_name = $('[name="wpcf[video-name-news]"]').val();
    }
    else if ($('[name="wpcf[nom-du-fichier-video]"]').length > 0) {
      video_name = $('[name="wpcf[nom-du-fichier-video]"]').val();
    }
    if (!video_name) {
      alert("Un nom de vidéo doit être spéficiée pour pouvoir l'uploader sur Facebook.");
      return;
    }

    var title = $('[name="post_title"]').val();
    var desc = $('#sample-permalink a').attr('href');
   
    var window_url = location.protocol + "//" + window.location.hostname + "/wp-content/plugins/bx1-transfer/php/bx1-transfer-facebook.php";  
    console.log(window_url, 'window_url'); // TODO clean
    var mapForm = document.createElement("form");
    mapForm.target = "Map";
    mapForm.method = "post";
    mapForm.action = window_url;

    var videoInput = document.createElement("input");
    videoInput.type = "hidden";
    videoInput.name = "video";
    videoInput.value = video_name;
    mapForm.appendChild(videoInput);
    
    var titleInput = document.createElement("input");
    titleInput.type = "hidden";
    titleInput.name = "title";
    titleInput.value = $('[name="post_title"]').val();
    mapForm.appendChild(titleInput);
    
    var descInput = document.createElement("input");
    descInput.type = "hidden";
    descInput.name = "desc";
    descInput.value = $('#sample-permalink a').attr('href');
    mapForm.appendChild(descInput);

    document.body.appendChild(mapForm);
    map = window.open("", "Map", "status=0,title=0,height=600,width=800,scrollbars=1");

    if (map) {
      mapForm.submit();
    }
    else {
      alert("Vous devez autoriser les popups pour pouvoir uploader une vidéo sur Facebook.");
    }
  });
});
