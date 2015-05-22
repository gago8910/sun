<?php
include('functions.php');
//var_dump($_SERVER['SERVER_NAME']);die;
//if (array_key_exists($_SERVER['SERVER_NAME'], $alias)) {
//    echo "Got Irix";
//}
if($_SERVER['SERVER_NAME'] == 'diabetesshirt.ga') {
    $html = file_get_contents($siteurl . '/search/index.cfm?SEARCH=diabetes');
    $link_sunfrog = '';
} else {
    $html = file_get_contents($siteurl);
    $link_sunfrog = '/p';
}
$epl = explode('<form name="sendtocollection" method="post" action="/AddtoGo.cfm">', $html);
for ($i = 1; $i < count($epl); $i++) {
    $item[$i - 1]['pic'] = get_center($epl[$i], 'data-original="', '"');
    $item[$i - 1]['title'] = get_center($epl[$i], 'title="', '"');
    $item[$i - 1]['link'] = get_center($epl[$i], '<a href="', '"');
    $item[$i - 1]['price'] = preg_replace('/\s+/', '', get_center($epl[$i], '<strong>', '</strong>'));
//    $item[$i - 1]['price'] = preg_replace('/\s+/', '', get_center($epl[$i], '<td valign="top" align="right" class="product-price">', '</td>'));
}
?>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="<? echo strtoupper($_SERVER['SERVER_NAME']);?> The Best T Shirts"/>
        <meta property="og:type" content="product"/>
        <meta property="og:image" content="http://images.sunfrogshirts.com/2015/03/16/md_Jurassic-Park.jpg"/>
        <meta property="og:url" content="<? echo 'http://'.$_SERVER['SERVER_NAME'].'/';?>"/>
        <link rel="image_src" href="https://www.sunfrogshirts.com/images/SunFrog-Shirts-Logo-Sq.png" />
              <meta property="og:site_name" content="<? echo strtoupper($_SERVER['SERVER_NAME']);?>"/>
        <meta property="fb:admins" content="tuongthenao" />
        <meta property="og:description" content="Shop t-shirts <? echo strtoupper($_SERVER['SERVER_NAME']);?>. Choose from over 2,000,000 unique tees. Large selection of shirt styles. Satisfaction guaranteed."/>

        <!-- Latest compiled and minified CSS -->
        <title><?php echo strtoupper($_SERVER['SERVER_NAME']); ?> The Best T Shirts</title>
        <meta name="description" content="TShop t-shirts <? echo strtoupper($_SERVER['SERVER_NAME']);?>. Choose from over 2,000,000 unique tees. Large selection of shirt styles. Satisfaction guaranteed.">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link href="http://bootswatch.com/<? echo $alias[$_SERVER['SERVER_NAME']];?>/bootstrap.min.css" rel="stylesheet">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <style>
        body { padding-top: 70px; }
        .productbox {
            background-color:#ffffff;
            padding:10px;
            margin-bottom:10px;
            -webkit-box-shadow: 0 8px 6px -6px  #999;
            -moz-box-shadow: 0 8px 6px -6px  #999;
            box-shadow: 0 8px 6px -6px #999;
        }

        .producttitle {
            padding:5px 0 5px 0;
        }

        .productprice {
            border-top:1px solid #dadada;
            padding-top:5px;
        }

        .pricetext {
            font-weight:bold;
            font-size:1.4em;
        }
        .truncate {
            width: 200 px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

    </style>
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
                    <a class="navbar-brand" href="/"><? echo strtoupper($_SERVER['SERVER_NAME']);?></a>
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
                    for ($i = 0; $i < count($item); $i++)
                        echo '<div class="col-md-3 column productbox">
    <a href="'.$link_sunfrog . $item[$i]['link'] . '?39166"><img src="' . $item[$i]['pic'] . '" class="img-rounded" alt="' . $item[$i]['title'] . '" style="max-height:200px;"></a>
    <div class="producttitle truncate">' . $item[$i]['title'] . '</div>
    <div class="productprice"><div class="pull-right"><a href="'.$link_sunfrog . $item[$i]['link'] . '?39166" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">' . $item[$i]['price'] . '</div></div>
</div>';
                    ?>
                </div>
            </div>		
        </div>
        <?php analytics(); ?>
    </body>
</html>