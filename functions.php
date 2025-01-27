<?php

(defined('ABSPATH')) || exit;
define('ARMA_VERSION', '0.0.2');

define('ARMA_PATH', get_template_directory() . "/");
define('ARMA_INCLUDES', ARMA_PATH . 'includes/');
define('ARMA_CLASS', ARMA_PATH . 'classes/');
define('ARMA_CORE', ARMA_PATH . 'core/');
define('ARMA_FUNCTION', ARMA_PATH . 'functions/');
define('ARMA_VIEWS', ARMA_PATH . 'views/');

define('ARMA_URL', get_template_directory_uri() . "/");
define('ARMA_ASSETS', ARMA_URL . 'assets/');
define('ARMA_CSS', ARMA_ASSETS . 'css/');
define('ARMA_JS', ARMA_ASSETS . 'js/');
define('ARMA_IMAGE', ARMA_ASSETS . 'image/');
define('ARMA_VENDOR', ARMA_ASSETS . 'vendor/');


require_once ARMA_INCLUDES . '/postype.php';
require_once ARMA_CORE . '/accesses.php';
require_once ARMA_INCLUDES . '/taxonomies.php';
require_once ARMA_INCLUDES . '/meta_boxs.php';

require_once ARMA_INCLUDES . '/init.php';
require_once ARMA_INCLUDES . '/theme-function.php';
require_once ARMA_INCLUDES . '/styles.php';
// require_once ARMA_INCLUDES . '/jdf.php';
require_once ARMA_INCLUDES . '/ajax.php';

// require_once ARMA_CLASS . '/Nasr.php';

// require_once ARMA_INCLUDES . '/cron.php';

if (is_admin()) {
    // require_once ARMA_CLASS . '/List_Table.php';

    require_once ARMA_INCLUDES . '/menu.php';
    require_once ARMA_INCLUDES . '/install.php';

}

// exit;




