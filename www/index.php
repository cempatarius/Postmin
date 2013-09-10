<?php

/**
 * Main index page for Postmin web interface.
 *
 * @author    Cempatarius <code@cempatarius.com>
 * @copyright 2013 Cempatarius
 * @license   GNU AGPL V3
 * @link      http://www.8bitnet.com/
 */

/**
 * Include all required pages.
 */
foreach(glob('inc/*.php') as $filename) {
    require_once($filename);
}

/**
 * Initialize the configuration class
 */
$config = new Config;
$config->getConfigFile();

/**
 * Instantiate MySQL connection
 */
$mysql = new mysqli($config->getConfig('mysqlhostname'),
                    $config->getConfig('mysqlusername'),
                    $config->getConfig('mysqlpassword'),
                    $config->getConfig('mysqldatabase'));

if($mysql->connect_error > 0) {
    die('Unable to connect to database [' . $mysql->connect_error . ']');
}

/**
 * Instantiate Authentication class
 */
$auth = new auth;

/**
 * Inject the already established mysql connection into the auth class.
 */
$auth->authInjectMySql($mysql);

/**
 * Instatiate Dispatcher Class
 */
$dispatcher = new Dispatcher;

/**
 * Inject the already esablished mysql connection into the dispatcher class.
 */
$dispatcher->injectClass($mysql,$config);

/**
 * Check if the user is currently authenticated.
 */
if($auth->authCurrent()) {
    $dispatcher->render();
} else {
    require_once('theme/' . $config->getConfig('theme') . '/signin.php');
}

/**
 * Close MySQL connection
 */
$mysql->close();
