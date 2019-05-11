<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/teacher.php';

$database = new Database();
$db = $database->connect();
$post = new Teacher($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'name' => $post->name,
    'subject' => $post->subject
);

print_r(json_encode($post_arr));