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
    <h2>Добавьте книгу в свою библиотеку</h2>
    <form action="library.php" method="post" class="authorization">
        <input type="text" name="name" class="form-control" placeholder="Введите Название книги"><br>
        <input type="text" name="age" class="form-control" placeholder="Укажите год издания"><br>
        <div class="button">
            <button type="submit" name="add">Добавить</button>
            <button type="submit" name="cancel">Отмена</button>
        </div>
    </form>
</div>
</body>
</html>

