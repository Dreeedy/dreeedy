<?php
session_start();
if ($_SESSION['auth'] == false)
{
    //если пользователь не авторизован
    header('location: login.php');
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--LINKS-->
    <?php require "blocks/links.php" ?>
    <!--Конец LINKS-->

    <title>ЗАГС ИК МО "ЛМР" РТ</title>
</head>
<body>
<!--HEADER-->
<?php require "blocks/header.php" ?>
<!--Конец HEADER-->

<!--MAIN-->
<main>
    <?php require "blocks/main_staff.php" ?>
</main>

<!--Конец MAIN-->

<!--FOOTER-->
<?php require "blocks/footer.php" ?>
<!--Конец FOOTER-->
</body>
</html>
