<?php
//Старт сессии и открытие файла
session_start();
if (isset($_REQUEST['login']) && isset($_REQUEST['password'])) {
    $login = trim($_REQUEST['login']);
    $password = trim($_REQUEST['password']);
    $f_json = "accounts/" . $login . '_' . $password . ".json";
    if ($json = file_get_contents("$f_json")) {
        $_SESSION['auth'] = true;
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;
        $_SESSION['$countSortName'] = 0;
    } else {
        $_SESSION['auth'] = false;
        die("<b>Неверные данные</b>");
    }
} else {
    if (!empty($_SESSION['auth']) && $_SESSION['auth']) {
        $login = trim($_SESSION['login']);
        $password = trim($_SESSION['password']);
        $f_json = "accounts/" . $login . '_' . $password . ".json";
        $json = file_get_contents("$f_json");
    } else {
        $_SESSION['auth'] = false;
        die("<b>Введите данные</b>");
    }
}
$arr = json_decode($json, true);

//Добавление книги
if (isset($_REQUEST['add'])) {
    $name = $_REQUEST['name'];
    $age = $_REQUEST['age'];
    $arr[] = ["name" => $name, "age" => $age];
    $newJson = json_encode($arr);
    file_put_contents($f_json, $newJson);
}


if (isset($_POST['query'])) {
    //Поиск по книгам
    function search($query, $arr)
    {
        $library = array();
        $query = trim($query);
        if (!empty($query)) {
            if (strlen($query) < 3) {
                $text = '<p>Слишком короткий поисковый запрос.</p>';
                exit($text);
            } else if (strlen($query) > 128) {
                $text = '<p>Слишком длинный поисковый запрос.</p>';
                exit($text);
            } else {
                foreach ($arr as $book) {
                    if (stripos($book['name'], $query) !== false) {
                        $library[] = ["name" => $book['name'], "age" => $book['age']];
                    }
                }
            }
        }
        return $library;
    }
}
if (isset($_POST['sortName'])) {
    $sortName = $_POST['sortName'];
    // По возрастанию:
    function cmp_function($a, $b)
    {
        return ($a['name'] > $b['name']);
    }

    // По убыванию:
    function cmp_function_desc($a, $b)
    {
        return ($a['name'] < $b['name']);
    }

    $_SESSION['$countSortName']++;
    if ($_SESSION['$countSortName'] % 2 == 0) {
        uasort($arr, 'cmp_function');
    } else {
        uasort($arr, 'cmp_function_desc');
    }
}
if (isset($_POST['sortAge'])) {
    $sortAge = $_POST['sortAge'];
    // По возрастанию:
    function cmp_function($a, $b)
    {
        return ($a['age'] > $b['age']);
    }

    // По убыванию:
    function cmp_function_desc($a, $b)
    {
        return ($a['age'] < $b['age']);
    }

    $_SESSION['$countSortName']++;
    if ($_SESSION['$countSortName'] % 2 == 0) {
        uasort($arr, 'cmp_function');
    } else {
        uasort($arr, 'cmp_function_desc');
    }
}
?>
<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Библиотека</h1>

    <form name="search" method="post" action="library.php">
        <input type="search" list="search" name="query" placeholder="Поиск">
        <datalist id="search">
            <?php foreach ($arr

            as $index => $book) { ?>
            <option value="<?= $book["name"] ?>">
                <?php } ?>
        </datalist spellcheck="true">
        <button type="submit">Найти</button>
    </form>
    <?php
    if (!empty($_POST['query'])) {
        $search_result = search($_POST['query'], $arr);
        ?>
        <table>
            <table border="1"
            <tr>
                <th>Название книги</th>
                <th>Год издания</th>
            </tr>
            <?php foreach ($search_result as $value) { ?>
                <tr>
                    <td><?= $value["name"] ?></td>
                    <td><?= $value["age"] ?></td>
                </tr>
            <?php } ?>
        </table>
        <?php

    } else {
        ?>
        <table>
            <table border="1"
            <tr>
                <th>Название книги
                    <form action="library.php" method="post">
                        <button type="submit" name="sortName"><span class="material-icons">swap_vert</span></button>
                    </form>
                </th>
                <th>Год издания
                    <form action="library.php" method="post">
                        <button type="submit" name="sortAge"><span class="material-icons">swap_vert</span></button>
                    </form>
                </th>
            </tr>
            <?php foreach ($arr as $index => $book) { ?>
                <tr>
                    <td><?= $book["name"] ?></td>
                    <td><?= $book["age"] ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } ?>
    <form action="addBook.php" method="post" class="authorization">
        <button class="btn btn-success" type="submit">Добавить</button>
    </form>
</div>
</body>
</html>

