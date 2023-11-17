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
    <title>Edit Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Edit Post</h2>
    <form action="script.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_post" value="<?php echo $id_post; ?>">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $articleData['p_title']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content:</label>
            <textarea name="content" class="form-control" required><?php echo $articleData['p_content']; ?></textarea>
        </div>
        <div class="mb-3">
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
                <label for="images">Zdjęcia:</label>
                <input type="file" class="form-control-file" id="images" name="images[]" accept="image/*" multiple required>
        </div>
        <button type="submit" id="addPostButton" name='kategoria' value='Edytujpost' class="btn btn-primary">Zapisz zmiany</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
