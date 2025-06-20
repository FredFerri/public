<?php

/**
 * The sidebar containing the main widget area.
 *
 * @package TeleBruxelles
 */

// echo "YAYYYYYYYYYYYYYYYYYY";

if (! is_active_sidebar('sidebar-3')) {
  return;
}
?>

<div id="pubAside">

  <?php if (is_user_logged_in() && $_COOKIE['nopub'] == 'on'): ?>
    <!-- Nopub activé -->
  <?php else: ?>
    <!-- ads - zone images publicitaires bannering_imu -->
    <div id="gestcom_56"></div>
  <?php endif; ?>

  <?php dynamic_sidebar('sidebar-3'); ?>
</div>