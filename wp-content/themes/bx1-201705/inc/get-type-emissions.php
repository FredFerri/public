<?php
   // Display 4 categories sorted by last update
   $cat_array = array();
   $args=array(
    'post_type' => 'emission',
    'post_status' => 'publish',
    'posts_per_page' => 4
    );
   $my_query = null;
   $my_query = new WP_Query($args);
   if( $my_query->have_posts() ) {
    while ($my_query->have_posts()) : $my_query->the_post();
      $cat_args=array('orderby' => 'none');
      $cats = wp_get_post_terms( $post->ID , 'type_emissions', $cat_args);
      foreach($cats as $cat) {
        array_push($cat_array, $cat->term_id);
      }
    endwhile;
   }
   if ($cat_array) {
    foreach($cat_array as $cat) {
      $category = get_term_by('id',$cat, 'type_emissions');

      global $wp_query;
        $term = get_term_by('id',$cat, 'type_emissions');
        $wp_query->queried_object = $term;
        $img_url = apply_filters( 'taxonomy-images-queried-term-image-url', '', array(
         'image_size'   => 'Emissions'
      ) );
         $wp_query->queried_object = wp_reset_query();
   ?>

      <div class="news news--emissions large-3 medium-6 columns">
         <a class="news__link-img" href="<?php echo esc_attr(get_term_link($category, 'type_emissions')); ?>">
            <img class="news__img" src="<?php echo $img_url; ?>" alt="<?php echo $category->name; ?>">
         </a>
         <h3 class="news__title" data-equalizer-watch><a class="news__title-link" href="<?php echo esc_attr(get_term_link($category, 'type_emissions')); ?>"><?php echo $category->name; ?></a></h3>
      </div>

   <?php
    }
   }
   wp_reset_query();
?>