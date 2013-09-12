<?php

    require_once('general.php');
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
     * Error messages.
     */
    public $error;

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
        if(isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'add':
                    $this->pageContent['pageTitle'] = 'Add Address Aliases';
                    $this->pageContent['pageDescription'] = 'Add an address alias.<br /> '
                        . '<b>Example simple alias:</b> Original Destination <code>address1@example.com</code> '
                        . 'Final Destination <code>address2@example.com</code><br /> '
                        . '<b>Example forward and deliver:</b> Original Destination <code>address1@example.com</code> '
                        . 'Final Destination <code>address2@example.com, address1@example.com</code>';
                     $this->pageContent['type'] = 'form';
                     $this->addAlias();
                    break;
                case 'delete':
                    $this->pageContent['pageTitle'] = 'Delete Address Aliases';
                    $this->pageContent['pageDescription'] = 'Delete Alias?';
                    $this->pageContent['type'] = 'form';
                    $this->deleteAlias();
                    break;
                case 'edit':
                    $this->pageContent['pageTitle'] = 'Edit Address Aliases';
                    $this->pageContent['pageDescription'] = 'Edit an existing alias.';
                    $this->pageContent['type'] = 'form';
                    $this->editAlias();
                    break;
            }
        } else {
            if($this->countAliases()) {
                $this->pageContent['pageTitle'] = 'List Address Aliases';
                $this->pageContent['pageDescription'] = 'An Address Alias is simply a '
                    . 'forwarding email address.';
                $this->pageContent['type'] = 'table';
                $this->pageContent['pageCount'] = $this->pagination->totalPages();
                $this->pageContent['pagePvs'] = $this->pagination->pvsPage();
                $this->pageContent['pageCur'] = $this->pagination->currentPage();
                $this->pageContent['pageNxt'] = $this->pagination->nxtPage();
                $this->fetchAliases();
            } else {
                return false;
            }
        }
    }

    /**
     * Count the number of records in the alias table.
     * Also sets the totalItems for pagination class.
     */
    private function countAliases() {
        $sqlCountQuery = 'SELECT COUNT(*) AS total FROM aliases';
        if(!$resultCount = $this->mysql->query($sqlCountQuery)) {
            $this->error = 'Unable to count the number of address aliases';
            return false;
        }
        $tmpCount = $resultCount->fetch_assoc();
        $this->pagination->totalItems = $tmpCount['total'];
        $resultCount->free();
        return true;
    }

    /**
     * Fetch aliases and build array.
     *
     * @return array
     */
    private function fetchAliases() {
        $sqlFetchQuery = 'SELECT * FROM aliases LIMIT ' . $this->pagination->limitResults();
        if(!$fetchResult = $this->mysql->query($sqlFetchQuery)) {
            $this->error = 'Unable to fetch address aliases.';
            return false;
        }
        $trows = $fetchResult->num_rows;
        $tcols = $fetchResult->field_count;
        for($row = 0; $row < $trows; $row++) {
            $rs = $fetchResult->fetch_row();
            for($col = 0; $col < $tcols; $col++) {
                $aliasesArray[$row][$col] = $rs[$col];
            }
        }
        $this->pageContent['tableColumns'] = array('ID',
                                                   'Orig Destination',
                                                   'Final Destination',
                                                   'Description',
                                                   'Date',
                                                   'Active',
                                                   'Actions');
        $this->pageContent['content'] = $aliasesArray;
        $fetchResult->free();
        return true;
    }

}


