

        <div class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Postmin</a>
                </div> <!-- navbar-header -->
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
<?php
        foreach($this->config->getConfig('modules') as $linkKey => $linkValue) {
            if($this->curModule() == $linkValue) {
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
                    echo '<li><a href="?module=' . $linkLinkValue . '">'
                         . $linkLinkKey . '</a></li>' . "\n";
                }
                echo '</ul>' . "\n";
            } else {
                echo '<li' . $current . '><a href="?p=' . $linkValue . '">'
                    . $linkKey . '</a></li>' . "\n";
            }
        }
?>


                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?module=auth&amp;action=logout">Logout</a></li>
                    </ul>
                </div> <!-- nav-collapse -->
            </div> <!-- container -->
        </div> <!-- navbar -->

