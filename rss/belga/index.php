<?php echo '<?xml version="1.0" encoding="UTF-8"?>'."\n" ?>
<rss xmlns:dc="http://purl.org/dc/elements/1.1/" version="2.0">
  <channel>
    <title>BX1</title>
    <link>http://www.belga.be</link>
    <description>BX1 - RSS News +</description>
    <language>fr</language>
    <dc:language>fr</dc:language>
<?php 
function getFeed($feed_url) {
     
    $content = file_get_contents($feed_url);
    $x = new SimpleXmlElement($content);
     
    foreach($x->channel->item as $entry) {
	#print_r($entry);
        if(empty($entry->title)){
                continue;
        }
	$namespaces = $entry->getNameSpaces(true);
	$dc = $entry->children($namespaces['dc']); 
	echo "<item>\n";
        echo "\t<title>" . htmlspecialchars($entry->title,ENT_NOQUOTES) . "</title>\n";
        $now = microtime(true);
	usleep(100);
	echo "\t<link>" .  $entry->guid . "</link>\n";
	$enc_img = $entry->enclosure->attributes()->url;
	echo "\t<description>";
	 if(isset($enc_img)){ echo "<![CDATA[<img src=\"".$enc_img."\">]]>";}
	echo  htmlspecialchars($entry->description,ENT_NOQUOTES); 
	echo "</description>\n";
	echo "\t<pubDate>" . $entry->pubDate . "</pubDate>\n";
	echo "\t<guid isPermaLink=\"false\">" . $entry->guid . "</guid>\n";
	echo "\t<dc:date>" . $dc->date . "</dc:date>\n"; 
	echo "</item>\n";
    }

}

$feed_url = 'http://rss.belga.be/rss/belga_telebxl_n_fr_rss.xml';
getFeed($feed_url);

?>
  </channel>
</rss>
