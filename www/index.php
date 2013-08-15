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


require_once('theme/'.$config->getConfig('theme').'/header.php');
require_once('theme/'.$config->getConfig('theme').'/nav.php');
require_once('theme/'.$config->getConfig('theme').'/index.php');
require_once('theme/'.$config->getConfig('theme').'/footer.php');


