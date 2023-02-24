<?php

class Registration
{
    protected $login;
    protected $password;
    protected $password_confirm;
    protected $email;
    protected $name;
    public $errors = [];

    public function __construct($login, $password, $password_confirm, $email, $name)
    {
        $this->login = $login;
        $this->password = $password;
        $this->password_confirm = $password_confirm;
        $this->email = $email;
        $this->name = $name;
    }

    // проверка данных
    public function informationChecking($login, $password, $email, $password_confirm, $name)
    {
        // проверка правильности введеного логина
        if (strlen($login) < 6) {
            $this->errors['loginError'] = 'слишком короткий логин';
        }

        // проверка правильности введеного пароля
        if (
            strlen($password) < 6 ||
            preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[a-zA-Z\d]+$/", $password) == 0
        ) {
            $this->errors['passwordError'] = 'это неподходящий пароль';
        }

        // проверка правильности введеного повторно пароля
        if (
            $password !== $password_confirm
        ) {
            $this->errors['passwordConfirmError'] = 'пароли не совпадают';
        }

        if (
            strpos($email, '.') == false
        ) {
            $this->errors['emailError'] = 'некорректный email';
        }
        // проверка правильности введеного имени

        if (
            strlen($name) < 2
        ) {
            $this->errors['fullNameLengthError'] = 'слишком короткое имя';
        }
        if (
            !ctype_alpha($name)
        ) {
            $this->errors['fullNameStructureError'] = 'в имени должны быть только буквы';
        }
        if (
            strpos($login, ' ') !== false ||
            strpos($password, ' ') !== false ||
            strpos($password_confirm, ' ') !== false ||
            strpos($email, ' ') !== false ||
            strpos($name, ' ') !== false
        ) {
            $this->errors['spaceError'] = 'в полях формы не должно быть пробелов';
        }
    }

    // метод для проверки уникален ли логин
    public function regCheckLoginInfo($registerFormData)
    {
        if (file_exists('database.json')) {
            $json = file_get_contents('database.json');
            $jsonArray = json_decode($json, true);

            if (isset($registerFormData['login'])) {
                foreach ($jsonArray as $key => $value) {

                    if (($value['login'] == $registerFormData['login'])) {
                        $this->errors['uniqLogin'] = false;
                    }
                }
            }
        }
    }

    // метод для проверки уникален ли email
    public function regCheckEmailInfo($registerFormData)
    {
        if (file_exists('database.json')) {
            $json = file_get_contents('database.json');
            $jsonArray = json_decode($json, true);

            if (isset($registerFormData['email'])) {
                foreach ($jsonArray as $key => $value) {

                    if (($value['email'] == $registerFormData['email'])) {
                        $this->errors['uniqEmail'] = false;
                    }
                }
            }
        }
    }


    public function getErrors()
    {
        $this->errors = json_encode($this->errors, JSON_UNESCAPED_UNICODE);
        print_r($this->errors);
    }

    public function noErrors()
    {
        $this->errors = json_encode($this->errors, JSON_UNESCAPED_UNICODE);
        print_r($this->errors);
    }
}
