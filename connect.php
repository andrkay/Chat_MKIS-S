<?php

// Устанавливаем кодировку UTF-8
header('Content-Type: text/html; charset=utf-8');

session_start();
$conn = new mysqli("localhost", "root", "", "ChatMKIS");

if ($_POST['text']) {
    $text = mysqli_real_escape_string($conn, $_POST['text']);
    $username = $_SESSION['username'];

    $sql = "INSERT INTO text (massaging, username) VALUES ('".$text."', '".$username."')";
    $conn->query($sql);
}

if ($_POST['get']) {
    $sql = "SELECT * FROM text ORDER BY id DESC";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "<li>".$row['username']." : ".$row['massaging'].$row['created_at']."</li>";
    }
}
?>