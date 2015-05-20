<?php

$string = '<ul class="dropdown-menu" role="menu">
    <li><a href="#">All</a></li>
    <li><a href="#">Best Sellers</a></li>
    <li><a href="http://www.sunfrogshirts.com/Automotive/" data-cid="52">Automotive</a></li>
    <li><a href="http://www.sunfrogshirts.com/Camping/" data-cid="51">Camping</a></li>
    <li><a href="http://www.sunfrogshirts.com/Faith/" data-cid="26">Faith</a></li>
    <li><a href="http://www.sunfrogshirts.com/Fishing/" data-cid="50">Fishing</a></li>
    <li><a href="http://www.sunfrogshirts.com/Fitness/" data-cid="61">Fitness</a></li>
    <li><a href="http://www.sunfrogshirts.com/Funny/" data-cid="19">Funny</a></li>
    <li><a href="http://www.sunfrogshirts.com/Geek &amp; Tech/" data-cid="24">Geek &amp; Tech</a></li>
    <li><a href="http://www.sunfrogshirts.com/Holidays/" data-cid="35">Holidays</a></li>
    <li><a href="http://www.sunfrogshirts.com/Hunting/" data-cid="30">Hunting</a></li>
    <li><a href="http://www.sunfrogshirts.com/LifeStyle/" data-cid="43">LifeStyle</a></li>
    <li><a href="http://www.sunfrogshirts.com/Movies/" data-cid="12">Movies</a></li>
    <li><a href="http://www.sunfrogshirts.com/Music/" data-cid="71">Music</a></li>
    <li><a href="http://www.sunfrogshirts.com/Offensive/" data-cid="20">Offensive</a></li>
    <li><a href="http://www.sunfrogshirts.com/Pets/" data-cid="62">Pets</a></li>
    <li><a href="http://www.sunfrogshirts.com/Political/" data-cid="17">Political</a></li>
    <li><a href="http://www.sunfrogshirts.com/Sports/" data-cid="27">Sports</a></li>
    <li><a href="http://www.sunfrogshirts.com/TV Shows/" data-cid="34">TV Shows</a></li>
    <li><a href="http://www.sunfrogshirts.com/Video Games/" data-cid="13">Video Games</a></li>
    <li><a href="http://www.sunfrogshirts.com/Zombies/" data-cid="11">Zombies</a></li>
</ul>';

$document = new DOMDocument();
$document->loadHTML($string);

$ul = $document->getElementsByTagName("a");


$as = $document->getElementsByTagName('a');
$result = array();
for($i=0;$i<($as->length-1); $i++) {
    $result[]['content']=$as->item($i)->textContent;
    $result[]['link'] = $as->item($i)->getAttribute( 'href');
}

// echo implode(' ', $result);  
var_dump($result);die;

// // var_dump($ul);die;

// foreach ($ul as $element) {
//     $data[] = $element->nodeValue;
// }
// var_dump($data);die;
?>