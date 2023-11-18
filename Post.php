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

    public function getNumberOfPosts()
    {
        $conn = $this->db->getConnection();

        $query = "SELECT COUNT(*) as count FROM post";
        $result = $conn->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['count'];
        } else {
            return 0;
        }
    }

    public function addPost($title, $content, $images)
    {
        $conn = $this->db->getConnection();

        $content = nl2br($content);

        $query = "INSERT INTO post (title, content) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $title, $content);
        $stmt->execute();
        $postId = $stmt->insert_id;

        if (!empty($images)) {
            foreach ($images['name'] as $key => $name) {
                $tmp_name = $images['tmp_name'][$key];
            
                $fp = fopen($tmp_name, 'r');
                $content = fread($fp, filesize($tmp_name));
                fclose($fp);
            
                $base64Image = base64_encode($content);
            
                $query = "INSERT INTO post_image (id_post, images) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("is", $postId, $base64Image);
                $stmt->execute();
            }
        }
        $stmt->close();
        $this->db->closeConnection();
    }

    public function getPosts($startIndex, $postsPerPage)
    {
        $conn = $this->db->getConnection();

        $query = "SELECT p.*, pi.images 
              FROM post p 
              LEFT JOIN post_image pi ON p.id_post = pi.id_post 
              GROUP BY p.id_post 
              ORDER BY p.date DESC LIMIT ?, ?";
    
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

    public function getFullPost($id_post)
    {
        $conn = $this->db->getConnection();

        $query = "SELECT p.*, pi.images FROM post p LEFT JOIN post_image pi ON p.id_post = pi.id_post WHERE p.id_post = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id_post);
        $stmt->execute();
        $result = $stmt->get_result();

        $post = array();
        while ($row = $result->fetch_assoc()) {

            if (empty($post)) {
                $post['p_title'] = $row['title'];
                $post['p_date'] = $row['date'];
                $post['p_content'] = $row['content'];
                $post['images'] = array();
            }

            if (!empty($row['images'])) {
                $post['images'][] = $row['images'];
            }
        }
        return $post;
    }


    public function editPost($id_post, $title, $content, $images)
    {
        $conn = $this->db->getConnection();

        $query = "UPDATE post SET title = ?, content = ? WHERE id_post = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $title, $content, $id_post);
        $stmt->execute();

        $queryDelete = "DELETE FROM post_image WHERE id_post = ?";
        $stmtDelete = $conn->prepare($queryDelete);
        $stmtDelete->bind_param("i", $id_post);
        $stmtDelete->execute();

        if (!empty($images)) {
            foreach ($images['name'] as $key => $name) {
                $tmp_name = $images['tmp_name'][$key];
            
                $fp = fopen($tmp_name, 'r');
                $content = fread($fp, filesize($tmp_name));
                fclose($fp);
            
                $base64Image = base64_encode($content); // Konwertuj obrazek do Base64
            
                $query = "INSERT INTO post_image (id_post, images) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("is", $id_post, $base64Image);
                $stmt->execute();
            }
        }

        $stmt->close();
        $stmtDelete->close();
        $this->db->closeConnection();
    }

    public function deletePost($id_post)
    {
        // Połącz z bazą danych
        $conn = $this->db->getConnection();

        $queryDeletePost = "DELETE FROM post WHERE id_post = ?";
        $stmtDeletePost = $conn->prepare($queryDeletePost);
        $stmtDeletePost->bind_param("i", $id_post);
        $stmtDeletePost->execute();

        $queryDeleteImages = "DELETE FROM post_image WHERE id_post = ?";
        $stmtDeleteImages = $conn->prepare($queryDeleteImages);
        $stmtDeleteImages->bind_param("i", $id_post);
        $stmtDeleteImages->execute();

        $stmtDeletePost->close();
        $stmtDeleteImages->close();
        $this->db->closeConnection();
    }
}
?>
