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
