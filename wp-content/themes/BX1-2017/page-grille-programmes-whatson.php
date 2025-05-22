<?php

/**
 * Template Name: Grille des programmes 2022
 *
 *
 * @package TeleBruxelles
 */

get_header('v2'); ?>

<style>
    .legend {
        display: inline-block;
        line-height: 32px;
        vertical-align: middle;
    }
    .legend div{
        margin-left: 7px;
        display: inline-block;
    }
    .legend div i{
        line-height: 32px;
    }
    .legend div span.label{
        line-height: 32px;
        font-size:10px;
        vertical-align: top;
    }
    .icons-grid{
        width: 20px;
        height: 32px;
        color:#696969;
        vertical-align: middle;
        text-align: center;
        line-height:32px;
        display: inline-block;
    }
    .table .theaddate{
        text-align: center;
        white-space: nowrap;
    }
    .table .thead{
        background-color: #EB1E7C;
        color:#FFFFFF;
    }
    .table-striped tr:nth-child(even){
        background-color: #f1f1f1;
    }
    .prevday, .nextday{
        cursor: pointer;
    }
    .prevday:hover, .nextday:hover{
        color: #EB1E7C;
    }
</style>
<script src="https://kit.fontawesome.com/b0b7120428.js" crossorigin="anonymous"></script>
<section class="news">
<div class="legend">
    <div style='color:#EB1E7C;white-space: nowrap;'><i class="far fa-play-circle"></i><span class="label"> Première diffusion!</span></div>
    <div style='color:#06718E;white-space: nowrap;'><i class="fas fa-redo-alt"></i><span class="label"> Programme en rediffusion</span></div>
    <div style='color:#16C377;white-space: nowrap;'><i class="fas fa-closed-captioning"></i><span class="label"> Sous-titrage</span></div>
    <div style='color:#ff9100;white-space: nowrap;'><i class="fas fa-deaf"></i><span class="label"> Sous-titrage mal entendant</span></div>
    <div style='color:#01b110;white-space: nowrap;'><i class="fas fa-audio-description"></i><span class="label"> Audio-description</span></div>
    <div style='color:#00bdef;white-space: nowrap;'><i class="fas fa-sign-language"></i><span class="label"> Doublé en langue des signes</span></div>
