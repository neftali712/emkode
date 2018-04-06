<?php

define('VERSION', '?1.5.3');

/**
 * Data Base
 */

define('DB_DRIVER', get_env_or_default('DB_DRIVER'));
define('HOST', get_env_or_default('DB_HOST'));
define('PORT', get_env_or_default('DB_PORT'));
define('DB_USER', get_env_or_default('DB_USER'));
define('DB_PASSWORD', get_env_or_default('DB_PASS'));
define('DB', get_env_or_default('DB_NAME'));

/**
 * Private Directories & Files
 */

define('INCLUDES', ROOT . 'include' . DS);
define('LOAD', ROOT . 'load' . DS);
define('SESSION', ROOT . 'session' . DS);
define('HEADER', INCLUDES . 'header.php');
define('FOOTER', INCLUDES . 'footer.php');

/**
 * Public Directories & Files
 */

/* Basics */
$protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')? 'https://' : 'http://';
define('SITE', $protocol . $_SERVER['HTTP_HOST'] . DS);
define('CONFIG', 'Admin');
define('SET_LOG', true);

// Global
define('ASSETS', SITE . 'assets' . DS);
define('GLOBAL_CSS', ASSETS . 'global' . DS . 'css' . DS);
define('GLOBAL_IMG', ASSETS . 'global' . DS . 'img' . DS);
define('GLOBAL_PLUGINS', ASSETS . 'global' . DS . 'plugins' . DS);
define('GLOBAL_SCRIPTS', ASSETS . 'global' . DS . 'scripts' . DS);

// Admin Layout
define('ADMIN_LAYOUT_CSS', ASSETS . 'admin' . DS . 'layout' . DS . 'css' . DS);
define('ADMIN_LAYOUT_IMG', ASSETS . 'admin' . DS . 'layout' . DS . 'img' . DS);
define('ADMIN_LAYOUT_SCRIPTS', ASSETS . 'admin' . DS . 'layout' . DS . 'scripts' . DS);

// Admin Pages
define('ADMIN_PAGES_CSS', ASSETS . 'admin' . DS . 'pages' . DS . 'css' . DS);
define('ADMIN_PAGES_IMG', ASSETS . 'admin' . DS . 'pages' . DS . 'img' . DS);
define('ADMIN_PAGES_SCRIPTS', ASSETS . 'admin' . DS . 'pages' . DS . 'scripts' . DS);

define('ERROR', SITE . 'error' . DS);
define('LOGIN', SITE . 'login' . DS);
define('LOGOUT', SITE . 'logout' . DS);
define('ACTION_DO', SITE . 'do.php');
define('RESOURCES', SITE . 'resource' . DS);
define('RESOURCES_REQUISITION_PDF', SITE . 'resource' . DS . 'requisitions' . DS . 'pdf' .DS);
define('RESOURCES_INVOICE', RESOURCES . 'invoice' . DS);
define('RESOURCES_SALES_RECEIPT', RESOURCES . 'sales-receipt' . DS);
define('PDF', SITE . 'pdf' . DS);

/* Customs */
define('LOCK_SCREEN', SITE . 'pantalla-bloqueada' . DS);
define('PROFILE', SITE . 'perfil' . DS);
define('HOME', SITE . 'inicio' . DS);


/**
 * Sessions
 */

define('SESSION_ADMIN', 'botanasAdmin');
define('SESSION_ID_ADMIN', 'idBotanasAdmin');
define('SESSION_LOCK', 'lock');
define('SESSION_BROWSER', 'browser');
define('SESSION_BROWSER_VERSION', 'browserVersion');

// This maps the User class to the users table in the authorization schema

fORM::mapClassToTable('User', 'user');
fORM::mapClassToTable('Address', 'address');


fSession::setPath(SESSION);
fSession::setLength('1 day', '1 week');
fAuthorization::setLoginPage(LOGIN);

try {
    $db = new fDatabase(DB_DRIVER, DB, DB_USER, DB_PASSWORD, HOST, PORT);

    // Please note that calling this method is not required, and simply
    // causes an exception to be thrown if the connection can not be made
    $db->connect();
    fORMDatabase::attach($db);
} catch (fAuthorizationException $e) {
    $e->printMessage();
}

$authLevels = array();
// $roles = Role::getAll(array(), array('level' => 'DESC', 'id_role' => 'ASC'));
// if ($roles->count() > 0) {
// 	foreach ($roles as $role) {
// 		$authLevels[$role->getName()] = $role->getLevel();
// 	}
// }
fAuthorization::setAuthLevels($authLevels);

/* Money */

fMoney::defineCurrency(
    'MEX',            // The three digit ISO code
    'Peso', // The name of the currency
    '$',              // The currency symbol
    '2',              // The precision after the decimal point
    '0.066771'      // The current exchange rate with USD
);
fMoney::setDefaultCurrency('MEX');

