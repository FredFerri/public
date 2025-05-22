<?php
switch ($_GET["type"]) {
	case 'chronique':
		require_once("../../../../wp-load.php");
		add_image_size( 'list-thumb', 99999999, 175 );
            add_filter( 'list', 'list-thumb' );
            $loop = new WP_Query( array('post_type' => 'radio-chronique', 'posts_per_page' => 4, 'paged' => $_GET["page"]));
                while ( $loop->have_posts() ) :
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'list-thumb');
                  $imagelink  = explode(".", $image[0]);
                  $imageext   = end($imagelink);
                  $imageextl  = strlen(".".$imageext);
                  $newimageln = substr($image[0], 0,-$imageextl);
                  $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                  echo "<a href=\"" . get_the_permalink() . "\"><img src=\"" . $image[0] . "\"></a>";
                  echo "<div class=\"listeBlocTXT\"><span class=\"titreChronique\">" . get_the_title() . "</span>";
                  echo "<span class=\"dateChronique\">" . types_render_field('date-chronique') . "</span></div>";
                endwhile;
                wp_reset_postdata();
		break;
	case 'emission':
		require_once("../../../../wp-load.php");
		add_image_size( 'list-thumb', 260, 9999 );
            add_filter( 'list', 'list-thumb' );
            $loop = new WP_Query( array('post_type' => 'radio-emission', 'posts_per_page' => 4, 'paged' => $_GET["page"]));
                while ( $loop->have_posts() ) :
                  $loop->the_post();
                  $do_not_duplicate[] = $post->ID;
                  $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'list-thumb');
                  $imagelink  = explode(".", $image[0]);
                  $imageext   = end($imagelink);
                  $imageextl  = strlen(".".$imageext);
                  $newimageln = substr($image[0], 0,-$imageextl);
                  $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;
                  $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
                  echo "<a href=\"" . get_the_permalink() . "\"><img src=\"$newimage\"></a>";
                  echo "<div class=\"listeBlocTXT\"><span class=\"titreEmission\">" . get_the_title() . "</span>";
                  echo "<span class=\"dateEmission\">" . types_render_field('date-chronique') . "</span></div>";
                endwhile;
                wp_reset_postdata();
		break;

	default:
		# code...
		break;
}

?>