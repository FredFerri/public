<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package TeleBruxelles
 */
?>

         </div><!-- #content -->

         <?php if ( !is_front_page() ) { ?>
         <section class="row">
            <div class="large-12 columns">
               <h2 class="section-title section-title--emissions">Émissions <span class="section-title-all"><a href="">Toutes les émissions</a></span></h2>
               <div class="row" data-equalizer data-options="equalize_on_stack: true">
                <?php include('inc/get-type-emissions.php'); ?>
               </div>
            </div>
         </section>
         <?php } ?>

         <footer id="colophon" class="site-footer footer-partners" role="contentinfo">
            <div class="row" data-equalizer data-options="equalize_on_stack: true">
               <?php echo do_shortcode('[wpv-view name="partenaires"]'); ?>
            </div>
         </footer><!-- #colophon -->

         <footer id="colophon-2" class="site-footer footer-top" role="contentinfo">
            <div class="row">
               <a class="link-logo-mini" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                <svg class="logo-mini" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 874.15 739.27"><defs><style>.cls-1{fill:url(#gradient);}.cls-2{fill:url(#gradient_2);}.cls-3{fill:#e61073;}.cls-4{fill:url(#gradient_3);}</style><linearGradient id="gradient" x1="200.62" y1="305.55" x2="751" y2="305.55" gradientTransform="matrix(1, 0, 0, -1, 16.37, 822.7)" gradientUnits="userSpaceOnUse"><stop offset="0.02" stop-color="#2d2f30"/><stop offset="0.97" stop-color="#808486"/></linearGradient><linearGradient id="gradient_2" x1="820" y1="271.4" x2="787.38" y2="445.38" gradientTransform="matrix(1, 0, 0, -1, 16.37, 822.7)" gradientUnits="userSpaceOnUse"><stop offset="0" stop-color="#e51273"/><stop offset="1" stop-color="#b61359"/></linearGradient><linearGradient id="gradient_3" x1="135.08" y1="415.45" x2="72.92" y2="414.33" xlink:href="#gradient_2"/></defs><title>bx1</title><path class="cls-1" d="M767.37,739.25l-0.09-110.14-120-108.86,120-110.13V295.06S679.93,377.4,586,464.7L476.13,365.82c-132.38-121.5-259-43.89-259-43.89l61.24,73.71C302.65,393.78,352.63,358,419.76,424c26.78,26.33,66.88,59.44,106,96.16-39.17,36.75-79.31,72.77-106.11,99.11-67.13,66-126.14,29.48-150.43,27.62L217,721.28S360.79,783,476,677.39L586.42,575.12C680.28,662.31,767.37,739.25,767.37,739.25Z" transform="translate(-0.03)"/><path class="cls-2" d="M789.09,739.27L873,739s1.33-419.18,1.21-426.25L789.6,273.83Z" transform="translate(-0.03)"/><polygon class="cls-3" points="727.26 332.69 727.26 446.85 874.14 313.22 874.14 313.22 789.56 273.84 727.26 332.69"/><path class="cls-3" d="M220.84,297.51c-50.79,0-98,17.72-135.81,47.25V0L0,59.94V518.36C0,640,99.24,739.21,220.88,739.21S441.69,640,441.69,518.36,342.48,297.51,220.84,297.51Zm0,356.67C146.44,654.18,85,592.77,85,518.36s61.42-135.81,135.81-135.81S355.47,444,355.47,518.36,295.25,654.18,220.84,654.18Z" transform="translate(-0.03)"/><path class="cls-4" d="M85.21,344.58V507.46s0-68.64,74.43-110.12c-2.11-63.9-6.07-89.14-6.07-89.14S115.28,320.17,85.21,344.58Z" transform="translate(-0.03)"/></svg>
               </a>
               <div class="site-info large-6 columns">
                  <span>&copy; Télé Bruxelles ASBL &ndash; 1993 - <?php echo date("Y"); ?> &ndash; Tous droits réservés</span>
               </div>
               <div class="site-info-location large-6 columns">
                  <span><a href="https://www.google.be/maps/place/Rue+Gabrielle+Petit+32,+1080+Molenbeek-Saint-Jean/" target="_blank">BX1 - 32 rue Gabrielle Petit 1080 Bruxelles, Belgique</a></span>
               </div><!-- .site-info -->
            </div>
         </footer><!-- #colophon -->

         <footer id="colophon-3" class="site-footer footer-bottom" role="contentinfo">
            <div class="row">
               <div class="large-centered columns text-center">
                  <ul class="inline-list social-list">
                     <li><a href="https://twitter.com/BX1_actu"><svg class="footer__icon icon-twitter"><use xlink:href="#icon-twitter" /></svg></a></li>
                     <li><a href="https://www.facebook.com/bx1officiel"><svg class="footer__icon icon-facebook"><use xlink:href="#icon-facebook" /></svg></a></li>
                     <li><a href="https://www.youtube.com/user/TeleBruxelles"><svg class="footer__icon icon-youtube"><use xlink:href="#icon-youtube" /></svg></a></li>
                     <li><a href="/feed"><svg class="footer__icon icon-rss"><use xlink:href="#icon-rss" /></svg></a></li>
                  </ul>
                  <p class="makers">Made by <a href="http://spade.be">Spade</a><img class="ace" alt="Ace of Spade symbol for Spade Agency" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAcAAAAHCAYAAADEUlfTAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyRpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYxIDY0LjE0MDk0OSwgMjAxMC8xMi8wNy0xMDo1NzowMSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNS4xIE1hY2ludG9zaCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo1QUE3QTRFRjJBREUxMUU0QTUzNkE1NzRBMkFGQjAxOCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo1QUE3QTRGMDJBREUxMUU0QTUzNkE1NzRBMkFGQjAxOCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjVBQTdBNEVEMkFERTExRTRBNTM2QTU3NEEyQUZCMDE4IiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjVBQTdBNEVFMkFERTExRTRBNTM2QTU3NEEyQUZCMDE4Ii8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+UEb9CwAAAIdJREFUeNpifCTEzwACzAwMjG8ZGL8IMPznAXL/g8SYQAQrAwPLfQbGf/7/WbmA3H8QtRBJ7vMMjL+T/rMynGH8xQAFf0DiTED968uBEmcZfzJ8ZUAB6xlBdoow/G94w8D4EigwDYizgFgciBsYYQ4CAlkgfgSln8AdBAU7gPgNEO+ECQAEGACuNyFVsoEZNwAAAABJRU5ErkJggg=="/></p>
               </div>
            </div>
         </footer><!-- #colophon -->
      </div><!-- #page -->
   </div><!-- .inner-wrap-->

<?php wp_footer(); ?>

   <script src="<?php echo get_template_directory_uri();?>/js/build/tbxl.min.js"></script>

   <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
     (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
     m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-29621584-1', 'auto');
     ga('send', 'pageview');
   </script>
</body>
</html>
