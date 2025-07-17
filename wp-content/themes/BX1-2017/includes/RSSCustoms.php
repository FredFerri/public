<?php
require('../../../../wp-load.php');
header('Content-type: application/rss+xml;charset=UTF-8');
function limit_words($words, $limit, $append = '&hellip;') {
	// Add 1 to the specified limit becuase arrays start at 0
	$limit = $limit + 1;
	// Store each individual word as an array element
	// Up to the limit
	$words = explode(' ', $words, $limit);
	// Shorten the array by 1 because that final element will be the sum of all the words after the limit
	array_pop($words);
	// Implode the array for output, and append an ellipse
	$words = implode(' ', $words) . $append;
	// Return the result
	return $words;
}
date_default_timezone_set('Europe/Brussels');
$xw = xmlwriter_open_memory();
xmlwriter_set_indent($xw, 1);
$res = xmlwriter_set_indent_string($xw, ' ');

xmlwriter_start_document($xw, '1.0', 'UTF-8');

// Attribute element 'rss'
xmlwriter_start_element($xw, 'rss');
xmlwriter_start_attribute($xw, 'xmlns:g');
xmlwriter_text($xw, 'http://base.google.com/ns/1.0');
xmlwriter_start_attribute($xw, 'version');
xmlwriter_text($xw, '2.0');
xmlwriter_end_attribute($xw);

// Start Channel
xmlwriter_start_element($xw, 'channel');

xmlwriter_start_element($xw, 'description');
if (isset($_GET["category"])) {
	$details = $_GET["category"];
} elseif (isset($_GET["tag"])) {
	$details = "TAG : " . $_GET["tag"];
} elseif (isset($_GET["type_emission"])) {
	$details = "EMISSION : " . $_GET["type_emission"];
}
xmlwriter_text($xw, "Flux RSS de BX1 - " . ucfirst($details));
xmlwriter_end_element($xw); // title

// Attribute element 'title'
xmlwriter_start_element($xw, 'title');
xmlwriter_text($xw, "BX1 - " . ucfirst($details));
xmlwriter_end_element($xw); // title

// Attribute element 'link'
xmlwriter_start_element($xw, 'link');
xmlwriter_text($xw, "https://bx1.be/");
xmlwriter_end_element($xw); // link

// Attribute element 'copyright'
xmlwriter_start_element($xw, 'copyright');
xmlwriter_text($xw, "BX1 - " . date("Y") . ". Tous droits réservés.");
xmlwriter_end_element($xw); // copyright

// Attribute element 'language'
xmlwriter_start_element($xw, 'language');
xmlwriter_text($xw, "fr");
xmlwriter_end_element($xw);
// language


// Attribute element 'lastBuildDate'
xmlwriter_start_element($xw, 'lastBuildDate');
$dt = new DateTime('now', new DateTimezone('Europe/Brussels'));
xmlwriter_text($xw, $dt->format('D, d M Y H:i:s O'));
xmlwriter_end_element($xw); // lastBuildDate

wp_reset_query();
if (isset($_GET["posts"]) && $_GET["posts"] >= 1) {
	$post_per_page = $_GET["posts"];
} else {
	$post_per_page = 10;
}
if (isset($_GET["category"])) {
	$loop = new WP_Query(
		array(
			//'meta_key' => '_yoast_wpseo_primary_radio-type_emissions',
			'category_name'      => $_GET["category"],
			'posts_per_page' => $post_per_page
		)
	);
} elseif (isset($_GET["tag"])) {
	$loop = new WP_Query(
		array(
			//'meta_key' => '_yoast_wpseo_primary_radio-type_emissions',
			'tag'      => $_GET["tag"],
			'posts_per_page' => $post_per_page
		)
	);
} elseif (isset($_GET["type_emission"])) {
	$loop = new WP_Query(
		array(
			'post_type' => 'emission',
			'tax_query' => array(
				array(
					'taxonomy' => 'type_emissions',
					'field' => 'slug',
					'terms' => $_GET["type_emission"]
				)
			),
			'posts_per_page' => $post_per_page
		)
	);
} elseif (isset($_GET["show_emission"]) && $_GET["show_emission"] == 1) {
	$loop = new WP_Query(
		array(
			'post_type' => 'emission',
			'posts_per_page' => $post_per_page
		)
	);
}
while ($loop->have_posts()) :
	$loop->the_post();
	//$do_not_duplicate[] = $post->ID;
	//Attribute element 'item'
	xmlwriter_start_element($xw, 'item');

	// Attribute element 'title'
	xmlwriter_start_element($xw, 'title');
	xmlwriter_text($xw, html_entity_decode(get_the_title()));
	xmlwriter_end_element($xw); // title

	// Attribute element 'guid'
	xmlwriter_start_element($xw, 'guid');
	xmlwriter_text($xw, get_the_permalink());
	xmlwriter_end_element($xw); // guid

	// Attribute element 'link'
	xmlwriter_start_element($xw, 'link');
	xmlwriter_text($xw, "https://bx1.be/?p=" . get_the_ID());
	xmlwriter_end_element($xw); // link

	// Attribute element 'pubDate'
	xmlwriter_start_element($xw, 'pubDate');
	//$postdate = get_the_date ( get_option('date_format') ).get_the_time( ' H:i:s' );
	//$postdate = new DateTime($postdate);
	xmlwriter_text($xw, get_the_time('D, d M Y H:i:s O', get_the_ID()));
	xmlwriter_end_element($xw); // pubDate
	$featured_img_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'Widget info image');
	xmlwriter_start_element($xw, 'media:content');
	xmlwriter_start_attribute($xw, 'xmlns:media');
	xmlwriter_text($xw, 'http://search.yahoom.com/mrss/');
	xmlwriter_end_attribute($xw);
	xmlwriter_start_attribute($xw, 'url');
	xmlwriter_text($xw, esc_url($featured_img_url[0]));
	xmlwriter_end_attribute($xw);
	xmlwriter_text($xw, '');
	xmlwriter_end_element($xw); // itunes:category

	// Attribute element 'description'
	xmlwriter_start_element($xw, 'description');
	// Change Excerpt Ending value
	add_filter('excerpt_more', function ($more_link) {
		return '';
	});
	add_filter('excerpt_length', function ($length) {
		return 2000;
	});

	$excerpt    =   get_the_excerpt(get_the_ID());
	$excerpt    =   limit_words($excerpt, 50);
	xmlwriter_text($xw,  html_entity_decode($excerpt));
	xmlwriter_end_element($xw); // description

	xmlwriter_end_element($xw); // item

endwhile;

xmlwriter_end_element($xw); // channel

xmlwriter_end_element($xw); // rss

xmlwriter_end_document($xw);

echo xmlwriter_output_memory($xw);
