<?php
/**
 * Custom WordImpress RSS2 Feed
 * Integrates Featured Image as "Enclosure"
 * See http://www.rssboard.org/rss-2-0-1#ltenclosuregtSubelementOfLtitemgt
 * for RSS 2.0 specs
 * @package WordPress
 */
require( dirname( __FILE__ ) . '/../../wp-load.php' );
header('Content-Type: ' . feed_content_type('rss-http') . '; charset=' . get_option('blog_charset'), true);
$more = 1;
$postimages = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );

$dayofweek    = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
$dayinfrench  = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
$day          = str_replace($dayofweek, $dayinfrench, ucfirst(strftime("%A")));
$monthofyear  = array("January","February","March","April","May","June","July","August","September","October","November","December");
$monthinfrench= array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Décembre");
$month        = str_replace($monthofyear, $monthinfrench, ucfirst(strftime("%B")));
$date         = ucfirst(strftime('%e')); 
$monthnum     = strftime("%m");
$year         = strftime('%Y'); 
$newdate      = $day." ".$date." ".$month." ".$year;
$newdatenum   = $year.$monthnum.$date;
// Check for images
if ( $postimages ) {

  // Get featured image
  $postimage = $postimages[0];

} else {}

echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';

/**
 * Fires between the <xml> and <rss> tags in a feed.
 * @since 4.0.0
 * @param string $context Type of feed. Possible values include 
 * 'rss2', 'rss2-comments', 'rdf', 'atom', and 'atom-comments'.
 */
 
do_action( 'rss_tag_pre', 'rss2' );
?>
<rss version="2.0"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:wfw="http://wellformedweb.org/CommentAPI/"
  xmlns:dc="http://purl.org/dc/elements/1.1/"
  xmlns:atom="http://www.w3.org/2005/Atom"
  xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
  xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
  <?php
  /**
   * Fires at the end of the RSS root to add namespaces.
   * @since 2.0.0
   */
  do_action( 'rss2_ns' );
  ?>
>

