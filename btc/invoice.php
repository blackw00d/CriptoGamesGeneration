<?php
require_once '../sign/lib/bitcoin_api.php';

/*
 * Получение данных о пользователе по email
 */
function get_user_data($user_id)
{
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT user, bitcoin_Address, token FROM users WHERE email="' . $user_id . '"';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $user = $row['user'];
        $user_adr = $row['bitcoin_Address'];
        $token = $row['token'];
        mysqli_free_result($result);
        $link->close();
    } else {
        $link->close();
        return [];
    }
    return ['user'=>$user, 'user_adr'=> $user_adr, 'token'=>$token];
}

/*
 * Получение списка транзакций от пользователя с указанным адрессом
 */
function get_user_payment($user_adr)
{
    $receive = 0;
    $pay_time = date("Y-m-d H:i:s");
    $api = new Bitcoin();
    $currentblock = $api->CurrentBlock();
    $result = $api->TrackReceivePayments($user_adr);
    foreach ($result as $key) {
        foreach ($key->out as $pay) {
            if ($pay->addr == $user_adr) {
                $receive = $pay->value / 100000000;
                $pay_time = date("Y-m-d H:i:s", $key->time);
                $pay_time_timestamp = $key->time;
                if ($key->block_height == null)
                    $confirmation = 0;
                else
                    $confirmation = $currentblock - $key->block_height + 1;
            }
        }
        $tx = $key->hash;
        $address = $key->inputs[0]->prev_out->addr;
    }
    print_r($user_adr . "<br>" . $address . "<br>");
    if ($confirmation < 3)
        return [];
    return ['receive'=>$receive, 'pay_time'=>$pay_time, 'tx'=>$tx, 'address'=>$address];
}

/*
 * Получение количества токенов из транзакции пользователя
 */
function get_tokens($user_data, $receive)
{
    $tokens = 0;
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT tokens FROM transactions where user="' . $user_data['user'] . '" and pay_address="' . $user_data['user_adr'] . '" and currency="BTC" and total="' . $receive . '"';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $tokens = $row['tokens'];
        mysqli_free_result($result);
    }
    $link->close();
    return $tokens;
}

/*
 * Получение транзакции пользователя, определения количества отправленного btc и добавление нужного количества токенов на счет пользователя
 */
function main()
{
    $user_id = $_GET['id'];
    $user_secret = $_GET['secret'];

    $user_data = get_user_data($user_id);
    if (count($user_data) == 0)
        exit();

    if (strtoupper(md5($user_id)) == $user_secret) {

        $payment = get_user_payment($user_data['user_adr']);
        $user_data['token'] += get_tokens($user_data, $payment['receive']);

        $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
        if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
        $query = 'update users set token="' . $user_data['token'] . '" where email="' . $user_id . '"';
        mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        $query = 'update transactions set status=1, address = "' . $payment['address'] . '", tx = "' . $payment['tx'] . '" where user="' . $user_data['user'] . '" and pay_address="' . $user_data['user_adr'] . '" and currency="BTC" and total="' . $payment['receive'] . '"';
        mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        $query = 'INSERT INTO transactions_btc (user, date, value, address, pay_address, tx) VALUES ("' . $user_data['user'] . '","' . $payment['pay_time'] . '","' . $payment['receive'] . '","' . $payment['address'] . '","' . $user_data['user_adr'] . '","' . $payment['tx'] . '");';
        mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        $link->close();
    } else
        exit();
}

//Commented out to test, uncomment when live
if ($_GET['test'] == true) {
    return;
}

main();