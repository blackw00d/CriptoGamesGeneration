<?

require_once 'settings.php';
require_once 'sign/services.php';

/*
 * Вход пользователя
 */
if ($_POST['signin'] == 1) {
    $error = enter();
    if (count($error) == 0) {
        header("Location: dashboard.php");
    } else {
        html(array('user_err' => true));
    }
}
/*
 * Регистрация
 */
else if ($_POST['signup'] == 1) {
    signup();
}
/*
 * Проверка хэша восстановления пароля и отправка на генерацию формы восстановления пароля
 */
else if ($_POST['forget'] == 1) {
    forget();
}
/*
 * Проверка хэша восстановления пароля и
 */
else if (isset($_GET['forget'])) {
    forget_hash();
}
/*
 * Проверка реферальнной ссылки пользователя
 */
else if (isset($_GET['ref'])) {
    referer();
}
/*
 * Форма восстановления пароля
 */
else if ($_POST['new_pass'] == 1) {
    set_new_pass();
}
/*
 * Отображение формы авторизации
 */
else {
    html();
}