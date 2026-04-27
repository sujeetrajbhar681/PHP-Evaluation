<?php 

include 'db.php';

if ( ! isset($_SESSION["id"])) {
    header("Location:login.php");
}


$result = $conn->query("select menu.* , user.name from menu join user on menu.user_id=user.id");
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


        <style>
            .card-img-top{
                height:200px;
                
            }
        </style>
    </head>

    <body>
        <header>
        <nav
            class="navbar navbar-expand-sm navbar-light bg-light"
        >
            <div class="container ">
                <a class="navbar-brand" href="#">Restaurant </a>
                <button
                    class="navbar-toggler d-lg-none"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId"
                    aria-controls="collapsibleNavId"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="addMenu.php" aria-current="page"
                                >➕Add Menu
                                <span class="visually-hidden">(current)</span></a
                            >
                        </li>
                       
                    </ul>
                    <form class="d-flex my-2 my-lg-0" action="logout.php">
                 
                        <button
                            class="btn btn-outline-success my-2 my-sm-0"
                            type="submit"
                        >
                            Logout
                        </button>
                    </form>

                    <form class="d-flex my-2 my-lg-0" action="pdf.php">
                 
                        <button
                            class="btn btn-outline-success my-2 my-sm-0"
                            type="submit"
                        >
                            PDF Generates
                        </button>
                    </form>

                    <form class="d-flex my-2 my-lg-0" action="excel.php">
                 
                        <button
                            class="btn btn-outline-success my-2 my-sm-0"
                            type="submit"
                        >
                            Excel Generates
                        </button>
                    </form>
                </div>
            </div>
        </nav>
        
        </header>
        <main>

        <div
            class="container"
        >
            <div
                class="row justify-content-center align-items-center g-2"
            >
            <?php  while ($row=$result->fetch_assoc()) {?>
                
                <div class="col-md-4 "><div class="card">
                    <img class="card-img-top" src="uploads/<?= $row["image"]?>" alt="Title" />
                    <div class="card-body">
                        <small><?= $row["name"] ?> ||  <?= $row["created_at"] ?></small>
                        <h4 class="card-title"><?= $row["title"]?></h4>
                        <p class="card-text"><?= $row["content"]?></p>
                        <p>
                            <?php if ($_SESSION["id"]== $row["user_id"] ) {?>
                                <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="edit.php?id=<?= $row['id'] ?>"
                                    role="button"
                                    >Edit</a
                                >

                                <a
                                    name=""
                                    id=""
                                    class="btn btn-primary"
                                    href="delete.php?id=<?= $row['id'] ?>"
                                    role="button"
                                    >Delete</a
                                >
                                
                                
                           <?php } ?>
                        </p>
                    </div>
                </div>
                </div>
                <?php } ?>
                
                
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
