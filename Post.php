<?php
include_once 'Database.php';
include_once 'config.php';
class Post
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }

    public function addPost($title, $content, $images)
{
    // Połącz z bazą danych
    $conn = $this->db->getConnection();

    // Wstaw nowy post do tabeli "post"
    $query = "INSERT INTO post (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $title, $content);
    $stmt->execute();
    $postId = $stmt->insert_id;

    // Wstaw zdjęcia do tabeli "post_image"
    if (!empty($images)) {
        foreach ($images['name'] as $key => $name) {
            $tmp_name = $images['tmp_name'][$key];
        
            $fp = fopen($tmp_name, 'r');
            $content = fread($fp, filesize($tmp_name));
            fclose($fp);
        
            $base64Image = base64_encode($content); // Konwertuj obrazek do Base64
        
            $query = "INSERT INTO post_image (id_post, images) VALUES (?, ?)";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("is", $postId, $base64Image);
            $stmt->execute();
        }
    }

    // Zamknij połączenie z bazą danych
    $stmt->close();
    $this->db->closeConnection();
}

    public function getPosts($startIndex, $postsPerPage)
    {
        // Połącz z bazą danych
        $conn = $this->db->getConnection();

        // Pobierz posty z bazy danych z uwzględnieniem tabeli post_image
        $query = "SELECT p.*, pi.images FROM post p LEFT JOIN post_image pi ON p.id_post = pi.id_post ORDER BY p.date DESC LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $startIndex, $postsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();

        $posts = array();
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }

        return $posts;
    }

    
}

?>
