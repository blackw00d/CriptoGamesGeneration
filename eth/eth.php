<?php
require_once '../settings.php';

/*
 * Получение списка транзакций с etherscan.io для указанного адреса начиная с указанного блока
 */
function get_eth_transaction()
{
    $url = ETH_URL;
    $eth = file_get_contents($url, false);
    $data = json_decode($eth, true);
    $arr = array();
    if ($data['status']) {
        $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
        if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
        foreach ($data['result'] as $key => $value) {
            if ($value['to'] == ETH_ADDRESS and $value['confirmations'] >= 3)
                $query = 'SELECT id FROM transactions_eth WHERE tx="' . $value['hash'] . '"';
            $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
            if (mysqli_num_rows($result) == 0)
                $arr[$value['from']][] = array(
                    'tx' => $value['hash'],
                    'time' => $value['timeStamp'],
                    'value' => $value['value'] / 1000000000000000000,
                    'confirm' => $value['confirmations']
                );
        }
        $link->close();
    } else {
        echo $data['message'];
    }
    return $arr;
}

/*
 * Добавление проведенных транзакций соответсвующим пользователям в базу данных, обновление количества токенов пользователям
 */
function main()
{
    $arr = get_eth_transaction();
    if (count($arr) == 0) exit();

    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $query = 'SELECT id, user, address, total, tokens FROM transactions WHERE status=0 and currency="ETH"';
    $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    while ($row = mysqli_fetch_assoc($result)) {
        $user = $row['user'];
        $address = $row['address'];
        $total = $row['total'];
        $id = $row['id'];
        $tokens = $row['tokens'];
        $query = 'SELECT token FROM users WHERE user="' . $user . '"';
        $result2 = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if (mysqli_num_rows($result) == 1)
            $row2 = mysqli_fetch_assoc($result2);
        else break;
        $token = $row2['token'];
        if (isset($arr[$address])) {
            foreach ($arr[$address] as $key => $value) {
                if ($value['value'] == $total) {
                    $token += $tokens;
                    $query = 'UPDATE transactions SET status = 1, tx = "' . $value['tx'] . '" WHERE id=' . $id . ';';
                    mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
                    $query = 'UPDATE users SET token = ' . $token . ' where user = "' . $user . '";';
                    mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
                    $query = 'INSERT INTO transactions_eth (user, date, value, address, tx) VALUES ("' . $user . '","' . date("Y-m-d H:i:s", $value['time']) . '","' . $value['value'] . '","' . $address . '","' . $value['tx'] . '");';
                    mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
                    break;
                }
            }
        }
        mysqli_free_result($result2);
    }
    mysqli_free_result($result);
    $link->close();
}

main();

