<?php
add_action('admin_menu', 'add_global_dalet_options');
function add_global_dalet_options(){
  add_menu_page('Dalet Meta Dashboard','Dalet Meta Dashboard','manage_categories','daletmeta-dashboard','daletmeta_dashboard','dashicons-feedback',2);
}
function daletmet_load_scripts() {
  if ($_GET['page'] == "daletmeta-dashboard"){
	wp_enqueue_script('daletmeta_dashboard','/wp-content/themes/BX1-2017/js/daletmeta_dashboard.js');
  }
}
add_action('admin_enqueue_scripts','daletmet_load_scripts');
function daletmeta_dashboard() {
  echo '<h1>Dalet Meta Dashboard</h1>';
  echo '<div style="font-style: italic";>Système automatisé de publication d\'émissions.</div><br/>';
  echo '<h2>File d\'attente des fichiers envoyés</h2><br/>';
  echo '<div style="font-style: italic";>Les fichiers ci-dessous sont envoyé par Dalet.&nbsp;&nbsp;&nbsp;Rafraichissement dans : <span class="queuecounter"></span> seconde(s)</div>';
  echo '<div class="daletqueue"></div><br><br>';
  echo '<button onclick="daletmeta_manual();">Lancer manuellement la validation</button>';
  echo '<br/><br/><h2>Derniers fichiers traités</h2><br/>';
  echo '<div style="font-style: italic";>Les fichiers ci-dessous ont été tratés.&nbsp;&nbsp;&nbsp;Rafraichissement dans : <span class="historycounter"></span> seconde(s)</div>';
  echo '<div class="dalethistory"></div><br><br>';
  
}