<?php
session_start();

require "rb/rb-mysql.php";

//Создает подключения к БД
R::setup('mysql:host=localhost;dbname=tania_valerova', 'root', 'root');

//Проверка работы подключения к БД
if (!R::testConnection())
{
    exit('Нет подключения к базе данных');
}

reg_in($_POST);

function reg_in($request)
{
    //заполнение сесии полями
    fillSession($request);

    //валидация данных с формы
    $_SESSION['REGISTER']['ERRORS'] = reg_validate($request);

    if (empty($_SESSION['REGISTER']['ERRORS']))
    {
        $_SESSION['REGISTER']['ERRORS'] = find_user();
    }

    if (empty($_SESSION['REGISTER']['ERRORS']))
    {
        reg_user();
        if ($_SESSION['REGISTER']['reg'] == true)
        {
            header('location: register.php');
        }
    }
}

function fillSession($request)
{
    $_SESSION['REGISTER']['code'] = $request['code'];
    $_SESSION['REGISTER']['inputSurname'] = $request['inputSurname'];
    $_SESSION['REGISTER']['inputName'] = $request['inputName'];
    $_SESSION['REGISTER']['inputMiddleName'] = $request['inputMiddleName'];
    $_SESSION['REGISTER']['inputPhoneNumber'] = $request['inputPhoneNumber'];
    $_SESSION['REGISTER']['inputPassword'] = $request['inputPassword'];
    $_SESSION['REGISTER']['inputDoublePassword'] = $request['inputDoublePassword'];
    $_SESSION['REGISTER']['role_name'] = '';
    $_SESSION['REGISTER']['reg'] = false;
    $_SESSION['REGISTER']['ERRORS'] = [];
    $_SESSION['REGISTER']['SUCCESS'] = [];
}

function reg_validate($request)
{
    $ERRORS = [];

    $code = $request['code'];
    if ($code == 0) {
        array_push($ERRORS, "Необходимо выбрать роль пользователя");
    }

    $surname = $request['inputSurname'];
    if (preg_match('/[^,\p{Cyrillic}]/ui',$surname))
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
    if (preg_match('/[^,\p{Cyrillic}]/ui',$name))
    {
        //если не проходит проверку
        array_push($ERRORS, "Имя может содержать только кириллицу");
    }

    $middle_name = $request['inputMiddleName'];
    if (preg_match('/[^,\p{Cyrillic}]/ui',$middle_name))
    {
        //если содержит не только кириллицу
        array_push($ERRORS, "Отчество может содержать только кириллицу");
        //переделать так, чтобы в строке были только кириллица
    }

    $phone_number = $request['inputPhoneNumber'];
    //если в строке не цифра
    if (preg_match('/[\D]+/u',$phone_number))
    {
        //если не проходит проверку
        array_push($ERRORS, "Номер телефона должен состоять только из цифр");
    }

    $password = $request['inputPassword'];
    $doublePassword = $request['inputDoublePassword'];
    //если пароли не совпадают
    if ($password != $doublePassword)
    {
        //если не проходит проверку
        array_push($ERRORS, "Пароли не совпадают");
    }

    return $ERRORS;
}

//если ненаходит пользователя то возвращается ошибку, а если находит то пустой массив
function find_user()
{
    //работает с сессией тк в ней уже есть данные с формы
    $ERRORS = [];

    //Поиск нужного пользователя
    $staf_id = R::findOne('staff',
        'roles_id = ? AND
             surname = ? AND
             name = ? AND
             middle_name = ?', [$_SESSION['REGISTER']['code'], $_SESSION['REGISTER']['inputSurname'], $_SESSION['REGISTER']['inputName'], $_SESSION['REGISTER']['inputMiddleName']]);

    if ($staf_id != NULL)
    {
        //если есть такой пользователь, говорим что такой уже есть
        array_push($ERRORS, "Такой пользователь уже есть");
    }
    else
    {
        //если такой пользователь не найден, то можно его регистрировать
        $_SESSION['REGISTER']['role_name'] = R::load('roles', $_SESSION['REGISTER']['code'])->role_name;
        array_push($_SESSION['REGISTER']['SUCCESS'], $_SESSION['REGISTER']['inputSurname'].' '.$_SESSION['REGISTER']['inputName'].' '.$_SESSION['REGISTER']['inputMiddleName'].' '."успешно зарегистрирован как".' '.$_SESSION['REGISTER']['role_name']);
        //ниже функция регистрации
    }
    return $ERRORS;
}

function reg_user()
{
    $code = $_SESSION['REGISTER']['code'];
    $role_ID = R::findOne('roles', 'code = ?',  [$code]);

    $role = R::load('roles', $role_ID->id);

    $staf = R::dispense('staff');
    $staf->surname = $_SESSION['REGISTER']['inputSurname'];
    $staf->name = $_SESSION['REGISTER']['inputName'];
    $staf->middleName = $_SESSION['REGISTER']['inputMiddleName'];
    $staf->phoneNumber = $_SESSION['REGISTER']['inputPhoneNumber'];
    $staf->password = $_SESSION['REGISTER']['inputPassword'];

    $role->ownStaffList[] = $staf;
    R::store($role);

    $_SESSION['REGISTER']['reg'] = true;
}

function myDump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}