<?php


class Dispatcher {

    ###########################################################################
    # Variables                                                               #
    ###########################################################################
    /**
     * Protected MySQL Connection
     */
    protected $mysql;

    /**
     * Protected Config Class
     */
    protected $config;

    /**
     * Contains module class.
     */
    private $module;

    /**
     * Contains an array of content used by themes.
     */
    public $pageContent;

    /**
     * Contains current error message.
     */
    public $error;

    ###########################################################################
    # Public functions                                                        #
    ###########################################################################
    /**
     * Inject MySQL connection into class
     *
     * @return void
     */
    public function injectClass($mysqlConnection,$configClass) {
        $this->mysql = $mysqlConnection;
        $this->config = $configClass;
    }

    /**
     * Returns current page
     *
     * @return var
     */
    public function curModule() {
        if(isset($_GET['module'])) {
            return $_GET['module'];
        } else {
            return 'home';
        }
    }

    /**
     * Return current action
     *
     * @return var
     */
    public function curAction() {
        if(isset($_GET['action'])) {
            return $_GET['action'];
        } else {
            return false;
        }
    }


    /**
     * Function to display the finished page
     *
     * @return mixed
     */
    public function render() {
        if(!$this->loadModule($this->curModule())) {
            $this->error = 'Error! Invalid Module or ';
        }
        require_once('theme/' . $this->config->getConfig('theme') . '/header.php');
        require_once('theme/' . $this->config->getConfig('theme') . '/nav.php');
        require_once('theme/' . $this->config->getConfig('theme') . '/index.php');
        require_once('theme/' . $this->config->getConfig('theme') . '/footer.php');
    }


    ###########################################################################
    # Private functions                                                       #
    ###########################################################################
    /*
     * Load the requested module.
     *
     * @return mixed
     */
    private function loadModule($module) {
        if(file_exists('./modules/' . $module . '/init.php')) {
            require_once('./modules/' . $module . '/init.php');
            $this->module = new Module;
            $this->module->injectClass($this->mysql);
            $this->module->execute();
            $this->pageContent = $this->module->pageContent;
        } else {
            $this->error = 'Unable to load module!';
            return false;
        }
    }

    /**
     *
     *
     */
    public function dispatcher() {

    }



}

