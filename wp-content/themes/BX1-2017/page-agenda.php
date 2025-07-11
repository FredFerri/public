<?php

/*********************************************
 *   Template Name: Agenda - Accueil
 *   Project : BX1 - PROD
 *   File    : page-agenda.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 30 January 2020
 *   Don't edit this code without authorization
 *********************************************/
require($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
get_header('v2');
$currenttheme = strtolower($_GET["theme"]);
?>

<link rel="stylesheet" href="/wp-content/themes/BX1-2017/assets/css/selectize.css">
<link rel="stylesheet" href="/wp-content/themes/BX1-2017/assets/period_picker.6.1.8/build/jquery.periodpicker.min.css">
<link rel="stylesheet" href="/wp-content/themes/BX1-2017/assets/css/style.css">
<script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
<script src="/wp-content/themes/BX1-2017/assets/js/selectize.js"></script>
<script src="/wp-content/themes/BX1-2017/assets/period_picker.6.1.8/build/jquery.periodpicker.full.min.js"></script>
<link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
<script src="/wp-content/themes/BX1-2017/assets/js/categories.min.json"></script>

<style type="text/css">
  /* Règles générales */

  .news-top-block {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  .news-top-block .news__article {
    flex: 0 0 48% !important;
    box-sizing: border-box;
  }

  /* Header */

  .logo img {
    width: 90px;
  }

  .siteHeader img {
    max-width: 100%;
    height: auto;
    display: block;
  }

  .header-bottom {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin: auto;
    width: 1200px;
    align-items: end;
  }

  #menu-home-v2_menu {
    display: flex;
    justify-content: space-between;
    align-items: start;
    flex-direction: row;
    margin-top: 30px;
    padding: 0;
  }

  #menu-home-v2_menu li {
    list-style: none;
    position: relative;
  }

  #menu-home-v2_menu li a {
    color: #000;
    font-size: 23px;
    letter-spacing: 1.6px;
    text-decoration: none;
  }

  #menu-home-v2_menu li a:hover {
    text-decoration: none;
    color: #535353;
  }

  #menu-home-v2_menu .sub-menu {
    display: none;
    padding: 0;
    margin-top: 10px;
    position: absolute;
    z-index: 999;
  }

  #menu-home-v2_menu .sub-menu li a {
    font-size: 18px;
    letter-spacing: initial;
  }

  #menu-home-v2_menu>li::first-letter {
    font-weight: bolder;
    font-size: 29px;
  }

  /* 1. Onglet "Info" – première lettre en magenta (#EC1F7C) */
  #menu-home-v2_menu>li:nth-child(1)::first-letter {
    color: #EC1F7C;
  }

  /* 2. Onglet "Reportages" – première lettre en bleu sombre (#084266) */
  #menu-home-v2_menu>li:nth-child(2)::first-letter {
    color: #305B9E;
  }

  /* 3. Onglet "Sport" – première lettre en orange (#EC9C2B) */
  #menu-home-v2_menu>li:nth-child(3)::first-letter {
    color: #EC9C2B;
  }

  /* 4. Onglet "Culture" – première lettre en turquoise (#0F8B8D) */
  #menu-home-v2_menu>li:nth-child(4)::first-letter {
    color: #0F8B8D;
  }

  /* 5. Onglet "Émissions" – première lettre en gris (#8F8F8F) */
  #menu-home-v2_menu>li:nth-child(5)::first-letter {
    color: #8F8F8F;
  }

  /* 6. Onglet "Ma commune" – première lettre en violet foncé (#B1125C) */
  #menu-home-v2_menu>li:nth-child(6)::first-letter {
    color: #B1125C;
  }

  #menu-home-v2_menu>li:nth-child(6) .sub-menu>li {
    background-color: #B1125C;
    padding: 2px 5px;
    border-bottom: 2px solid #fff;
    width: 215px;
  }

  #menu-home-v2_menu>li:nth-child(6) .sub-menu>li:hover {
    background-color: #D51C70;
  }

  #menu-home-v2_menu>li:nth-child(6) .sub-menu>li a {
    color: #fff;
  }

  .header-btn-monbx1 {
    display: none;
  }

  .header-btn-directtv img:hover,
  .header-btn-directradio img:hover,
  .header-btn-whatsapp img:hover,
  .header-btn-alert img:hover,
  .header-btn-monbx1 img:hover {
    opacity: 0.8 !important;
  }

  .header-btn-directtv img,
  .header-btn-directradio img,
  .header-btn-whatsapp img,
  .header-btn-alert img,
  .header-btn-monbx1 img {
    transition: opacity 0.3s ease;
  }

  .siteHeader {
    background-image: url('/wp-content/themes/BX1-2017/images/barre-menu-navigation.png');
    background-size: cover;
  }

  .siteHeader--fixed {
    border-bottom: none;
  }

  .siteHeader__iReporter {
    background: url('/wp-content/themes/BX1-2017/images/alertez-nous.png');
    top: 26px;
    width: 120px;
    height: 55px;

  }

  .siteHeader__whatsapp {
    background: url('/wp-content/themes/BX1-2017/images/whatsapp.png');
    top: 26px;
    width: 120px;
    height: 55px;
    float: right;
    position: absolute;
  }

  .siteHeader__iReporter--mini {
    background: url('/wp-content/themes/BX1-2017/images/alertez-nous_white.png') no-repeat !important;
    background-position: center !important;
    background-size: cover !important;
    width: 55px;
    top: 0 !important;
    height: 39px !important;
    margin-bottom: 0 !important;
    margin-top: 0 !important;
  }

  .siteHeader .inside {
    display: flex;
    justify-content: space-between;
    max-width: 1230px !important;
  }

  .header-right,
  .header-center,
  .header-left {
    display: flex;
    align-items: center;
    flex: 1.2 1 0%;
    justify-content: space-evenly;
  }

  .header-center {
    flex: 2;
    justify-content: center;
  }

  .openMenu,
  .openSearch {
    position: initial;
    float: initial;
  }

  .openMenu {
    color: #D51C70 !important;
  }

  .openMenu span {
    background-color: #D51C70 !important;
  }

  .openSearch {
    margin: 0 23px;
  }

  .openSearch,
  .siteHeader__iReporter,
  .siteHeader__whatsapp {
    color: #fff !important;
  }

  .openMenu:visited,
  .openMenu:visited span {
    background-color: #D51C70 !important;
    color: #D51C70 !important;
  }

  .openMenu:hover {
    color: #B5115D !important;
  }

  .openMenu:hover span {
    background-color: #B5115D !important;
  }

  .openSearch,
  .openSearch:hover {
    background: url('/wp-content/themes/BX1-2017/images/loupe.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    margin-top: 0;
  }

  /* Dossiers */

  .nav-menu-dossiers {
    width: 295px;
    padding-right: 25px;
  }

  .nav-menu-dossiers_title {
    background-color: #e3e3e3;
    padding: 3px 0px 3px 10px;
    font-weight: bold;
  }

  #menu-home-v2_menu_dossiers li {
    background-color: #D51C70;
    padding: 3px 0px 3px 10px;
    margin-bottom: 1px;
    list-style: none;
    width: auto !important;
  }

  #menu-home-v2_menu_dossiers li a {
    color: #fff;
  }

  #menu-home-v2_menu_dossiers li a:hover {
    text-decoration: none;
    text-shadow: 1px 1px 33px #fff;
  }


  #menu-home-v2_menu_dossiers {
    padding: 0;
    margin: 0;
  }

  /* Sidebar */

  .sidebar-socials_responsive {
    display: none;
  }

  .sidebar-socials {
    position: absolute;
    right: -55px;
    width: 25px;
  }

  .sidebar-socials li img {
    width: 25px;
  }

  .sidebar-socials li {
    margin-top: 0;
    margin-bottom: 10px;
    border-bottom: none !important;
  }

  .btn-direct-info {
    margin: 12px 0;
    background-color: #EB1F7C;
    padding: 2px 10px;
  }

  .btn-direct-info a {
    color: #fff;
  }

  .btn-direct-info a:hover {
    text-decoration: none;
    text-shadow: 1px 1px 33px #fff;
  }


  /* Footer */

  .footerEnd {
    text-align: center;
  }

  .footerEnd .inside {
    display: initial !important;
  }

  .footerPartners .inside {
    display: flex;
    justify-content: center !important;
  }


  /* Media Queries */
  @media screen and (max-width: 1560px) {

    /* Header */
    .header-bottom {
      width: 1020px;
    }

    .siteHeader .inside {
      width: 1020px !important;
    }

    .openMenu,
    .openSearch,
    .siteHeader__iReporter {
      margin: 0 !important;
    }

    /* Homepage */
    .pubTop {
      left: 30px;
    }

    .news {
      width: 650px !important;
    }

    .nav-menu-dossiers {
      padding-right: 38px;
    }
  }

  @media screen and (max-width: 1060px) {

    /* Header */
    #menu-home-v2_menu {
      display: none;
    }

    .header-bottom {
      width: auto;
      flex-direction: column;
      align-items: center;
    }

    .siteHeader {
      height: 95px;
      padding-top: 0;
    }

    .realHeader {
      display: flex;
    }

    .logo img {
      width: 75px !important;
    }

    .openMenu {
      font-size: 13px !important;
    }

    .openMenu span {
      width: 38px;
      margin-bottom: 10px !important;
    }

    .siteHeader .inside {
      width: auto !important;
    }

    /* Homepage */
    .pubTop {
      left: 0;
    }

    .news {
      width: 66% !important;
    }

    .news--big {
      width: 100% !important;
    }

    .header-center img {
      width: 70%;
    }

    /* Sidebar */
    .sidebar-socials_responsive {
      display: flex;
    }

    .sidebar-socials_responsive ul {
      display: flex;
      justify-content: center;
      padding: 0;
      width: 100%;
    }

    .header-btn-directtv,
    .header-btn-directtv>a,
    .header-btn-directradio,
    .header-btn-directradio>a {
      display: flex;
      justify-content: center;
    }

    .nav-menu-dossiers {
      display: none;
    }

    /* Footer */
    .footer-block {
      width: 85% !important;
      padding: 0;
    }

    .siteHeader {
      background-position: top;
    }
  }

  @media screen and (max-width: 680px) {

    /* Header */
    .openSearch {
      width: 35px;
      height: 35px;
      margin: 0 !important;
    }

    .logo {
      overflow: initial !important;
    }

    .siteHeader {
      padding: 5px !important;
      height: 65px;
    }

    .inside {
      padding: 0 !important;
    }

    .header-center {
      flex: 1 !important;
      justify-content: space-evenly;
    }

    .openMenu {
      font-size: 10px !important;
      margin: 0 !important;
      overflow: initial;
    }

    .openMenu span {
      width: 26px;
      margin-bottom: 6px !important;
      height: 1px !important;
    }

    /* Homepage */
    .news {
      width: 100% !important;
    }

    .news-top-block,
    .news--big {
      padding: 0 10px;
    }


    /* Sidebar */
    .sideFil .widget {
      text-align: center;
    }

    /* Footer */
    .footer-block {
      padding: 0 !important;
      width: 100% !important;
      text-align: center;
    }
  }
