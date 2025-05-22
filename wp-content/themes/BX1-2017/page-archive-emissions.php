<?php

/*********************************************
 *   Template Name: Archives - Emissions masonry
 *   Project : BX1 - PROD
 *   File    : page-archive-emissions.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 01 April 2021
 *   Don't edit this code without authorization
 *********************************************/

get_header('v2');
$currenttheme = strtolower($_GET["theme"]);
?>
    <script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
<style>
    /* Masonry */
    .masonry {
        display: grid;
        grid-template-columns: repeat(1, minmax(100px,1fr));
        grid-gap: 10px;
        grid-auto-rows: 10;
    }
    @media only screen and (max-width: 1023px) and (min-width: 768px) {
        .masonry {
            grid-template-columns: repeat(2, minmax(100px,1fr));
        }
    }
    @media only screen and (min-width: 1024px) {
        .masonry {
            grid-template-columns: repeat(3, minmax(100px,1fr));
        }
    }
    .masonry-item, .masonry-content {
        border-radius: 4px;
        overflow: hidden;
    }
    .masonry-item {
        filter: drop-shadow(0px 2px 2px rgba(0, 0, 0, .3));
        transition: filter .25s ease-in-out;
    }
    .item-button{
        cursor: pointer;
    }
    .results-archives h2 {
        font-size: 17px;
        margin-top: 0;
    }
    .results-archives article {
        background-color: #FFFFFF;
        border: 1px solid rgba(0,0,0,0.2);
        cursor: pointer;
    }
    .results-archives article div {
        background-color: #EB1F7C;
    }
    .results-archives article div span{
	    padding-left: 5px;
	    padding-right: 5px;
        display: block;
        color:#FFF;
        font-family: sys-tt, sans-serif;
    }
	.results-archives article div span.date{
		width: calc(100%-10px);
		background-color: rgba(0,0,0,0.2);
		font-weight: bold;
		font-size: 11px;
	}
    .results-archives article div span.title{
	    padding-top:8px;
	    padding-bottom: 6px;

    }
    body.lightbox-open{
        height: 100vh;
        overflow-y: hidden;
    }
    .lightbox{
        display: none;
        float: left;
        top: 0;
        left: 0;
        position: fixed;
        background: rgba(255,255,255,0.8);
        width: 100vw;
        height: 100vh;
        z-index: 1000;
    }
    .lightbox .close{
        top: 10px;
        right: 40px;
        background-color: #eb1f7c;
        width: 50vw;
        height: 40px;
        line-height: 40px;
        text-align: center;
        color: #FFF;
        cursor: pointer;
        display: block;
    }
    .lightbox .video{
        width: 50vw;
        margin: 25vh 25vw;
        height: 50vh;
        vertical-align: middle;
    }
</style>
    <section>
        <div class="masonry-wrapper">
<?php
$currenttheme = strtolower($_GET["theme"]);
if (empty ($currenttheme))
{$currenttheme = "classic";}
// The Query
$args       = array(
						'post_type' => 'emission',
						'posts_per_page' => -1,
						'date_query' => array(
							array(
                                'after'     => '-7 days',
								'column' => 'post_date'
							),
						),
                        'orderby' => 'wpcf-horaire-debut',
                        'order' => 'DESC'
					);
