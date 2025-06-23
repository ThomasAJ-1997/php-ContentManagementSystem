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


if (isset($_GET['id'])) {
    $user_id = $users->get_user_by_id( $_GET['id']);
} else {
    $secure->set_message("No user ID provided.");
}

if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['active'])) {

    $edit_user = $users->edit_user(
        $user_id['id'], 
        $_POST['username'], 
        $_POST['email'], 
        $_POST['password'] ? SHA1($_POST['password']) : $user_id['password'], // Only update password if provided
        $_POST['active']
    );

    if ($user_id) {
    
    $secure->set_message("User: " . htmlspecialchars($_POST['username']) . " successfully updated.");

    header('location: users.php');
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
    <?php if($user_id): ?>

        <div class="container mt-5">
        <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="post">
             <!-- Username input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control" value="<?= htmlspecialchars($user_id['username']); ?>" />
                <label class="form-label" for="username">Username</label>
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" 
                value="<?= htmlspecialchars($user_id['email']); ?>"/>
                <label class="form-label" for="email">Email address</label>
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="password" id="password" name="password" class="form-control" />
                <label class="form-label" for="password">Password</label>
            </div>

            <!-- Select input (active / inactive) -->
                <div data-mdb-input-init class="form-outline mb-4">
                <select class="form-select" id="active" name="active">
        
                    <option <?= ($user_id['active']) ? 'selected' : "" ?> value="1">Active</option>
                    <option <?= ($user_id['active']) ? "" : 'selected' ?>  value="0">Inactive</option>
                  
                </select>
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
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">CREATE USER</button>
            </form>
        </div>
    </div>
</div>

    <?php else: ?>
        <p>User not found.</p>
    <?php endif; ?>

    
</div>

<?php require 'includes/footer.php'; ?>