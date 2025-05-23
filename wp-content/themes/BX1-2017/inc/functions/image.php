<?php

function mk_image($attachment_id = false, $format = false, $class = false, $id = false, $eager = false, $custom_sizes = false, $fetchpriority = false) {
	if ($attachment_id == false) {
		$attachment_id = get_post_thumbnail_id(get_the_ID());
	}

	$extension = substr(get_attached_file($attachment_id), -3);

	if ($format == false) {
		$Src        = wp_get_attachment_image_url($attachment_id, 'full');
		$Srcset     = wp_get_attachment_image_srcset($attachment_id, 'full');
		$Sizes      = wp_get_attachment_image_sizes($attachment_id, 'full');
	} else {
		$Src        = wp_get_attachment_image_url($attachment_id, $format);
		$Srcset     = wp_get_attachment_image_srcset($attachment_id, $format);
		$Sizes      = wp_get_attachment_image_sizes($attachment_id, $format);
	}

	// Générer des sizes plus appropriés si pas de custom_sizes fourni
	if ($custom_sizes !== false) {
		$Sizes = $custom_sizes;
	} else {
		// Sizes par défaut plus modernes et responsive
		$Sizes = '(max-width: 480px) 100vw, (max-width: 768px) 100vw, (max-width: 1024px) 75vw, 50vw';
	}

	/*
    if (empty($Src)) {
        $Src         = get_template_directory_uri() . '/assets/img/default-placeholder.jpg';
    }
    */
	$alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
	if (empty($alt)) {
		$alt = false;
	} else {
		$alt = 'alt="' . $alt . '"';
	}

	if (!empty($id)) {
		$id = 'id="' . $id . '"';
	}

	if (!empty($Srcset)) {
		$Srcset = 'srcset="' . $Srcset . '"';
	}

	if (!empty($Sizes) && !empty($Srcset)) {
		$Sizes = 'sizes="' . $Sizes . '"';
	}

	$loading = $eager ? "eager" : "lazy";
	$fetchpriority_attr = '';

	// Ajouter fetchpriority si spécifié et valide
	if (!empty($fetchpriority) && in_array($fetchpriority, ['high', 'low', 'auto'])) {
		$fetchpriority_attr = ' fetchpriority="' . $fetchpriority . '"';
	}

	if (!empty($Src)) {
		if (
			function_exists('get_rocket_option')
			&& get_rocket_option('lazyload')
			&& !(defined('DONOTROCKETOPTIMIZE') && DONOTROCKETOPTIMIZE)
		) {

			if ($extension == 'svg' or empty($Srcset)) {
				return '<img ' . $id . ' class="' . $class . '" src="' . $Src . '" ' . $alt . ' loading="' . $loading . '"' . $fetchpriority_attr . ' />';
			} else {
				return '<img ' . $id . ' class="' . $class . '" src="data:image/gif;base64,R0lGODdhAQABAPAAAP///wAAACwAAAAAAQABAEACAkQBADs=" ' . $Srcset . ' ' . $Sizes . ' data-lazy-src="' . $Src . '" ' . $alt . ' loading="' . $loading . '"' . $fetchpriority_attr . ' />';
			}
		} else {
			if ($extension == 'svg' or empty($Srcset)) {
				return '<img ' . $id . ' class="' . $class . '" src="' . $Src . '" ' . $alt . ' loading="' . $loading . '"' . $fetchpriority_attr . ' />';
			} else {
				return '<img ' . $id . ' class="' . $class . '" src="' . $Src . '" ' . $Srcset . ' ' . $Sizes . ' ' . $alt . ' loading="' . $loading . '"' . $fetchpriority_attr . ' />';
			}
		}
	}
}


// Add thumbnail class to thumbnail links
function add_class_attachment_link($html) {
	$postid = get_the_ID();
	$html = str_replace('<a', '<a class="thumbnail"', $html);
	return $html;
}

function add_rel_lightbox($content) {

	/* Find internal links */

	//Check the page for link images direct to image (no trailing attributes)
	$string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';
	preg_match_all($string, $content, $matches, PREG_SET_ORDER);

	//Check which attachment is referenced
	foreach ($matches as $val) {

		$slimbox_caption = '';

		$post = get_post($val[5]);
		$slimbox_caption = esc_attr($post->post_content);

		//Replace the instance with the lightbox and title(caption) references. Won't fail if caption is empty.
		$string = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$replace = '<a href="' . $val[1] . '.' . $val[2] . '" rel="lightbox" title="' . $slimbox_caption . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
		$content = str_replace($string, $replace, $content);
	}

	return $content;
}

/* Filter Hook */

add_filter('the_content', 'add_rel_lightbox', 2);


//Récupère la valeur d'un champ acf pour assigner l'image à la une. (On rassemble ainsi les images en gestion acf)
// add_action('acf/save_post', 'setPostThumbnailFromAcf', 50);
function setPostThumbnailFromAcf() {

	global $post;

	if (!isset($post->ID))
		return;
	$post_id                = ($post->ID); // Current post ID

	if (get_post_type($post_id) == 'post') {
		$post_custom_featured  = get_field('featured_by_acf', $post_id); // ACF field

		if (!empty($post_id)) {
			if (!empty($post_custom_featured)) {
				$post_image_id          = $post_custom_featured['id']; // ACF image filed ID
				$post_image_url         = $post_custom_featured['url']; // ACF image filed URL
				if (($post_image_url) and (($post_image_url) != (get_the_post_thumbnail()))) {
					update_post_meta($post_id, '_thumbnail_id', $post_image_id);
				}
			} else {
				update_post_meta($post_id, '_thumbnail_id', 0);
			}
		}
	} else {
		$post_banner            = get_field('display_ban_image', $post_id); // ACF field
		$post_banner_check      = get_field('display_ban_image_check', $post_id);

		if (!empty($post_id)) {
			if (!empty($post_banner) && $post_banner_check) {
				$post_image_id          = $post_banner['id']; // ACF image filed ID
				$post_image_url         = $post_banner['url']; // ACF image filed URL
				if (($post_image_url) and (($post_image_url) != (get_the_post_thumbnail()))) {
					update_post_meta($post_id, '_thumbnail_id', $post_image_id);
				}
			} else {
				update_post_meta($post_id, '_thumbnail_id', 0);
			}
		}
	}
}
