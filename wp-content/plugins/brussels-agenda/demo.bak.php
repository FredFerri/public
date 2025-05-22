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
ini_set('error_reporting', E_ALL);
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
get_header();
?>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>assets/css/style.css">
<script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
<script src="<?php echo plugins_url( 'assets/js', __FILE__ );?>/selectize.js"></script>
<link rel="stylesheet" href="<?php echo plugins_url( 'assets/css', __FILE__ );?>/selectize.css">
<link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
<label for="category">States:</label>
<select id="category" name="state[]" multiple style="width:50%" placeholder="Sélectionnez une catégorie...">
    <option value="">Sélectionnez une catégorie...</option>
    <?php
        $json_file 		= file_get_contents( plugin_dir_path( __FILE__ ) . "assets/js/categories.json");
        $response       = json_decode($json_file, true);
        $category       = $response['category'];
        foreach ($category as $cat)
            {
                if ($cat["search"] == 1)
                {
	                echo "<option value='" . $cat["id"] . "'>" . $cat["name"] . "</option>";
                }
            }
    ?>
</select>
<button onclick="displayResult()">Bip!</button>
<script>
    jQuery('#category').selectize({
    });
</script>
<input placeholder="Code Postal" id="zip" type="text">
<section>
    <div class="results-layout"><div class="buttons"><i class="fa fa-th-large fa-2x changelayout" data-layout="3"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-th fa-2x changelayout" data-layout="5"></i></div></div>
    <div class="results-agenda">
        <?php
        /* Categories display */
        $hidecat = array( 29, 34, 41, 46, 58, 59, 60, 61, 62, 63, 64, 65, 66, 67, 68, 69, 72, 73, 75, 76, 77, 78, 79, 80, 81, 82, 86, 91, 94, 96, 97, 98, 100, 119, 120, 121, 122, 123, 124, 125, 126, 127, 128, 129, 130, 131, 132, 133, 134, 135, 136, 137, 138, 139, 140, 141, 142, 143, 144, 145, 146, 147, 148, 149, 150, 151, 152, 153, 154, 155, 156, 157, 158, 159, 161, 162, 163, 164, 165, 166, 167, 168, 169, 170, 171);
        include_once 'functions.php';
        $json_file 		= file_get_contents( plugin_dir_path( __FILE__ ) . "cache/cache.calendar.cur.json");
        $response       = json_decode($json_file, true);
        $data           = $response['data'];
        $today          = date("Y-m-d");
        $i              = 1;
        $jsoncontent    = null;
        $prevdate       = null;
        $e              = 1;
        //$eventcolor = array(1 => '#7863ff',23 => '#7f2d94', 49 => '#ff4a4a',57 => '#7564e2',70 => '#aea4ee', 71 => '#ce3f3f', 74 => '#f952e9',84 => '#dabbff',90 => '#c9a2bf',102 => '#f279d5', 118 => '#f593fb');
        $event          = array();
        foreach ($data as $item)
            {
	            if (in_array($item['categories']['main']['id'], $hidecat) or in_array($item['categories']['others']['list'][0],$hidecat))
                    {
                        continue;
                    }
                $title       =   $item['translations']['fr']['name'];
                //$title       =   str_replace("'","\'",$title);
                //$jsoncontent .= "{\n\tstart : '" . $item['date_next'] . "',\n\ttitle : '".$title."',\n\tbackgroundColor: '" . $eventcolor[$item['categories']['main']['id']] . "',\n\tborderColor: '" . $eventcolor[$item['categories']['main']['id']] . "'\n},\n";
                $link   =   $item['media'][0]["link"];
                if (empty($link))
                    {
                        //$link = "<i class='fa fa-6x fa-calendar' style='color:silver;'></i>";
                        $link = "<img src='" . esc_url( plugins_url( 'img/nopicture.jpg', __FILE__ ) ) . "'>";
                    }
                else
                    {
                        foreach ($item['media'] as $media){
                            if ($media["type"] == "photo" || $media["type"] == "poster")
                                {
	                                $imagename = str_replace("https://agendabrussels.imgix.net/",plugins_url( 'cache/img/', __FILE__ ) ,$media["link"]);
	                                $link = "<img src='". $imagename . "'>";
	                                break;
                                }
                        }
                    }
                $dates = $item['date_next'];
                foreach ($item["dates"] as $date)
                    {
                        if( $today < $date["day"])
                            {
                                $dates .= "," . $date["day"];
                            }
                    }
                $categories     = $item['categories']['main']['id'];
                $types          = " type-" . $item['categories']['main']['id'];
	            foreach ($item['categories']['others']['list'] as $subcategory)
                    {
                        $categories .= "," . $subcategory;
	                    $types      .= " type-" . $subcategory;
                    }
	            $date_next = date("d M Y",strtotime($item['date_next']));
	            $date_end = date("d M Y",strtotime($item['date_end']));
                echo "
                    <div class='calitem" . $types . "' data-city='" . $item["place"]["translations"]["fr"]["address_zip"] . "' data-date='{" . $dates . "}' data-categories='{" . $categories . "}' data-itemid='" . $item['id'] . "'>
                        <div class='item-image'>$link
                        <span class='item-category'>" . $item['categories']['main']['translations']['fr'] .  "&nbsp;&nbsp;|&nbsp;&nbsp;" . $item['categories']['others']['translations']['fr'][0] . "</span></div>
                        <div>
                            <H4>" . $title . "</H4>
                            <span class='item-location'><i class='fa fa-map-marker-alt'></i>&nbsp;" . $item["place"]["translations"]["fr"]["name"] . "</span>
                            <span class='item-date'><i class='fa fa-arrow-right'></i>&nbsp;" . $date_next . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='far fa-dot-circle'></i>&nbsp;" . $date_end . "</span>
                            <span class='item-button' data-url='" . $item["translations"]["fr"]["agenda_url"] . "'>Afficher l'événement &rang;</span>
                        </div>
                    </div>
                ";
                //$event['date'][$item['date_next']][$item['categories']['main']['id']][] = "{\n\tstart : '" . $item['date_next'] . "',\n\ttitle : '".$title."',\n\tbackgroundColor: '" . $eventcolor[$item['categories']['main']['id']] . "',\n\tborderColor: '" . $eventcolor[$item['categories']['main']['id']] . "'\n},\n";
                $prevdate = $item['date_next'];
                $i++;
                if ($i == 26)
                    {
	                    break;
                    }
            }
        echo $i;
        ?>
    </div>