$articles_query  = new WP_Query($args);
$i=1;
$d=0;
$firstloop = 1;
// The Loop
if ( $articles_query->have_posts() ) {
	while ( $articles_query->have_posts() ) {
		$articles_query->the_post();
		$postthumburl           =   get_the_post_thumbnail_url();
		$art_date               =   get_the_date('d F Y');
		$heuredebut             =   get_post_meta(get_the_ID(), 'wpcf-horaire-debut', true);
		//$heuredebut             =   types_render_field('horaire-debut');
		$heuredebut             =   date ("H:i",$heuredebut);
		if ($d == 1 ){
			$grp_date       = $art_date;
			$d++;
		}elseif ($art_date != $grp_date){
			$grp_date       = $art_date;
			$d              = 1;
        }
		else{
		    $d++;
        }
		if ($art_date == $grp_date && $d == 1){
		    if ($firstloop == 1) {
			    echo "<h1 style='border-bottom: 1px solid #696969;padding-left: 10px'>" . $art_date . "</h1><div class=\"results-archives masonry\">".PHP_EOL;
			    $firstloop = 2;
			    }
		    else{
			    echo "</div><h1 style='border-bottom: 1px solid #696969;padding-left: 10px'>" . $art_date . "</h1><div class=\"results-archives masonry\">".PHP_EOL;
            }
        }
		echo "<div class='calitem item-button masonry-item' data-video='" . types_render_field('nom-du-fichier-video') . "'>
                   <div class='item-image' style='z-index: 4'>
                        <img src='" . $postthumburl . "' class='masonry-content'>
                   </div>
                   <div style='background-color: #eb1f7c; color: #FFF;position:relative;z-index: 5;margin-top: -6px;padding-top: 6px;border-radius: 0 0 4px 4px;'>
                       <span class='item-date' style='padding-left: 6px;'><i class='fa fa-calendar-o'></i>&nbsp;&nbsp;" . get_the_date('d F Y') . " - <i class='fa fa-clock-o'></i>&nbsp;&nbsp;" . $heuredebut . "</span>
                       <H4 style='font-size: 13px;padding-left: 6px; font-weight: bold;'>" . get_the_title() . "</H4>
                       <span  style='background-color: #B5115D;display: block;text-align: center;padding: 6px;border-radius: 0 0 4px 4px;'>Regarder la vidéo</span>
                   </div>
              </div>".PHP_EOL;
		//echo '<div class="archives_emission"><img src="' .  $postthumburl . '" ><div><span class="date">' . get_the_date('d F Y') . '</span><span class="title">' . get_the_title() . '</span></div></div>';
		$i++;
	}
	echo "</div>".PHP_EOL;
} else {
	// no posts found
} ?>
. Charger Plus ....
    </div>
    </section>
	<div class="lightbox">

        <div class="video">
            <div class="close"><i class="fa fa-close"></i> Stopper la vid&eacute;o</div>
            <div id="video"></div>
        </div>
	</div>
    <script>
        jQuery(".item-button").on("click",function(e){
            e.preventDefault();
            jQuery("body").addClass("lightbox-open");
            jQuery(".lightbox").show();
            var filename = jQuery(this).data('video');
            jwplayer("video").setup({
                sources: [{
                    file: "https://59959724487e3.streamlock.net:443/vod/mp4:" + filename + ".mp4" + "/playlist.m3u8"
                },{
                    file: "rtmps://59959724487e3.streamlock.net:443/vod/mp4:" + filename + ".mp4"}],
                primary: 'html5',
                width: '100%',
                aspectratio: '16:9',
                autostart: true,
                androidhls: true
            });
        });
        jQuery(".close").on("click",function(e){
            e.preventDefault();
            jQuery("body").removeClass("lightbox-open");
            jwplayer("video").stop();
            jQuery(".lightbox").hide();
        });
        function resizeMasonryItem(item){
            /* Get the grid object, its row-gap, and the size of its implicit rows */
            var grid = document.getElementsByClassName('masonry')[0];
            if( grid ) {
                var rowGap = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-row-gap')),
                    rowHeight = parseInt(window.getComputedStyle(grid).getPropertyValue('grid-auto-rows')),
                    gridImagesAsContent = item.querySelector('img.masonry-content');

                /*
				 * Spanning for any brick = S
				 * Grid's row-gap = G
				 * Size of grid's implicitly create row-track = R
				 * Height of item content = H
				 * Net height of the item = H1 = H + G
				 * Net height of the implicit row-track = T = G + R
				 * S = H1 / T
				 */
                var rowSpan = Math.ceil((item.querySelector('.masonry-content').getBoundingClientRect().height+rowGap)/(rowHeight+rowGap));

                /* Set the spanning as calculated above (S) */
                item.style.gridRowEnd = 'span '+rowSpan;
                if(gridImagesAsContent) {
                    item.querySelector('img.masonry-content').style.height = item.getBoundingClientRect().height + "px";
                }
            }
        }

        function resizeAllMasonryItems(){
            // Get all item class objects in one list
            var allItems = document.querySelectorAll('.masonry-item');

            /*
			 * Loop through the above list and execute the spanning function to
			 * each list-item (i.e. each masonry item)
			 */
            if( allItems ) {
                for(var i=0;i>allItems.length;i++){
                    resizeMasonryItem(allItems[i]);
                }
            }
        }

        function waitForImages() {
            //var grid = document.getElementById("masonry");
            var allItems = document.querySelectorAll('.masonry-item');
            if( allItems ) {
                for(var i=0;i<allItems.length;i++){
                    imagesLoaded( allItems[i], function(instance) {
                        var item = instance.elements[0];
                        resizeMasonryItem(item);
                        console.log("Waiting for Images");
                    } );
                }
            }
        }

        /* Resize all the grid items on the load and resize events */
        var masonryEvents = ['load', 'resize'];
        masonryEvents.forEach( function(event) {
            window.addEventListener(event, resizeAllMasonryItems);
        } );

        /* Do a resize once more when all the images finish loading */
        waitForImages();


</script>

<?php
/* Restore original Post Data */
wp_reset_postdata();
 get_footer('v2');?>