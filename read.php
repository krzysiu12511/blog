<?php
// Pobierz identyfikator artykułu z parametru URL
$articleId = isset($_GET['id']) ? $_GET['id'] : null;

// Pobierz pełne informacje o artykule z bazy danych na podstawie $articleId
// (Tu musisz dostosować kod do swojej struktury bazy danych)

// Przykładowe dane artykułu
$articleData = array(
    'title' => "Tytuł artykułu o identyfikatorze $articleId",
    'date' => "January 1, 2020",
    'image' => "http://placehold.it/800x400", // URL do zdjęcia
    'text' => "To jest pełen tekst artykułu o identyfikatorze $articleId."
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Czytaj artykuł</title>
    <link rel="stylesheet" type="text/css" href="style">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
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
                            <a class="nav-link active" style="width:120px;" href="index.php">Strona główna</a>
                        </li>
                        <?php
                        if(isset($_SESSION['User']))
                            {   
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">Utówrz post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="edit.php">Edytuj post</a>
                        </li>
                        <?php 
                            } 
                        ?>
                    </ul>
                </div>
                <?php
                if(isset($_SESSION['User']))
                {
                ?>
                <div class="navbar-collapse collapse w-100 order-3 dual-collapse2" id="collapsibleNavbar">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown">Witaj <?php echo $_SESSION['User']; ?> ! </a>
                        </li>
                        <li class="nav-item"><?php echo '<a href="script.php?logout" class="nav-link" style="color:red; font-weight: 600;">Wyloguj</a>';?></li>
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
        <div class="container">
            <h1 class="my-4"><?php echo $articleData['title']; ?></h1>

            <!-- Zdjęcie artykułu -->
            <img class="img-fluid rounded mb-3" src="<?php echo $articleData['image']; ?>" alt="">

            <!-- Informacje o artykule -->
            <p class="blog-post-meta"><?php echo $articleData['date']; ?> by <a href="#">Author</a></p>

            <!-- Pełny tekst artykułu -->
            <p><?php echo $articleData['text']; ?></p>
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
