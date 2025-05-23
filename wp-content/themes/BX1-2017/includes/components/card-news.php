<?php

$videoFileName = get_post_meta($post->ID, 'wpcf-video-name-news', true);
$flash = get_post_meta($post->ID, 'wpcf-flash-news', true);
$sport = in_category('sport');
$redaction = in_category('dossiers-redaction');
$bonus = in_category('bx1-bonus');
$exclusif = get_post_meta($post->ID, 'wpcf-info-bx1', true);
$count++;
if (get_option('home_pres') == 'news') {
	$even_odd_class = (($count % 2) == 0) ? "odd" : "even";
} else {
	$even_odd_class = (($count % 2) == 0) ? "even" : "odd";
}

$post_thumbnail_id = get_post_thumbnail_id($post->ID);
?>

<article class="news__article <?= $videoFileName != '' ? 'news__article--video ' : '' ?><?= $even_odd_class; ?> <?= $classes ?>">
	<a href="<?php the_permalink(); ?>" title="Lire l'article <?php the_title(); ?>">
		<h3><?php the_title(); ?> <span class="date"><?php echo get_the_date('d F Y'); ?></span></h3>
		<figure>
			<?php if ($flash == '1'): ?><span class="flash">Flash info</span><?php endif; ?>
			<?php if ($sport == '1'): ?><span class="flash flash--sport">Sport</span><?php endif; ?>
			<?php if ($redaction == '1'): ?><span class="flash redaction">Les dossiers de BX1</span><?php endif; ?>
			<?php if ($bonus == '1'): ?><span class="flash bonus">Les bonus de BX1</span><?php endif; ?>
			<?php if ($exclusif == '1'): ?><span class="flash exclusif">Info BX1</span><?php endif; ?>

			<?= mk_image($post_thumbnail_id, 'medium', '', '', $count <= 4 ? true : false); ?>
		</figure>
	</a>
</article>

git rm --cached wp-content/updraft/backup_2024-07-30-1127_BX1_74cad4d9c419-uploads10.zip
git add .gitignore
git commit -m "Stop tracking wp-content/updraft/backup_2024-07-30-1127_BX1_74cad4d9c419-themes5.zip"

git filter-branch --force --index-filter \
"git rm --cached --ignore-unmatch wp-content/plugins.zip" \
--prune-empty --tag-name-filter cat -- --all