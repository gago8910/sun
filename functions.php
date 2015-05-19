<?php

error_reporting(0);
$siteurl = 'http://www.sunfrogshirts.com';
include('alias.php');

function get_center($data, $first, $last) {
    list($a, $b) = explode($first, $data);
    list($a, $b) = explode($last, $b);
    return $a;
}

function cat($siteurl) {
    $html = file_get_contents($siteurl);
    $cut = get_center($html, '<li class="title">Categories</li>', '</ul>');
    $epl = explode('</a>', $cut);
    for ($i = 0; $i < count($epl) - 1; $i++) {
        preg_match('/">[a-zA-Z0-9].+<\/li>/', $epl[$i], $regex);
        $cat[$i]['name'] = get_center($regex[0], '">', '</li>');
        $cat[$i]['link'] = str_replace("&", "and", get_center($epl[$i], '<a href="', '/"'));
        $cat[$i]['title'] = get_center($epl[$i], 'title="', '">');
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