<?php

/**
 * Configuration options are specified here.
 *
 * @author    Cempatarius <code@cempatarius.com>
 * @copyright 2013 Cempatarius
 * @license   GNU AGPL V3
 * @link      http://www.8bitnet.com/
 */

/**
 * Choose a theme.
 */
$this->config['theme'] = 'default';

/**
 * Modules that are enabled, Key is the name of module, value is name of module
 * folder.
 */
$this->config['modules'] = array('Domains'        => 'domains',
                                 'Mailboxes'      => 'mailboxes',
                                 'Aliases'        => 'aliases',
                                 'Blocklists'     => 'blocklists',
                                 'Transports'     => 'transports',
                                 'Smarthosts'     => 'smarthosts',
                                 'Spam User Pref' => 'userpref');


