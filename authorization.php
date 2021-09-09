<!doctype html>
<html lang="RU">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Авторизация</h1><br>
    <form action="library.php" method="post" class="authorization">
        <input type="text" name="login" class="form-control" placeholder="Введите логин"><br>
        <input type="password" name="password" class="form-control" placeholder="Введите пароль"><br>
        <button class="btn btn-success" type="submit">Войти</button>
    </form>
</div>
</body>
</html>

