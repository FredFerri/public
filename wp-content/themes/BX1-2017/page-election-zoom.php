<?php

/**
 * Template Name: Élections 2018 Zoom Commune
 *
 *
 * @package BX1
 */

get_header(); 

		$_GENERAL["TRADUCTION"]["AffairesetrangeresBruxelles-Capitale"] =   "Affaires étrangères Bruxelles-Capitale";
        $_GENERAL["TRADUCTION"]["Anderlecht"]                           =   "Anderlecht";
        $_GENERAL["TRADUCTION"]["Anvers"]                               =   "Anvers";
        $_GENERAL["TRADUCTION"]["Asse"]                                 =   "Asse";
        $_GENERAL["TRADUCTION"]["Auderghem"]                            =   "Auderghem";
        $_GENERAL["TRADUCTION"]["Berchem-Sainte-Agathe"]                =   "Berchem-Sainte-Agathe";
        $_GENERAL["TRADUCTION"]["Brabantflamand"]                       =   "Brabant flamand";
        $_GENERAL["TRADUCTION"]["Brabantwallon"]                        =   "Brabant wallon";
        $_GENERAL["TRADUCTION"]["Bruxelles"]                            =   "Bruxelles";
        $_GENERAL["TRADUCTION"]["Bruxelles-Capitale"]                   =   "Bruxelles-Capitale";
        $_GENERAL["TRADUCTION"]["Collegeelectoralfrancais"]             =   "College electoral francais";
        $_GENERAL["TRADUCTION"]["Collegeelectoralneerlandais"]          =   "College electoral neerlandais";
        $_GENERAL["TRADUCTION"]["Crainhem"]                             =   "Crainhem";
        $_GENERAL["TRADUCTION"]["Drogenbos"]                            =   "Drogenbos";
        $_GENERAL["TRADUCTION"]["Etterbeek"]                            =   "Etterbeek";
        $_GENERAL["TRADUCTION"]["Evere"]                                =   "Evere";
        $_GENERAL["TRADUCTION"]["Flandreoccidentale"]                   =   "Flandre occidentale";
        $_GENERAL["TRADUCTION"]["Flandreorientale"]                     =   "Flandre orientale";
        $_GENERAL["TRADUCTION"]["Forest"]                               =   "Forest";
        $_GENERAL["TRADUCTION"]["Ganshoren"]                            =   "Ganshoren";
        $_GENERAL["TRADUCTION"]["Hainaut"]                              =   "Hainaut";
        $_GENERAL["TRADUCTION"]["Hal"]                                  =   "Hal";
        $_GENERAL["TRADUCTION"]["Ixelles"]                              =   "Ixelles";
        $_GENERAL["TRADUCTION"]["Jette"]                                =   "Jette";
        $_GENERAL["TRADUCTION"]["Koekelberg"]                           =   "Koekelberg";
        $_GENERAL["TRADUCTION"]["LeRoyaume"]                            =   "Le Royaume";
        $_GENERAL["TRADUCTION"]["Lennik"]                               =   "Lennik";
        $_GENERAL["TRADUCTION"]["Limbourg"]                             =   "Limbourg";
        $_GENERAL["TRADUCTION"]["Linkebeek"]                            =   "Linkebeek";
        $_GENERAL["TRADUCTION"]["Liege"]                                =   "Liège";
        $_GENERAL["TRADUCTION"]["Luxembourg"]                           =   "Luxembourg";
        $_GENERAL["TRADUCTION"]["Meise"]                                =   "Meise";
        $_GENERAL["TRADUCTION"]["Molenbeek-Saint-Jean"]                 =   "Molenbeek-Saint-Jean";
        $_GENERAL["TRADUCTION"]["Namur"]                                =   "Namur";
        $_GENERAL["TRADUCTION"]["Rhode-Saint-Genese"]                   =   "Rhode-Saint-Genese";
        $_GENERAL["TRADUCTION"]["Saint-Gilles"]                         =   "Saint-Gilles";
        $_GENERAL["TRADUCTION"]["Saint-Josse-Ten-Noode"]                =   "Saint-Josse-Ten-Noode";
        $_GENERAL["TRADUCTION"]["Schaerbeek"]                           =   "Schaerbeek";
        $_GENERAL["TRADUCTION"]["Uccle"]                                =   "Uccle";
        $_GENERAL["TRADUCTION"]["Vilvorde"]                             =   "Vilvorde";
        $_GENERAL["TRADUCTION"]["Watermael-Boitsfort"]                  =   "Watermael-Boitsfort";
        $_GENERAL["TRADUCTION"]["Wemmel"]                               =   "Wemmel";
        $_GENERAL["TRADUCTION"]["Wezembeek-Oppem"]                      =   "Wezembeek-Oppem";
        $_GENERAL["TRADUCTION"]["Woluwe-Saint-Lambert"]                 =   "Woluwe-Saint-Lambert";
        $_GENERAL["TRADUCTION"]["Woluwe-Saint-Pierre"]                  =   "Woluwe-Saint-Pierre";
        $_GENERAL["TRADUCTION"]["Zaventem"]                             =   "Zaventem";
		
		$CF=types_render_field('code-fichier');
        $LN=types_render_field('langue-resultats');
		$json_file_resultats_siege 		= file_get_contents("/data/sites/bx1.be/httpdocs/files/"  . $CF . "_resultats_sieges_" . strtolower($LN) . ".json");
		$json_content_resultats_siege 	= json_decode($json_file_resultats_siege,true);

		$json_file_voix_prefs	 		= file_get_contents("/data/sites/bx1.be/httpdocs/files/"  . $CF . "_voix_preference.json");
		$json_content_voix_prefs	 	= json_decode($json_file_voix_prefs,true);

		$json_file_taux_depouillement 	= file_get_contents("/data/sites/bx1.be/httpdocs/files/"  . $CF . "_trombinoscope_" . strtolower($LN) . ".json");
		$json_content_taux_depouillement= json_decode($json_content_resultats_siege,true);

		$json_file_resultats_parti 		= file_get_contents("/data/sites/bx1.be/httpdocs/files/"  .  $CF . "_resultats_partis_" . strtolower($LN) . ".json");
		$json_content_resultats_parti 	= json_decode($json_file_resultats_parti,true);

        if(file_exists("/data/sites/bx1.be/httpdocs/files/"  . $CF . "_resultats_sieges_" . strtolower($LN) . ".json"))
                {
                    $json_depouillement = json_decode($json_file_resultats_siege,true);
                }
        elseif(file_exists("/data/sites/bx1.be/httpdocs/files/"  .  $CF . "_resultats_partis_" . strtolower($LN) . ".json"))
            {
                    $json_depouillement = json_decode($json_file_resultats_parti,true);
            }

		//print_r($json_content_resultats_parti);
		//echo "/files/"  . $_GENERAL["COMMUNE"][$CP]["FILENAME"] . "_resultats_sieges.json";
