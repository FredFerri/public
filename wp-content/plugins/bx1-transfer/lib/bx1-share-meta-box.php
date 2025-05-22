<?php

/**
 * Register a meta box using a class.
 */
class BX1_Share_Meta_Box {
  /**
   * SelfPath to allow themes as well as plugins.
   *
   * @var string
   */
  protected $SelfPath;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->SelfPath = plugins_url(null, plugin_basename(dirname(__FILE__)));
    if (is_admin()) {
      add_action('load-post.php',     array($this, 'init_metabox'));
      add_action('load-post-new.php', array($this, 'init_metabox'));
    }
  }

  /**
   * Meta box initialization.
   */
  public function init_metabox() {
    add_action('add_meta_boxes',     array($this, 'add_metabox'));
    add_action('save_post',          array($this, 'save_metabox'), 10, 2);
    add_action('admin_print_styles', array($this, 'load_scripts_styles'));
  }

  /**
   * Load all Javascript and CSS.
   */
  public function load_scripts_styles() {
    wp_enqueue_script('bx1_share', $this->SelfPath . '/js/bx1_transfer.js', array('jquery'));
  }

  /**
   * Adds the meta box.
   */
  public function add_metabox($post_type) {
    // Limit meta box to certain post types.
    $post_types = array('post', 'emission','radio-emission','radio-chronique');

    if (in_array($post_type, $post_types)) {
      add_meta_box(
          'bx1-share-meta-box',
          __('Share the video on social networks', 'textdomain'),
          array($this, 'render_metabox'),
          $post_type,
          'side',
          'high'
      );
    }
  }

  /**
   * Renders the meta box.
   */
  public function render_metabox($post) {
    // Add nonce for security and authentication.
    wp_nonce_field('bx1_share_metabox_action', 'bx1_share_metabox');

    $video_name = null;
    if ($post->post_type == 'post') {
      $video_name = get_post_meta($post->ID, 'wpcf-video-name-news', true);
    }
    elseif ($post->post_type == 'emission') {
      $video_name = get_post_meta($post->ID, 'wpcf-nom-du-fichier-video', true);
    }
    elseif ($post->post_type == 'radio-emission'){
      $video_name = get_post_meta($post->ID, 'wpcf-video-chronique', true);
    }
    elseif ($post->post_type == 'radio-chronique'){
      $video_name = get_post_meta($post->ID, 'wpcf-video-chronique', true);
    }
    // Le post n'est pas publié ou n'a pas de vidéo à uploader.
    if ('publish' != $post->post_status || empty($video_name)) {
      ?><p><?php _e('The post must have a video and be published to upload this video on social networks.', 'textdomain'); ?></p><?php
    }
    else {
      ?>
      	<p class="disclaimer">
      		<?php _e('By uploading a video, you certify that you own all rights to the content or that you are authorized by the owner to make the content publicly available on YouTube, and that it otherwise complies with the YouTube Terms of Service located at <a href="http://www.youtube.com/t/terms" target="_blank">http://www.youtube.com/t/terms</a>', 'textdomain'); ?>
      	</p>
        <p><input value="<?php _e('Upload on YouTube', 'textdomain'); ?>" data-id="<?php print $post->ID; ?>"
        			 id="bx1_share_youtube" class="bx1_share button" type="button"/></p>
        <p class="disclaimer">
        	<?php _e('Facebook limits the videos upload to a size of 10 Go maximum and to a duration of 4 hours maximum.', 'textdomain'); ?>
        </p>
        <p><input value="<?php _e('Upload on Facebook', 'textdomain'); ?>" data-id="<?php print $post->ID; ?>"
        			 id="bx1_share_facebook" class="bx1_share button" type="button"/></p>
      <?php
    }
  }

  /**
   * Handles saving the meta box.
   *
   * @param int     $post_id Post ID.
   * @param WP_Post $post    Post object.
   * @return null
   */
  public function save_metabox($post_id, $post) {
    // Add nonce for security and authentication.
    $nonce_name   = isset($_POST['bx1_share_metabox']) ? $_POST['bx1_share_metabox'] : '';
    $nonce_action = 'bx1_share_metabox_action';

    // Check if nonce is set.
    if (! isset($nonce_name)) {
      return;
    }

    // Check if nonce is valid.
    if (! wp_verify_nonce($nonce_name, $nonce_action)) {
      return;
    }

    // Check if user has permissions to save data.
    if (! current_user_can('edit_post', $post_id)) {
      return;
    }

    // Check if not an autosave.
    if (wp_is_post_autosave($post_id)) {
      return;
    }

    // Check if not a revision.
    if (wp_is_post_revision($post_id)) {
      return;
    }
  }
}
