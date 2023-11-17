<?php include_once('script.php');include_once('Post.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mój blog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
	<script src="jquery-3.6.1.min.js"></script>
	<script src="jquery.js"></script>
</head>
<body>
    <!-- Navigation -->
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
                            <a class="nav-link" style="width:120px;" href="edit_post.php">Edytuj post</a>
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

    <section class="py-2" style="min-height: calc(100vh - 72px);">
        <div class="container">
            <div class="row">
                <!-- Blog Entries -->
                <div class="col-md-12">
                    <h1 class="my-4">Podróże z Gugusiem
                        <!-- <small>Secondary Text</small> -->
                    </h1>
                     <!-- Blog Posts Loop -->
                <?php
                $post = new Post();
                $numberOfPosts = $post->getNumberOfPosts(); // Pobierz ilość postów z bazy danych
                $postsPerPage = 8; // Ilość postów na jednej stronie
                $numberOfPages = ceil($numberOfPosts / $postsPerPage); // Oblicz liczbę stron
                
                // Pobierz numer strony z parametru URL
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                
                // Określ, które posty należy wyświetlić na bieżącej stronie
                $startIndex = ($currentPage - 1) * $postsPerPage;
                
                // Utwórz instancję klasy Post
                
                
                // Pobierz posty z bazy danych
                $posts = $post->getPosts($startIndex, $postsPerPage);
                
                foreach ($posts as $i => $post) {
                    $maxLength = 200; // Maksymalna długość tekstu
                    $content = $post['content']; // Tekst do obcięcia
                    if (strlen($content) > $maxLength) {
                        $content = substr($content, 0, $maxLength) . '...';
                    }
                    // Otwórz nowy wiersz co 4 posty
                    if ($i % 4 == 0) {
                        echo '<div class="row">';
                    }
                    ?>
                    <div class="col-md-3 blog-post" style="margin-bottom:15px;">
                        <?php
                        if (!empty($post['images'])) {
                            // Wyświetl obrazek, jeśli istnieje
                            ?>
                            <img class="img-fluid rounded mb-3 mb-md-0 post-image" src="data:image/jpeg;base64,<?php echo $post['images']; ?>" alt="<?php echo $post['title']; ?>">
                            <?php
                        }
                        ?>
                        <div class="blog-post-title"><?php echo $post['title'];  ?></div>
                        <div class="blog-post-meta"><?php echo $post['date']; ?></div>
                        <p><?php echo $content ;?></p>
                        <a class="btn btn-info" href="read.php?id=<?php echo $post['id_post'];?> ">Cały artykuł</a>
                    </div>
                    <?php
                    // Zamknij wiersz co 4 posty
                    if (($i + 1) % 4 == 0 || $i == count($posts) - 1) {
                        echo '</div>';
                    }
                }
                
                
                ?>
                <!-- Koniec pętli -->

                <!-- Paginacja -->
                <ul class="pagination justify-content-center">
                    <?php
                    for ($page = 1; $page <= $numberOfPages; $page++) {
                        echo '<li class="page-item ' . ($page == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
                    }
                    ?>
                </ul>
                <!-- Koniec paginacji -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
    <!-- Page Content -->
    
    <!-- Footer -->
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

