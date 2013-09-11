


    <div class="container">
        <div class="panel panel-info">
            <div class="panel-heading"><?php echo $this->pageContent['pageTitle']; ?></div>
            <div class="panel-body">
                <p><?php echo $this->pageContent['pageDescription']; ?></p>
            </div>
<?php foreach($this->pageContent['sections'] as $key => $value) {
    echo $this->pageContent['sections'][$key]['content'];
} ?>
        </div>
    </div>

