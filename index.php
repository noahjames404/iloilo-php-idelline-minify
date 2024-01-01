<?php

include_once "backend/conn.php";
include_once "backend/crud.php";

//TABLE TASKS
$task = new CRUD($conn);
$task->table = "task";

$task->primaryKey = "id";
$task->columns = [
    "task"
];

$task->create([
    "task" => "mag laba mag damag"
]);

print_r($task->get());

echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";






//TABLE USER
$user = new CRUD($conn);

$user->table = "user";

$user->primaryKey = "id";
$user->columns = [
    "username",
    "name",
    "description"
];


// echo $user->create([
//     "username" => "supreme power!"
// ]);

// echo $user->create([
//     "username" => "passerby!",
//     "name" => "nani?"
// ]);

echo $user->delete(6);
echo $user->delete(7);
echo $user->delete(8);
echo $user->delete(9);
echo $user->delete(10);

echo $user->update([
    "username" => "supremeleader"
],1);

echo '<br>';
echo '<br>';
echo '<br>';

print_r($user->get());

