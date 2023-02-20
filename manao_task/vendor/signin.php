<?php

// разрешаем доступ к этой странице только с помощью ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    // подключаем нужные классы
    require_once '../classes/registration.php';
    require_once '../classes/authorization.php';
    require_once '../classes/CRUDJSON.php';

    // через ajax приходят эти данные
    $login = $_POST['auth-login'];
    // не храним пароль в открытом виде
    $_POST['auth-password'] = md5($_POST['auth-password']);
    $password = $_POST['auth-password'];
    $registerFormData = $_POST;


    //проверка введенных данных
    /* сначала проверяем данные на корректность,
    ** потом проверяем есть ли такие данные в базе,
    ** иначе зачем тревожить базу если данные не соответсвуют требованиям для ввода в форму 
    */

    $authorization = new Authorization($login, $password);
    $authorization->authInformationChecking($login, $password);
    //если ошибки есть отправляем их обратно
    if (!empty($authorization->errors)) {
        $authorization->getErrors();
    } else {
        // если ошибок нет проверям есть ли такой пользоватль в базе данных
        $crudjson = new CRUDJSON;
        $crudjson->authCheckInfo($registerFormData);
    }
}
