<?php


class Pagination {

    public $itemsPerPage = '50';
    public $curPage;
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
    private function limitResults() {
        $maxRecord = $this->curPage * $this->itemsPerPage;
        if($maxRecord > $this->totalItems) {
            $maxRecord = $this->totalItems;
        }
        $minRecord = $maxRecord - $this->itemsPerPage;
        $limit = $minRecord . ', ' . $maxRecord;
        return $limit;
    }

    /**
     * Show total number of pages.
     *
     * @return num
     */
    private function totalPages() {
        $totalPages = ceil($this->totalItems / $this->itemsPerPage);
        return $totalPages;
    }




}
