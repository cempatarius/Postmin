<?php


class Pagination {

    public $itemsPerPage = '50';
    public $nxtPage;
    public $pvsPage;
    public $totalItems;

    /**
     * Paginator master function.
     */
    public function paginator() {

    }

    /**
     * Determin the record numbers to limit mysql search.
     *
     * @return string
     */
    public function limitResults() {
        $maxRecord = $this->itemsPerPage;
        $minRecord = ($this->currentPage() - 1) * $this->itemsPerPage;
        if($minRecord < 0) {
            $minRecord = 0;
        }
        $limit = $minRecord . ', ' . $maxRecord;
        return $limit;
    }

    /**
     * Show total number of pages.
     *
     * @return num
     */
    public function totalPages() {
        $totalPages = ceil($this->totalItems / $this->itemsPerPage);
        return $totalPages;
    }

    /**
     * Return current page.
     *
     * @return num
     */
    public function currentPage() {
        if(isset($_GET['page'])) {
            return $_GET['page'];
        } else {
            return '1';
        }
    }

    /**
     * Previous Page
     */
    public function pvsPage() {
        return $this->currentPage() - 1;
    }

    /**
     * Next Page
     */
    public function nxtPage() {
        return $this->currentPage() + 1;
    }



}