?>
<?php
            $NomPartis          =   array();
            $CouleurPartis      =   array();
            $CouleurPartisHEX   =   array();
            $ResultatPartis     =   array();
            //print_r($json_content["partis"]);
            function toHex($n) {
                $n = intval($n);
                if (!$n)
                    return '00';

                $n = max(0, min($n, 255)); // make sure the $n is not bigger than 255 and not less than 0
                $index1 = (int) ($n - ($n % 16)) / 16;
                $index2 = (int) $n % 16;

                return substr("0123456789ABCDEF", $index1, 1)
                       . substr("0123456789ABCDEF", $index2, 1);
            }

        foreach ($json_content_resultats_siege["sieges"] as $partis)
                {
                    $hex = null;
                    $r   = $partis["couleur"][0];
                    $g   = $partis["couleur"][1];
                    $b   = $partis["couleur"][2];
	                $hex = '#' . toHex($r) . toHex($g) . toHex($b);
	                $partinom = $partis["nomabrege"] . " (" . $partis["sieges2019"] . " / " . $partis["pourcentage2019"] . " %)";
                    array_push($NomPartis,$partinom);
                    array_push($CouleurPartis,$partis["couleur"]);
                    array_push($CouleurPartisHEX,$hex);
                    array_push($ResultatPartis,$partis["sieges2019"]);
                }

                //print_r($CouleurPartis);
                //echo count($CouleurPartis);

                if ($json_depouillement["bureauxdep"] == 1)
                	{
                		$bureau 	=	"bureau dépouillé";
                	}
                else
                	{
                		$bureau 	= "bureaux dépouillés";
                	}


        	$NomPartisHisto          =   array();
            $CouleurPartisHisto      =   array();
            $ResultatPartisHisto2012 =   array();
            $ResultatPartisHisto2018 =   array();
            //print_r($json_content["partis"]);
            foreach ($json_content_resultats_parti["partis"] as $partishisto)
            {
                $partinom = $partishisto["nomabrege"] . " (" . $partishisto["pourcentage2014"] . "% / " . $partishisto["pourcentage2019"] . " %)";
                array_push($NomPartisHisto,$partinom);
                array_push($CouleurPartisHisto,$partishisto["couleur"]);
                array_push($ResultatPartisHisto2012,$partishisto["pourcentage2014"]);
                array_push($ResultatPartisHisto2018,$partishisto["pourcentage2019"]);
            }

        ?>
        <div style="display: none;"><pre>
            <?php
                print_r($json_content_resultats_siege);
            ?>
        </pre></div>
