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
$this->config['modules'] = array('Home'           => 'home',
                                 'Domains'        => 'domains',
                                 'Mailboxes'      => 'mailboxes',
                                 'Aliases'        => array ('Address Aliases' => 'addraliases',
                                                            'Domain Aliases'  => 'domaliases'),
                                 'ACL'     => array ('Sender'    => 'aclsender',
                                                            'Client'    => 'aclclient',
                                                            'Recipient' => 'aclrecipient'),
                                 'Transports'     => 'transports',
                                 'Smarthosts'     => 'smarthosts',
                                 'Spam Settings'  => 'spamsettings');

/**
 * Website domain name ie mail.example.com
 */
$this->config['domain'] = 'mail.example.com';


/**
 * MySQL Hostname
 */
$this->config['mysqlhostname'] = '127.0.0.1';

/**
 * MySQL Username
 */
$this->config['mysqlusername'] = 'postmin';

/**
 * MySQL Password
 */
$this->config['mysqlpassword'] = 'chAnGEme';

/**
 * MySQL Database
 */
$this->config['mysqldatabase'] = 'postmin';
