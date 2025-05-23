<?php
/**
 * @package TeleBruxelles
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
   <header class="entry-header">
      <div class="entry-meta">
         <?php telebruxelles_posted_on(); ?>
      </div><!-- .entry-meta -->
      <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
      <?php echo share(); ?>
   </header><!-- .entry-header -->

   <div class="entry-content">
      <?php
         $videoName = types_render_field('video-name-news', array('raw'=>'true'));
         if ( !empty($videoName) ) { ?>
         <div id="video"></div>
         <script>
            jwplayer("video").setup({
              image: "<?php $image_news = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); echo $image_news[0]; ?>",
              sources: [{
                  file: "rtmp://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4"},{
                  file: "http://149.202.81.107:1935/vod/mp4:" + "<?php echo types_render_field('video-name-news'); ?>" + ".mp4" + "/playlist.m3u8"
              }],
              primary: "html5",
              width: "100%",
              aspectratio: "16:9",
              androidhls: true,
              advertising: {
                client: 'vast',
                schedule: {
                        adbreak1: {
                          offset: "pre",
                          tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-preroll/?t=' + Math.floor(Date.now() / 1000)
                        },
                        adbreak2: {
                          offset: "post",
                          tag: 'https://ads-rmb.adhese.com/ad/sl_telebruxelles_-postroll/?t=' + Math.floor(Date.now() / 1000)
                        }                 
                }
              }
            });
            </script>         
      <?php }  ?>
      <?php the_content(); ?>
   </div><!-- .entry-content -->
</article><!-- #post-## -->




<!-- Begin MailChimp Signup Form -->
<div id="mc_embed_signup" class="panel panel-mailchimp-form">
  <form action="//bx1.us13.list-manage.com/subscribe/post?u=775158238761fcbff1e56e294&amp;id=16e5ba96fd" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
    <div id="mc_embed_signup_scroll">
      <h4 id="mc-register" class="mc-register-toggle">Abonnez-vous à nos newsletters</h4>
      <div class="form-content" style="display: none;">
        <div class="indicates-required"><span class="asterisk">*</span> indique les champs obligatoires</div>
        <div class="mc-field-group row">
          <div class="large-12 columns">
            <label for="mce-EMAIL">Email  <span class="asterisk">*</span></label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
        </div>
        <div class="mc-field-group row input-group">
          <div class="large-12 columns">
            <strong>Titre  <span class="asterisk">*</span></strong>
            <div class="row">
              <div class="large-6 columns"><input type="radio" value="Monsieur" name="TITRE" id="mce-TITRE-0"><label for="mce-TITRE-0">Monsieur</label></div>
              <div class="large-6 columns"><input type="radio" value="Madame" name="TITRE" id="mce-TITRE-1"><label for="mce-TITRE-1">Madame</label></div>
            </div>
          </div>
        </div>
        <div class="mc-field-group row">
          <div class="large-6 columns">
            <label for="mce-FNAME">Prénom  <span class="asterisk">*</span></label>
            <input type="text" value="" name="FNAME" class="required" id="mce-FNAME">
          </div>
          <div class="large-6 columns">
            <label for="mce-LNAME">Nom  <span class="asterisk">*</span></label>
            <input type="text" value="" name="LNAME" class="required" id="mce-LNAME">
          </div>
        </div>
        <div class="mc-field-group row">
          <div class="large-12 columns">
            <label for="mce-BDAY-month">Date de naissance  <span class="asterisk">*</span></label>
          </div>
          <div class="datefield">
            <div class="large-4 columns">
              <span class="subfield dayfield"><input class="datepart required" type="text" pattern="[0-9]*" value="" placeholder="Jour" size="2" maxlength="2" name="BDAY[day]" id="mce-BDAY-day"></span>
            </div>
            <div class="large-4 columns">
              <span class="subfield monthfield"><input class="datepart required" type="text" pattern="[0-9]*" value="" placeholder="Mois" size="2" maxlength="2" name="BDAY[month]" id="mce-BDAY-month"></span>
            </div>
            <div class="large-4 columns">
              <span class="small-meta nowrap">(jj/mm)</span>
            </div>
          </div>
        </div>
        <div class="mc-field-group row">
          <div class="large-12 columns">
            <label for="mce-ZIP">Code postal  <span class="asterisk">*</span></label>
            <input type="number" name="ZIP" class="required" value="" id="mce-ZIP">
          </div>
        </div>
        <div class="row">
          <div class="mc-field-group large-6 columns">
            <label for="mce-QUOTI12">Actu quotidienne 12h  <span class="asterisk">*</span></label>
            <select name="QUOTI12" class="required" id="mce-QUOTI12">
              <option value=""></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
          </div>
          <div class="mc-field-group large-6 columns">
            <label for="mce-QUOTI17">Actu quotidienne 17h  <span class="asterisk">*</span></label>
            <select name="QUOTI17" class="required" id="mce-QUOTI17">
              <option value=""></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
          </div>
          <div class="mc-field-group large-6 columns">
            <label for="mce-MMERGE8">Actu samedi 10h  <span class="asterisk">*</span></label>
            <select name="MMERGE8" class="required" id="mce-MMERGE8">
              <option value=""></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
          </div>
          <div class="mc-field-group large-6 columns">
            <label for="mce-MMERGE9">Events BX1 &amp; partenaires  <span class="asterisk">*</span></label>
            <select name="MMERGE9" class="required" id="mce-MMERGE9">
              <option value=""></option>
              <option value="Oui">Oui</option>
              <option value="Non">Non</option>
            </select>
          </div>
        </div>
        <p><a href="http://us13.campaign-archive2.com/home/?u=775158238761fcbff1e56e294&amp;id=16e5ba96fd" title="Voir les précédentes newsletters">Voir les précédentes newsletters.</a></p>
        <div id="mce-responses" class="clear">
          <div class="response" id="mce-error-response" style="display:none"></div>
          <div class="response" id="mce-success-response" style="display:none"></div>
        </div>
        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_775158238761fcbff1e56e294_16e5ba96fd" tabindex="-1" value=""></div>
        <div class="clear"><input type="submit" value="S'abonner" name="subscribe" id="mc-embedded-subscribe" class="button mc-subscribe-btn"></div>
      </div>
    </div>
  </form>
</div>
<!--End mc_embed_signup-->

<script>
jQuery( "#mc-register" ).click(function() {
  jQuery( ".form-content" ).toggle('slow');
});
</script>
