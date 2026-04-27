<?php
include 'db.php';

if(!isset($_SESSION["id"])){
    header("Location: login.php");
}

if(!isset($_GET['id'])){
    echo "Invalid Request";
}

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM menu WHERE id=$id");
$row = $res->fetch_assoc();

if($_SESSION["id"] != $row["user_id"]){
    echo "Unauthorized";
}

if(!empty($row['image']) && file_exists("uploads/".$row['image'])){
    unlink("uploads/".$row['image']);
}

$conn->query("DELETE FROM menu WHERE id=$id");

header("Location: dashboard.php");
?>