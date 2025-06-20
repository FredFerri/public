<?php
	$_CONFIG["VERSION"]				=	"1.0";
	$_CONFIG["WPDIR"]				=	"/data/sites/bx1.be/staging.bx1.be";
	$options						=	getopt("hvY:F:D:");
	$debug 							=	"no";
	@$_OPTIONS["HELP"]				=	$options["h"];
	@$_OPTIONS["VERSION"]			=	$options["v"];
	@$_OPTIONS["FILE"]				=	$options["F"];
	@$_OPTIONS["DIR"]				=	$options["D"];
	$help  = "\nScript Usage :\n\n";
	$help .= "\t " . basename(__FILE__) . " -D <directory> | -F <filename> \n";
	$help .= "\t\t-v Show Version informations\n";
	$help .= "\t\t-h Display this help message\n";
	$help .= "\t\t-D Directory where XML is stored\n";
	$help .= "\t\t    - or -\n";
	$help .= "\t\t-F Specify the file you want to read\n";
	if (isset($_OPTIONS["VERSION"]) ) {

		echo "\nWordPress Create post from XML Cron\n";
		echo "---------------------------------------\n\n";

		echo "Version \t: " . $_CONFIG["VERSION"] . "\n";
		echo "Developper\t: bruno@infinite-it.be\n";
		echo "Customer\t: BX1 ASBL - 2023\n\n";
		exit();
		}
	elseif (isset($_OPTIONS["FILE"]) && isset($_OPTIONS["DIR"])) {
		echo "\n   Error !  \n";
		echo "   -------\n";
		echo "    -> You cannot set file and directory into same command line !\n\n";
		exit();
		}	
	elseif ( isset($_OPTIONS["FILE"]) || isset($_OPTIONS["DIR"])) {
			$logfile = fopen("logs/DaletMetaData-logs-" . date("Y-m-d") . ".log", "a+") or die("Unable to open file!");
			if ($debug == "yes"){
				$debugfile = fopen("logs/DaletMetaData-logs-" . date("Y-m-d") . "-debug.log", "a+") or die("Unable to open file!");
			}
			$logcontent = "======================  Create New Post  ======================\n";
			if (isset($_OPTIONS["FILE"]))
				{	
					$logcontent.= "\n Date : " . date("Y-m-d H:i:s.u") . " | Filename : " . $_OPTIONS["FILE"];
				}
			elseif (isset($_OPTIONS["DIR"]))
				{
					$logcontent.= "\n Date : " . date("Y-m-d H:i:s.u") . " | Directory : " . $_OPTIONS["DIR"];
				}	
			$logcontent .= "\n---------------------------------------------------------------";
			fwrite($logfile, "\n". $logcontent);
			if ($debug == "yes"){
				fwrite($debugfile, "\n". $logcontent."\n");
			}
			include_once($_CONFIG["WPDIR"] . "/wp-config.php");
			if (isset($_OPTIONS["FILE"]))
				{
					$logcontent = "\n Start reading file\n";
					fwrite($logfile, "\n". $logcontent);
					$xmldata = simplexml_load_file($_CONFIG["WPDIR"] . "/xmlparser/" . $_OPTIONS["FILE"]) or die("Failed to load");
					$my_post = array(
					  'post_title'    => wp_strip_all_tags( $xmldata->Titre ),
					  'post_content'  => $xmldata->Contenu,
					  'post_status'   => 'publish',
					  'post_author'   => 68,
					  'post_category' => array( 1,14 )
					);

					// Insert the post into the database
					$postid = wp_insert_post( $my_post );
					$logcontent = "\n Post is created with ID " . $postid . "\n";
					fwrite($logfile, "\n". $logcontent);
					if ($postid) {
						add_post_meta($postid, 'wpcf-flash-news', 0);
						add_post_meta($postid, 'wpcf-featured-news', 0);
						add_post_meta($postid, 'wpcf-exclusif-blog', 0);
						set_post_thumbnail( $postid, '385671' );
					}
				}
			elseif (isset($_OPTIONS["DIR"]))
				{
					$XMLFiles = glob($_OPTIONS["DIR"] . '/*.xml');
					if (empty($XMLFiles))
					{
						$logcontent = "\n Folder id empty - No file to read\n";
						fwrite($logfile, "\n". $logcontent);
					}
					foreach ($XMLFiles as $XML) {
							$Filename   = end(explode('/', $XML));
							
							$logcontent = "\n Reading file : " . $XML;
							fwrite($logfile, "\n". $logcontent);
							$xmldata 	= simplexml_load_file($XML) or die("Failed to load");
							$Emission   = $xmldata->Emission;
							$pubdate	= $xmldata->Publication;
							$difdate	= $xmldata->DateEmission;
							$Contenu	= $xmldata->Contenu;
							if ($Contenu == '')
								{
									$Contenu = "&nbsp;";
								}
							if ( !empty( $pubdate ) && $pubdate != '' )
								{
									$pubdate	 =	explode('T', $pubdate);
									$pubtime 	 =	explode('.', $date[1]);
									$pubdate 	 =	$pubdate[0] . " " . $pubtime[0];
									$my_post = array(
										  'post_title'    => wp_strip_all_tags( $xmldata->Titre ),
										  'post_content'  => $Contenu,
										  'post_status'   => 'draft',
										  'post_type'	  => 'emission',
										  'post_date'     => $pubdate,
										  'post_author'   => 68,
										  'post_category' => array ( $_EMISSION[ "$Emission" ]["ID"] )
										);
								}
							else
								{
									$my_post = array(
										  'post_title'    => wp_strip_all_tags( $xmldata->Titre ),
										  'post_content'  => $Contenu,
										  'post_status'   => 'publish',
										  'post_type'	  => 'emission',
										  'post_author'   => 68,
										  'post_category' => array ( $_EMISSION[ "$Emission" ]["ID"] )
										);
								}	
							
							$postid = wp_insert_post( $my_post );
							$logcontent = " Post is created with ID " . $postid . "\n";
							fwrite($logfile, "\n". $logcontent);
							if ($postid) {
								$videoname = explode(".", $Filename);
								add_post_meta($postid, 'wpcf-nom-du-fichier-video', $videoname[0]);
								add_post_meta($postid, '_yoast_wpseo_primary_type_emissions', $_EMISSION[ "$Emission" ]["ID"]);
								if ( $difdate != '')
									{
										$difdate =	explode('T', $difdate);
										$diftime =	explode('.', $date[1]);
										$difdate =	$difdate[0] . " " . $diftime[0];
										//$difdate =  strtotime($difdate);
										add_post_meta($postid, 'wpcf-horaire-debut', "$difdate");
									}
								else
									{
										$difdate = date("Y-m-d H:i:s");
										//$difdate = strtotime($difdate);
										add_post_meta($postid, 'wpcf-horaire-debut', "$difdate");	
									}	
								//add_post_meta($postid, 'wpcf-flash-news', 0);
								//add_post_meta($postid, 'wpcf-featured-news', 0);
								//add_post_meta($postid, 'wpcf-exclusif-blog', 0);
							}
							
							$imageEmission = $_EMISSION[ "$Emission" ]["DefaultImageID"];
							set_post_thumbnail( $postid, $imageEmission );
							$xmldata = null;
							
							if ($postid != null)
								{
									//rename($_OPTIONS["DIR"] . "/" . $Filename, $_OPTIONS["DIR"] . "/done/" . $Filename);
									$logcontent = " File moved to " . $_OPTIONS["DIR"] . "/done/" . $Filename . "\n";
									fwrite($logfile, "\n". $logcontent);
								}
							else
								{
									//rename($_OPTIONS["DIR"] . "/" . $Filename, $_OPTIONS["DIR"] . "/error/" . $Filename);
									$logcontent = " File moved to " . $_OPTIONS["DIR"] . "/error/" . $Filename . "\n";
									fwrite($logfile, "\n". $logcontent);
								}
						}
				}
				$logcontent = "========================  END OF JOB  =========================\n";
				fwrite($logfile, "\n". $logcontent);
		}
	elseif( isset($_OPTIONS["HELP"]))
		{
		echo $help;
		exit();
		}
	else{
		echo $help;
		exit();
		}
?>