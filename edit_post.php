<?php include_once('script.php');include_once('Post.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportowy blog</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
	<script src="jquery-3.6.1.min.js"></script>
    <script src="script.js?ver=0.2"></script>



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
                            <a class="nav-link" style="width:120px;" href="index.php">Strona główna</a>
                        </li>
                        <?php
                        if(isset($_SESSION['user']))
                            {   
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" style="width:120px;" href="create_post.php">Utówrz post</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" style="width:120px;" href="edit_post.php">Edytuj post</a>
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

    <section class="py-5" style="min-height: calc(100vh - 122px);">
        <div class="container">
            <h2>Lista Wszystkich Postów</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tytuł</th>
                        <th>Data</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $post = new Post();
                    $numberOfPosts = $post->getNumberOfPosts(); // Pobierz ilość postów z bazy danych
                    $postsPerPage = 8; // Ilość postów na jednej stronie
                    $numberOfPages = ceil($numberOfPosts / $postsPerPage); // Oblicz liczbę stron
                    $postsPerPage = 10; // Ilość postów na jednej stronie
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $startIndex = ($currentPage - 1) * $postsPerPage;

                    $allPosts = $post->getPosts($startIndex, $postsPerPage);

                    foreach ($allPosts as $post) {
                        ?>
                        <tr>
                            <td><?php echo $post['id_post']; ?></td>
                            <td><?php echo $post['title']; ?></td>
                            <td><?php echo $post['date']; ?></td>
                            <td>
                                <a class="btn btn-info btn-sm" href="edit.php?id=<?php echo $post['id_post'];?> ">Edytuj</a>
                                <!-- W miejscu, gdzie chcesz umieścić przycisk do usuwania postu -->
                                <button type="submit" class="hide btn btn-danger btn-sm" name='kategoria' id="<?php echo $post['id_post']; ?>">Usun</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
                <ul class="pagination justify-content-center">
                    <?php
                        for ($page = 1; $page <= $numberOfPages; $page++) {
                        echo '<li class="page-item ' . ($page == $currentPage ? 'active' : '') . '"><a class="page-link" href="?page=' . $page . '">' . $page . '</a></li>';
                        }
                    ?>
                </ul>
        </div>
    </section>

    <!-- Page Content -->
    
    <!-- Footer -->
    <footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
            <div class="container text-center">
                <small>Copyright &copy; Your Website</small>
            </div>
    </footer>
</body>
</html>

