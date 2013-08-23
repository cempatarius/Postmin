<?php

/**
 * Configuration class.
 *
 * @author    Cempatarius <code@cempatarius.com>
 * @copyright 2013 Cempatarius
 * @license   GNU AGPL V3
 * @link      http://www.8bitnet.com/
 */

class auth {

    /**
     * User information.
     *
     * @var array
     */
    private $userInfo;

    /**
     * Protected MySQL Connection
     */
    protected $mysql;

    /**
     * Store Error messages/status
     */
    private $error = false;

    /**
     * -----------------------------------------------------------
     */

    /**
     * Inject MySQL connection into class
     */
    public function authInjectMySql($mysqlConnection) {
        $this->mysql = $mysqlConnection;
    }

    /**
     * Is the user currently authenticated
     *
     * @return boolean
     */
    public function authCurrent() {
        return false;
    }

    /**
     * Process logout request
     */
    public function authLogout() {

    }

    /**
     * Process login request
     */
    public function authLogin($formPassword) {

    }

    /**
     * Fetch current error status
     */
    public function authError() {
        if(isset($this->error)) {
            return $this->error;
        } else {
            return false;
        }
    }

    /**
     * Pull account information by username
     *
     * @return array
     */
    private function authByUsername($formUsername) {
        $sqlQuery = 'SELECT * FROM mailboxes WHERE username = "'
                  . $formUsername . '" AND admin = "1"';
        if(!$result = $this->mysql->query($sqlQuery)) {
            $this->error = 'Username/Password lookup failure!';
            return false;
        }
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->userInfo[] = $row;
            }
            $result->free();
            return true;
        } else {
            $result->free();
            $this->error = 'Invalid Username/Password!';
            return false;
        }
    }

    /**
     * Pull account information by cookie.
     *
     * @return array
     */
    private function authByCookie() {
        $sqlQuery = 'SELECT * FROM mailboxes WHERE cookiestring = "'
                  . $_COOKIE['postminauth'] . '" AND admin = "1" AND '
                  . 'ip = "' . $this->authReturnIp() . '"';
        if(!$result = $this->mysql->query($sqlQuery)) {
            $this->error = 'Username/Password lookup failure!';
            return false;
        }
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->userInfo[] = $row;
            }
            $result->free();
            return true;
        } else {
            $result->free();
            $this->error = 'Session has expired!';
            return false;
        }
    }

    /**
     * Verify that a plaintext password matches the hashed password.
     *
     * @return boolean
     */
    private function authPassword($formPassword, $storedPassword) {
        if(isset($formPassword) && isset($storedPassword)) {
            if(crypt($formPassword, $storedPassword) == $storedPassword) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Generate cookie id string, pseudorandom.
     *
     * @return string
     */
    private function authGenRandom($length = '32', $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        $randomString = '';
        for($i = 0; $i < $length; $i++) {
            $randomString .= $alphabet[rand(0,strlen($alphabet) - 1)];
        }
        return $randomString;
    }

    /**
     * Returns the users IP address.
     *
     * @return string
     */
    private function authReturnIp() {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Create or Destroy a cookie. Destroy cookie by default.
     *
     * @return boolean
     */
    private function authCookie($cookieString = null, $destroy = true) {
        if($destroy) {
            setcookie('postminauth', '', time() - 3600);
        } else {
            setcookie('postminauth', $cookieString, time() + 3600);
        }
        return true;
    }

}
