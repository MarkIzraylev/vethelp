<?php

$breadcrumbsHTML = "<div class='breadcrumbs'>";

foreach ($pages as $pagename => $url) {
    $breadcrumbsHTML .= "
    <div class='breadcrumbs__block'>
        <a href='$url' class='link'>$pagename</a>
    </div>
    ";
}

$breadcrumbsHTML .= "</div>";
global $breadcrumbsHTML;