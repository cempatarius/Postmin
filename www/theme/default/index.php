


    <div class="container">
        <div class="page-header">
            <h1><?php echo $this->pageContent['pageTitle']; ?></h1>
        </div>

<?php foreach($this->pageContent['sections'] as $key => $value) {
    echo $this->pageContent['sections'][$key]['content'];
} ?>
    </div>

