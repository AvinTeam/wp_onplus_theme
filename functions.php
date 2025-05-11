<?php
date_default_timezone_set('Asia/Tehran');

(defined('ABSPATH')) || exit;
define('ARMA_VERSION', '1.4.10');

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

if (! defined('ARMA_PANEL_BASE')) {
    define('ARMA_PANEL_BASE', 'panel');
}

require_once ARMA_CLASS . '/ARMADB.php';
require_once ARMA_CLASS . '/ARMAVISIT.php';

require_once ARMA_INCLUDES . '/theme_filter.php';
require_once ARMA_INCLUDES . '/postype.php';
require_once ARMA_CORE . '/accesses.php';
require_once ARMA_INCLUDES . '/taxonomies.php';
require_once ARMA_INCLUDES . '/edittaxonomy.php';
require_once ARMA_INCLUDES . '/meta_boxs.php';

require_once ARMA_INCLUDES . '/init.php';
require_once ARMA_INCLUDES . '/theme-function.php';
require_once ARMA_INCLUDES . '/styles.php';
require_once ARMA_INCLUDES . '/jdf.php';
require_once ARMA_INCLUDES . '/ajax.php';
require_once ARMA_INCLUDES . '/form-submit.php';

// require_once ARMA_INCLUDES . '/cron.php';

$arma_option = arma_start_working();

if (is_admin()) {
    // require_once ARMA_CLASS . '/List_Table.php';

    require_once ARMA_INCLUDES . '/menu.php';
    require_once ARMA_INCLUDES . '/install.php';
    require_once ARMA_INCLUDES . '/edit_column_episode.php';
    require_once ARMA_INCLUDES . '/edit_user_table.php';
    require_once ARMA_INCLUDES . '/user_filed.php';
    require_once ARMA_INCLUDES . '/dashboard_widget.php';
    require_once ARMA_INCLUDES . '/cron.php';

}

// $visited = new ARMAVISIT('visit');
// $v =$visited->getall()->show();

// print_r($v);

// exit;
