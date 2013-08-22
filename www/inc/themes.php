<?php

/**
 * Theme Functions.
 *
 * @author    Cempatarius <code@cempatarius.com>
 * @copyright 2013 Cempatarius
 * @license   GNU AGPL V3
 * @link      http://www.8bitnet.com/
 */

/**
 * Function to build navigation, $links is an array that expects 'pagetitle' ->
 * 'pagename'. Page title is what is displayed in the UI and pagename is what
 * the site uses to know what page to display. $tags is what html tag should
 * surround the <a> tag. $active is what css class should be used for the current
 * page.
 */
function buildNav($links, $tags = 'li', $active = 'active') {
        foreach($links as $linkKey => $linkValue) {
            if(curPage() == $linkValue) {
                $current = ' class="' . $active . '"';
            } else {
                $current = '';
            }
            echo '<' . $tags . $current . '><a href="?p=' . $linkValue . '">'
                 . $linkKey . '</a></' . $tags . '>' . "\n";
        }
}

function themePageTitle() {

}