<section class="news news--grille"> 
	<style>
        #chart {
            
            margin: 35px auto;
        }

        .logocandidat{
        	display: block; 
        	max-width:150px; 
        	max-height:150px; 
        	width: auto; 
        	height: auto;
        }
        .blocklogo{
        	height:30%;
        	max-height:200px;
        }
        @media screen and (min-width: 400px) {
		    .logocandidat{
	        	max-width:60px; 
	        	max-height:60px; 
       		}
       		.blocklogo{
	        	height:30%;
	        	max-height:100px;
	        }
	        #chartpie{
	        	margin: 0 auto;
	        }
		}

		@media screen and (min-width: 800px) {
		    .logocandidat{
	        	max-width:150px; 
	        	max-height:150px; 
	        }
	        .blocklogo{
	        	height:30%;
	        	max-height:200px;
	        }
	        #chartpie{
	        	margin: 0 30%;
	        }
		}
        
    </style>
    <script src="/assets/apexcharts/apexcharts.min.js"></script>
    <div class="row"><?php echo the_content();?></div>
    <div class="row" style="text-align: center;"><h3>
    	<?php if($json_content_resultats_siege["complet"] == 0)
    		{ ?>
    	Actuellement, il y a <?php echo $json_depouillement["bureauxdep"] . " " . $bureau;?> sur un total de <?php echo $json_depouillement["bureauxtot"];?>
    		<?php } 
    		  else
    		  {
    		?>
    		Tous les résultats nous sont parvenus.
    	<?php } ?>
    	</h3></div>
        <?php if(file_exists("/data/sites/bx1.be/httpdocs/files/"  . $CF . "_resultats_sieges_" . strtolower($LN) . ".json"))
            {?>
                <div class="row"  style="margin: auto;text-align: center;">
                	<h1><br><br>Les sièges par partis</h1>
                    <div id="chartpie" style="text-align: center;width: 100%;"></div>
                </div>
            <?php }?>
    <div class="row"  style="text-align:center;margin: auto;">
    	<h1><br><br>Les voix par partis</h1>
         <div id="chart"  style="text-align: center;width: 100%; margin: 0 auto;"></div><br>
        <div class="col-12"></div>
    </div>
    <?php 

        if (file_exists("/data/sites/bx1.be/httpdocs/files/"  . $CF . "_voix_preference.json"))
            { ?>
    <div class="row" style="text-align:center;">
    	<h1><br><br>Les voix de préférences</h1>
    	<table>
    		<tr>
    	<?php
            foreach ($json_content_voix_prefs["candidats"] as $candidat)
                {
                    if(file_exists("/data/sites/bx1.be/httpdocs/img/elections/" . $candidat["photo"]))
                        {
                            $photo = "/img/elections/" . $candidat["photo"];
                        }
                    else
                        {
                            $photo = "/img/elections/nopicture.png";
                        }
                    $nomcandidat = utf8_decode($candidat["candidat"]);
                    echo "<td style='vertical-align: top;' width=200px>";
                    echo "<div class=\"blocklogo col-lg-2 col-sd-2 col-md-2 col-6\" style='margin: auto;text-align: center;max-width:140px;display:inline-table;padding:10px;height:200px;'>";
                    echo "<img class=\"logocandidat\" src=\"" . $photo . "\"></div>";
                    echo "<div class=\"row resulatacandidat\" style=\"text-align: center;\">
                            <div class=\"col-md-12\" style=\"max-height: 75px;height: 75px;\"><h1 style='font-size: 2vh'>" . $candidat["nomabrege"] . "</h1><br><br></div>";
                    echo "<div class=\"col-md-12\"><h4>2019 : <span style='white-space:nowrap;'>" . number_format($candidat["voix2019"],0,',',' ') . " Voix</span></h4></div></div>";
                    echo "<div class=\"col-md-12\"><h6>2014 : <span style='white-space:nowrap;'>" . number_format($candidat["voix2014"],0,',',' ') . " Voix</span></h6></div></div>";
                    echo "</div>";
                    echo "</td>";
                }

        ?></tr></table>
    </div>
<?php }?>
    </section>
 <section class="sideFil">
    <?php dynamic_sidebar('filinfo'); ?>
    <?php get_sidebar(); ?>
  </section>
        <script>
            var optionspie = {
                chart: {
                	width: '40%',
                    type: 'donut',
                    height:400
                },
                responsive: [{
    				breakpoint: 995,
    					options: {
    						chart: {
		                	width: '100%',
		                    type: 'pie',
		                    height:400
		                },
    					}
    				}],
                legend:{
                    floating:false,
                    position:'bottom',
                    horizontalAlign: 'center',
                    verticalAlign:'bottom'
                },
                dataLabels:{
                    enabled: false,
                    style: {
                        colors:[<?php
		                    foreach ($CouleurPartisHEX as $couleurhex)
		                    {
			                    echo "'$couleurhex',";
		                    }
		                    ?>]
                    }
                },

                colors:[<?php
	                foreach ($CouleurPartisHEX as $couleurhex)
	                {
		                echo "'$couleurhex',";
	                }
	                ?>],
                fill:{
                    colors:[<?php
		                foreach ($CouleurPartisHEX as $couleurhex)
		                {

			                echo "'$couleurhex',";
		                }
		                ?>]
                },

                series: [<?php
	                    foreach ($ResultatPartis as $resultatparti)
	                    {
		                    echo "$resultatparti,";
	                    }
	                    ?>],
                labels: [<?php
		            foreach ($NomPartis as $nomparti)
		            {
			            echo "\"" . $nomparti . "\",";
		            }
		            ?>],
            }


            var chartpie = new ApexCharts(
                document.querySelector("#chartpie"),
                optionspie
            );
            chartpie.render();
        </script>
        <script>
            var options = {
                chart: {
                    height: 500,
                    width: '100%',
                    type: 'bar',
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: 'flat',
                        columnWidth: '55%',
                    },
                },
                dataLabels: {
                    enabled: false,
                    formatter: function (val) {
                        return val
                    },
                    textAnchor:'end',
                     position: '100%',
                    style:{
                        fontSize:'16px'
                    },
                },
                legend:{
                    enabled:true,
                    position:'top'
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Résultats 2014',
                    data: [<?php
				        foreach ($ResultatPartisHisto2012 as $resultatparti2012)
				        {
					        echo "$resultatparti2012,";
				        }
				        ?>]
                }, {
                    name: 'Résultats 2019',
                    data: [<?php
				        foreach ($ResultatPartisHisto2018 as $resultatparti2018)
				        {
					        echo "$resultatparti2018,";
				        }
				        ?>]
                }],
                xaxis: {
                    categories: [<?php
				        foreach ($NomPartisHisto as $nomparti)
				        {
					        echo "\"" . strtoupper($nomparti) . "\",";
				        }
				        ?>],
                    tickAmount: 6,
                    labels: {
                        show:true
                    }
                },
                yaxis: {
                    title: {
                        text: '% de voix'
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + "% de voix"
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#chart"),
                options
            );

            chart.render();
        </script>
<?php get_footer(); ?>