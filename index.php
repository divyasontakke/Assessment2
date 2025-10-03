<?php
require 'database/db.php';
require 'classes/Todo.php';

$pdo = db_connect();

$rows = db_fetch_all($pdo, 'todos');

$todos = [];
$dueToday = [];

foreach ($rows as $row) {
    $todo = new Todo($row['description'], $row['due_date']);
    if ($row['is_completed']) {
        $todo->markAsCompleted();
    }
    
    $todo->id = $row['id'];
    $todos[] = $todo;

    if (date('Y-m-d') === date('Y-m-d', strtotime($row['due_date']))) {
        $dueToday[] = $todo;
    }
}

require 'views/index.html';