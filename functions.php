<?php

error_reporting(0);
$siteurl = 'http://www.sunfrogshirts.com';
$affiliate_id = 39166;
include('alias.php');

function get_center($data, $first, $last) {
    list($a, $b) = explode($first, $data);
    list($a, $b) = explode($last, $b);
    return $a;
}

function cat($siteurl) {
    $html = file_get_contents($siteurl);
//    $cut = get_center($html, '<li class="title">Categories</li>', '</ul>');
    $cut = get_center($html, '<ul class="dropdown-menu" role="menu">', '</ul>');
    $epl = explode('</a>', $cut);
    $document = new DOMDocument();
    $document->loadHTML($cut);
    $as = $document->getElementsByTagName('a');
    for($i=0;$i<($as->length-1); $i++) {
        $cat[$i]['name']=$as->item($i)->textContent;
        $cat[$i]['title']=$as->item($i)->textContent;
        $text = $as->item($i)->getAttribute('href');
        $link = str_split($text, 28);
        $cat[$i]['link'] = $link[1];
    }
    for ($i = 1; $i < count($cat); $i++)
        echo '<li class="list-group-item"><a href="/c' . $cat[$i]['link'] . '" title="' . $cat[$i]['title'] . '">' . $cat[$i]['name'] . '</a></li>';
}

function analytics() {
    $code = "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-59452733-2', 'auto');
  ga('send', 'pageview');

</script>";
    echo $code;
}

?>