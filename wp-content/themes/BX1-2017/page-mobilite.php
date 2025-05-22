<?php

/**
 * Template Name: Mobilité
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

    <section class="news">
      <?php while ( have_posts() ) : the_post(); ?>
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
      <?php endwhile; // end of the loop. ?>

      <h2>État du trafic bruxellois en temps réel</h2>
      
      <div id="mapTrafic"></div>
      
      <script>
        function initMap() {
          var map = new google.maps.Map(document.getElementById('mapTrafic'), {
            zoom: 12,
            center: {lat: 50.849535, lng: 4.349640}
          });

          var trafficLayer = new google.maps.TrafficLayer();
          trafficLayer.setMap(map);
        }
      </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAWA5tZFfDQnNSeUXAwmLyEK41CKOK5T5c&callback=initMap">
      </script>

      <h2>Les travaux en cours à Bruxelles-Capitale</h2>

      <iframe src="https://opendata.bruxelles.be/explore/embed/dataset/evenements-trafic-travaux/map/?location=12,50.84499,4.35359&static=false&datasetcard=false" width="100%" height="650" frameborder="0"></iframe>

    </section>

    <section class="sideFil">
      <?php dynamic_sidebar('filinfo2'); ?>
      <?php dynamic_sidebar('sidebar-3'); ?>
    </section>

<?php get_footer('v2'); ?>

