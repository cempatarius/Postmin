<?php

class Module {

    /**
     * Protected MySQL
     */
    protected $mysql;

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
    }

    public function execute() {
        $this->pageContent['pageTitle'] = 'Page Title';
        $this->pageContent['sections']['0']['content'] = '<div class="row">' . "\n"
                                                       . '    <h3>Logging</h3>' . "\n"
                                                       . '    <table class="table table-hover">' . "\n"
                                                       . '        <tr>' . "\n"
                                                       . '            <th>ID</td>' . "\n"
                                                       . '            <th>Username</td>' . "\n"
                                                       . '            <th>Action</td>' . "\n"
                                                       . '        </tr>' . "\n"
                                                       . '        <tr>' . "\n"
                                                       . '            <td>1</td>' . "\n"
                                                       . '            <td>Admin</td>' . "\n"
                                                       . '            <td>Test action for the first log entry.</td>' . "\n"
                                                       . '        </tr>' . "\n"
                                                       . '        <tr class="danger">' . "\n"
                                                       . '            <td>2</td>' . "\n"
                                                       . '            <td>Admin</td>' . "\n"
                                                       . '            <td>The admin put in some text for this log entry.</td>' . "\n"
                                                       . '        </tr>' . "\n"
                                                       . '    </table>' . "\n"
                                                       . '</div>';
        $this->pageContent['sections']['1']['content'] = '<div class="row">' . "\n"
                                                       . '    <h3>Graphs</h3>' . "\n"
                                                       . '';
    }

    /**
     * Input array and output an HTML Table
     *
     * @return mixed
     */
    private function tablefy($content) {


    }

}


