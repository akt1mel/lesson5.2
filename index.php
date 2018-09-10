<?php

session_start();
require_once ('data/functions.php');

if($_SESSION['user']) {
  header("Location: list.php");
}


if(!empty($_POST)){
    $errors = [];

    if ($_POST['enter']) {
        if (login($_POST['login'], $_POST['password'])) {
            header("Location: list.php");
            die;
        } else {
            $errors[] = "Неверный логин или пароль";
        }
    }

    if ($_POST['guest']) {
        $_SESSION['user'] = "guest";
        $_SESSION['name'] = $_POST['login'];
        header("Location: list.php");
        die;
    }
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach ($errors as $error):?>
        <li><?= $error ?></li>
        <?php endforeach;?>
    </ul>
    <form method="POST">
        <label for="login">логин</label>
        <input type="text" name="login" id="login">
        <label for="login">пароль</label>
        <input type="password" name="password" id="password">

        <input type="submit" name="enter" value="вход">
    </form>
    <br>
    <form method="POST">
        <p>Войти как гость</p>
        <label for="login">Введите ваше имя</label>
        <input type="text" name="login" id="login">
        <input type="submit" name="guest" value="вход как гость">
    </form>
</body>
</html>
