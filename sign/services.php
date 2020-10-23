<?php
require_once 'lib/bitcoin_api.php';

/*
 * Отображение ошибки
 */
function show_error($error)
{
    return '<div class="m-alert m-alert--outline alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                <span>' . $error . '</span>
            </div>';
}

/*
 * Шаблон письма пользователю при регистрации
 */
function signup_message($user)
{
    return "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>CryptoGameGeneration</title>
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.3.1/css/all.css\" integrity=\"sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU\" crossorigin=\"anonymous\">
</head>
<body>
    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
        <tbody>
            <tr>
                <td align=\"center\" valign=\"top\">
                    <table width=\"640\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                        <tbody>
                            <tr>
                                <td align=\"center\" valign=\"top\" width=\"600\">
                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                        <tbody>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"15\"></td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\">
                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                        <tbody>
                                                            <tr>
                                                                <td align=\"left\" valign=\"top\" width=\"95\" height=\"36\"><a href=\"http://cryptogamegeneration.io\" target=\"_blank\"><img src=\"http://arbitrage.hhos.ru/cgg/logo.png\" width=\"95\" style=\"display:block;\" border=\"0\" alt=\"CryptoGameGeneration\"></a>
                                                                </td>
                                                                <td align=\"right\" valign=\"middle\" style=\"font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:15px;color:#585858;\">
                                                                    CRYPTO GAME GENERATION
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"25\">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" style=\"border:1px solid #dddddd;\" bgcolor=\"#ffffff\">
                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                        <tbody>
                                                            <tr>
                                                                <td align=\"left\" valign=\"top\" width=\"49\">
                                                                </td>
                                                                <td align=\"left\" valign=\"top\" width=\"500\">
                                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" height=\"50\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:22px;line-height:28px;color:#333333;font-weight:bold;font-family:Arial, Helvetica, sans-serif;\">Hello {$user},</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"20\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">
                                                                                     we are proud to welcome you as a new member of <a href=\"http://cryptogamegeneration.io\" target=\"_blank\" style=\"text-decoration:none;color:#585858;\"><span style=\"text-decoration:none;color:#585858;\">cryptogamegeneration.io</span></a>.
                                                                                    <br><br>
                                                                                    Your are just one step away from investment in CGG Token.
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"25\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" height=\"50\">
                                                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align=\"left\" valign=\"top\" width=\"126\"></td>
                                                                                                <td align=\"center\" valign=\"middle\" height=\"50\" width=\"248\" bgcolor=\"#0082b2\" style=\"font-size:14px;line-height:19px;color:#ffffff;font-family:Arial, Helvetica, sans-serif;\"><a href=\"http://arbitrage.hhos.ru/cgg/sign.php\" target=\"_blank\" style=\"color:#ffffff;text-decoration:none;\"><span style=\"font-size:14px;line-height:19px;color:#ffffff;font-family:Arial, Helvetica, sans-serif;\">BUY CGG COIN</span></a></td>
                                                                                                <td align=\"left\" valign=\"top\" width=\"126\"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"30\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"30\" align=\"left\" valign=\"top\" style=\"border-top:1px solid #dddddd;\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">Thank you for choosing <a href=\"http://cryptogamegeneration.io\" target=\"_blank\" style=\"text-decoration:none;color:#585858;\" rel=\" noopener noreferrer\"><span style=\"text-decoration:none;color:#585858;\">cryptogamegeneration.io</span></a>. Enjoy the experience!<br><br>
                                                                                    <strong>Your CGG Team</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" height=\"50\"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </td>
                                                                <td align=\"left\" valign=\"top\" width=\"49\"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"40\"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align=\"center\" valign=\"top\" width=\"20\"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width=\"640\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                        <tbody>
                            <tr>
                                <td align=\"center\" valign=\"top\" width=\"20\"></td>
                                <td align=\"center\" valign=\"top\" width=\"600\">
                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                        <tbody>
                                            <tr>
                                                <td align=\"center\" valign=\"top\"><a href=\"http://cryptogamegeneration.io\" target=\"_blank\"><img src=\"http://arbitrage.hhos.ru/cgg/logo.png\" width=\"95\" border=\"0\" alt=\"Logo\"></a></td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">
                                                    Crypto Game Generation
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"20\"></td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" valign=\"top\">
                                                    <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                                                        <tbody>
                                                            <tr>
                                                                <td align=\"center\" valign=\"top\" width=\"60\"></td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://twitter.com/CryptoGameGeneration\" title=\"Twitter\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/twitter.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://t.me/CryptoGameGeneration\" title=\"Telegram\" style=\"color:blue\">
                                                                       <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/telegram.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://bitcointalk.org/index.php?topic=\" title=\"BitcoinTalk\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/btc.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://www.reddit.com/user/cryptogamegeneration\" title=\"Reddit\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/reddit.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://medium.com/@cryptogamegeneration.io\" title=\"Medium\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/medium.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"60\"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"30\"></td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" valign=\"top\" style=\"font-size:11px;line-height:16px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">
                                                    Copyright © 2018
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align=\"center\" valign=\"top\" width=\"20\"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>";
}

