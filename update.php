<?php
include 'db.php';
session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
}

$id = $_POST['id'];
$title = $_POST['item_name'];
$content = $_POST['description'];

$res = $conn->query("SELECT * FROM menu WHERE id=$id");
$row = $res->fetch_assoc();

if($_SESSION["id"] != $row["user_id"]){
    echo "Unauthorized";
}

$image = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];

if(!empty($image)){

    if(!empty($row['image']) && file_exists("uploads/".$row['image'])){
        unlink("uploads/".$row['image']);
    }

    move_uploaded_file($tmp, "uploads/".$image);

    $stmt = $conn->prepare("UPDATE blog SET title=?, content=?, image=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $content, $image, $id);

} else {

    $stmt = $conn->prepare("UPDATE menu SET item_name=?, description=? WHERE id=?");
    $stmt->bind_param("ssi", $item_name, $descrition, $id);
}

if($stmt->execute()){
    header("Location: dashboard.php");
    exit();
} else {
    echo "Update Failed";
    
}
?>