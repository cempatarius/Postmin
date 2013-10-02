<?php

class Module {

    /**
     * Protected MySQL
     */
    protected $mysql;

    /**
     * Protected pagination
     */
    protected $pagination;

    /**
     * Array that holds page content
     */
    public $pageContent = array();

    /**
     * Inject class
     *
     * @return void
     */
    public function injectClass($mysql) {
        $this->mysql = $mysql;
        $this->pagination = new Pagination;
    }

    /**
     * Execute the module.
     */
    public function execute() {
        $this->pageContent['pageTitle'] = 'Domain Aliases';
        $this->pageContent['sections'][0]['content'] = '';
    }

    /**
     *
     */
    private function getAliases() {
        $sqlCountQuery = 'SELECT COUNT(*) FROM aliases';
        if(!$resultCount = $this->mysql->query($sqlCountQuery)) {
            $this->error = 'Unable to count the number of aliases';
        }
        $tmpCount = $resultCount->fetch_assoc();
        $this->pagination->totalItems = $tmpCount['total'];
    }

}


