<?php
session_start();

require "rb/rb-mysql.php";

log_in($_POST);

function log_in($request)
{
    //заполнение сесии полями
    fillSession($request);

    //валидация данных с формы
    $_SESSION['ERRORS'] = login_validate($request);

    if (empty($_SESSION['ERRORS']))
    {
        $_SESSION['ERRORS'] = find_user();
    }
    //var_dump($_SESSION['ERRORS']);
    if (empty($_SESSION['ERRORS']))
    {
        //если все поля правильно заполнены и в базе есть такой чел и правильный пароль
        $_SESSION['auth'] = true;

        if ($_SESSION['code'] == 3)
        {
            //если admin
            $_SESSION['backPage'] = 'location: login.php';
            header('location: admin.php');
        }
        else
        {
            //если не админ
            $_SESSION['backPage'] = 'location: login.php';
            header('location: index.php');
        }
    }
    else
    {
        header('location: login.php');
    }

}

function fillSession($request)
{
    $_SESSION['code'] = $request['code'];
    $_SESSION['inputSurname'] = $request['inputSurname'];
    $_SESSION['inputName'] = $request['inputName'];
    $_SESSION['inputMiddleName'] = $request['inputMiddleName'];
    $_SESSION['inputPassword'] = $request['inputPassword'];
    $_SESSION['auth'] = false;
    $_SESSION['ERRORS'] = [];
    $_SESSION['backPage'] = [];
}

function login_validate($request)
{
    $ERRORS = [];

    $code = $request['code'];
    if ($code == 0) {
        array_push($ERRORS, "Необходимо выбрать роль пользователя");
    }

    $surname = $request['inputSurname'];
    if (!preg_match('/[а-яёА-ЯЁ]+/u',$surname))
    {
        //если не проходит проверку
        array_push($ERRORS, "Фамилия может содержать только кириллицу");
    }

    /*    //проверка на пробелы - пока забил
        if (!preg_match('" "', $surname))
        {
            //если не проходит проверку
            array_push($ERRORS, "Фамилия не должна содержать пробелов");
        }*/

    $name = $request['inputName'];
    if (!preg_match('/[а-яёА-ЯЁ]+/u',$name))
    {
        //если не проходит проверку
        array_push($ERRORS, "Имя может содержать только кириллицу");
    }

    $middle_name = $request['inputMiddleName'];
    if (!preg_match('/[а-яёА-ЯЁ]+/u',$middle_name))
    {
        //если не проходит проверку
        array_push($ERRORS, "Отчество может содержать только кириллицу");
    }

    $phone_number = $request['phone_number'];
    $password = $request['inputPassword'];
    /*    if (strlen($password) == 0)
        {
            array_push($ERRORS, "Введите пароль");
        }*/

    return $ERRORS;
}

function find_user()
{
    //работает с сессией тк в ней уже есть данные с формы
    $ERRORS = [];

    //Создает подключения к БД
    R::setup('mysql:host=localhost;dbname=tania_valerova', 'root', 'root');

    //Проверка работы подключения к БД
    if (!R::testConnection())
    {
        exit('Нет подключения к базе данных');
    }

    //Поиск нужного пользователя
    $staf_id = R::findOne('staff',
        'roles_id = ? AND
             surname = ? AND
             name = ? AND
             middle_name = ?', [$_SESSION['code'], $_SESSION['inputSurname'], $_SESSION['inputName'], $_SESSION['inputMiddleName']]);

    if ($staf_id != NULL)
    {
        //если есть такой пользователь, проверяем пароль
        if ($staf_id->password == $_SESSION['inputPassword'])
        {
            //если пароли совпадают
            //header('location: index.php');
        }
        else
        {
            //если пароли не совпадают
            array_push($ERRORS, "Неверный пароль");
            //header('location: login.php');
        }
    }
    else
    {
        //если такой пользователь не найден
        array_push($ERRORS, "Пользователь не найден");
        //header('location: login.php');
    }
    return $ERRORS;
}