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
$all_post = $posts->all_posts($conn);

if (isset($_GET['delete'])) {
    $delete_post = $posts->delete_post($_GET['delete']);

    if ($delete_post) {
        $secure->set_message('Post deleted successfully.');
        header('Location: posts.php');
        exit();
    } else {
        $secure->set_message('Failed to delete post.');
    }
}

?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center mb-4">
        <h1 class="display-1">Post Management</h1>
  
        <a href="dashboard.php">Back to dashboard</a>

    </div>
</div>

<div>
    <?php if($all_post): ?>

        <table class="table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Date</th>
                <th>Edited</th>
                <th>Edit | Delete </th>
            </tr>

            <?php foreach($all_post as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['id']); ?></td>
                    <td><?= htmlspecialchars($p['title']); ?></td>
                    <td><?= htmlspecialchars($p['content']); ?></td>
                    <td><?= htmlspecialchars($p['author']); ?></td>
                    <td><?= htmlspecialchars($p['date']); ?></td>
                    <td><?= htmlspecialchars($p['edited']); ?></td>
                    <td>
                        <a href="posts_edit.php?id=<?= $p['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="posts.php?delete=<?= $p['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else: ?>
        <p>No posts found.</p>
    <?php endif; ?>

    <a class="btn btn-secondary" href="posts_add.php">Add New Post</a>
</div>

<?php require 'includes/footer.php'; ?>