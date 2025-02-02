<?php
(defined('ABSPATH')) || exit;

wp_logout();
wp_redirect(arma_base_url());
exit;
