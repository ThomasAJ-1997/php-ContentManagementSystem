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

if (isset($_POST['username'])) {
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $active = $_POST['active'] ?? 1;

    if ($username && $email && $password) {;
        $add_user = $users->add_user($username, $email, $password, $active);

        if ($add_user) {
            $secure->set_message("User " . htmlspecialchars($username) . " has been added successfully.");
        } else {
            $secure->set_message("Failed to add user. Please try again.");
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
        <h1 class="display-1">Add User</h1>

    </div>
</div>

<div>
    <?php if($user): ?>

        <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="post">
             <!-- Username input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="text" id="username" name="username" class="form-control" />
                <label class="form-label" for="username">Username</label>
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
                <input type="email" id="email" name="email" class="form-control" />
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
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
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