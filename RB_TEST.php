<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--LINKS-->
    <?php require "blocks/links.php"?>
    <!--Конец LINKS-->

    <title>ЗАГС ИК МО "ЛМР" РТ</title>
</head>
<body>
<!--HEADER-->
<?php require "blocks/header.php"?>
<!--Конец HEADER-->

<!--MAIN-->
<div class="container" style="min-height: 850px; background-color: red">
<main>
<?php
    //Создает подключения к БД
    R::setup('mysql:host=localhost;dbname=tania_valerova', 'root', 'root');

    //Проверка работы подключения к БД
    if (!R::testConnection())
    {
        exit('Нет подключения к базе данных');
    }

    //Создаю таблицу roles
/*    $role = R::dispense( 'roles' );
    $role->roleName = 'Клиент';
    $role->code = 1;
    R::store($role);

    $role = R::dispense( 'roles' );
    $role->roleName = 'Сотрудник';
    $role->code = 2;
    R::store($role);

    $role = R::dispense( 'roles' );
    $role->roleName = 'admin';
    $role->code = 3;
    R::store($role);*/


    //Создаю таблицу users

    //

    //print_r($role);
/*    $user = R::dispense('users');
    $user->userName = 'Max';
    R::store($user);*/

/*    $role_ID = R::findOne('roles', 'role_name = ?',  ['employee']);
    $role = R::load('roles', $role_ID->id);

    print_r($role);

    $user = R::dispense('users');
    $user->userName = 'Max444';

    $role->ownUsersList[] = $user;
    R::store($role);

    print_r($role);*/
?>
</main>
</div>
<!--Конец MAIN-->

<!--FOOTER-->
<?php require "blocks/footer.php"?>
<!--Конец FOOTER-->
</body>
</html>