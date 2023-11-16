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

        // Utwórz instancję klasy Database
        $db = new Database();
        $conn = $db->getConnection();

        // Sprawdź czy użytkownik o podanym loginie i haśle istnieje w bazie danych
        $query = "SELECT id_user FROM user WHERE login = '$login' AND password = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Użytkownik istnieje, zaloguj go
            $_SESSION['user'] = $login;
            header("Location: index.php"); // Przekieruj do strony głównej po zalogowaniu
        } else {
            // Błędne dane logowania
            header("Location: login.php");
            echo "Błędny login lub hasło.";
        }

        // Zamknij połączenie z bazą danych
        //$db->closeConnection();
    
}

if ($kategoria == "Dodajpost") {
    include_once 'Post.php'; // Załóżmy, że masz taki plik zdefiniowany
    echo "jestem.";
    // Pobierz dane z formularza
    $title = $_POST['title'];
    $content = $_POST['content'];
    $images = $_FILES['images'];

    // Utwórz instancję klasy Post
    $post = new Post();

    // Dodaj nowy post do bazy danych
    $post->addPost($title, $content, $images);

    // Wyświetl komunikat sukcesu
    echo "Post został dodany do bazy pomyślnie.";
    header("location:create_post.php");
}


if(isset($_GET['logout'])){
    session_destroy();
    header("location:index.php");
}

?>
