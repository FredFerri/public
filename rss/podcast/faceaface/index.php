<?php header('Content-type: application/xml');
echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:spotify="http://www.spotify.com/ns/music/1" version="2.0">
    <channel>
        <title>
            BX1 - Le duel
        </title>
        <link>
        https://bx1.be/
        </link>
        <description>
            <![CDATA[Le duel, c’est un débat d’actualité entre deux personnalités, animé du lundi au vendredi par Fabrice Grosfilley dans + d’actu.]]>
        </description>
        <itunes:summary>
            Le duel, c’est un débat d’actualité entre deux personnalités, animé du lundi au vendredi par Fabrice Grosfilley dans + d’actu.
        </itunes:summary>
        <copyright>
            BX1 &#xA9; <?php echo date("Y"); ?>. Tous droits réservés.
        </copyright>
        <image>
            <url>
                https://bx1.be/wp-content/uploads/2022/01/Logo-Plus-Actu-Podcast.jpg
            </url>
            <title>
                Toujours + d'Actu
            </title>
            <link>
            https://bx1plus.be/
            </link>
        </image>
        <itunes:author>
            BX1
        </itunes:author>
        <itunes:owner>
            <itunes:name>
                BX1+
            </itunes:name>
            <itunes:email>
                web@bx1.be
            </itunes:email>
        </itunes:owner>
        <itunes:explicit>
            false
        </itunes:explicit>
        <itunes:category text="News" />
        <language>
            fr
        </language>
        <lastBuildDate><?php
                        $dt = new DateTime('now', new DateTimezone('Europe/Brussels'));
                        echo $dt->format('D, d M Y H:i:s O');
                        ?></lastBuildDate>
        <itunes:image href="https://bx1.be/wp-content/uploads/2022/01/Logo-Plus-Actu-Podcast.jpg" />
        <?php
        //Let's use WP functions
        require_once("../../../wp-load.php");
        date_default_timezone_set('Europe/Brussels');
        $loop = new WP_Query(array('post_type' => 'radio-chronique', 'meta_key' => '_yoast_wpseo_primary_radio-type_emissions', 'meta_value' => '13260', 'posts_per_page' => -1));
        while ($loop->have_posts()) :
            $loop->the_post();
            $do_not_duplicate[] = $post->ID;
            if (types_render_field('video-chronique') != "") {
        ?>
                <item>
                    <title>
                        <?php echo get_the_title(); ?>
                    </title>
                    <guid>
                        <?php echo $post->ID; ?>
                    </guid>
                    <link>
                    https://bx1.be/?p=<?php echo $post->ID; ?>
                    </link>
                    <?php $date_chronique = get_post_meta($post->ID, 'wpcf-date-chronique', true); ?>
                    <?php if ($date_chronique): ?>
                        <pubDate>
                            <?= date(DATE_RFC1123, $date_chronique); ?>
                        </pubDate>
                    <?php endif; ?>
                    <itunes:explicit>false</itunes:explicit>
                    <itunes:image href="https://bx1.be/wp-content/uploads/2022/01/Logo-Plus-Actu-Podcast.jpg" />
                    <enclosure url="https://dts.podtrac.com/redirect.mp3/bx1.be/videofiles/<?php echo types_render_field('video-chronique'); ?>.mp3" type="audio/mpeg" length="1" />
                    <itunes:duration>
                        <?php echo types_render_field('duree-chronique'); ?>
                    </itunes:duration>
                    <?php

                    //Create XML Friendly Title

                    $badchar    = array("&");
                    $goodchar   = array("-");

                    $goodsummary = str_replace($badchar, $goodchar, types_render_field('sous-titre-itunes'));
                    ?>
                    <itunes:summary>
                        <?php echo $goodsummary; ?>
                    </itunes:summary>
                    <description>
                        <![CDATA[<?php echo $goodsummary; ?>]]>
                    </description>
                </item>
        <?php
            }
        endwhile;
        ?>
    </channel>
</rss>