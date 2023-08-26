<?php

    $host='localhost';
    $db = 'postgres';
    $username = 'postgres';
    $password = 'postgres';

    $book_name_from_html = $_POST['book_name'];
    $book_author_from_html = $_POST['book_author'];
    $book_price_from_html = $_POST['book_price'];

    # Создаем соединение с базой PostgreSQL с указанными выше параметрами
    $dbconn = pg_connect("host=$host port=5432 dbname=$db user=$username password=$password");

    # Проверка на правильное соединение
    if (!$dbconn) {
    die('Could not connect');
    }
    else {
    echo ("Connected to local DB");
    }

    $query = "INSERT INTO book (book_name, book_author, book_price) VALUES ('$book_name_from_html', '$book_author_from_html', '$book_price_from_html')";
    $result = pg_query($dbconn, $query);
    if(!$result) {
    echo "Could not insert into database";
    }
    else {
    echo "Inserted successfully";
    }

?>