</section>
<script>
    jQuery("#category").change(function(){
        var x = document.getElementById("category");
        var i;
        filtercat();
        for (i = 0; i < x.length; i++) {
            console.log("lenght : " + x.length);
            txt = x.options[i].value;
            filtercat(txt);
        }
    });
    jQuery("#zip").keyup(function(){
        var selectSize = jQuery(this).val();
        filterzip(selectSize);
    });
    function displayResult() {
        clearcat('');
    }
    function filterzip(e) {
        var regex = new RegExp('\\b\\w*' + e + '\\w*\\b');
        jQuery('.calitem').hide().filter(function () {
            return regex.test(jQuery(this).data('city'))
        }).show();
    }
    function clearcat(e) {
        var regex = new RegExp('\\b\\w*' + e + '\\w*\\b');
        jQuery('.calitem').hide().filter(function () {
            return regex.test(jQuery(this).data('categories'))
        }).show();
    }
    function filtercat(catid){
        jQuery('div.calitem').each(function(e){
            var category = jQuery(this).data("categories");
            var category = category.replace('{','');
            var category = category.replace('}','');
            var itemid   = jQuery(this).data("itemid");
            var catexp   = category.split(",");
            var showitem = 0;
            catexp.forEach(function(entry) {
                //console.log("Controle : CAT : " + catid + " Block : " + entry + " // ITEM ID : " + itemid);
                if(entry === catid)
                    {
                        //console.log("Touché " + jQuery(".calitem[data-itemid="+itemid+"]").data("categories"));
                        showitem = 1;
                    }
            });
            if (showitem === 1)
                {
                    jQuery(".calitem[data-itemid="+itemid+"]").show();
                }
            else
                {
                    jQuery(".calitem[data-itemid="+itemid+"]").hide();
                }
        })
    }
    jQuery("div.buttons i.changelayout").on("click",function(){
        var layout = jQuery(this).data("layout");
        //alert(layout);
        jQuery(".results-agenda").css("column-count",layout);
    });
</script>
<?php get_footer();?>
