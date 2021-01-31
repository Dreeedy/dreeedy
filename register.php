<?php
session_start();
if ($_SESSION['code'] != 3)
{
    //если пытается войти не адми
    header('location: index.php');
}
?>
<!doctype html>
<html lang="ru" class="html-100 html-18px">
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

    <form action="registerController.php" method="post">

        <img class="mb-4" src="icons/favicon.svg" alt="" width="72" height="57">

        <h1 class="h3 mb-3 fw-normal">Регистрация персонала</h1>

        <select name="code" class="form-select form-select-lg mb-3" aria-label=".form-select-sm example">
            <?php
            //выбор роли
            if ($_SESSION['REGISTER']['code'] == 0) {
                echo '<option selected value="0">Выберите роль сотрудника</option>';
                echo '<option value="2">Сотрудник</option>';
                echo '<option value="3">Администратор</option>';
            } elseif ($_SESSION['REGISTER']['code'] == 2) {
                echo '<option value="0">Выберите роль сотрудника</option>';
                echo '<option selected value="2">Сотрудник</option>';
                echo '<option value="3">Администратор</option>';
            } elseif ($_SESSION['REGISTER']['code'] == 3) {
                echo '<option value="0">Выберите роль сотрудника</option>';
                echo '<option value="2">Сотрудник</option>';
                echo '<option selected value="3">Администратор</option>';
            }

            $_SESSION['REGISTER']['inputSurname'] = '';
            $_SESSION['REGISTER']['inputName'] = '';
            $_SESSION['REGISTER']['inputMiddleName'] = '';
            $_SESSION['REGISTER']['inputPhoneNumber'] = '';
            $_SESSION['REGISTER']['inputPassword'] = '';
            $_SESSION['REGISTER']['inputDoublePassword'] = '';
            ?>
        </select>

        <label for="inputSurname" class="visually-hidden">Фамилия</label>
        <input type="text" id="inputSurname" name="inputSurname" class="form-control" placeholder="Фамилия"
               value="<?php echo $_SESSION['REGISTER']['inputSurname'] ?>" minlength="2" maxlength="33" required="" autofocus="">

        <label for="inputName" class="visually-hidden">Имя</label>
        <input type="text" id="inputName" name="inputName" class="form-control" placeholder="Имя"
               value="<?php echo $_SESSION['REGISTER']['inputName'] ?>" minlength="2" maxlength="33" required="">

        <label for="inputMiddleName" class="visually-hidden">Отчество</label>
        <input type="text" id="inputMiddleName" name="inputMiddleName" class="form-control" placeholder="Отчество"
               value="<?php echo $_SESSION['REGISTER']['inputMiddleName'] ?>" minlength="2" maxlength="33" required="">

        <label for="inputPhoneNumber" class="visually-hidden">Номер телефона</label>
        <input type="text" id="inputPhoneNumber" name="inputPhoneNumber" class="form-control" placeholder="+7 495 123-45-67"
               value="<?php echo $_SESSION['REGISTER']['inputPhoneNumber'] ?>" minlength="10" maxlength="15" required="">

        <label for="inputPassword" class="visually-hidden">Пароль</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control mb-0" placeholder="Пароль"
               minlength="4" maxlength="16" required="">

        <label for="inputDoublePassword" class="visually-hidden">Повторите пароль</label>
        <input type="password" id="inputDoublePassword" name="inputDoublePassword" class="form-control mb-1" placeholder="Повторите пароль"
               minlength="4" maxlength="16" required="">

        <?php
        //вывод ошибок
        if ($_SESSION['REGISTER']['reg'] == false & !empty($_SESSION['REGISTER']['ERRORS']))
        {
            foreach ( $_SESSION['REGISTER']['ERRORS'] as $error)
            {
                echo '<div class="alert alert-danger mb-1 p-1" role="alert">' . $error . '</div>';
            }
        }

        //вывод успешный действий
        if ($_SESSION['REGISTER']['reg'] == true & !empty($_SESSION['REGISTER']['SUCCESS']))
        {
            {
                foreach ( $_SESSION['REGISTER']['SUCCESS'] as $success)
                {
                    echo '<div class="alert alert alert-success mb-1 p-1" role="alert">' . $success . '</div>';
                }
            }

            $_SESSION['REGISTER']['reg'] = false;
        }
        ?>
        <button class="w-100 btn btn-lg btn-primary mb-1" type="submit">Зарегистрировать</button>
    </form>

        <a href="admin.php">
            <button class="w-100 btn btn-lg btn-primary">Назад</button>
        </a>

        <p class="mt-3 mb-3 text-muted">© 2017-2021</p>

</main>
<!--Конец MAIN-->
</body>
</html>