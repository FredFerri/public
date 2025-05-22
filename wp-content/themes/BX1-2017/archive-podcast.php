<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : archive-bxl-vit.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 26 February 2020
 *   Don't edit this code without authorization
 *********************************************/
get_header('v2'); ?>

<div style="margin-bottom:30px">
    <?php 
      $terms = get_the_terms( $post->ID, 'radio-type_emissions');
      //$itunepodcast = get_term_meta(get_queried_object_id(),'wpcf-radio-url-podcast-itunes', true);
      foreach ( $terms as $term ) {
          $termID[] = $term->slug;
          $termDSC[] = $term->description;
      }
      $the_term_id = $termID[0];
      //echo $the_term_id;
      ?>
    <div style="display:block;width: 100%; text-align: center;  height:150px"><img style="border-radius:10px 10px 0 0; height: 150px;" src="<?php echo get_template_directory_uri();?>/images/bannerradio/<?php echo $the_term_id; ?>.jpg"></div>
    <div style="width: 100%;margin:auto;font-weight: bold;text-align: center;padding-top:25px;padding-bottom:10px;border-radius: 0 0 10px 10px;color:#FFF;background: rgb(113,6,55);background: linear-gradient(180deg, rgba(113,6,55,1) 0%, rgba(235,31,124,1) 25%, rgba(235,31,124,1) 100%);">
      <div style="width: 60%;margin:auto"><?php echo $termDSC[0];?> </div>
    </div>
  </div>

<div>
<?php while ( have_posts() ) : the_post(); ?>
                        <article class="news__article odd">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <h3><?php the_title(); ?></h3>
                            </a>
                            <div style="font-size:18px;font-weight: bold"><?php the_date(); ?></div>
                            <div style="font-size:14px"><?php
//assign content of a custom field
$content  = get_the_content();
 
$trimmed_content = wp_trim_words($content, 25, '...');
 
echo $trimmed_content;
?> 
</div>
<br />
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                              <figure>
                                <?php the_post_thumbnail( 'medium' ); ?>
                              </figure>
                            </a>
                        </article>

	<?php endwhile; // end of the loop. ?>

  <?php wp_paginate(); ?>

   	</div>