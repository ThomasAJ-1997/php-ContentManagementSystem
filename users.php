<?php 

session_start();

require 'classes/Connect.php';
require 'classes/Authenticate.php';
require 'classes/Users.php';

$secure = new Authenticate();
$secure->secure();

$db = new Connect();
$conn = $db->dbConnect();

$users = new Users($conn, '','');
$user = $users->all_users($conn);

if (isset($_GET['delete'])) {
    $delete_user = $users->delete_user($_GET['delete']);

    if ($delete_user) {
        $secure->set_message('User deleted successfully.');
        header('Location: users.php');
        exit();
    } else {
        $secure->set_message('Failed to delete user.');
    }
}

?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center mb-4">
        <h1 class="display-1">User Management</h1>
  
        <a href="dashboard.php">Back to dashboard</a>

    </div>
</div>

<div>
    <?php if($user): ?>

        <table class="table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Edit | Delete </th>
            </tr>

            <?php foreach($user as $u): ?>
                <tr>
                    <td><?= htmlspecialchars($u['id']); ?></td>
                    <td><?= htmlspecialchars($u['username']); ?></td>
                    <td><?= htmlspecialchars($u['email']); ?></td>
                    <td><?= $u['active'] ? 'Active' : 'Inactive'; ?></td>
                    <td>
                        <a href="users_edit.php?id=<?= $u['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="users.php?delete=<?= $u['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>

    <a class="btn btn-secondary" href="users_add.php">Add New User</a>
</div>

<?php require 'includes/footer.php'; ?>