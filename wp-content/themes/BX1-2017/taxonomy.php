<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>
<?php
        $currentcat =   get_queried_object()->term_id;
        if ($_GET["debug"] == 1)
            {
                echo $currentcat;
            }
        if ($currentcat=="13255")
            {
	            get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13252")
            {
	            get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13256")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13253")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13257")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13258")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13262")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13259")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13260")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "13261")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "15803")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "15901")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "20914")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21028")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21029")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21030")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21031")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21032")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21033")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21035")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21036")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21037")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21172")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21170")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21357")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "21676")
            {
                get_template_part( 'archive', 'podcast' );
            }
            elseif ($currentcat == "23409")
            {
                get_template_part( 'archive', 'podcast' );
            }
        elseif ($currentcat == "23446")
           {
                get_template_part( 'archive', 'podcast' );
           }
   elseif ($currentcat == "23458")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "23531")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "23557")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "24877")
      {
           get_template_part( 'archive', 'podcast' );
      }

      elseif ($currentcat == "25019")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "24313")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "25321")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "25320")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "25027")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "21678")
      {
           get_template_part( 'archive', 'podcast' );
      }
      elseif ($currentcat == "23755")
      {
           get_template_part( 'archive', 'podcast' );
      }

      elseif ($currentcat == "26245")
      {
           get_template_part( 'archive', 'podcast' );
      }

      elseif ($currentcat == "26349")
      {
           get_template_part( 'archive', 'podcast' );
      }
      
        else {
	        ?>
            <section class="news">

		        <?php if ( have_posts() ) : ?>

                    <h1 class="section-title section-title--emissions"><?php echo single_cat_title( '', false ); ?></h1>

			        <?php while ( have_posts() ) : the_post(); ?>

                        <article class="news__article">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <h3><?php the_title(); ?></h3>
                                <figure>
							        <?php the_post_thumbnail( 'medium' ); ?>
                                </figure>
                            </a>
                        </article>

			        <?php endwhile; ?>

			        <?php wp_pagenavi(); ?>

		        <?php else : ?>

			        <?php get_template_part( 'content', 'none' ); ?>

		        <?php endif; ?>

            </section>

            <section class="sideFil">
              <?php dynamic_sidebar('filinfo2'); ?>
              <?php dynamic_sidebar('sidebar-3'); ?>
            </section>

	        <?php
        }
            get_footer('v2'); ?>