<channel>
  <title><?php bloginfo_rss('name'); ?></title>
  <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
  <link><?php bloginfo_rss('url') ?></link>
  <description><?php echo $newdate;?></description>
  <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified($timezone = 'server'), false); ?></lastBuildDate>
  <language><?php bloginfo_rss( 'language' ); ?></language>
  <?php
  $duration = 'hourly';
  /**
   * Filter how often to update the RSS feed.
   * @since 2.1.0
   * @param string $duration The update period.
   * Default 'hourly'. 
   * Accepts 'hourly', 'daily', 'weekly', 'monthly', 'yearly'.
   */
  ?>
  <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', $duration ); ?></sy:updatePeriod>
  <?php
  $frequency = '1';
  /**
   * Filter the RSS update frequency.
   * @since 2.1.0
   * @param string $frequency An integer passed as a string 
   * representing the frequency of RSS updates within the update period. 
   * Default '1'.
   */
  ?>
  <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', $frequency ); ?></sy:updateFrequency>
  <?php
  /**
   * Fires at the end of the RSS2 Feed Header.
   * @since 2.0.0
   */
  do_action( 'rss2_head');
  $my_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 6));
  if ( $my_query->have_posts() ) { 
    $i 			= 1;
    //$article    = null;
    while ( $my_query->have_posts() ) { 
      $my_query->the_post();
      ?>
  
    <?php
      if ($i == 1)
      	{
          setlocale(LC_ALL, 'en_US');
    ?>
	    <item>
      <pubDate><?php echo date(DATE_RFC822, get_post_time('U', false));?></pubDate>
      <guid isPermaLink="false">http://bx1.be/?p=<?php echo get_the_ID();?></guid>
	    <description>
    <?php
	    	$article = "<tr>";
  		}
    	if (($i % 2) != 0  && $i != 1) {
         	$article = "<tr>";
      		}
      $falsechar  = array(' ',"'","´",'&rsquo;');
      $truechar   = array('+','%60','%60','%60');
      $TWText     = str_replace($falsechar, $truechar, get_the_excerpt());
      $TWLink     = htmlentities(substr($TWText, 0, 110)) . "%2E%2E%2E%0Dhttp://bx1.be/%3Fp=" . get_the_ID();
      add_filter( 'the_content_more_link', 'remove_more_link_scroll' );
      add_image_size( 'rss-thumb', 260, 9999 );
      add_filter( 'rss', 'rss-thumb' );
      $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'rss-thumb');
      //print_r($image);
      $imagelink  = explode(".", $image[0]);
      $imageext   = end($imagelink);
      $imageextl  = strlen(".".$imageext);
      $newimageln = substr($image[0], 0,-$imageextl);
      $newimage   = $newimageln."-".$image[1]."x".$image[2].".".$imageext;
      $article   .= "<td align=\"center\" valign=\"top\" class=\"templateColumnContainer\" style=\"padding-top:20px;\" width=\"300px\">
        <table border=\"0\" cellpadding=\"20\" cellspacing=\"0\" width=\"300px\">
          <tr>
            <td>
              <img src=\"" . $newimage . "\" class=\"artimage\" style=\"width:260px; max-width:260px;\" />
            </td>
          </tr>
          <tr>
            <td class=\"titlenews\">
              <h2>" . get_the_title_rss() . "</h2>
            </td>
          </tr>
          <tr>
            <td valign=\"top\">
              <font color=\"#fff\">" . get_the_excerpt() . "</font><br/><br/>
              <table>
            	<tr>
            		<td>
              			<a href=\"" . get_the_permalink() . "?utm_campaign=". $newdatenum . "&utm_medium=Email&utm_source=Newsletter\" class=\"readmorbutton\"><img src=\"http://bx1.be/img/readmore.png\" height=\"30px\" width=\"90px\" /></a>
              		</td>
              	</tr>
              </table>
            </td>
          </tr>
          <tr>
            <td valign=\"top\">
            <table>
            <tr>
            <td>
              <img src=\"http://bx1.be/img/share.png\" height=\"25px\" width=\"25px\" />
              </td><td style=\"margin: 0 auto;\">
              <a target=\"_blank\" href=\"https://www.facebook.com/sharer/sharer.php?u=" . get_the_permalink() . "\"><img src=\"http://bx1.be/img/nwslfbshare.png\" height=\"25px\" width=\"25px\" /></a>
              </td><td>
              <a target=\"_blank\" href=\"https://twitter.com/intent/tweet?text=" . $TWLink . "\"><img src=\"http://bx1.be/img/nwsltwshare.png\" style=\"height:25px!important;width:25px!important;\" height=\"25px\" width=\"25px\" /></a>
              </td><td>
              <a target=\"_blank\" href=\"https://plus.google.com/share?url=" . get_the_permalink() . "\"><img src=\"http://bx1.be/img/nwslgplusshare.png\" height=\"25px\" width=\"25px\" /></a>
              </td></tr></table>
            </td>
          </tr>
        </table>
      </td>";
      if (($i % 2) == 0 && $i != 6) {
        $article = $article."</tr>";
      }
	if ($i == 6){
        $article = $article."</tr>";
		    $article = $article."</table>";
		}
      echo  htmlspecialchars($article);
      $article = null;
    $i++;
    }
  }
$applications = "<tr><td><table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" id=\"templateFooter\">
  <tr>
    <td align=\"center\">
      <table>
        <tr>
          <td align=\"right\"><a target=\"_blank\" href=\"https://itunes.apple.com/be/app/bx1/id1088283244\"><img src=\"http://bx1.be/img/appstore.png\" style=\"height:35px;\"></a></td>
          <td align=\"left\"><a target=\"_blank\" href=\"https://play.google.com/store/apps/details?id=be.bx1.app\"><img src=\"http://bx1.be/img/googleplay.png\" style=\"height:35px;\"></a></td>
        </tr>
      </table>
    </td>
  </tr>
</table>";
echo  htmlspecialchars($applications);
 ?>
</description>
</item>
</channel>
</rss>