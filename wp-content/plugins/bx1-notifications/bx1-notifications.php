<?php
/*
Plugin Name: BX1 - Notifications
Description: Notifie AWS of new "Flash News" posts.
Version: 0.1
Author: Jolan Delvaux (defimedia)
Author URI: https://www.defimedia.be/
License: GPL2
*/

require __DIR__.'/vendor/autoload.php';


function bx1_notifications_action($post_id) {
  // If this is just a revision, don't send the notification.
  if (wp_is_post_revision($post_id)) {
    return;
  }

  // Only new published "flash news" posts can be notified.
  if ('publish' === get_post_status($post_id)) {
    $flash_news = get_post_meta($post_id, 'wpcf-flash-news', true);
    if ($flash_news == true) {
      $notified = get_post_meta($post_id, 'bx1-notified', true);
      if (empty($notified)) {

        $AmazonSNS = new AmazonSNS('AKIAIWEPOISF2GQTDO4Q','sejeGsPe7/kfcIXOG9Ad2whLFDC/m3ABFZRA+MLD');
        $AmazonSNS->setRegion('eu-west-1');

        $postcat = get_the_category($post_id);
        if(!empty($postcat)){
          $catid = esc_html($postcat[0]->slug);   
        }

        $json = file_get_contents('https://'.$_SERVER['HTTP_HOST'].'/categories.json');
        $table_arn = json_decode($json,true);
        $key = array_search($catid,array_column($table_arn,'slug'));

        if($key != NULL || $key === 0){
        	$arn = $table_arn[$key];
	        $arn = $arn["arn"];
	        try {
	          $AmazonSNS->publish($arn, 'FLASH NEWS : '.get_the_title($post_id));
	        }
	        catch(SNSException $e) {
	          error_log('SNS returned the error "' . $e->getMessage() . '" and code ' . $e->getCode());
	        }
	        catch(APIException $e) {
	          error_log('There was an unknown problem with the API, returned code ' . $e->getCode());
	        }
        }
        else{
        	error_log('Flash news notification : the category doesn\'t exist in Amazon SNS');
        }
        
      }
    }
  }
}
add_action('save_post', 'bx1_notifications_action');
