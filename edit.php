<?php
require 'database/db.php';

$pdo = db_connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM todos WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
    $todo = $statement->fetch(PDO::FETCH_ASSOC);
}


if (isset($_POST['id'])) {
    if (empty($_POST['description']) || empty($_POST['due_date'])) {
        $errorMessage = "All fields are required";
    } else {
        $fields = [
            'description' => $_POST['description'],
            'due_date' => $_POST['due_date']
        ];
        $conditions = [
            'id' => $_POST['id']
        ];
        $result = db_update($pdo, 'todos', $fields, $conditions);

        if ($result) {
            header("Location: index.php");
            exit;
        }
    }
}

require 'views/edit.html';
