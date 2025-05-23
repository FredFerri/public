              <div class="clearfix"></div>
           </div><!-- #content -->

    	</div>
<div class="pubmobilebx1" data-publocationid="1" data-loaded="0" id="pub1" style="max-width: 640px;"></div>

    </div>

    <div id="notifs">
    	<p></p>
    </div>

    <div id="accesJournaliste"></div>
    <div id="popUpJournaliste">
      <h3>Accès journaliste</h3>
      <p>Vous avez débloqué l'accès journaliste.</p>
      <p>Si c'est une erreur, vous pouvre annuler et vous retournerez à l'application.</p>
      <p>Si vous êtes journaliste, vous pouvez continuer afin de vous connecter et d'être redirigé sur l'ajout d'un article.</p>
      <a href="../../wp-admin/post-new.php">Continuer</a>
      <a href="" class="btn" id="closePopUpJournaliste">Annuler</a>
    </div>

  <?php if(!is_page('mobilite')): ?>
    <?php wp_footer(); ?>
  <?php endif; ?>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPPx1hjIEbsAe5eY2t0dZogtmfGsvoogQ&libraries=places"></script>

  <script src="<?php echo get_stylesheet_directory_uri();?>/js/main.js"></script>
  <script src="<?php echo get_stylesheet_directory_uri();?>/js/loadads.js"></script>
  <script src="https://gestcom.divercom.be/w/bx1/30" async defer></script>

  <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-4EDZJXK2F4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4EDZJXK2F4');
</script>



  </body>
</html>