/*
 * Шаблон письма пользователю при восстановлении пароля
 */
function forget_message($user, $reset)
{
    return "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>CryptoGameGeneration</title>
    <link rel=\"stylesheet\" href=\"https://use.fontawesome.com/releases/v5.3.1/css/all.css\" integrity=\"sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU\" crossorigin=\"anonymous\">
</head>
<body>
    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
        <tbody>
            <tr>
                <td align=\"center\" valign=\"top\">
                    <table width=\"640\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                        <tbody>
                            <tr>
                                <td align=\"center\" valign=\"top\" width=\"600\">
                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                        <tbody>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"15\"></td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\">
                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                        <tbody>
                                                            <tr>
                                                                <td align=\"left\" valign=\"top\" width=\"95\" height=\"36\"><a href=\"http://cryptogamegeneration.io\" target=\"_blank\"><img src=\"http://arbitrage.hhos.ru/cgg/logo.png\" width=\"95\" style=\"display:block;\" border=\"0\" alt=\"CryptoGameGeneration\"></a>
                                                                </td>
                                                                <td align=\"right\" valign=\"middle\" style=\"font-family:Arial, Helvetica, sans-serif;font-size:12px;line-height:15px;color:#585858;\">
                                                                    CRYPTO GAME GENERATION
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"25\">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" style=\"border:1px solid #dddddd;\" bgcolor=\"#ffffff\">
                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                        <tbody>
                                                            <tr>
                                                                <td align=\"left\" valign=\"top\" width=\"49\">
                                                                </td>
                                                                <td align=\"left\" valign=\"top\" width=\"500\">
                                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" height=\"50\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:22px;line-height:28px;color:#333333;font-weight:bold;font-family:Arial, Helvetica, sans-serif;\">Hello {$user},</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"20\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">
                                                                                     we are proud to welcome you as a new member of <a href=\"http://cryptogamegeneration.io\" target=\"_blank\" style=\"text-decoration:none;color:#585858;\"><span style=\"text-decoration:none;color:#585858;\">cryptogamegeneration.io</span></a>.
                                                                                    <br><br>
                                                                                    Your are just one step away from investment in CGG Token.
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"25\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" height=\"50\">
                                                                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                                                                        <tbody>
                                                                                            <tr>
                                                                                                <td align=\"left\" valign=\"top\" width=\"126\"></td>
                                                                                                <td align=\"center\" valign=\"middle\" height=\"50\" width=\"248\" bgcolor=\"#0082b2\" style=\"font-size:14px;line-height:19px;color:#ffffff;font-family:Arial, Helvetica, sans-serif;\"><a href=\"http://arbitrage.hhos.ru/cgg/sign.php?forget={$reset}\" target=\"_blank\" style=\"color:#ffffff;text-decoration:none;\"><span style=\"font-size:14px;line-height:19px;color:#ffffff;font-family:Arial, Helvetica, sans-serif;\">RESET PASSWORD</span></a></td>
                                                                                                <td align=\"left\" valign=\"top\" width=\"126\"></td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"25\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">Or paste this link into your browser:<br>
                                                                                    <a href=\"http://arbitrage.hhos.ru/cgg/sign.php?forget={$reset}\" target=\"_blank\" style=\"text-decoration: none;color:#0082b2;\"><span style=\"color:#0082b2;\">http://arbitrage.hhos.ru/cgg/sign.php?forget={$reset}</span></a>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"30\" align=\"left\" valign=\"top\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height=\"30\" align=\"left\" valign=\"top\" style=\"border-top:1px solid #dddddd;\"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">Thank you for choosing <a href=\"http://cryptogamegeneration.io\" target=\"_blank\" style=\"text-decoration:none;color:#585858;\"><span style=\"text-decoration:none;color:#585858;\">cryptogamegeneration.io</span></a>. Enjoy the experience!<br><br>
                                                                                    <strong>Your CGG Team</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align=\"left\" valign=\"top\" height=\"50\"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>

                                                                </td>
                                                                <td align=\"left\" valign=\"top\" width=\"49\"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"40\"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align=\"center\" valign=\"top\" width=\"20\"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table width=\"640\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                        <tbody>
                            <tr>
                                <td align=\"center\" valign=\"top\" width=\"20\"></td>
                                <td align=\"center\" valign=\"top\" width=\"600\">
                                    <table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" border=\"0\">
                                        <tbody>
                                            <tr>
                                                <td align=\"center\" valign=\"top\"><a href=\"http://cryptogamegeneration.io\" target=\"_blank\"><img src=\"http://arbitrage.hhos.ru/cgg/logo.png\" width=\"95\" border=\"0\" alt=\"Logo\"></a></td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" valign=\"top\" style=\"font-size:14px;line-height:19px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">
                                                    Crypto Game Generation
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"20\"></td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" valign=\"top\">
                                                    <table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                                                        <tbody>
                                                            <tr>
                                                                <td align=\"center\" valign=\"top\" width=\"60\"></td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://twitter.com/CryptoGameGeneration\" title=\"Twitter\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/twitter.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://t.me/CryptoGameGeneration\" title=\"Telegram\" style=\"color:blue\">
                                                                       <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/telegram.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://bitcointalk.org/index.php?topic=\" title=\"BitcoinTalk\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/btc.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://www.reddit.com/user/cryptogamegeneration\" title=\"Reddit\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/reddit.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"30\">
                                                                    <a href=\"https://medium.com/@cryptogamegeneration.io\" title=\"Medium\" style=\"color:blue\">
                                                                        <img src=\"http://arbitrage.hhos.ru/cgg/sign/icons/medium.png\" height=\"20\">
                                                                    </a>
                                                                </td>
                                                                <td align=\"center\" valign=\"top\" width=\"60\"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td align=\"left\" valign=\"top\" height=\"30\"></td>
                                            </tr>
                                            <tr>
                                                <td align=\"center\" valign=\"top\" style=\"font-size:11px;line-height:16px;color:#585858;font-family:Arial, Helvetica, sans-serif;\">
                                                    Copyright © 2018
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td align=\"center\" valign=\"top\" width=\"20\"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>";
}

