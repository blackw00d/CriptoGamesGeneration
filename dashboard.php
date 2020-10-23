<?php

require_once 'settings.php';
require_once 'dashboard/services.php';

if ($_GET['action'] == "out") out();
if (!login()) header("Location: index.php");

$settings = ico_bonus();
$date = $settings['date'];
$bonus = $settings['bonus'];
$stage = $settings['stage'];

$user_data = get_user_data();
$token_data = get_crypto_data();

?>

<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="static/logo.png">
    <title>Dashboard | Crypto Game Generation</title>
    <link href="static/dashboard/css/style_dashboard.css" rel="stylesheet"/>
    <style>
        select {
            font-family: 'FontAwesome', 'sans-serif';
        }
    </style>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="static/index/js/jquery.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#sidebarnav li").click(function (e) {
                var top = document.getElementsByClassName('active');
                for (var i in top) {
                    top[i].className = '';
                }
                this.className = 'active';
            });
            $("#walletclick").click(function (e) {
                var top = document.getElementById('controlpanel');
                top.className = '';
                top.style = 'visibility: hidden;'
                var top = document.getElementById('wallet');
                top.className = 'page-wrapper';
                top.style = 'visibility: visible;position:absolute;top:70px;height:100%;';
            });
            $("#panelclick").click(function (e) {
                var top = document.getElementById('wallet');
                top.className = '';
                top.style = 'visibility: hidden;position:absolute;top:70px;height:70%;';
                var top = document.getElementById('controlpanel');
                top.className = 'page-wrapper';
                top.style = 'visibility: visible;';
            });
            $("#addressinput").change(function (e) {
                var address = $(this).val();
                if (!(/^(0x){1}[0-9a-fA-F]{40}$/i.test(address))) {
                    $('#errortext').html("Wrond Address");
                } else $('#errortext').html("");
            });
            $("#sumbitForm").click(function (e) {
                var address = $("#addressinput").val();
                if (!(/^(0x){1}[0-9a-fA-F]{40}$/i.test(address))) {
                    $('#errortext').html("Wrond Address");
                } else {
                    $.post("dashboard/trans.php", {
                        user: '<?php echo $user_data['user_name'];?>',
                        address: $("#addressinput").val()
                    })
                        .done(function (data) {
                            $('#errortext').html(data);
                        });
                }
            });
            $("#currency").change(function (e) {
                var cur = document.getElementById('currency');
                var currency = cur.options[cur.selectedIndex].value;
                var price = '';
                if (currency === 'BTC') {
                    price = '<?php echo number_format($token_data['token_price_usd'] / $token_data['btc_price'], '7', ',', '');?>';
                } else if (currency === 'ETH') {
                    price = '<?php echo number_format($token_data['token_price_usd'] / $token_data['eth_price'], '7', ',', '');?>';
                }
                document.getElementById('currencyPrice').value = price;
                var amount = parseFloat(document.getElementById('amountToken').value);
                price = parseFloat(price.replace(",", "."));
                var total = document.getElementById('currencyTotal');
                var totalprice = (price * amount).toString().replace(".", ",");
                if (totalprice.length > 9) totalprice = totalprice.substr(0, 9);
                total.value = totalprice;
            });
            $("#amountToken").change(function (e) {
                var amount = this.value;
                this.style = "";
                var price = parseFloat(document.getElementById('currencyPrice').value.replace(",", "."));
                var total = document.getElementById('currencyTotal');
                var totalprice = (price * amount).toString().replace(".", ",");
                if (totalprice.length > 9) totalprice = totalprice.substr(0, 9);
                total.value = totalprice;
                if (amount < 20) {
                    this.style = "border-color: red";
                    this.value = "Minimum 20 Tokens";
                }
            });
            $("#sumbitCalculator").click(function (e) {
                var amount = $("#amountToken").val();
                if (amount !== 'Minimum 20 Tokens') {
                    var cur = document.getElementById('currency');
                    var currency = cur.options[cur.selectedIndex].value;
                    var currencyPrice = parseFloat(document.getElementById('currencyPrice').value.replace(",", "."));
                    var currencyTotal = parseFloat(document.getElementById('currencyTotal').value.replace(",", "."));
                    $.post("dashboard/trans.php", {
                        user: '<?php echo $user_data['user_name'];?>',
                        amountToken: amount,
                        currency: currency,
                        currencyPrice: currencyPrice,
                        currencyTotal: currencyTotal
                    })
                        .done(function (data) {
                            $('#complite').html(data);
                        });
                }
            });
        });
    </script>
