<?php
include('functions.php');
$id = $_GET['id'];
$html = file_get_contents($siteurl . '/' . str_replace("_", "/", $id));
var_dump($html); die;
$pic = get_center($html, '<link rel="image_src" href="', '" / >');
$title = get_center($html, '<h1 style="margin-left:15px;">', '</h1>');
$author = get_center($html, '<span style="color:#06F; ">', '</span>');
$desc = get_center($html, '<meta property="og:description" content="', '"/>');

$cut = get_center($html, '<select id="size" name="size" style="width:90%;">', '</select>');
preg_match_all('/">.+<\//', $cut, $price);
$cut = get_center($html, '<div class="colorBox">', '</td>');
$epl = explode('</div></a>', $cut);
for ($i = 0; $i < count($epl) - 1; $i++) {
    $color[$i]['link'] = get_center($epl[$i], '<a href="', '"');
    $color[$i]['pic'] = get_center($epl[$i], "background:url('", "')");
    $color[$i]['title'] = get_center($epl[$i], 'title="', '"');
}

$cut = get_center($html, '<div class="iconBox">', '</td>');
$epl = explode('<div class="icon', $cut);
for ($i = 1; $i < count($epl); $i++) {
    $type[$i]['link'] = get_center($epl[$i], '<a href="', '"');
    $type[$i]['pic'] = get_center($epl[$i], '<img src="', '"');
    $type[$i]['title'] = str_replace("SunFrog", strtoupper($_SERVER['SERVER_NAME']), get_center($epl[$i], 'title="', '"'));
    if (strpos($epl[$i], 'Indicate'))
        $type[$i]['active'] = 'yes';
}
$cut = get_center($html, '<h4>You May Also Like These:</h4>', '<br style="clear:both;" />');
$epl = explode('</div></a>', $cut);
for ($i = 0; $i < count($epl) - 1; $i++) {
    $also[$i]['link'] = get_center($epl[$i], '<a href="', '"');
    $also[$i]['pic'] = get_center($epl[$i], "background:url('", "')");
    $also[$i]['title'] = get_center($epl[$i], 'title="', '"');
}
?>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" <?php echo 'content="'.$title.'"'; ?>/>
              <meta property="og:type" content="product"/>
        <meta property="og:image" <?php echo 'content="'.$pic.'"'; ?>/>
              <meta property="og:url" <?php echo 'content="http://'.$_SERVER['SERVER_NAME'].'/p/'.$id.'"'; ?>/>
              <link rel="image_src" href="https://www.sunfrogshirts.com/images/SunFrog-Shirts-Logo-Sq.png" />
              <meta property="og:site_name" content="<?php echo strtoupper($_SERVER['SERVER_NAME']);?>"/>
        <meta property="fb:admins" content="tuongthenao" />
        <meta property="og:description" <?php echo 'content="'.$desc.'"'; ?>/>

              <!-- Latest compiled and minified CSS -->
              <?php echo '<title>' . $title . '</title>'; ?>
              <meta name="description" <?php echo 'content="'.$desc.'"'; ?>>
              <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link href="http://bootswatch.com/<? echo $alias[$_SERVER['SERVER_NAME']];?>/bootstrap.min.css" rel="stylesheet">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <style>
            body { padding-top: 70px; }
            h3 {font-size:15px;}
            h2 {font-size:20px;}
            h1 {font-size:30px;}
        </style>
    </head>
    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><?php echo strtoupper($_SERVER['SERVER_NAME']);?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Track order</a></li>
                        <li><a href="#">Sizing</a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" method="get" role="search" action="/s/">
                            <div class="form-group">
                                <input type="text" name="query" class="form-control" placeholder="Over 2,000,000+ designs">
                            </div>
                            <button type="submit" class="btn btn-default">Search</button>
                        </form>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <ul class="list-group">
                        <?php
                        cat($siteurl);
                        ?>
                    </ul>
                </div>
                <div class="col-md-10">
                    <?php
                    echo '<h1>' . $title . '</h1>';
                    echo '<h2>' . $desc . '</h2>';
                    echo '<h2>Author: <a href="/a/' . $author . '" title="Designer ' . $author . '">' . $author . '</a></h2>';
                    ?>
                    <div class="row">
                        <div class="col-md-8">
                            <?php
                            echo '<img class="img-rounded img-responsive" src="' . $pic . '" title="' . $title . '" alt="' . $title . '">';
                            ?>
                            <hr>
                            <h4>T&ndash;Shirt Sizing and Details</h4>
                            <div class="col-md-6">
                                <table class="table table-striped">
                                    <tbody><tr><th>SIZE</th>
                                            <th>CHEST in</th>
                                            <th>LENGTH in</th>
                                        </tr>
                                        <tr><td class="size">S</td><td>18</td><td>27</td></tr>
                                        <tr><td class="size">M</td><td>19</td><td>28</td></tr>
                                        <tr><td class="size">L</td><td>21</td><td>29</td></tr>
                                        <tr><td class="size">XL</td><td>23</td>	<td>30</td></tr>
                                        <tr><td class="size">2X</td><td>25</td><td>31</td></tr>
                                        <tr><td class="size">3X</td><td>27</td><td>32</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <ul>

                                    <li>100% Cotton Adult 30/1s Tee Shirt</li>
                                    <li>4.3 oz 100% Ringspun Cotton, Preshrunk Jersey</li>
                                    <li>Tubular</li>
                                    <li>3/4 inch Seamless Rib Knit Collar</li>
                                    <li>Taped neck and shoulders</li>
                                    <li>Double-Needle Sleeve and Bottom Hem</li>
                                    <li>Shirts run small</li>
                                    <li style="list-style-type:none">&nbsp;</li>
                                    <li style="list-style-type:none">* <em>Sports Grey and Dark Heather are made of 50% Cotton / 50% Polyester</em></li>

                                </ul>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <div class="well">
                                <span class='st_plusone_hcount' displayText='Google +1'></span>
                                <span class='st_fblike_hcount' displayText='Facebook Like'></span>
                                <h3>Choose type</h3>
                                <?php for($i=1;$i<=count($type);$i++) {
                                if($type[$i]['active']=='yes') echo '<a href="'.$type[$i]['link'].'" title="'.$type[$i]['title'].'"  ><img style="outline: 1px solid green;margin:2px;" src="'.$siteurl.$type[$i]['pic'].'" width="50" /></a>';
                                else echo '<a href="'.$type[$i]['link'].'" title="'.$type[$i]['title'].'"  ><img style="margin:2px;" src="'.$siteurl.$type[$i]['pic'].'" width="50" /></a>';

                                }?>
                                <h3>Choose color</h3>
                                <?php for($i=0;$i<count($color);$i++) echo '<a href="'.$color[$i]['link'].'"><div style="'."background:url('".$color[$i]['pic']."') top left repeat;".'width:25px; height:25px; float:left; margin-right:3px; margin-bottom:3px; border:2px solid #a0d592;" title="'.$color[$i]['title'].'"></div></a>'; ?>
                                <br /><h3>Choose size</h3>
                                <select class="form-control">

                                    <?php
                                    for ($i = 0; $i < count($price[0]); $i++)
                                        echo '<option value="">' . get_center($price[0][$i], '">', '</') . '</option>';
                                    ?>
                                </select>
                                <?php echo '<br /><a href="' . $siteurl . '/' . $id . '?40387" rel="nofollow" target="_blank" class="btn btn-info" role="button" style="display: block; width: 100%;">Buy Now</a>'; ?>
                            </div>

                            <h3>YOU MAY ALSO LIKE THESE</h3>
                            <div class="row" style="text-align: center;">
                                <?php
                                foreach ($alias as $key => $value) {
                                $domain[]=$key; // lay domain
                                }
                                for($i=0;$i<count($also);$i++) echo '<div class="col-xs-6"><a href="http://'.$domain[rand(0,count($alias)-1)].'/p/'.$also[$i]['link'].'" data-toggle="tooltip" data-placement="top" title="'.$also[$i]['title'].'"/><img class="img-responsive img-circle" style="max-height:100px;margin:0px 5px 5px 0px;" src="'.$also[$i]['pic'].'"></a></div>';
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		
        </div>
        <?php analytics(); ?>
    </body>
</html>