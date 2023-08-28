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
        die("Could not connect</br>");
    }
    else {
        echo ("Connected to local DB</br>");
    }

    # Добавление данных в бд
    $query_1 = "INSERT INTO book (book_name, book_author, book_price) VALUES ('$book_name_from_html', '$book_author_from_html', '$book_price_from_html')";
    if (isset($_POST['input_1'])) {
        $result_1 = pg_query($dbconn, $query_1);
        echo "Inserted successfully</br>";
    }
    else {
        echo "Inserting error</br>";
    }

    # Вывод списка на экран
    $query_2 = 'SELECT * FROM book';
    if (isset($_POST['input_2'])) {
        $result_2 = pg_query($dbconn, $query_2);
        echo "<table>\n";
        while ($line = pg_fetch_array($result_2, null, PGSQL_ASSOC)) {
            echo "\t<tr>\n";
            foreach ($line as $col_value) {
                echo "\t\t<td>$col_value</td>\n";
            }
            echo "\t</tr>\n";
        }
        echo "</table>\n";
    }
    else {
        echo "Could not display values</br>";
    }

    pg_close($dbconn);

?>