</head>

<body class="fix-header fix-sidebar card-no-border">
<div id="main-wrapper">
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-sm navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">
                    <span>
                        <img src="static/logo.png" height="55" title="Crypto Game Generation" class="dark-logo"/>
                    </span>
                </a>
            </div>
            <div class="navbar-collapse">
                <ul class="nav-menu-toggle navbar-nav mr-auto">
                    <li class="nav-item">
                        <span class="nav-link text-muted d-none d-md-block">
                                <span>Contract address: </span>
                            <a href="https://etherscan.io/token/0xC16b542ff490e01fcc0DC58a60e1EFdc3e357cA6"
                               target="_blank">
                                <span>0xC16b542ff490e01fcc0DC58a60e1EFdc3e357cA6</span>
                            </a>
                        </span>
                    </li>
                </ul>
                <ul class="navbar-nav my-lg-0">
                    <li class="nav-item d-none d-sm-flex">
                        <a class="link text-themecolor" href="index.php">
                            Crypto Game Generation
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="left-sidebar">
        <!-- Sidebar scroll-->
        <div class="scroll-sidebar">
            <div class="user-profile">
                <div class="profile-text">
                    <span><a href="#" class="__cf_email__"><?php echo $user_data['user_name']; ?></a></span>
                </div>
            </div>
            <nav class="sidebar-nav">
                <ul id="sidebarnav">
                    <li id="panelclick" class=active>
                        <a href="#">
                            <i class="fas fa-compass"></i>
                            <span class="hide-menu">Control Panel</span>
                        </a>
                    </li>
                    <li id="walletclick">
                        <a href="#">
                            <i class="fas fa-credit-card"></i>
                            <span class="hide-menu">Wallet</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="contacts">
            <a href="https://twitter.com/CryptoGameGeneration" title="Twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://t.me/CryptoGameGeneration" title="Telegram">
                <i class="fab fa-telegram-plane"></i>
            </a>
            <a href="https://bitcointalk.org/index.php?topic=" title="BitcoinTalk">
                <i class="fab fa-btc"></i>
            </a>
            <a href="https://www.reddit.com/user/cryptogamegeneration" title="Reddit">
                <i class="fab fa-reddit"></i>
            </a>
            <a href="https://medium.com/@cryptogamegeneration.io" title="Medium">
                <i class="fab fa-medium"></i>
            </a>
        </div>
        <div class="sidebar-footer">
            <a href="dashboard.php?action=out" class="link" data-toggle="tooltip" title="" data-original-title="Exit"><i
                        class="fas fa-sign-out-alt">Exit</i></a>
        </div>
    </aside>

    <div id="controlpanel" class="page-wrapper">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col-md-4 col-xs-12 align-self-center">
                    <h3 class="text-themecolor m-b-0 m-t-0">Control Panel</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="card-title m-b-0 text-warning">
                                    <span class="lstick warning"></span>
                                    <?php echo $stage; ?>
                                </h3>
                            </div>
                            <div>To Buy CGG Token click <span style="color: #0069d9;">Wallet</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="max-width: 50%;">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                Your personal
                                <span style="color: #0069d9;">
                                    <a href="sign.php?ref=<?php echo substr(md5($user_data['email']), -8); ?>">Referal link</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="max-width: 50%;">
                    <div class="card">
                        <div class="card-body">
                            <div>
                                You invited <span style="color: #0069d9;"><?php echo $user_data['ref']; ?></span> people
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="dashcard card-body">
                            <div class="d-flex no-block">
                                <div class="dashcard-icon m-r-20 align-self-center">
                                    <span class="lstick m-r-20"></span>
                                    <svg class="dashcard-icon-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512" alt="Tokens">
                                        <path d="m421.4,11.9h-330.8l-77,113.4 242.4,375.6 242.4-375.6-77-113.4zm-98.5,122.8l-66.9,301.7-67.9-301.7h134.8zm-125.7-19.8l59.2-76.2 59.2,76.2h-118.4zm138.9-7.3l-58.9-75.9h117.8l-58.9,75.9zm-159.2,1.1l-59.7-77h119.4l-59.7,77zm-21.4,6.2h-110.9l51.7-76.3 59.2,76.3zm12.9,19.8l66.5,297-191.3-297h124.8zm174.2,0h125.9l-193,299.4 67.1-299.4zm124.8-19.8h-110.8l59.2-76.2 51.6,76.2z"/>
                                    </svg>
                                </div>
                                <div class="dashcard-text align-self-center">
                                    <h6 class="dashcard-text-title text-muted">Tokens amount</h6>
                                    <h2 class="dashcard-text-stat"><?php echo number_format($user_data['tokens'], '2', ',', ''); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="dashcard card-body">
                            <div class="d-flex no-block">
                                <div class="dashcard-icon m-r-20 align-self-center">
                                    <span class="lstick m-r-20"></span>
                                    <svg class="dashcard-icon-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 612.322 612.322" alt="Main currency">
                                        <path d="M187.57,359.458h360.895l63.856-227.934h-93.973l-33.74-104.22L343.9,72.916l19.244,58.608h-6.623l-34.74-104.22
				                L181.072,72.916l19.244,58.608h-75.228l-15.62-62.482c-7.873-31.241-35.115-53.359-66.481-53.359H0V41.8h42.987
				                c19.494,0,36.489,12.996,41.738,32.616l69.105,270.421c-14.246,10.247-23.618,26.992-23.618,46.112
				                c0,31.241,26.117,57.358,57.358,57.358h351.773V422.19H187.57c-16.995,0-31.241-14.371-31.241-31.241
				                C156.33,373.829,170.7,359.458,187.57,359.458L187.57,359.458z M467.739,59.795l23.493,70.355H389.637l-14.371-40.363
				                L467.739,59.795z M304.911,59.795l23.493,70.355H226.809l-14.371-40.363L304.911,59.795z M578.457,156.267l-49.486,177.199
				                H177.198l-45.612-177.198L578.457,156.267L578.457,156.267z"/>
                                        <path d="M424.751,487.171c-29.991,0-54.734,24.743-54.734,54.734c0,29.991,24.743,54.734,54.734,54.734
				                c31.241,0,54.734-24.743,54.734-54.734C479.486,511.914,454.743,487.171,424.751,487.171z M424.751,571.896
				                c-16.995,0-29.991-14.371-29.991-29.991c0-16.995,14.371-29.991,29.991-29.991c16.995,0,29.991,12.996,29.991,29.991
				                C454.743,558.9,440.372,571.896,424.751,571.896z"/>
                                        <path d="M224.06,487.171c-29.991,0-54.734,24.743-54.734,54.734c0,29.991,24.743,54.734,54.734,54.734
				                s54.734-24.743,54.734-54.734C278.794,511.914,254.051,487.171,224.06,487.171z M224.06,571.896
				                c-16.995,0-29.991-14.371-29.991-29.991c0-16.995,14.371-29.991,29.991-29.991s29.991,12.996,29.991,29.991
				                C254.051,558.9,239.68,571.896,224.06,571.896z"/>
                                    </svg>
                                </div>
                                <div class="dashcard-text align-self-center">
                                    <h6 class="dashcard-text-title text-muted">USD amount</h6>
                                    <h2 class="dashcard-text-stat"><?php echo number_format($user_data['tokens'] * $token_data['token_price_usd'], '2', ',', ''); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="dashcard card-body">
                            <div class="d-flex no-block">
                                <div class="dashcard-icon m-r-20 align-self-center">
                                    <span class="lstick m-r-20"></span>
                                    <svg class="dashcard-icon-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512" alt="Bonus">
                                        <path d="m393.2,105.9c9.3-10 15.1-23.6 15.1-38.6 0-31.3-25-56.3-55.3-56.3-23,0-76,34.4-97.2,65.3-21.9-30.9-74.7-64.3-96.8-64.3-30.2,0-55.3,25-55.3,56.3 0,14.5 5.4,27.6 14.1,37.5h-106.8v134.5h29.2v260.7h153.3 125.1 153.3v-260.6h29.1v-134.5h-107.8zm-40.2-74c18.8-7.10543e-15 34.4,15.6 34.4,36.5 0,17.6-12.3,32.7-28.2,35.9h-84.6c-5.4-1.6-7.1-3.5-7.1-4.6 0-17.8 62.5-67.8 85.5-67.8zm-194-0c21.9,0 85.5,50 85.5,67.8 0,1.6-3.7,3.4-6.4,4.6h-85.2c-15.9-3.2-28.2-18.3-28.2-35.9-0.1-19.9 15.6-36.5 34.3-36.5zm34.4,448.2h-132.4v-239.7h132.4v239.7zm0-259.5h-161.5v-93.8h161.6v93.8zm104.2,259.5h-83.4v-353.4h83.4v353.4zm153.3,0h-132.4v-239.7h132.4v239.7zm29.1-259.5h-161.5v-93.8h161.6v93.8z"/>
                                    </svg>
                                </div>
                                <div class="dashcard-text align-self-center">
                                    <h6 class="dashcard-text-title text-muted">Current Bonus</h6>
                                    <h2 class="dashcard-text-stat"><?php echo $bonus; ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3">
                    <div class="card">
                        <div class="dashcard card-body">
                            <div class="d-flex no-block">
                                <div class="dashcard-icon m-r-20 align-self-center">
                                    <span class="lstick m-r-20"></span>
                                    <svg class="dashcard-icon-svg" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 512 512" alt="EndDate">
                                        <path d="M422.8,82.4V11H402v71.4H110V11H89.2v71.4H11v134.2V501h490V216.6V82.4H422.8z M31.9,102.6h449.3v93.7H31.9V102.6z     M481.2,480.8H31.9V216.6h449.3V480.8z"/>
                                        <rect width="43.8" x="99.6" y="285.8" height="21.3"/>
                                        <rect width="43.8" x="234.1" y="285.8" height="21.3"/>
                                        <rect width="43.8" x="368.6" y="285.8" height="21.3"/>
                                        <rect width="43.8" x="99.6" y="386" height="21.3"/>
                                        <rect width="43.8" x="234.1" y="386" height="21.3"/>
                                        <rect width="43.8" x="368.6" y="386" height="21.3"/>
                                    </svg>
                                </div>
                                <div class="dashcard-text align-self-center">
                                    <h6 class="dashcard-text-title text-muted">Days то end ICO</h6>
                                    <h2 class="dashcard-text-stat"><?php echo number_format($date, '0', ',', ''); ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="card-title m-b-0">
                                        <span class="lstick"></span>
                                        Payments
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover no-wrap">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Date</th>
                                    <th>Tokens</th>
                                    <th>Status</th>
                                    <th>Price</th>
                                    <th>Payment method</th>
                                    <th>Payment address</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        get_user_transactions();
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="card-title m-b-10">
                                    <span class="lstick"></span>
                                    CGG Token Price
                                </h3>
                            </div>                            <div class="table-responsive">
                                <table class="table table-hover table-borderless no-wrap m-b-0">
                                    <tbody>
                                    <tr>
                                        <td><img src="static/dashboard/media/usd.png" class="currency-icon"> USD</td>
                                        <td>  <?php echo number_format($token_data['token_price_usd'], '2', ',', ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="static/dashboard/media/btc.png" class="currency-icon"> BTC</td>
                                        <td>  <?php echo number_format($token_data['token_price_usd'] / $token_data['btc_price'], '7', ',', ''); ?></td>
                                    </tr>
                                    <tr>
                                        <td><img src="static/dashboard/media/eth.png" class="currency-icon"> ETH</td>
                                        <td>  <?php echo number_format($token_data['token_price_usd'] / $token_data['eth_price'], '7', ',', ''); ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-4 col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="card-title m-b-20">
                                    <span class="lstick"></span>
                                    Bonus calendar
                                </h3>
                            </div>
                            <div class="steamline m-t-20">
                                <div class="sl-item">
                                    <div class="sl-left ">1</div>
                                    <div class="sl-right">
                                        <div class="text-muted"><i class="far fa-clock"></i> Until 11.11.2018 0:00:00
                                        </div>
                                        <div class="desc text-muted">FREE 30% CGG Token</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left ">2</div>
                                    <div class="sl-right">
                                        <div class="text-muted"><i class="far fa-clock"></i> Until 21.11.2018 0:00:00
                                        </div>
                                        <div class="desc text-muted">FREE 20% CGG Token</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left ">3</div>
                                    <div class="sl-right">
                                        <div class="text-muted"><i class="far fa-clock"></i> Until 01.12.2018 0:00:00
                                        </div>
                                        <div class="desc text-muted">FREE 15% CGG Token</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left ">4</div>
                                    <div class="sl-right">
                                        <div class="text-muted"><i class="far fa-clock"></i> Until 11.12.2018 0:00:00
                                        </div>
                                        <div class="desc text-muted">FREE 10% CGG Token</div>
                                    </div>
                                </div>
                                <div class="sl-item">
                                    <div class="sl-left ">5</div>
                                    <div class="sl-right">
                                        <div class="text-muted"><i class="far fa-clock"></i> Until 21.12.2018 0:00:00
                                        </div>
                                        <div class="desc text-muted">FREE 5% CGG Token</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wallet" style="visibility: hidden;position:absolute;top:70px;height:70%;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="card-title m-b-0 text-warning">
                                    <span class="lstick warning"></span>
                                    <?php echo $stage; ?>
                                </h3>
                            </div>
                            <div>Use Calculator to buy CGG Token.<br>Enter Token amount and select payment
                                cryptocurrency. After Complete, the system will reserve for you the specified number of
                                Tokens.<br>Next, follow the instructions.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="max-width: 50%;">
                    <div class="card">
                        <div class="dashcard card-body">
                            <div class="d-flex no-block">
                                <div class="dashcard-icon m-r-20 align-self-center">
                                    <img src="static/dashboard/media/btc.png" class="currency-icon">
                                </div>
                                <div class="dashcard-text align-self-center">
                                    <h6 class="dashcard-text-title text-muted">BTC address</h6>
                                    <h6 class="dashcard-text-title text-muted"><?php echo $user_data['btc_address']; ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12" style="max-width: 50%;">
                    <div class="card">
                        <div class="dashcard card-body">
                            <div class="d-flex no-block">
                                <div class="dashcard-icon m-r-20 align-self-center">
                                    <img src="static/dashboard/media/eth.png" class="currency-icon">
                                </div>
                                <div class="dashcard-text align-self-center">
                                    <h6 class="dashcard-text-title text-muted">ETH address</h6>
                                    <h6 class="dashcard-text-title text-muted">
                                        0x5ec5C57849b62d3F4782C35fDc0579c1b572b09c</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Enter your Ethereum tokens (ERC-20 standard) wallet to get CGG tokens after ICO
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless no-wrap m-b-0" style="width: 50%">
                                    <tbody>
                                    <form id="addressForm" method="post">
                                    <tr>
                                        <td>
                                            <h6 class="dashcard-text-title text-muted">
                                                Your Wallet Address
                                            </h6>
                                            <input type="text" maxlength="42" size="42" id="addressinput"
                                                   value="<?php echo $user_data['address']; ?>">
                                        </td>
                                        <td style="vertical-align: bottom;">
                                            <div id="errortext"></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="dashcard-text-stat">
                                                <a href="#" id="sumbitForm" class="link" data-toggle="tooltip" title=""
                                                   data-original-title="Save">
                                                    Save
                                                </a>
                                            </h4>
                                        </td>
                                    </tr>
                                    </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                Calculator
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless no-wrap m-b-0" style="width: 50%">
                                    <tbody>
                                    <form id="CalculatorForm" method="post">
                                    <tr>
                                        <td>
                                            <h6 class="dashcard-text-title text-muted">
                                                Token Amount
                                            </h6>
                                            <input type="text" maxlength="10" size="20" id="amountToken" value="20"
                                                   onkeyup="this.value=this.value.replace(/[^\d]+/g,'')">
                                        </td>
                                        <td>
                                            <h6 class="dashcard-text-title text-muted">
                                                Currency
                                            </h6>
                                            <select id="currency" name="currency" style="padding: 1px;width: 100px;">
                                                <option selected value="BTC"> Bitcoin</option>
                                                <option value="ETH"> Ethereum</option>
                                            </select>
                                        </td>
                                        <td>
                                            <h6 class="dashcard-text-title text-muted">
                                                Currency Price
                                            </h6>
                                            <input type="text" maxlength="15" size="20" id="currencyPrice"
                                                   value="<?php echo number_format($token_data['token_price_usd'] / $token_data['btc_price'], '7', ',', ''); ?>"
                                                   readonly>
                                        </td>
                                        <td>
                                            <h6 class="dashcard-text-title text-muted">
                                                Total
                                            </h6>
                                            <input type="text" maxlength="15" size="20" id="currencyTotal"
                                                   value="<?php echo number_format($token_data['token_price_usd'] / $token_data['btc_price'] * 20, '7', ',', ''); ?>"
                                                   readonly>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <h4 class="dashcard-text-stat">
                                                <a href="#" id="sumbitCalculator" class="link" data-toggle="tooltip"
                                                   title="" data-original-title="Save">
                                                    Complete
                                                </a>
                                            </h4>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
                                            <h6 class="dashcard-text-title text-muted">
                                                <div id="complite"></div>
                                            </h6>
                                        </td>
                                    </tr>
                                    </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
