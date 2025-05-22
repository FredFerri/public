<?php
 /**
 * Template Name: Home
 *
 **
 * @package TeleBruxelles
 */

get_header(); ?>

   <div id="primary" class="content-area large-8 columns">
      <main id="main" class="site-main" role="main">

         <section>
            <h2 class="section-title section-title--news">L’info en images <span class="section-title-all"><a href="/news">Toute l'info</a></span></h2>

            <?php dynamic_sidebar( 'info-bar' ); ?>

            <div class="row" data-equalizer data-options="equalize_on_stack: true">
               <?php echo do_shortcode('[wpv-view name="news-homepage"]'); ?>
            </div>
         </section>

         <section>
            <h2 class="section-title section-title--depeche">Fil d'actu <span class="section-title-all"><a href="/depeches">Toutes les dépêches</a></span></h2>
            <?php include 'depeches-accordion.php'; ?>
         </section>

      </main><!-- #main -->
   </div><!-- #primary -->

   <?php get_sidebar(); ?><!-- #secondary -->

</div><!-- #content -->

  <?php if ( is_front_page() ) { ?>

    <?php //echo do_shortcode('[wpv-view name="banner-leaderboard"]'); ?>

    <div class="row-ads row-ads--bottom">
      <div id="pebbleSplash">
        <script type="text/javascript"> adhese.tag({ format: "Splash", publication:"tele-bruxelles", location: "homepage",});</script>
      </div>
    </div>

   <section class="row">
      <div class="large-12 columns">
         <h2 class="section-title section-title--sport">Sport <span class="section-title-all"><a href="/category/sport/">Tout le sport</a></span></h2>

         <div class="row" data-equalizer data-options="equalize_on_stack: true">
            <?php echo do_shortcode('[wpv-view name="sport-homepage"]'); ?>
         </div>
      </div>
   </section>

   <section class="row">
      <div class="large-12 columns">
         <h2 class="section-title section-title--emissions">Émissions <span class="section-title-all"><a href="/emissions">Toutes les émissions</a></span></h2>
         <div class="row" data-equalizer data-options="equalize_on_stack: true">
            <?php include('inc/get-type-emissions.php'); ?>
         </div>
      </div>
   </section>

   <?php } else { ?>

  <div class="row-ads row-ads--bottom">
    <div id="pebbleSplash">
      <script type="text/javascript"> adhese.tag({ format: "Splash", publication:"tele-bruxelles", location: "others",});</script>
    </div>
  </div>

   <?php } ?>

<?php get_footer(); ?>
