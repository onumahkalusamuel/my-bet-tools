<?php

// Error reporting for production
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Africa/Lagos');

// Settings
$settings = [];

// Path settings
$settings['root'] = dirname(__DIR__);
$settings['temp'] = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';
$settings['upload_dir'] = $settings['public'] . '/uploads';
$settings['assets_dir'] = $settings['public'] . '/assets';

// for smarty
$settings['smarty'] = [
    'template_dir' => $settings['root'] . '/templates/',
    'compile_dir' => $settings['root'] . '/smarty/tmpl_c/',
    'config_dir' => $settings['root'] . '/smarty/config/',
    'cache_dir' => $settings['root'] . '/smarty/cache/'
];

// Error Handling Middleware settings
$settings['error'] = [
    // Should be set to false in production
    'display_error_details' => preg_match("/^localhost/", $_SERVER['HTTP_HOST']),
    'log_errors' => true,
    'log_error_details' => true,
];

$dbHost = 'localhost';
$dbUser = 'root';
$dbName = 'my_bet_tools';
$dbPass = 'root';

// Database settings
$settings['db'] = [
    'driver' => 'mysql',
    'host' => $dbHost,
    'username' => $dbUser,
    'database' => $dbName,
    'password' => $dbPass,
    'charset' => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'options' => [
        // Turn off persistent connections
        PDO::ATTR_PERSISTENT => false,
        // Enable exceptions
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // Emulate prepared statements
        PDO::ATTR_EMULATE_PREPARES => true,
        // Set default fetch mode to array
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // Set character set
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
    ],
];

// phoenix
$settings['phoenix'] = [
    'migration_dirs' => [
        'first' => __DIR__ . '/../resources/migrations',
    ],
    'environments' => [
        'local' => [
            'adapter' => 'mysql',
            'host' => $dbHost,
            'username' => $dbUser,
            'password' => $dbPass,
            'db_name' => $dbName,
            'charset' => 'utf8',
        ],
        'production' => [
            'adapter' => 'mysql',
            'host' => $dbHost,
            'username' => $dbUser,
            'password' => $dbPass,
            'db_name' => $dbName,
            'charset' => 'utf8',
        ],
    ],
    'default_environment' => 'local',
    'log_table_name' => 'phoenix_log',
];
// email settings
$settings['smtp'] = [
    'email' => '',
    'password' => '',
    'name' => '',
    'host' => gethostname()
];

// Session
$settings['session'] = [
    'name' => 'webapp',
    'cache_expire' => 0,
];

$settings['image_manager'] = [
    'driver' => 'gd',
];

return $settings;
