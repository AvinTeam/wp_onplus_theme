<?php

(defined('ABSPATH')) || exit;
define('OP_VERSION', '0.0.1');

define('OP_PATH', get_template_directory() . "/");
define('OP_INCLUDES', OP_PATH . 'includes/');
define('OP_CLASS', OP_PATH . 'classes/');
define('OP_FUNCTION', OP_PATH . 'functions/');
define('OP_VIEWS', OP_PATH . 'views/');

define('OP_URL', get_template_directory_uri() . "/");
define('OP_PHP', OP_URL . 'json/');
define('OP_ASSETS', OP_URL . 'assets/');
define('OP_CSS', OP_ASSETS . 'css/');
define('OP_JS', OP_ASSETS . 'js/');
define('OP_IMAGE', OP_ASSETS . 'image/');

// require_once OP_INCLUDES . '/init.php';
// require_once OP_INCLUDES . '/theme-function.php';
// require_once OP_INCLUDES . '/styles.php';
// require_once OP_INCLUDES . '/jdf.php';
// require_once OP_INCLUDES . '/ajax.php';

// require_once OP_CLASS . '/Nasr.php';

// require_once OP_INCLUDES . '/cron.php';

if (is_admin()) {
    // require_once OP_CLASS . '/List_Table.php';

    // require_once OP_INCLUDES . '/menu.php';
    // require_once OP_INCLUDES . '/install.php';

}




// exit;