</div>
	<?php
        $currentdayofweek   =   date("N");
        if ($currentdayofweek == 6 || $currentdayofweek == 7)
            {
	            $currentweek = date("W_Y",strtotime("+1 week"));
	            // $currentweek = date("W_Y");
            }
        else
            {
	            $currentweek = date("W_Y");
	            // $currentweek = date("W_Y",strtotime("-1 week"));
            }



        $today       = date("d/m/Y");
        $xmlfilename  =  get_template_directory() . "/cache/prgtv/Semaine_".$currentweek.".xml";
        // var_dump($xmlfilename);
        if (file_exists($xmlfilename)) {
            $xml        = simplexml_load_file($xmlfilename);
            $grid       = $xml->{'Grille'};
            $i          = 1;
	        $totaldays  = 0;
            foreach ($grid as $countdays)
                {
	                $daygridlist = $countdays->{'Date'};
	                $date1  =   str_replace("/", "-",$daygridlist);
	                $date1  =   date("Y-m-d",strtotime($date1));
	                $date2  =   date("Y-m-d",strtotime("now"));
	                if ($date1 < $date2){

                        }
                    else{
                        $totaldays++;
                    }
                }
            foreach ($grid as $daygrid)
                {
	                $daygridlist = $daygrid->{'Date'};
	                $date1  =   str_replace("/", "-",$daygridlist);
	                $date1  =   date("Y-m-d",strtotime($date1));
	                $date2  =   date("Y-m-d",strtotime("now"));
                    if ($date1 < $date2){
                        }
                    else{
                    $gridlist    = $daygrid->{'Pgm'};
	                $displaydate = "table";
                    if($i !=1)
                        {
                            $displaydate = "none";
                        }
	                echo "<table style='display:" . $displaydate . ";' class=\"table table-striped\" width='100%' data-displayid='" . $i . "' data-total='" . $totaldays . "'>";
	                echo "    <thead class='theaddate'>";
	                echo "        <tr>";
	                echo "            <td colspan=\"3\" style='white-space: nowrap;width:100%'>";
                    if ($i > 1){
                        echo "<div style='width:20px;display:inline-block;' class='prevday'><i class=\"fas fa-chevron-circle-left fa-2x\"></i></div>";
                    }
                    echo "<div style='display:inline-block;width:calc(100% - 40px);'><h1 style='width:100%'>".$daygridlist."</h1></div>";
	                if ($i < $totaldays){
		                echo "<div style='width:20px;display:inline-block;' class='nextday'><i class=\"fas fa-chevron-circle-right fa-2x\"></i></div>";
	                }
                    echo "</td>";
                    echo "       </tr>";
	                echo "    </thead>";
	               /* echo "    <thead class='theaddate'>";
	                echo "        <tr>";
	                echo "            <td colspan=\"3\" style='white-space: nowrap;width:100%;padding-bottom:5px'>";
                    echo "            <input type=\"text\" class='filter' name=\"filter\" style='border-radius: 5px;width: 50%; border:2px solid #D1D1D1;padding:5px;color:#000' placeholder='Entrez le nom du programme'>";
	                echo "</td>";
	                echo "       </tr>";
	                echo "    </thead>";*/
                    echo "    <thead class=\"thead\">";
                    echo "        <tr>";
                    echo "            <th scope=\"col\">Heure</th>";
                    echo "            <th scope=\"col\">&nbsp;</th>";
                    echo "            <th style='text-align:left;' scope=\"col\">Programme</th>";
                    echo "        </tr>";
                    echo "    </thead>";
                    echo "    <tbody>";
                    foreach ($gridlist as $pgmdetails){
                        $HeurePgm = $pgmdetails->{'Heure'};
                        $NamePgm  = $pgmdetails->{'Programme'};
                        if ($HeurePgm == "" OR $NamePgm == "")
                            {
                                continue;
                            }
                        $pictos = null;
                        if ($pgmdetails->{'Est_Rediffusion'} == 0)
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:#EB1E7C'><i class=\"far fa-play-circle\"></i></div>";
                            }
                        else
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:#06718E'><i class=\"fas fa-redo-alt\"></i></div>";
                            }
	                    if ($pgmdetails->{'Soustitrage'} == 1)
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:#16C377'><i class=\"fas fa-closed-captioning\"></i></div>";
                            }
	                    else
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:silver'><i class=\"fas fa-closed-captioning\"></i></div>";
                            }
	                    if ($pgmdetails->{'SoustitreMalentendants'} == 1)
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:#ff9100'><i class=\"fas fa-deaf\"></i></div>";
                                //$pictos .= "<div class=\"icons-grid\" style='color:silver'><i class=\"fas fa-deaf\"></i></div>";
                            }
	                    else
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:silver'><i class=\"fas fa-deaf\"></i></div>";
                            }
	                    if ($pgmdetails->{'Audiodescription'} == 1)
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:#01b110'><i class=\"fas fa-audio-description\"></i></div>";
                            }
	                    else
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:silver'><i class=\"fas fa-audio-description\"></i></div>";
                            }
	                    if ($pgmdetails->{'LangueSignes'} == 1)
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:#00bdef'><i class=\"fas fa-sign-language\"></i></div>";
                            }
	                    else
                            {
                                $pictos .= "<div class=\"icons-grid\" style='color:silver'><i class=\"fas fa-sign-language\"></i></div>";
                            }
                        echo "<tr class='elementline'>";
                        echo "<th scope=\"row\" style='width: 120px;'>" . $HeurePgm . "</th>";
                        echo "<td style='white-space: nowrap; width: 120px;'>" . $pictos . "</td>";
                        echo "<td>" . $NamePgm . "</td>";
                        echo "</tr>";
                    }
                    echo  "</tbody>";
                    echo  " </table>";
                    $i++;
                    }
                }
        } else {
            echo '<br>Echec lors de la lecture du programme de la semaine.';
        }
    ?>
    <script type="text/javascript">
        jQuery(".filter").on("keyup", function(){
            const regex = '/(.)\w+/gm';
            var filter = $(this).val();
            jQuery( "tr.elementline" ).each(function() {
                if (! filter.match(regex)){
                    jQuery(this).hide();
                } else {
                    jQuery(this).show();
                }
            });
        });
        jQuery(".nextday, .prevday").on("click", function(){
            var currentdate = jQuery(this).closest('table').attr('data-displayid');
            currentdate = parseInt(currentdate);
            if(jQuery(this).hasClass("prevday"))
                {
                    var previousdate = currentdate-1;
                    jQuery('*[data-displayid="'+previousdate+'"]').css('display', 'table');
                    jQuery(this).closest('table').css('display', 'none');
                }
            if(jQuery(this).hasClass("nextday"))
                {
                    var nextdate = currentdate+1;
                    jQuery('*[data-displayid="'+nextdate+'"]').css('display', 'table');
                    jQuery(this).closest('table').css('display', 'none');
                }
        });
    </script>
</section>
<section class="sideFil">
  <?php dynamic_sidebar('filinfo2'); ?>
  <?php dynamic_sidebar('sidebar-3'); ?>
</section>
<?php get_footer('v2'); ?>
