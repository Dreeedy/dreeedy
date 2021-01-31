<?php
session_start();
if ($_SESSION['auth'] == true)
{
    //если пользователь авторизован
    header('location: index.php');
}
?>
<!doctype html>
<html lang="ru" class="html-100">
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
<body class="text-center body-signin body-100">
<!--MAIN-->
<main class="form-signin">

    <form action="loginController.php" method="post">

        <img class="mb-4" src="icons/favicon.svg" alt="" width="72" height="57">

        <h1 class="h3 mb-3 fw-normal">Пожалуйста авторизуйтесь</h1>

        <select name="code" class="form-select form-select-lg mb-3" aria-label=".form-select-sm example">
            <?php
            //выбор роли
            if ($_SESSION['code'] == 0) {
                echo '<option selected value="0">Выберите вашу роль</option>';
                echo '<option value="2">Сотрудник</option>';
                echo '<option value="3">Администратор</option>';
            } elseif ($_SESSION['code'] == 2) {
                echo '<option value="0">Выберите вашу роль</option>';
                echo '<option selected value="2">Сотрудник</option>';
                echo '<option value="3">Администратор</option>';
            } elseif ($_SESSION['code'] == 3) {
                echo '<option value="0">Выберите вашу роль</option>';
                echo '<option value="2">Сотрудник</option>';
                echo '<option selected value="3">Администратор</option>';
            }
            ?>
        </select>

        <label for="inputSurname" class="visually-hidden">Фамилия</label>
        <input type="text" id="inputSurname" name="inputSurname" class="form-control" placeholder="Фамилия"
               value="<?php echo $_SESSION['inputSurname'] ?>" minlength="2" maxlength="33" required="" autofocus="">

        <label for="inputName" class="visually-hidden">Имя</label>
        <input type="text" id="inputName" name="inputName" class="form-control" placeholder="Имя"
               value="<?php echo $_SESSION['inputName'] ?>" minlength="2" maxlength="33" required="">

        <label for="inputMiddleName" class="visually-hidden">Отчество</label>
        <input type="text" id="inputMiddleName" name="inputMiddleName" class="form-control" placeholder="Отчество"
               value="<?php echo $_SESSION['inputMiddleName'] ?>" minlength="2" maxlength="33" required="">

        <label for="inputPassword" class="visually-hidden">Пароль</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Пароль"
               minlength="4" maxlength="250" required="">

        <?php
        if ($_SESSION['auth'] == false & !empty($_SESSION['ERRORS']))
        {
            foreach ( $_SESSION['ERRORS'] as $error)
            {
                echo '<div class="alert alert-danger mb-1 p-1" role="alert">' . $error . '</div>';
            }
        }
        ?>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>

        <p class="mt-5 mb-3 text-muted">© 2017-2021</p>
    </form>
</main>
<!--Конец MAIN-->
</body>
</html>