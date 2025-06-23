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

if (isset($_GET['id'])) {
    $post_id = $posts->get_post_by_id($_GET['id']);
} else {
    $secure->set_message("No post ID provided.");
}

if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['author'])) {
    $edit_post = $posts->edit_post(
        $post_id['id'], 
        $_POST['title'], 
        $_POST['content'], 
        $_POST['author'], 
        $_POST['date'] ? $_POST['date'] : $post_id['date'],
        $_POST['edited'] ? $_POST['edited'] : $post_id['edited']
    );


    if ($post_id) {
    
        $secure->set_message("Post: " . htmlspecialchars($_POST['title']) . " successfully updated.");

        header('location: posts.php');
        die();
    } else {
        $secure->set_message("User not found or could not be updated.");
    }
}
?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center mb-4">
        <h1 class="display-1">Edit User</h1>

    </div>
</div>

<div>
    <?php if($post_id): ?>

        <div class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="post">
            <!-- Title input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="title" name="title" class="form-control" value="<?= htmlspecialchars($post_id['title']); ?>" />
                <label class="form-label" for="title">Title</label>
            </div>

            <!-- Content input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="content" id="content" name="content" class="form-control" 
                value="<?= htmlspecialchars($post_id['content']); ?>"/>
                <label class="form-label" for="email">Content</label>
            </div>

            <!-- Author input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="author" name="author" class="form-control" />
                <label class="form-label" for="author">Author</label>
            </div>

              <div data-mdb-input-init class="form-outline mb-4">
                <input type="date" id="date" name="date" class="form-control" />
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
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">EDIT POST</button>
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