<?php



function curPage() {
    if(isset($_GET['p'])) {
        return $_GET['p'];
    } else {
        return 'home';
    }
}

