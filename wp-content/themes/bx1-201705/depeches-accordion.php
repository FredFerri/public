<dl class="accordion depeches-accordion" data-accordion>
  <?php

    $args = array(
    'post_type' => 'depeches',
    'posts_per_page' => 6
    );

    $query = new WP_Query($args);
    if ( $query->have_posts() ) {
      while ( $query->have_posts() ) : $query->the_post(); ?>

        <?php
        $title = get_the_title();
        $url = get_permalink();
        $postid = get_the_ID();
        $postexcerpt = do_shortcode('[wpv-post-excerpt length="300"]');
        $postdate = get_the_date( 'j F Y', $postid );
        ?>

      <dd class="accordion-navigation">
        <a href="#panel<?php echo $postid; ?>">
        <span class="accordion-nav-date"><?php echo $postdate; ?></span>
        <?php echo $title ?>
        </a>
        <div id="panel<?php echo $postid; ?>" class="content">
        <?php echo $postexcerpt; ?>
        <p>Belga</p>
        <?php echo share(); ?>
        </div>
      </dd>

      <?php endwhile; ?>

    <?php
    }

    wp_reset_postdata();
  ?>
</dl>
