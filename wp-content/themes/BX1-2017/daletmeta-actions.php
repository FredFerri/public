<?php
	$section 	= $_GET["section"];
	switch ($section){
		case 'staging':
			$WPDIR = '/data/sites/bx1.be/staging.bx1.be';
			$WPURL = 'staging.bx1.be';
			$DALETMETA	= '/data/sites/bx1.be/daletmeta/staging';
			break;
		case 'prod':
			$WPDIR = '/data/sites/bx1.be/httpdocs';	
			$WPURL = 'bx1.be';
			$DALETMETA	= '/data/sites/bx1.be/daletmeta/prod';
			break;
	}
	include_once($WPDIR."/wp-load.php");
	require_once($WPDIR."/wp-admin/includes/image.php");
	require_once($WPDIR."/wp-admin/includes/file.php");
	require_once($WPDIR."/wp-admin/includes/media.php");
	if($_GET["action"] == "deletemedia" && !empty($_GET["mediaid"]))
		{
			wp_delete_attachment($_GET["mediaid"], true);
		}
	elseif($_GET['action'] == "deletefile" && isset($_GET['XMLID']))
		{
			unlink($DALETMETA . "/" . $_GET['XMLID']);
		}
	elseif($_GET["action"] == "updatepost" && !empty($_GET["postid"]))
		{
			$XML			= $_GET['file'];
			$filename 		= basename($XML, ".xml");
			$filename 		= basename($filename, ".XML");
			$xmldata 		= simplexml_load_file($XML) or die("Failed to load");
			$Emission   	= (string) $xmldata->Emission;
			$Titre			= (string) $xmldata->TitreArticle;
			$difdate		= (string) $xmldata->Publication;
			$premdiff		= (string) $xmldata->DatePremDiff;
			$Contenu		= (string) $xmldata->TexteArticle;
			$ItemCde		= (string) $xmldata->Itemcode;
			$premdiff		= strtotime($premdiff);
			//echo $premdiff;
			if ($difdate != "")
				{
					//$difdate		= strtotime($difdate);
					$publication	= 'publish';
				}
			else
				{
					$difdate 		= new DateTime("now", new DateTimeZone('Europe/Brussels') );
					$difdate		= strtotime($difdate->format('Y-m-d H:i:s'));
					$publication	= 'draft';
				}
			$post_update = array(
				'ID'         	=> $_GET["postid"],
				'post_title'    => $Titre,
				'post_content'  => $Contenu,
				'post_status'   => $publication,  
				'post_author'   => 1,
				'post_date'     => $difdate,
				'post_type'	  	=> 'emission',
				'meta_input'	=> array(
  					'wpcf-nom-du-fichier-video'	=> $filename,
  					'wpcf-horaire-debut'		=> $premdiff
				)
			  );
			  
			  wp_update_post( $post_update );
		}
		elseif($_GET['action'] == "addemissionfile" && isset($_GET['ShowID']) && isset($_GET['XMLID']))
			{
				$emissionfile 	= fopen($DALETMETA . "/" . $_GET['XMLID'] . "_codeemission.txt", "w") or die("Unable to open file!");
				$txt = $_GET['ShowID'];
				fwrite($emissionfile, $txt);
				fclose($emissionfile);
			}