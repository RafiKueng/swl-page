<?php
  $whitelist = array("about", "tools", "discuss", "contact", "sources", "form");
  if(isset($_GET['id'])) {
    $page = 'direct.php';
  }
  else if(isset($_GET['page']) and in_array($_GET['page'], $whitelist)) {
    if ($_GET['page'] == "discuss") {
      header ("HTTP/1.1 301 Moved Permanently");
      header ("Location: http://talk.spacewarps.org/");
      exit(); 
    }
    $page = $_GET['page'].".php";
  }
  else {
    $page = 'about.php';
  }
?> 


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/slimbox2.css" type="text/css" media="screen" />
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>



    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        <div id="top">
          <div id="title">
            <h1>Space Warps Labs</h1>
          </div>
          <div id="menu">
            <ul>
              <li><a href="index.php?page=about">About</a></li>
              <li><a href="index.php?page=tools">Tools</a></li>
              <li><a href="index.php?page=discuss">Discuss</a></li>
              <li><a href="index.php?page=contact">Contact</a></li>
              <li><a href="index.php?page=sources">Add your Tool</a></li>
            </ul>
          </div>
        </div>
        
        
        <div id="main">

        <?php include($page); ?>
          
        </div>        
        
        <div id="foot">
          <p><a href="mailto:rafik[replace.this.with.at}physik.uzh.ch">Space Warps Labs</a>
            (using:
            <a href="http://jquery.com/">jquery 1.9.1</a>,
            <a href="http://html5boilerplate.com/">h5bp 4.2.0</a>,
            <a href="http://www.digitalia.be/software/slimbox2">slimbox 2.04</a>,
            <a href="http://necolas.github.io/normalize.css/">normalize.css</a>,
            <a href="https://en.wikipedia.org/wiki/File:Gravitational-lensing-angles.png">wikimedia</a>)
          </p>
        </div>
        
        
        
        
        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script type="text/javascript" src="js/slimbox2.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <!--
        <script>
            var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
            g.src='//www.google-analytics.com/ga.js';
            s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>
        -->
    </body>
</html>
