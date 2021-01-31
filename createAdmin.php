<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--LINKS-->
    <?php require_once("blocks/links.php") ?>
    <!--Конец LINKS-->

    <title>ЗАГС ИК МО "ЛМР" РТ</title>
</head>
<body>
<!--HEADER-->
<?php require_once("blocks/header.php") ?>
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

        $role_ID = R::findOne('roles', 'role_name = ?',  ['admin']);
        $role = R::load('roles', $role_ID->id);

        $staf = R::dispense('staff');
        $staf->surname = 'Иванов';
        $staf->name = 'Иван';
        $staf->middleName = 'Иванович';
        $staf->phoneNumber = '+79172444941';
        $staf->password = 'admin';

        $role->ownStaffList[] = $staf;
        R::store($role);
        ?>
    </main>
</div>
<!--Конец MAIN-->

<!--FOOTER-->
<?php require_once("blocks/footer.php") ?>
<!--Конец FOOTER-->
</body>
</html>