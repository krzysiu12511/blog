<?php include_once('script.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj post</title>

    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src='sweetalert2.all.min.js'></script>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top gradient-custom one-edge-shadow">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Blog</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" style="width:120px;" href="index.php">Strona główna</a>
                        </li>
                        <?php
                        if(isset($_SESSION['user']))
                            {   
                        ?>
                        <li class="nav-item">
                            <a class="nav-link active" style="width:120px;" href="create_post.php">Utówrz post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" style="width:120px;" href="edit.php">Edytuj post</a>
                        </li>
                        <?php 
                            } 
                        ?>
                    </ul>
                </div>
                <?php
                if(isset($_SESSION['user']))
                {
                ?>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="collapsibleNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" style="width:120px;" href="#">Witaj <?php echo $_SESSION['user']; ?> ! </a>
                        </li>
                        <li class="nav-item" style="width:80px;"><?php echo '<a href="script.php?logout" class="nav-link" style="color:red; font-weight: 600;">Wyloguj</a>';?></li>
                    </ul>
                </div>
                <?php
                }else{
                ?>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="collapsibleNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="login.php">Zaloguj się</a></li>
                    </ul>
                </div>
                <?php
                }
                ?>
                
            </div>
    </nav>


    <section class="py-5 " style="min-height: calc(100vh - 72px);">
        <div class="container mt-5">
            <h2 class="mb-4">Dodaj nowy post</h2>
            <form action="script.php" method="post" id="yourFormId" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Tytuł:</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Treść artykułu:</label>
                    <textarea class="form-control" id="content" name="content" rows="6" required></textarea>
                </div>
                <div class="form-group">
                    <label for="images">Zdjęcia:</label>
                    <input type="file" class="form-control-file" id="images" name="images[]" accept="image/*" multiple required>

                </div>
                <button type="submit" name='kategoria' value='Dodajpost' class="btn btn-primary">Dodaj post</button>
            </form>
        </div>
    </section>

    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
            <div class="container text-center">
                <small>Copyright &copy; Your Website</small>
            </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
</body>
</html>
