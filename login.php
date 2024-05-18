<?php

// Устанавливаем кодировку UTF-8
header('Content-Type: text/html; charset=utf-8');

session_start();
$conn = new mysqli("localhost", "root", "", "ChatMKIS");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $sql = "SELECT * FROM users WHERE username='".$username."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($user['password'] === $password) {
                $_SESSION['username'] = $username;
                header("Location: chat.html");
                exit;
            } else {
                echo "Неверный логин или пароль";
            }
        } else {
            echo "Пользователь не найден";
        }
    } else {
        echo "Заполните все поля";
    }
}
?>