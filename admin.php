<?php
session_start();
if ($_SESSION['code'] != 3)
{
    //если пытается войти не адми
    header('location: index.php');
}
?>
<!doctype html>
<html lang="ru" class="html-18px">
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
<main>
    <?
    require "blocks/main_admin.php";
    ?>
</main>

<!--Конец MAIN-->

<!--FOOTER-->
<?php require_once("blocks/footer.php") ?>
<!--Конец FOOTER-->
</body>
</html>