/* Variables */

// fSession::open();
// $sessionIdAdmin = fSession::get(SESSION_ID_ADMIN);
// $sessionAdmin = fSession::get(SESSION_ADMIN);
// $lock = fSession::get(SESSION_LOCK);
// $browserType = fSession::get(SESSION_BROWSER);
// $browserVersion = fSession::get(SESSION_BROWSER_VERSION);
// if ($browserType == '' || $browserVersion == '') {
// 	$browser = new Browser();
// 	$browserType = $browser->getBrowser();
// 	$browserVersion = $browser->getVersion();
// 	fSession::set(SESSION_BROWSER, $browserType);
// 	fSession::set(SESSION_BROWSER_VERSION, $browserVersion);
// }

/* Arrays */

/* Permissions */

$permissions = array(
    'admin' => array(),
	'product' => array(),
	'supplier' => array(),
	'tax' => array(),
	'invoice' => array(),
	'event' => array(),
	'salesReceipt' => array(),
	'account' => array(),
	'payment' => array(),
	'input' => array(),
	'store' => array(),
	'cargo' => array(),
	'client' => array(),
	'requisition' => array(),
	'creditor' => array(),
	'creditCollection' => array(),
	'saleReport' => array(),
	'report' => array()
);

/* Information Business */

$infoBusiness = array(
	'name' => 'sin nombre',
	'aboutUs' => 'sin descripci&oacute;n',
	'phone' => 'sin tel&eacute;fono',
	'email' => 'sin correo electr&oacute;nico',
	'facebook' => '#',
	'twitter' => '#'
);

/* Sections */

$sections = array(
	'home' => array(
		'pageTitle' => 'Inicio',
		'breadcrumbTitle' => 'Inicio',
		'title' => 'Inicio',
		'subtitle' => 'Test',
		'url' => HOME,
		'subsections' => array()
	)
);

/* Accepted files */

$acceptedFiles = array(
	'image' => array(
		'image/gif',
		'image/bmp',
		'image/jpg',
		'image/jpeg',
		'image/pjpeg',
		'image/png'
	),
	'application' => array(
		'application/msword',
		'application/pdf',
		'application/xml',
		'application/vnd.ms-excel',
		'application/vnd.ms-powerpoint',
		'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'application/vnd.openxmlformats-officedocument.presentationml.presentation'
	),
	'text' => array(
		'text/plain',
		'text/richtext',
		'text/html',
		'text/xml',
		'text/csv',
	),
	'video' => array(
		'video/mpeg',
		'video/x-mpeg2',
		'video/msvideo',
		'video/quicktime',
		'video/vivo',
		'video/wavelet',
		'video/x-sgi-movie',
		'video/x-flv',
		'video/mp4'
	),
	'audio' => array(
		'audio/x-wav',
		'audio/x-mp3',
		'audio/midi'
	)
);

$days = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");

$months = array(
    '01' => array('shortName' => 'Ene', 'name' => 'Enero'),
    '02' => array('shortName' => 'Feb', 'name' => 'Febrero'),
    '03' => array('shortName' => 'Mar', 'name' => 'Marzo'),
    '04' => array('shortName' => 'Abr', 'name' => 'Abril'),
    '05' => array('shortName' => 'May', 'name' => 'Mayo'),
    '06' => array('shortName' => 'Jun', 'name' => 'Junio'),
    '07' => array('shortName' => 'Jul', 'name' => 'Julio'),
    '08' => array('shortName' => 'Ago', 'name' => 'Agosto'),
    '09' => array('shortName' => 'Sep', 'name' => 'Septiembre'),
    '10' => array('shortName' => 'Oct', 'name' => 'Octubre'),
    '11' => array('shortName' => 'Nov', 'name' => 'Noviembre'),
    '12' => array('shortName' => 'Dic', 'name' => 'Diciembre')
);

$monthsToNumber = array(
    'Enero' => '01',
    'Febrero' => '02',
	'Marzo' => '03',
	'Abril' => '04',
	'Mayo' => '05',
	'Junio' => '06',
	'Julio' => '07',
	'Agosto' => '08',
	'Septiembre' => '09',
	'Octubre' => '10',
	'Noviembre' => '11',
	'Diciembre' => '12'
);

$shortMonthsToNumber = array(
    'Ene' => '01',
    'Feb' => '02',
	'Mar' => '03',
	'Abr' => '04',
	'May' => '05',
	'Jun' => '06',
	'Jul' => '07',
	'Ago' => '08',
	'Sep' => '09',
	'Oct' => '10',
	'Nov' => '11',
	'Dic' => '12'
);
?>
