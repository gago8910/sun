<?php
include('functions.php');
$id = $_GET['id'];
$html = file_get_contents($siteurl . '/' . $id . '/');
$title = 'Shirts by author ' . $id;
$epl = explode('<form name="sendtocollection"', $html);
for ($i = 1; $i < count($epl); $i++) {
    $item[$i - 1]['pic'] = get_center($epl[$i], '<img src="', '" class="');
    $item[$i - 1]['title'] = get_center($epl[$i], 'product-Title" colspan="2">', '</td>');
    $item[$i - 1]['cat'] = get_center($epl[$i], 'class="product-cat">', '</td>');
    if ($item[$i - 1]['cat'] == null)
        $item[$i - 1]['cat'] = 'No Category';
    preg_match('/[a-zA-Z0-9-\[\]]{1,100}.html/', get_center($epl[$i], '<a href="', '"'), $regex);
    $item[$i - 1]['link'] = $regex[0];
    $item[$i - 1]['price'] = preg_replace('/\s+/', '', get_center($epl[$i], '<td valign="top" align="right" class="product-price">', '</td>'));
}
?>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta property="og:title" content="SunFrogShirts.ga The Best T Shirts"/>
        <meta property="og:type" content="product"/>
        <meta property="og:image" content="http://images.sunfrogshirts.com/2015/03/16/md_Jurassic-Park.jpg"/>
        <meta property="og:url" content="http://sunfrogshirts.ga/"/>
        <link rel="image_src" href="https://www.sunfrogshirts.com/images/SunFrog-Shirts-Logo-Sq.png" />
              <meta property="og:site_name" content="SunFrogShirts"/>
        <meta property="fb:admins" content="tuongthenao" />
        <meta property="og:description" content="Shop t-shirts. Choose from over 2,000,000 unique tees. Large selection of shirt styles. Satisfaction guaranteed."/>

        <!-- Latest compiled and minified CSS -->
        <?php echo '<title>' . $title . '</title>'; ?>
        <meta name="description" <?php echo 'content="' . $title . '"'; ?>>
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
        .productcat {
            padding:5px 0 5px 0;
            color: green;
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
            width: 250 px;
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
                    <a class="navbar-brand" href="/"><?php echo strtoupper($_SERVER['SERVER_NAME']); ?></a>
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
                    echo '<h3>Shirts By Author: "' . $id . '"</h3>';
                    for ($i = 0; $i < count($item); $i++)
                        if ($item[$i]['link'] != null)
                            echo '<div class="col-md-3 column productbox">
    <a href="/p/' . $item[$i]['link'] . '"><img src="' . $item[$i]['pic'] . '" class="img-rounded" alt="' . $item[$i]['title'] . '" style="max-height:200px;"></a>
    <div class="producttitle truncate">' . $item[$i]['title'] . '</div>
	<div class="productcat truncate"><i>' . $item[$i]['cat'] . '</i></div>
    <div class="productprice"><div class="pull-right"><a href="/p/' . $item[$i]['link'] . '" class="btn btn-danger btn-sm" role="button">BUY</a></div><div class="pricetext">' . $item[$i]['price'] . '</div></div>
</div>';
                    ?>
                </div>
            </div>		
        </div>
        <?php analytics(); ?>
    </body>
</html>