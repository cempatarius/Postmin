<?php

class Module {

    /**
     * Protected MySQL
     */
    protected $mysql;

    /**
     * Inject class
     *
     * @return void
     */
    public function injectClass($mysql) {
        $this->mysql = $mysql;
    }





}