/*
 * Авторизация пользователя
 */
function enter()
{
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $error = array();
    if ($_POST['email'] != "" && $_POST['password'] != "") {
        $login = $_POST['email'];
        $password = $_POST['password'];
        $query = 'SELECT user, pass FROM users WHERE email="'.$login.'";';
        $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if (mysqli_num_rows($rez) == 1) {
            $row = mysqli_fetch_assoc($rez);
            if (md5($password) == $row['pass']) {
                ini_set("session.use_trans_sid", true);
                session_start();
                $_SESSION['user'] = $row['user'];
                $_SESSION['password'] = md5($row['user'] . $row['pass']);
                $link->close();
                return $error;
            } else {
                $error[] = "Неверный пароль";
                $link->close();
                return $error;
            }
        } else {
            $error[] = "Неверный логин и пароль";
            $link->close();
            return $error;
        }
    } else {
        $error[] = "Поля не должны быть пустыми!";
        return $error;
    }
}

/*
 * Завершение ссесии пользователя
 */
function out()
{
    unset($_COOKIE['user']);
    unset($_COOKIE['password']);
    unset($_SESSION['user']);
    unset($_SESSION['password']);
    header("Location: index.php");
}

/*
 * Регистрация нового пользователя
 */
function signup()
{
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    @file_put_contents("log.txt", 'New user ' . $_POST['email'] . "\n", FILE_APPEND);
    $api = new Bitcoin();
    $secret = strtoupper(md5($_POST['email']));
    $bitcoin = $api->GenAddress($secret);
    $track_id = $api->ReceivePayments($bitcoin['Address'], $_POST['email'], $secret);
    $query = "INSERT DELAYED INTO users (user, pass, email, token, address, reset, bitcoin_Address, bitcoin_PubKey, bitcoin_PrivateKey, bitcoin_WIFKey, ref) VALUES ('" . $_POST['name'] . "','" . md5($_POST['pass1']) . "','" . $_POST['email'] . "',0,'','" . md5($_POST['name'] . $_POST['pass1']) . "','" . $bitcoin['Address'] . "','" . $bitcoin['PubKey'] . "','" . $bitcoin['PrivateKey'] . "','" . $bitcoin['WIFKey'] . "',0)";
    $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if ($rez) {
        if ($_POST['ref_id'] !== '') {
            $query = 'SELECT id, ref, token FROM users WHERE RIGHT(MD5(email),8)="'.$_POST['ref_id'].'";';
            $result = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $query = "UPDATE users SET token = '" . ($row['token'] + 5) . "', ref = '" . ($row['ref'] + 1) . "' WHERE id='" . $row['id'] . "';";
                mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
            }
        }
        require_once "lib/SendMailSmtpClass.php";
        $mailSMTP = new SendMailSmtpClass(SMTP_USERNAME, SMTP_PASSWORD, SMTP_HOST, SMTP_PORT);
        $from = array(
            "Admin CGG",
            "admin@cryptogamegeneration.io"
        );
        $to = $_POST['email'];
        $subject = 'CryptoGameGeneration SignUp';
        $message = signup_message($_POST['name']);
        $result = $mailSMTP->send($to, $subject, $message, $from);
        if ($result === true) {
            $link->close();
            ini_set("session.use_trans_sid", true);
            session_start();
            $_SESSION['user'] = $_POST['name'];
            $_SESSION['password'] = md5($_POST['name'] . $_POST['pass1']);
            header("Location: dashboard.php");
        } else {
            $link->close();
            html(array('reset' => false));
        }
    } else {
        $link->close();
        html(array('signup' => false));
    }
}

