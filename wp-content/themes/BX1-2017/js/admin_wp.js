/* Script chargé uniquement dans l'admin de Wordpress */
var $ = jQuery.noConflict();

$(function(){
  /* Condition d'affiche des options de présentation BX1 */
  function showPres(){
    if($('#home_site').val() == 'actu'){
        $('label[for="home_pres"],select#home_pres').show();
    }
    else{
      $('label[for="home_pres"],select#home_pres').hide();
    }
  }
  $('#home_site').change(showPres);
  showPres();
 
/*  if($('body').hasClass('post-type-post')) {
    // Poster vidéo automatiquement sur Youtube/Facebook 
    if($('[name="wpcf[publish-facebook]"]').is(':checked')){
      sessionStorage.setItem('facebook','1');
    }
    else{
      sessionStorage.setItem('facebook','0');
    }
    if($('[name="wpcf[publish-youtube]').is(':checked')){
      sessionStorage.setItem('youtube','1');
    }
    else{
      sessionStorage.setItem('youtube','0');
    }
    var facebook = sessionStorage.getItem('facebook');
    var youtube = sessionStorage.getItem('youtube');
    var newFacebook = 0;
    var newYoutube = 0;
    $('[name="wpcf[publish-facebook]').change(function(){
      if($(this).is(':checked')){
        newFacebook = '1';
      }
      else{
        newFacebook = '0';
        if(facebook == '1'){
          alert('Attention : Si la vidéo a déjà été postée sur Facebook (case cochée et article publié), elle restera sur Facebook malgré que vous décochiez cette case. Si vous décocher la case pour supprimer la vidéo de Facebook, vous devez aussi aller supprimer la vidéo sur le compte Facebook de BX1. Attention aux possibles doublons de vidéo sur Facebook si vous décochez la case et la recochez plus tard, sans supprimer la vidéo sur Facebook.');
        }
      }
    });
    $('[name="wpcf[publish-youtube]').change(function(){
      if($(this).is(':checked')){
        newYoutube = '1';
      }
      else{
        newYoutube = '0';
        if(youtube == '1'){
          alert('Attention : Si la vidéo a déjà été postée sur Youtube (case cochée et article publié), elle restera sur Youtube malgré que vous décochiez cette case. Si vous décocher la case pour supprimer la vidéo de Youtube, vous devez aussi aller supprimer la vidéo sur le compte Youtube de BX1. Attention aux possibles doublons de vidéo sur Youtube si vous décochez la case et la recochez plus tard, sans supprimer la vidéo sur Youtube.');
        }
      }
    });
    $('body').on('click','#publish',function(){
      var videoFile = $('[name="wpcf[video-name-news]"]').val();
      if(facebook == '0' && newFacebook == '1' && videoFile != ''){
        alert('La vidéo va être postée sur Facebook d\'ici quelques minutes');
      }
      if(youtube == '0' && newYoutube == '1' && videoFile != ''){
        alert('La vidéo va être postée sur Youtube d\'ici quelques minutes');
      }
    });
    // pas oublier de reset les sessionstorage pour pas poser problème sur les autres posts 
    // pas oublier de faire ça pour tous les types de contenu 
  }*/

});
