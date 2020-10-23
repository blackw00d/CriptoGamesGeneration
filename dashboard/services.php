<?php
require_once './settings.php';

/*
 * Авторизация пользователя
 */
function login()
{
    ini_set("session.use_trans_sid", true);
    session_start();
    if (isset($_SESSION['user'])) {
        return true;
    } else {
        return false;
    }
}

/*
 * Закрытие сессии пользователя
 */
function out()
{
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['password']);
    SetCookie("user", null, -1, 'localhost');
    SetCookie("password", null, -1, 'localhost');
    unset($_COOKIE['user']);
    unset($_COOKIE['password']);
    header("Location: \index.php");
}

/*
 * Получение данных о пользователе из базы данных
 */
function get_user_data()
{
    $user_id = $_SESSION['user'];
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT user, email, token, address, bitcoin_Address, ref FROM users WHERE user="' . $user_id . '"';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $link->close();
        return ['user_name' => $row['user'], 'tokens' => $row['token'], 'address' => $row['address'], 'btc_address' => $row['bitcoin_Address'], 'email' => $row['email'], 'ref' => $row['ref']];
    } else header("Location: index.php");
}

/*
 * Получение данных о ценах на криптовалюту
 */
function get_crypto_data()
{
    $eth = file_get_contents('https://api.binance.com/api/v3/ticker/price?symbol=ETHUSDT', false);
    $eth_price = json_decode($eth, true)['price'];

    $btc = file_get_contents('https://api.binance.com/api/v3/ticker/price?symbol=BTCUSDT', false);
    $btc_price = json_decode($btc, true)['price'];

    $token_price_usd = 1;

    return ['eth_price' => $eth_price, 'btc_price' => $btc_price, 'token_price_usd' => $token_price_usd];
}

/*
 * Получение списка транзакций пользователя и вывод их на экран
 */
function get_user_transactions()
{
    $user_id = $_SESSION['user'];
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT * FROM transactions WHERE user="' . $user_id . '"';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo '<tr><td class="text-center">' . $i . '</td><td>' . $row['date'] . '</td><td>' . $row['tokens'] . '</td><td>';
            if ($row['status'] == 0) echo '<span class="label label-info label-rouded">Expected</span>';
            if ($row['status'] == 1) echo '<span class="label label-success label-rouded">Completed</span>';
            if ($row['status'] == 2) echo '<span class="label label-red label-rouded">Canceled</span>';
            echo '</td><td><span id="order-price-1">' . str_replace('.', ',', $row['price']) . '</span></td><td>';
            echo '<img src="';
            if ($row['currency'] == 'BTC') echo 'static/dashboard/media/btc.png'; else echo 'static/dashboard/media/eth.png';
            echo '" class="currency-icon"/> ' . $row['currency'];
            echo '</td><td><span id="order-address-1">' . $row['address'] . '</span></td>';
            if ($row['tx'] != NULL) {
                if ($row['currency'] == 'BTC')
                    echo '<td><a class="text-themecolor" href="https://www.blockchain.com/btc/tx/' . $row['tx'] . '">More Info</a></td></tr>';
                else
                    echo '<td><a class="text-themecolor" href="https://etherscan.io/tx/' . $row['tx'] . '">More Info</a></td></tr>';
            } else
                echo '<td><a class="text-themecolor" href="#">More Info</a></td></tr>';
            $i++;
        }
    } else echo '<tr>
                    <td class="text-center"></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                 </tr>';
    $link->close();
}