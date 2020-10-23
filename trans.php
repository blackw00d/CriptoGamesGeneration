<?php

require_once 'settings.php';

/*
 * Обновление адреса пользователю для выплаты токенов по окончанию ICO
 */
if (isset($_POST['address'], $_POST['user'])) {
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT id FROM users WHERE user="' . $_POST['user'] . '";';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $query = 'UPDATE users SET address = "' . $_POST['address'] . '" WHERE id=' . $row['id'] . ';';
        $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if ($result) {
            echo 'Address Save';
        } else echo 'Sorry. Service on maitenance. Try Later.';
    }
    $link->close();
    return;
}

/*
 * Покупка токенов, добавление транзакции пользователя с указанными параметрами в базу данных
 */
if (isset($_POST['user'], $_POST['currencyTotal'])) {
    $user_name = $_POST['user'];
    $amountToken = $_POST['amountToken'];
    $currency = $_POST['currency'];
    $currencyPrice = $_POST['currencyPrice'];
    $currencyTotal = $_POST['currencyTotal'];

    $btc_address = MY_BTC_ADDRESS;
    $eth_address_pay = MY_ETH_ADDRESS;

    if (($currencyTotal - ($currencyPrice * $amountToken)) * 100 / $currencyTotal > 0.01) {
        echo 'Sorry. Service on maitenance. Try Later.';
        exit;
    }

    $amountToken = ico_transaction($amountToken);

    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT address, bitcoin_Address FROM users WHERE user="' . $_POST['user'] . '";';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $btc_address_pay = isset($row['bitcoin_Address']) ? $row['bitcoin_Address'] : $btc_address;
        $eth_address = isset($row['address']) ? $row['address'] : $eth_address_pay;
    }
    $query = 'INSERT INTO transactions (user, date, tokens, status, price, total, currency, address, pay_address, tx) VALUES ("' . $user_name . '","' . date("Y-m-d H:i:s") . '",' . $amountToken . ',0,"' . $currencyPrice . '","' . $currencyTotal . '","' . $currency . '","' . ($currency == 'BTC' ? '' : $eth_address) . '","' . ($currency == 'BTC' ? $btc_address_pay : $eth_address_pay) . '",NULL);';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if ($result) {
        echo 'Thank You for Your purchase. Your transaction take a status <span class="label label-info label-rouded">Expected</span><br>Transfer <span style="color: var(--colorTheme)!important;">' . $currencyTotal . ' ' . $currency . '</span> on our ' . $currency . ' Address <span style="color: var(--colorTheme)!important;">' . ($currency == 'BTC' ? $btc_address : $eth_address) . '</span><br><span style="color: red!important;">If You pay with ETH, use for transfer only wallet address specified as "Your Wallet Address".</span><br>For BTC use any BTC wallet address.<br><span style="color: red!important;">Remember, cryptocurrency exchanges wallets are not accepted.</span><br>You can see Your transactions at Control Panel in table Payments.';
    } else echo 'Sorry. Service on maitenance. Try Later.';
    $link->close();
}
