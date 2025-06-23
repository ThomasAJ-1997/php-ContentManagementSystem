<?php 

session_start();

require 'classes/Connect.php';
require 'classes/Authenticate.php';
require 'classes/Posts.php';

$secure = new Authenticate();
$secure->secure();

$db = new Connect();
$conn = $db->dbConnect();

$posts = new Posts($conn);


if (isset($_POST['title'])) {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $author = $_POST['author'] ?? '';
    $date = date('Y-m-d');
    $edited = date('Y-m-d H:i:s');


    if ($title && $content && $author && $date) {;
        $add_post = $posts->add_post($title, $content, $author, $date, $edited);

        if ($add_post) {
            $secure->set_message("User " . htmlspecialchars($title) . " post has been added successfully.");
        } else {
            $secure->set_message("Failed to add post. Please try again.");
        }
    } else {
        $secure->set_message("Please fill in all fields.");
    }
}

?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center mb-4">
        <h1 class="display-1">Add Post</h1>

    </div>
</div>

<div>
    <?php if($posts): ?>

        <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <form method="post">
            <!-- Title input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="title" name="title" class="form-control" />
                <label class="form-label" for="title">title</label>
            </div>

    
            <!-- Content input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="content" name="content" class="form-control" />
                <label class="form-label" for="email">Content</label>
            </div>

            <!-- Author input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="author" name="author" class="form-control" />
                <label class="form-label" for="author">Author</label>
            </div>

            <div data-mdb-input-init class="form-outline mb-4">
                <input type="datr" id="date" name="date" class="form-control" />
                <label class="form-label" for="date">Date</label>
            </div>

       
            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                </div>
                </div>
            </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">CREATE POST</button>
            </form>
        </div>
    </div>
</div>

    <?php else: ?>
        <p>Post not found.</p>
    <?php endif; ?>

    
</div>

<script src="js/tinymce/tinymce.min.js"></script>
<script src="js/content-box.js"></script>

<?php require 'includes/footer.php'; ?>