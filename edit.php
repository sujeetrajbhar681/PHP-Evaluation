<?php
include 'db.php';

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    echo "Invalid Request";
}

$id = $_GET['id'];

$res = $conn->query("SELECT * FROM menu WHERE id=$id");

if($res->num_rows == 0){
    echo "menu not found";
}

$row = $res->fetch_assoc();

if($_SESSION["id"] != $row["user_id"]){
    echo "Unauthorized";
}
?>

<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container mt-5">
<div class="card p-4 shadow">

<h3>Edit Menu</h3>

<form action="update.php" method="Post" enctype="multipart/form-data">

<input type="hidden" name="id" value="<?= $row['id'] ?>">

<input type="text" name="item_name" value="<?= $row['item_name'] ?>" class="form-control mb-3" required>

<textarea name="description" class="form-control mb-3" required><?= $row['description'] ?></textarea>

<p>Current Image:</p>
<img src="uploads/<?= $row['image'] ?>" width="120"><br><br>

<input type="file" name="image" class="form-control mb-3">

<button class="btn btn-primary">Update</button>

</form>

</div>
</div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
