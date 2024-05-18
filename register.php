<?php

// Устанавливаем кодировку UTF-8
header('Content-Type: text/html; charset=utf-8');

session_start();
$conn = new mysqli("localhost", "root", "", "ChatMKIS");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

        if ($password !== $confirm_password) {
            echo "Пароли не совпадают";
            exit;
        }

        // Проверка уникальности email
        $check_email_query = "SELECT * FROM users WHERE email='".$email."'";
        $check_email_result = $conn->query($check_email_query);
        if ($check_email_result->num_rows > 0) {
            echo "Этот адрес электронной почты уже зарегистрирован";
            exit;
        }

        // Добавление пользователя в базу данных
        $insert_query = "INSERT INTO users (username, email, password) VALUES ('".$username."', '".$email."', '".$password."')";
        if ($conn->query($insert_query) === TRUE) {
            echo "Пользователь успешно зарегистрирован";
        } else {
            echo "Ошибка при добавлении пользователя: " . $conn->error;
        }
    } else {
        echo "Заполните все поля";
    }
}
?>