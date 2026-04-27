<?php 


include 'db.php';

if ( ! isset($_SESSION["id"])) {
    header("Location:login.php");
}


if ($_SERVER["REQUEST_METHOD"]==="POST") {
    $title=$_POST["title"];
    $img_name = $_FILES["image"]["name"];
    $user_id=$_SESSION["id"];
    $content=$_POST["content"];
    move_uploaded_file($_FILES["image"]["tmp_name"] , "uploads/$img_name" );
    $sql=$conn->prepare("insert into menu(item_name , image , description ,user_id) values (?,?,?,?)");
    $sql->bind_param("sssi", $title , $img_name , $content, $user_id);
    if ($sql->execute()) {
        header("Location:dashboard.php");
    }
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
            <div
                class="container col-5 p-5 border rounded shadow mt-4"
            >
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            id=""
                            aria-describedby="helpId"
                            placeholder=""
                        />
                    
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Choose file</label>
                        <input
                            type="file"
                            class="form-control"
                            name="image"
                            id=""
                            placeholder=""
                            aria-describedby="fileHelpId"
                        />
                        <div id="fileHelpId" class="form-text">Help text</div>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">Content</label>
                        <textarea class="form-control" name="content" id="" rows="3"></textarea>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Submit
                    </button>
                    
                    

                </form>
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
