<?php
/*********************************************
 *   Project : BX1 - PROD
 *   File    : agenda-details.php
 *
 *   Company : Infinite-IT
 *   Author  : DE NAEYER Bruno
 *   Support : support@infinite-it.be
 *
 *   File Created on 02 March 2020
 *   Don't edit this code without authorization
 *********************************************/
require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
global $wp;
get_header();
$getDetails = callAPI( 'GET', 'https://apidata.brussels/v1/event/' . $_GET["ID"], false, false, false, 0 );
$response   = json_decode( $getDetails, true );
$data       = $response['data'];
?>
<link rel="stylesheet" href="<?php echo plugin_dir_url( __FILE__ ); ?>assets/css/style.css">
<script src="https://kit.fontawesome.com/8d9d719a34.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://use.typekit.net/srz0xsf.css">
<div class="agenda-detail">
	<div class="title category<?php echo $data["categories"]["main"]["id"]; ?>"><?php echo  "<H1>" . $data["translations"]["fr"]["name"] . "</H1>"; ?></div>
	<div class="categories category<?php echo $data["categories"]["main"]["id"]; ?>"><?php echo  "<H1><span class=\"square\"></span>" . $data["categories"]["main"]["translations"]["fr"] . " | " . $data["categories"]["others"]["translations"]["fr"][0] . "</H1>"; ?></div>
	<div class="row">
		<div class="imagetop"><?php
				foreach ($data["media"] as $media)
					{
						if ($media["type"] == "photo")
							{
								echo "<img src='" . $media["link"] . "'>";
								break;
							}
					}
			?></div>
		<div class="informations">
            <span class="category<?php echo $data["categories"]["main"]["id"]; ?>">Informations</span>
			<div class="infotitle">Dates</div>
			<div class="infocontent" style="padding-left: 16px;"><?php
				    setlocale(LC_TIME, "fr_FR");
				    echo utf8_encode(strftime("%d %h %Y",strtotime($data["date_start"])));
                    //echo date("d m Y",$data["date_start"]);?> &mdash; <?php echo utf8_encode(strftime("%d %h %Y",strtotime($data["date_end"])));?></div>
			<div class="infotitle">Lieu</div>
			<div class="infocontent address">
				<span class="placename"><?php echo $data["place"]["translations"]["fr"]["name"]; ?></span>
				<span class="street"><?php echo $data["place"]["translations"]["fr"]["address_line1"]; ?><br><?php echo $data["place"]["translations"]["fr"]["address_line2"]; ?></span>
				<span class="phone"><?php echo $data["place"]["translations"]["fr"]["phone_contact"];?></span>
				<?php if ($data["place"]["translations"]["fr"]["phone_booking"] == $data["place"]["translations"]["fr"]["phone_contact"])
					{ ?>
				<span class="phonebooking"><?php echo $data["place"]["translations"]["fr"]["phone_booking"]; ?></span>
				<?php } ?>
				<span class="email"><?php echo $data["place"]["translations"]["fr"]["email"]; ?></span>
			</div>
			<?php if($data["organizer"]["translations"]["fr"]["name"] == $data["place"]["translations"]["fr"]["name"])
				{?>
			<div class="infotitle">Organisateur</div>
			<div class="infocontent" style="padding-left: 16px;"><?php echo $data["organizer"]["translations"]["fr"]["name"]; ?></div>
			<?php } ?><br><br>
            <form method="post" action="<?php echo plugin_dir_url( __FILE__ );?>includes/download-ics.php">
                <input type="hidden" name="eventid" value="<?php echo $_GET["ID"]; ?>">
                <input type="hidden" name="date_start" value="<?php echo strftime("%Y-%m-%d",strtotime($data["date_start"])); ?>">
                <input type="hidden" name="date_end" value="<?php echo strftime("%Y-%m-%d",strtotime($data["date_end"])); ?>">
                <input type="hidden" name="location" value="<?php echo $data["place"]["translations"]["fr"]["name"]; ?> - <?php echo $data["place"]["translations"]["fr"]["address_line1"]; ?> <?php echo $data["place"]["translations"]["fr"]["address_line2"]; ?>">
                <input type="hidden" name="description" value="<?php echo $data["translations"]["fr"]["shortdescr"];?>">
                <input type="hidden" name="summary" value="<?php echo $data["translations"]["fr"]["name"]; ?>">
                <input type="hidden" name="url" value="<?php echo home_url( $wp->request ); ?>>">
                <button type="submit"><i class='fa fa-calendar'></i>&nbsp;&nbsp;Ajouter à mon calendrier</button>
            </form>
		</div>
	</div>
    <?php
    $openningtimedata = $data["weekschema"][0]["days"];
    //print_r($openningtimedata);
    function CheckOpeningTime($day){
        global $openningtimedata;
	    //print_r($openningtimedata);
        //echo "@@@" . $openningtimedata["monday"]["is_open"] . "@@@";
	    if($openningtimedata["$day"]["is_open"] == 1)
            {
                $start = strtotime($openningtimedata["$day"]["hours"][0]["start"]);
	            $start = date("H",$start) . "h" . date("i",$start);
	            $end = strtotime($openningtimedata["$day"]["hours"][0]["end"]);
	            $end = date("H",$end) . "h" . date("i",$end);

                echo $start . " - " . $end;
            }
	    else
	        {
	            echo 'Fermé!';
             }

    }

    ?>
	<div class="description">
		<span class="category<?php echo $data["categories"]["main"]["id"]; ?>"><?php echo $data["translations"]["fr"]["shortdescr"]; ?></span>
		<?php echo $data["translations"]["fr"]["longdescr"];?>
        <br><br>
        <H4>Horaires</H4><br>
        <span class="daysopen">Lundi</span><span class="hoursopen"><?php CheckOpeningTime("monday"); ?></span>
        <span class="daysopen">Mardi</span><span class="hoursopen"><?php CheckOpeningTime("tuesday"); ?></span>
        <span class="daysopen">Mercredi</span><span class="hoursopen"><?php CheckOpeningTime("wednesday"); ?></span>
        <span class="daysopen">Jeudi</span><span class="hoursopen"><?php CheckOpeningTime("thursday"); ?></span>
        <span class="daysopen">Vendredi</span><span class="hoursopen"><?php CheckOpeningTime("friday"); ?></span>
        <span class="daysopen">Samedi</span><span class="hoursopen"><?php CheckOpeningTime("saturday"); ?></span>
        <span class="daysopen">Dimanche</span><span class="hoursopen"><?php CheckOpeningTime("sunday"); ?></span>
	</div>
	<div class="medias">
		<span class="category<?php echo $data["categories"]["main"]["id"]; ?>">Médias</span>
        <div class="medialist">
		<?php
			foreach ($data["media"] as $media)
			{
				if ($media["type"] == "photo")
				{
					echo "<img src='" . $media["link"] . "'>";
				}
			}
		?>
        </div>
	</div>
</div>
<?php get_footer();?>

