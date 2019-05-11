<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/product.php';

$database = new Database();
$db = $database->connect();
$post = new Product($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

$post->read_single();

$post_arr = array(
    'id' => $post->id,
    'name' => $post->name,
    'price' => $post->price
);

print_r(json_encode($post_arr));