<?php
require 'database/db.php';

$pdo = db_connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM todos WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$id]);
}

header("Location: index.php");
exit;
