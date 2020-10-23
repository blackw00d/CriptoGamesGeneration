<?php

include_once 'settings.php';
$settings = ico_date();
$date = $settings['date'];
$period = $settings['period'];

?>

<html>
<head>
    <link rel='stylesheet' href='static/index/css/style.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Sans+Pro'>
    <link href="https://fonts.googleapis.com/css?family=Poller+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <style type='text/css'>
        #access ul li a {
            font-family: Source Sans Pro;
            font-size: 95%;
            font-weight: 400;
        }

        #access > div > ul > li, #access > div > ul > li > a {
            color: white;
        }

        #access > div > ul > li:hover > a, #access > div > ul > li a:hover, #access > div > ul > li:hover {
            color: orange;
        }

        #access > div > ul > li > a > span::before, #site-title::before {
            background-color: orange;
        }

        #site-title a:hover {
            color: orange;
        }
    </style>
    <link rel='stylesheet' href='static/index/css/roadmap.css' type='text/css' media='all'>
    <link rel="icon" href="static/logo.png" sizes="32x32">
    <script src="static/index/js/canvasjs.min.js"></script>
    <script src="static/index/js/jquery.min.js" type="text/javascript"></script>
    <script src="static/index/js/services.js" type="text/javascript"></script>
    <script>
        window.onload = function () {
            chart_render();
        }
        clock(<?php echo $date; ?>);
    </script>
</head>
<body>
<div class="all">
    <div class="menu">
        <a href="" title="Cripto Games Generation">
            <img src="static/logo.png">
            <p>CryptoGameGeneration</p>
        </a>
        <nav id="access"><br>
            <div>
                <ul>
                    <li>
                        <a href="#About"><span>About</span></a>
                    </li>
                    <li>
                        <a href="#ICO"><span>Token Sale</span></a>
                    </li>
                    <li>
                        <a href="static/index/doc/WhitePaper.pdf"><span>White Paper</span></a>
                    </li>
                    <li>
                        <a href="#RoadMap"><span>Roadmap</span></a>
                    </li>
                    <li>
                        <a href="#Contact"><span>Contact</span></a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div id="ICO">
        <h2>
            TOKEN SALE
            <br><br>
            <?php echo $period; ?>
            <br><br>
            <div id="timerclock"></div>
            <br>
            <a href="sign.php" class="btn orange"><span>Buy TOKEN CGG</span></a>
        </h2>
    </div>
</div>
<div id="About">
    <div class="container">
        <div class="row">
            <h2>
                <span><b>CRYPTO GAMES GENERATION</b><br> PAY YOU FOR PLAYING TIMEKILLER GAME</span>
            </h2>
            <p>
                <span>Our TARGET is to restore the former glory of games - timekillers, such as snake, tetris, etc. </span>
            </p>
            <br><br><br>
            <h2>Token Distribution</h2>
        </div>
    </div>
    <div id="chartContainer" style="height: 300px; width: 100%;background: transparent;"></div>
</div>
<div id="RoadMap">
    <div class="title-box">
        <h2 class="title-center"><b>CryptoGameGeneration</b> ICO Roadmap</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class="timeline-split">
                <div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12">
                    <div class="timeline section-box-margin">
                        <div class="block block-left">
                            <h3>Achieved</h3>
                            <span>Q1 2017</span>
                            <p>Was born idea CGG coins</p>
                        </div>
                        <div class="block block-right mt-30">
                            <h3>Achieved</h3>
                            <span>Q2 2017</span>
                            <p>Started work on building the platform based on blockchain</p>
                        </div>
                        <div class="block block-left mt-30">
                            <h3>Achieved</h3>
                            <span>Q3 2018</span>
                            <p>Launch pre-alpha and alpha versions of mobile app and reward systems</p>
                        </div>
                        <div class="block block-right mt-30">
                            <h3>Planned</h3>
                            <span>Q4 2018</span>
                            <p>ICO and token distribution</p>
                        </div>
                        <div class="block block-left mt-30">
                            <h3>Planned</h3>
                            <span>Q1 2019</span>
                            <p>Launch beta version of mobile app and reward systems</p>
                        </div>
                        <div class="block block-right mt-30">
                            <h3>Planned</h3>
                            <span>Q2 2019</span>
                            <p>Full launch of the reward system</p>
                        </div>
                        <div class="block block-left mt-30">
                            <h3>Planned</h3>
                            <span>Q3 2019</span>
                            <p>Expansion of reward system functionality</p>
                        </div>
                        <div class="block block-right mt-30">
                            <h3>Planned</h3>
                            <span>Q4 2019</span>
                            <p>Listing on cryptocurrency Exchanges</p>
                        </div>
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>
<div id="Contact">
    <img src="static/index/media/snake_slow.gif">
    <img src="static/index/media/pacman_slow.gif">
</div>
<div id="footer">
    <div style="width: 40%">
        <img src="static/logo.png"><span>Copyright&copy2018 CryptoGameGeneration</span>
    </div>
    <div style="width: 60%">
        <a href="https://twitter.com/CryptoGameGeneration" title="Twitter" target="_blank">
            <i class="fab fa-twitter"></i>
        </a>
        <a href="https://t.me/CryptoGameGeneration" title="Telegram" target="_blank">
            <i class="fab fa-telegram-plane"></i>
        </a>
        <a href="https://bitcointalk.org/index.php?topic=" title="BitcoinTalk" target="_blank">
            <i class="fab fa-btc"></i>
        </a>
        <a href="https://www.reddit.com/user/cryptogamegeneration" title="Reddit" target="_blank">
            <i class="fab fa-reddit"></i>
        </a>
        <a href="https://medium.com/@cryptogamegeneration.io" title="Medium" target="_blank">
            <i class="fab fa-medium"></i>
        </a>
        <br><br>
        <span>EMAIL : info@cryptogamegeneration.io</span>
    </div>
</div>

</body>
</html>