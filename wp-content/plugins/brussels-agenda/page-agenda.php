<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : demo.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 30 January 2020
 *   Don't edit this code without authorization
 *********************************************/
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
?>
<pre>
    <?php
    /*global $wp_rewrite;
    print_r($wp_rewrite->rules);*/
    ?>
</pre>
<link rel="stylesheet" href="<?php echo plugins_url( 'assets/css', __FILE__ );?>/selectize.css">
<link rel="stylesheet" href="<?php echo plugins_url( 'assets/period_picker.6.1.8/build', __FILE__ );?>/jquery.periodpicker.min.css">
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>assets/css/style.css">
<script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
<script src="<?php echo plugins_url( 'assets/js', __FILE__ );?>/selectize.js"></script>
<script src="<?php echo plugins_url( 'assets/period_picker.6.1.8/build', __FILE__ );?>/jquery.periodpicker.full.min.js"></script>
<link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
<script src="/wp-content/plugins/brussels-agenda/assets/js/categories.min.json"></script>
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
		    $json_file 		= file_get_contents( plugin_dir_path( __FILE__ ) . "assets/js/categories.json");
		    $response       = json_decode($json_file, true);
		    $category       = $response['category'];
		    foreach ($category as $cat)
		    {
			    $ident = null;
			    if ($cat["search"] == 1 && $cat["level"] < 3)
			    {
				    if ($cat["level"] == 2)
				    {
					    $ident  =   "&nbsp;&nbsp;&nbsp;&nbsp;&rang;&nbsp;";
				    }
				    echo "<option class='level". $cat["level"] . "' value='" . $cat["id"] . "'>" . $ident . $cat["name"] . "</option>";
			    }
		    }
		    ?>
        </select></div>
    <div class="results-layout">
        <div class="buttons"><i class="fa fa-th-large fa-2x changelayout" data-layout="3"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-th fa-2x changelayout" data-layout="5"></i></div>
    </div>
    <div class="results-agenda"></div>
</section>
<script src="/wp-content/plugins/brussels-agenda/assets/js/functions.js"></script>
<script>
    jQuery("div.buttons i.changelayout").on("click",function(){
        var layout = jQuery(this).data("layout");
        //alert(layout);
        jQuery(".results-agenda").css("column-count",layout);
    });

</script>
<?php get_footer();?>