</style>

<section>
  <div>
    <input id="datepicker" value="<?php echo date("d-m-Y"); ?>" style="width:15%;top: -13px;" name="datepicker" class="selectize-input" placeholder="Sélectionnez une date">
    <input id="datepickerend" type="hidden">
    <select id="city" name="state[]" multiple style="width:25%" placeholder="Sélectionnez une commune...">
      <option value="">Sélectionnez une Commune...</option>
      <option value="1070">1070 - Anderlecht</option>
      <option value="1160">1160 - Auderghem</option>
      <option value="1082">1082 - Berchem-Sainte-Agathe</option>
      <option value="1000">1000 - Bruxelles-ville</option>
      <option value="1620">1620 - Drogenbos</option>
      <option value="1040">1040 - Etterbeek</option>
      <option value="1140">1140 - Evere</option>
      <option value="1190">1190 - Forest</option>
      <option value="1083">1083 - Ganshoren</option>
      <option value="1050">1050 - Ixelles</option>
      <option value="1090">1090 - Jette</option>
      <option value="1081">1081 - Koekelberg</option>
      <option value="1950">1950 - Crainhem</option>
      <option value="1630">1630 - Linkebeek</option>
      <option value="1080">1080 - Molenbeek-Saint-Jean</option>
      <option value="1640">1640 - Rhode-Saint-Genèse</option>
      <option value="1060">1060 - Saint-Gilles</option>
      <option value="1210">1210 - Saint-Josse-ten-Noode</option>
      <option value="1030">1030 - Schaerbeek</option>
      <option value="1180">1180 - Uccle</option>
      <option value="1170">1170 - Watermael-Boitsfort</option>
      <option value="1780">1780 - Wemmel</option>
      <option value="1970">1970 - Wezembeek-Oppem</option>
      <option value="1200">1200 - Woluwe-Saint-Lambert</option>
      <option value="1150">1150 - Woluwe-Saint-Pierre</option>
    </select>
    <select id="category" name="state[]" multiple style="width:50%" placeholder="Sélectionnez une catégorie...">
      <option value="">Sélectionnez une catégorie...</option>
      <?php
      $json_file     = file_get_contents(plugin_dir_path(__FILE__) . "assets/js/categories.json");
      $response       = json_decode($json_file, true);
      $category       = $response['category'];
      foreach ($category as $cat) {
        $ident = null;
        if ($cat["search"] == 1 && $cat["level"] < 3) {
          if ($cat["level"] == 2) {
            $ident  =   "&nbsp;&nbsp;&nbsp;&nbsp;&rang;&nbsp;";
          }
          echo "<option class='level" . $cat["level"] . "' value='" . $cat["id"] . "'>" . $ident . $cat["name"] . "</option>";
        }
      }
      ?>
    </select>
  </div>
  <div style="font-style: italic;font-size: 0.7rem;padding-left:15px;">
    Votre association ou votre comité de quartier souhaite partager une activité sur le site internet de bx1?<br /> Alors, faites-le directement sur <a href="https://agenda.brussels/fr" target="_blank">agenda.brussels</a>. Commencez par vous créer un compte et encodez l'événement, il apparaîtra ainsi dans l'agenda.
  </div>
  <div class="results-layout">
    <div class="buttons"><i class="fa fa-th-large fa-2x changelayout" data-layout="<?php if ($currenttheme == "app") {
                                                                                      echo "2";
                                                                                    } else {
                                                                                      echo "3";
                                                                                    } ?>"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-th fa-2x changelayout" data-layout="<?php if ($_GET["theme"] == "APP") {
                                                                                                                                                                            echo "3";
                                                                                                                                                                          } else {
                                                                                                                                                                            echo "5";
                                                                                                                                                                          } ?>"></i></div>
  </div>
  <div class="results-agenda"></div>
</section>
<script src="/wp-content/themes/BX1-2017/assets/js/functions.js"></script>
<script>
  jQuery("div.buttons i.changelayout").on("click", function() {
    var layout = jQuery(this).data("layout");
    //alert(layout);
    jQuery(".results-agenda").css("column-count", layout);
  });
  <?php if ($currenttheme == "app") {
    echo 'jQuery(".results-agenda").css("column-count","3");';
  } ?>
</script>
<?php get_footer('v2'); ?>