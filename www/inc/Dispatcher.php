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
    public function curPage() {
        if(isset($_GET['p'])) {
            return $_GET['p'];
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
     * Function to build navigation, $links is an array that expects 'pagetitle' ->
     * 'pagename'. Page title is what is displayed in the UI and pagename is what
     * the site uses to know what page to display. $tags is what html tag should
     * surround the <a> tag. $active is what css class should be used for the current
     * page.
     */
    public function buildNav($links, $tags = 'li', $active = 'active') {
        foreach($links as $linkKey => $linkValue) {
            if($this->curPage() == $linkValue) {
                $current = ' class="' . $active . '"';
            } else {
                $current = '';
            }
            if(is_array($linkValue)) {
                echo '<li class="dropdown">' . "\n";
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">'
                     . $linkKey . ' <b class="caret"></b></a>' . "\n";
                echo '<ul class="dropdown-menu">' . "\n";
                foreach($linkValue as $linkLinkKey => $linkLinkValue) {
                    echo '<' . $tags . '><a href="?p=' . $linkLinkValue . '">'
                         . $linkLinkKey . '</a></' . $tags . '>' . "\n";
                }
                echo '</ul>' . "\n";
            } else {
                echo '<' . $tags . $current . '><a href="?p=' . $linkValue . '">'
                    . $linkKey . '</a></' . $tags . '>' . "\n";
            }
        }
    }

    public function pageTitle() {

    }

    /**
     * Function to display the finished page
     *
     * @return mixed
     */
    public function render() {
        if(!$this->loadModule($this->curPage())) {
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

