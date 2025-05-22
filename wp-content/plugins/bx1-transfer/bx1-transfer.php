<?php
/*
Plugin Name: BX1 - Transfer BX1 videos to YouTube and Facebook
Version: 0.1
Author: Marie Detroz (defimedia)
Author URI: https://www.defimedia.be/
License: GPL2
*/

if (!class_exists('BX1_Share_Meta_Box')) {
  require_once dirname(__FILE__) . '/lib/bx1-share-meta-box.php';
}
$meta_box = new BX1_Share_Meta_Box();
