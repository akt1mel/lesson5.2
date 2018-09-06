<?php
session_start();
$testFiles = glob("tests/*.json");

if (!$_SESSION['user']) {
    echo "доступ запрещен";
    header('HTTP/1.0 403 Forbidden');
    exit;
}

if ($_GET['del']) {
    unlink("tests/".$_GET['del']);
}

?>


<!DOCTYPE html>
<html lang="ru" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Список тестов</title>
</head>
<body>
<h1>Список тестов</h1>

<?php
foreach ($testFiles as $test){
    $testName = str_replace("tests/", "", $test);
    echo $testName;
    echo " <a href='test.php?test=".$testName."'>Перейти к данному тесту </a>";
    if ($_SESSION['user'] != 'guest') {
        echo " <a href='list.php?del=".$testName."'> Удалить данный тест</a>";
    }
}
?>


<ul>
    <?php
        if ($_SESSION['user'] != 'guest') {
        echo "<li><a href='admin.php'>Загрузка теста</a></li>";
        }
    ?>
    <li><a href="list.php">Список тестов</a></li>
</ul>

</body>
</html>
