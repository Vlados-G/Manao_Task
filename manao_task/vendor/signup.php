<?php

// разрешаем доступ к этой странице только с помощью ajax
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    // подключаем нужные классы
    require_once('../classes/registration.php');
    require_once('../classes/CRUDJSON.php');

    // через ajax приходят эти данные
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];
    $name = $_POST['full_name'];
    $registerFormData = $_POST;


    //проверка введенных данных
    /* сначала проверяем данные на корректность,
    ** потом проверяем есть ли такие данные в базе,
    ** иначе зачем тревожить базу если данные не соответсвуют требованиям для ввода в форму 
    */

    // создаем объект для регистрации пользователя
    $registration = new Registration($login, $password, $password_confirm, $email, $name);
    $registration->informationChecking($login, $password, $email, $password_confirm, $name);
    $registration->regCheckLoginInfo($registerFormData);
    $registration->regCheckEmailInfo($registerFormData);
    // создаем объект crud-класса для работы с базой данных
    $crudjson = new CRUDJSON;

    // если ошибки есть отправляем их обратно
    if (!empty($registration->errors)) {
        $registration->getErrors();
    } else {
        // если ошибок нет - записываем данные в базу, устанавливаем cookie  и возвращаем пустой массив
        $crudjson->createNewEntry($registerFormData);
        setcookie('login', $registerFormData['login'], time() + 3600 * 24, '/');
        $registration->getErrors();
    }
}
