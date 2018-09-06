<?php
session_start();


function getUsers()
{
    $usersData = file_get_contents(__DIR__.'/users.json');
    $user = json_decode($usersData, true);

    return $user;
}

function getUser($login)
{
    $users = getUsers();

    foreach ($users as $user) {
        if ($user['login'] == $login) {
            return $user;
        }
    }

    return null;
}

function login($login, $password)
{
    $user = getUser($login);

    if ($user && $user['password'] == $password) {
        $_SESSION['user'] = $_POST['login'];
        $_SESSION['name'] = $user['name'];
        return true;
    }

    return false;
}
