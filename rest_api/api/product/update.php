<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/product.php';

$database = new Database();
$db = $database->connect();
$post = new Product($db);

$data = json_decode(file_get_contents("php://input"));

$post->id = $data->id;
$post->name = $data->name;
$post->price = $data->price;

if($post->update()){
    echo json_encode(array('message' => 'Post Updated'));
}
else{
    echo json_encode(array('message' => 'Post Not Updated'));
}