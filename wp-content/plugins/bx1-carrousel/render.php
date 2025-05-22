<?php
function bx1_carrousel_render($settings) {
    $category = get_category($settings['category']);
    $posts = get_posts([
        'category' => $category->term_id,
        'posts_per_page' => $settings['count']
    ]);

    ob_start(); ?>

    <div class="bx1_carrousel-head">
        <a href="<?= esc_url(get_category_link($category->term_id)); ?>" class="bx1_carousel-category absolute top-0 left-0 bg-gray-800 text-white px-3 py-1 text-sm rounded-br-md z-10" style="background-color: <?= esc_attr($settings['title_color']); ?>;">
            <?= esc_html($category->name); ?>
        </a>
        <a href="<?= esc_url(get_category_link($category->term_id)); ?>" class="bx1_carousel-more absolute top-0 right-0 border border-gray-800 text-gray-800 w-6 h-6 flex items-center justify-center rounded-full z-10" style="border-color: <?= esc_attr($settings['color']); ?>; color: <?= esc_attr($settings['color']); ?>;">+</a>
    </div>
    <div class="bx1_carousel-container relative" style="background-color: <?= esc_attr($settings['color']); ?>;">


        <div class="swiper mySwiper mt-6">
            <div class="swiper-wrapper">
                <?php foreach ($posts as $post): setup_postdata($post); ?>
                    <div class="swiper-slide px-2">
                        <a href="<?= get_permalink($post); ?>">
                            <?= get_the_post_thumbnail($post, 'medium', ['class' => 'w-full rounded']); ?>
                        </a>
                        <h3>
                            <a href="<?= get_permalink($post); ?>">
                                <?= esc_html(wp_trim_words(get_the_title($post), 10, '...')); ?>
                            </a>
                        </h3>
                        <p><?= get_the_date('', $post); ?></p>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <div class="swiper-pagination mt-4 text-center"></div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
