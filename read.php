<?php
include_once('Post.php');
include_once('script.php');
$id_post = isset($_GET['id']) ? $_GET['id'] : null;
$post = new Post();
$articleData = $post->getFullPost($id_post);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Czytaj artykuł</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <script src="jquery-3.6.1.min.js"></script>
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
                            if(isset($_SESSION['user']))
                                {   
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" style="width:120px;" href="create_post.php">Utówrz post</a>
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
        
        <section class="py-3" style="min-height: calc(100vh - 72px);">
            <div class="container">
                <h1 class="read my-4"><?php echo $articleData['p_title']; ?></h1>
                <div class="container d-flex justify-content-center align-items-center">
                    <?php if (!empty($articleData['images'])): ?>
                        <div id="carouselExample" class="carousel slide" data-ride="carousel" style="max-width: 800px;" data-interval="10000">
                            <div class="carousel-inner">
                                <?php foreach ($articleData['images'] as $index => $image): ?>
                                    <div class="carousel-item<?php echo ($index === 0) ? ' active' : ''; ?>">
                                        <img class="d-block w-100 read-image" src="data:image/jpeg;base64,<?php echo $image; ?>" alt="<?php echo $articleData['p_title']; ?>" style="width: 100%; height: 400px; object-fit: contain; outline: none;">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <p class="read blog-post-meta"><?php echo $articleData['p_date']; ?></p>
                <p class="read-content"><?php echo nl2br($articleData['p_content']); ?></p>

            </div>
        </section>

        <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
                <div class="container text-center">
                    <small>Copyright &copy; Your Website</small>
                </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    </body>
</html>
