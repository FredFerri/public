<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package TeleBruxelles
 */

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
   return;
}
?>
<div id="secondary" class="widget-area large-4 columns" role="complementary">
    <a id='blogmobilitesidebar' href="/mobilite/"><img src="<?php echo get_template_directory_uri();?>/img/mobilitethumb.jpg"></a><br>&nbsp;
   <?php if ( is_front_page() ) { ?>

    <div id="pebbleMiddle" class="text-center">
      <script type="text/javascript"> adhese.tag({ format: "Middle", publication:"tele-bruxelles", location: "homepage",});</script>
    </div>

   <?php } else { ?>

    <div id="pebbleMiddle" class="text-center">
      <script type="text/javascript"> adhese.tag({ format: "Middle", publication:"tele-bruxelles", location: "others",});</script>
    </div>

   <?php } ?>
   <?php dynamic_sidebar( 'sidebar-1' ); ?>
</div><!-- #secondary -->
