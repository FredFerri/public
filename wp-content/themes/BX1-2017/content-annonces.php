<?php
/**
 * @package TeleBruxelles
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <h1><?php the_title(); ?></h1>

  <div class="content">

      <div class="content">

        <?php the_content(); ?>

        <?php if(!empty(types_render_field('press-file'))): ?>
        <h2>Fichiers à télécharger</h2>
        <ul>
          <?php
            $urls = types_render_field('press-file');
            $urls = explode('> ',$urls);
            foreach ($urls as $url):
              $url = explode('"',$url);
              $arr = explode('/',$url[1]);
              $file_name = end($arr);
          ?>
            <li><a href="<?php echo $url[1]; ?>" title="Télécharger <?php echo $file_name; ?> (ouverture dans un nouvel onglet)" target="_blank"><?php echo $file_name; ?></a></li>
          <?php endforeach; ?>
        </ul>
        <?php endif; ?>

      </div>

      <div class="meta">
        <h2>Partager l'article</h2>
        <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
            <a class="a2a_button_facebook"></a>
            <a class="a2a_button_twitter"></a>
            <a class="a2a_button_whatsapp"></a>
            <a class="a2a_dd"></a>
        </div>
        <div class="date"><strong><?php echo get_the_date('d F Y'); ?></strong> - <?php echo get_the_date('H\hi'); ?></div>
        <ul class="tags">
          <?php the_tags('<li>','</li><li>','</li>') ?>
          <li><?php the_category('</li><li>'); ?></li>
        </ul>
        <?php dynamic_sidebar('sidebar-3'); ?>
      </div>

   </div>
</article>
