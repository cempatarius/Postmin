<?php

/**
 * Configuration class.
 *
 * @author    Cempatarius <code@cempatarius.com>
 * @copyright 2013 Cempatarius
 * @license   GNU AGPL V3
 * @link      http://www.8bitnet.com/
 */

class Config {

    /**
     * Private variable that configuration options are stored.
     *
     * @var array
     */
    private $config;

    function __construct() {
    }


    /**
     * Load the configuration file specified.
     *
     * @return void
     */
    function getConfigFile($arg = '../config.php') {
        require_once($arg);
    }

    /**
     * Get a configuration option and return it.
     *
     * @return mixed
     */
    function getConfig($arg = false) {
        if($arg) {
            if(array_key_exists($arg)) {
                return $this->config[$arg];
            } else {
                return 'Invalid Configuration Option.';
            }
        } else {
            return 'Invalid Configuration Option.';
        }
    }




}
