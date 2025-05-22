<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
   <label>
      <span class="screen-reader-text"><?php echo _x( 'Chercher', 'label' ) ?></span>
      <input type="search" class="search-field" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Entrez vos mots-clés', 'label' ) ?>" />
   </label>
   <input type="submit" class="button search-submit" value="<?php echo esc_attr_x( 'Rechercher', 'submit button' ) ?>" />
</form>