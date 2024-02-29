<?php
session_start();
include_once 'config.php';
include_once 'Database.php';

$kategoria='';
if(isset($_POST["kategoria"])){
	$kategoria = $_POST["kategoria"];}
		
if(isset($_GET["kategoria"])){
	$kategoria = $_GET["kategoria"];}

if ($kategoria == "Zaloguj") {
        $login = $_POST['Login'];
        $password = $_POST['Paswd'];

        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT id_user FROM user WHERE login = ? AND password = ?");
        
        $stmt->bind_param("ss", $login, $password);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['user'] = $login;
            header("Location: index.php"); 
        } else {
            header("Location: login.php");
            echo "Błędny login lub hasło.";
        }
        $db->closeConnection();
    
}

if ($kategoria == "Dodajpost") {
    include_once 'Post.php'; 
    $title = $_POST['title'];
    $content = $_POST['content'];
    $images = $_FILES['images'];

    $post = new Post();

    $post->addPost($title, $content, $images);

    header("location:create_post.php");
}

if (isset($_POST['kategoria']) && $_POST['kategoria'] == 'Edytujpost') {
    include_once 'Post.php';

    $id_post = isset($_POST['id_post']) ? $_POST['id_post'] : null;
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $content = isset($_POST['content']) ? $_POST['content'] : null;
    $images = isset($_FILES['images']) ? $_FILES['images'] : null;

    $post = new Post();
    $post->editPost($id_post, $title, $content, $images);


    header("location:edit_post.php");
}

if($kategoria == "Usunpost"){
    include_once 'Post.php';
    $postId = $_POST['id'];
    $post = new Post();
    $result = $post->deletePost($postId);
    echo 1;
}


if(isset($_GET['logout'])){
    session_destroy();
    header("location:index.php");
}

?>