/*
 * Отправка письма со ссылкой восстановления пароля
 */
function forget()
{
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    if ($_POST['email'] != "") {
        $login = $_POST['email'];
        $query = 'SELECT user, reset FROM users WHERE email="'.$login.'";';
        $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if (mysqli_num_rows($rez) == 1) {
            $row = mysqli_fetch_assoc($rez);
            require_once "lib/SendMailSmtpClass.php";
            $mailSMTP = new SendMailSmtpClass(SMTP_USERNAME, SMTP_PASSWORD, SMTP_HOST, SMTP_PORT);
            $from = array(
                "Admin CGG",
                "admin@cryptogamegeneration.io"
            );
            $to = $login;
            $subject = 'CryptoGameGeneration Password Change';
            $message = forget_message($row['user'], $row['reset']);
            $result = $mailSMTP->send($to, $subject, $message, $from);
            if ($result === true) {
                $link->close();
                html(array('reset' => true));
            } else {
                $link->close();
                html(array('reset' => false));
            }
        } else {
            $link->close();
            html(array('reset' => false));
        }
    } else {
        $link->close();
        html(array('reset' => false));
    }
}

/*
 * Проверка хэша восстановления пароля и отправка на генерацию формы восстановления пароля
 */
function forget_hash()
{
    if (preg_match('/^[a-f0-9]{32}$/i', $_GET['forget'])) {
        $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
        if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
        $query = 'SELECT email FROM users WHERE reset="' . $_GET['forget'] . '";';
        $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if (mysqli_num_rows($rez) == 1) {
            $row = mysqli_fetch_assoc($rez);
            $link->close();
            html(array('new' => true, 'hash' => $_GET['forget']));
        } else {
            $link->close();
            html(array('user_err' => true));
        }
    } else html(array('user_err' => true));
}

/*
 * Проверка реферальнной ссылки пользователя
 */
function referer()
{
    if (preg_match('/^[a-f0-9]{8}$/i', $_GET['ref'])) {
        $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
        if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
        $query = 'SELECT id FROM users WHERE RIGHT(MD5(email),8)="' . $_GET['ref'] . '";';
        $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if (mysqli_num_rows($rez) == 1) {
            $row = mysqli_fetch_assoc($rez);
            $link->close();
            html(array('ref' => true, 'ref_id' => $_GET['ref']));
        } else {
            $link->close();
            html(array('user_err' => true));
        }
    } else html(array('user_err' => true));
}

/*
 * Установка нового пароля для пользователя
 */
