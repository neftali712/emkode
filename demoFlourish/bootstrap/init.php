<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
ini_set('memory_limit', '512M');
ini_set('upload_max_filesize', '10M');
date_default_timezone_set('America/Mexico_City');

/**
 * Basic constants
 */

//define('DS', DIRECTORY_SEPARATOR);
define('DS', '/');
define('ROOT', $_SERVER['DOCUMENT_ROOT'] . DS);
define('BOOTSTRAP', ROOT . 'bootstrap' . DS);
define('LIB', BOOTSTRAP . 'lib' . DS);
define('CLASSES', BOOTSTRAP . 'class' . DS);
define('MODEL', BOOTSTRAP . 'model' . DS);

/**
 * Automatically includes classes
 *
 * @throws Exception
 *
 * @param  string $className Name of the class to load
 * @return void
 */
function __flourish_autoload($className)
{
    $file = $className . '.php';
    if (file_exists(LIB . 'flourishlib' . DS . $file)) {
        require_once LIB . 'flourishlib' . DS . $file;
    } elseif (file_exists(CLASSES . $file)) {
        require_once CLASSES . $file;
    } elseif (file_exists(MODEL . $file)) {
        require_once MODEL . $file;
    } else {
        // throw new Exception("The class $className could not be loaded.");
    }
}

/**
 * Get environment variable or a default value
 *
 * @throws Exception
 *
 * @param string $var_name Name of the environment
 * @param string $default_value Default value of variable if not found in by getenv method
 * @return string
 */
function get_env_or_default($var_name, $default_value='') {
    $env_var_val = getenv($var_name);
    if ($env_var_val === false)
        return $default_value;
    else
        return $env_var_val;
}

spl_autoload_register('__flourish_autoload');
require_once LIB . 'external/autoload.php';
$env_var_loader = new Dotenv\Dotenv(ROOT, '.botanas_env');
$env_var_loader->load();
require_once(BOOTSTRAP . 'config.php');
?>