function set_new_pass()
{
    $link = new mysqli(HOST, USERNAME, PASSWD, DBNAME);
    if ($link->connect_error) die('Ошибка подключения (' . $link->connect_errno . ') ' . $link->connect_error);
    $login = $_POST['email'];
    $hash = $_POST['reset_hash'];
    $query = 'SELECT user FROM users WHERE email = "'.$login.'" and reset = "'.$hash.'";';
    $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
    if (mysqli_num_rows($rez) == 1) {
        $row = mysqli_fetch_assoc($rez);
        $query = "UPDATE users SET pass = '" . md5($_POST['password']) . "', reset = '" . md5($row['user'] . $_POST['password']) . "' WHERE email='" . $login . "';";
        $rez = mysqli_query($link, $query) or die('Запрос не удался: ' . mysqli_error($link));
        if ($rez) {
            $link->close();
            ini_set("session.use_trans_sid", true);
            session_start();
            $_SESSION['user'] = $row['user'];
            $_SESSION['password'] = md5($row['user'] . $_POST['password']);
            html(array('new_pass' => true));
        } else {
            $link->close();
            html(array('signup' => true));
        }
    } else {
        $link->close();
        html(array('reset' => false));
    }
}

/*
 * Вывод страницы на экран
 */
function html($err = array())
{
    $auth_err = show_error('Invalid Email address or Password');
    if (!$err['reset'])
        $reset = show_error('Invalid Email address');
    else
        $reset = show_error('On email send link to reset password !');
    $signup = show_error('Sorry. Service on maitenance. Try Later.');
    $new = show_error('Password change. Please Sign In.');

    echo '
    <!DOCTYPE html>
    <html lang="en">
        <head>
        <meta charset="utf-8" />
        <title>Phoneum Platform</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="static/sign/css/fonts.css" rel="stylesheet" type="text/css" />
        <link href="static/sign/css/vendors.bundle.css" rel="stylesheet" type="text/css" />
        <link href="static/sign/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <link href="static/sign/css/admin.css?v=0003" rel="stylesheet" type="text/css" />
        <link rel="shortcut icon" href="static/logo.png">
        <meta name="theme-color" content="#ffffff">
        </head>
        <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
            <style>
                .g-recaptcha {
                    text-align: center;
                }
                .g-recaptcha div {
                    width: 100% !important;
                }
                .m-login__title {
                    font-size: 14px !important;
                }
                .m-login.m-login--2 .m-login__wrapper {
                    padding-top: 5%;
                }
                .m-login.m-login--2 .m-login__wrapper .m-login__container .m-login__logo {
                    margin-bottom: 0.5rem;
                }
                h2 {
                    text-align: center;
                    margin-bottom: 3rem;
                    font-size: 20px;
                }
                .select2-container--default .select2-selection--multiple, .select2-container--default .select2-selection--single {
                    padding: 10px;
                border-radius: 40px;
                background-color: #f7f6f9;
                border: none;
                }
            </style>
            <div class="m-grid m-grid--hor m-grid--root m-page">
                <div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login  m-login--singin  m-login--2 m-login-2--skin-2';
    if (isset($err['ref'])) echo ' m-login--signup';
    if (isset($err['new'])) echo ' m-login--success';
    echo '" id="m_login" style="background: #e3dc5f;">
                    <div class="m-grid__item m-grid__item--fluid m-login__wrapper">
                        <div class="m-login__container ">
                            <div class="m-login__logo">
                                <a href="index.php">
                                    <img src="static/logo.png" width=50px> CryptoGameGeneration
                                </a>
                            </div>
                            <div class="m-login__signin">
                                <h2>Sign In</h2>
                                <div class="m-login__head m--margin-top-50">
                                    <h3 class="m-login__title">
                                        Login
                                    </h3>
                                </div>
                                <form class="m-login__form m-form  m--margin-top-0" method="post" action="sign.php">
                                ';
    echo $err['user_err'] ? $auth_err : '';
    echo $err['signup'] ? $signup : '';
    echo isset($err['reset']) ? $reset : '';
    echo $err['new_pass'] ? $new : '';
    echo '
                                    <input type="hidden" name="signin" value="1">
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="email" autocomplete="off" name="email" value="" placeHolder="Email Address" required autofocus>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input m-login__form-input--last" type="password" name="password" placeholder="Password" data-parsley-minlength="6" required>
                                    </div>
                                    <div class="row m-login__form-sub">
                                        <div class="col m--align-right m-login__form-right">
                                            <a href="javascript:;" id="m_login_forget_password" class="m-link">
                                                Forgot your password?
                                            </a>
                                        </div>
                                    </div>
                                    <div class="m-login__form-action">
                                        <button type="button" id="m_login_signin_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary nLoggedPrimary triggerEvent" data-type="8">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="m-login__signup">
                                <div class="m-login__head">
                                    <h2>Sign Up</h2>
                                    <div class="m-login__desc">
                                        Enter your details to create your account:
                                    </div>
                                </div>
                                <form class="m-login__form m-form m--margin-top-0 m-register-form" method="post" action="sign.php">
                                    <input type="hidden" name="signup" value="1">
                                    <input type="hidden" id="signup_error" value="0">
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="text" id="signup_name" name="name" value="" placeHolder="User Name" required autofocus>
                                        <div id="signup_name_error" style="color:#f4516c;font-weight:400;font-size:.85rem;padding-left:1.6rem;display: none"></div>
                                    </div>          
                                    <div class="clearfix">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="email" id="signup_email" autocomplete="off" name="email" value="" placeHolder="Email Address" required>
                                        <div id="signup_email_error"style="color:#f4516c;font-weight:400;font-size:.85rem;padding-left:1.6rem;display: none"></div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="password" name="pass1" id="password" placeHolder="Password" title="Please enter password with minimum 8 and max 72 characters length. Must contain lower and upper characters, digits and special character (one of these: #?!@$%^&amp;*- )" required pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[_#?!@$%^&*=+-]).{8,}$" minlength="8">
                                        <div class="col-12">
                                            <div class="progress password-progress" style="margin-top: 10px">
                                                <div class="progress-bar m--bg-danger hidden fbar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                                <div class="progress-bar m--bg-warning hidden sbar" role="progressbar" style="width: 33%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                                <div class="progress-bar m--bg-success hidden tbar" role="progressbar" style="width: 34%;" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="password" name="pass2" data-rule-equalTo="#password" placeHolder="Retype your new password" title="Your password confirmation does not match" required minlength="8">
                                    </div>
                                    <div class="form-group m-form__group">
                                        <input class="form-control m-input" type="text" name="ref_id" placeHolder="';
    echo isset($err['ref_id']) ? '" value="' . $err['ref_id'] . '"' : 'Referal (Option)';
    echo '" minlength="8" maxlength="8">
                                    </div>
                                <div class="m-login__form-action">
                                    <button type="button" id="m_login_signup_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn nLoggedPrimary triggerEvent" data-type="5">
                                        Contribute Now
                                    </button>
                                    &nbsp;&nbsp;
                                    <button type="button" id="m_login_signup_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom  m-login__btn nLoggedSecondary">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__forget-password">
                            <div class="m-login__head">
                                <h2>Reset Password</h2>
                                <h3 class="m-login__title">Reset your password</h3>
                            </div>
                            <form class="m-login__form m-form" method="post" action="sign.php">
                                <input type="hidden" name="forget" value="1">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="email" placeholder="Email Address" name="email" value="" required autocomplete="off" autofocus>
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_forget_password_submit" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary nLoggedPrimary triggerEvent" data-type="6">
                                        Send reset link
                                    </button>
                                    &nbsp;&nbsp;
                                    <button type="button" id="m_login_forget_password_cancel" class="btn btn-outline-focus m-btn m-btn--pill m-btn--custom m-login__btn nLoggedSecondary">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__success" ';
    if (isset($err['new'])) echo ''; else echo 'style = "display: none;"';
    echo '>
                            <div class="m-login__head">
                                <h2>Phoneum password</h2>
                                <h3 class="m-login__title">
                                    Set new password
                                </h3>
                            </div>
                            <form class="m-login__form m-form" method="post" action="sign.php">';
    if (isset($err['hash'])) echo '<input type="hidden" name="reset_hash" value="' . $err['hash'] . '">';
    echo '
                                <input type="hidden" name="new_pass" value="1">
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="email" name="email" value="" placeholder="Email Address" required="" autofocus="" autocomplete="off">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="password" name="password" placeholder="Your new password" required="" minlength="8">
                                </div>
                                <div class="form-group m-form__group">
                                    <input class="form-control m-input" type="password" name="password_confirmation" placeholder="Retype your new password" required="" minlength="8">
                                </div>
                                <div class="m-login__form-action">
                                    <button id="m_login_forget_password_submit2" class="btn btn-focus m-btn m-btn--pill m-btn--custom m-btn--air  m-login__btn m-login__btn--primary nLoggedPrimary">
                                        Save new password
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="m-login__account">
                            <span class="m-login__account-msg">
                                Not a member yet?
                            </span>
                            &nbsp;&nbsp;
                            <a href="javascript:;" id="m_login_signup" class="m-link m-link--light m-login__account-link">
                                Create an Account
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="static/sign/js/vendors.bundle.js" type="text/javascript"></script>
        <script src="static/sign/js/scripts.bundle.js" type="text/javascript"></script>
        <script src="static/sign/js/login.js" type="text/javascript"></script>
    </body>
    </html>
    ';
}