<?php 

require 'classes/Connect.php';
require 'classes/Users.php';
require 'classes/Authenticate.php';
require 'includes/config.php';

$secure = new Authenticate();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $db = new Connect();
    $conn = $db->dbConnect();
    
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $users = new Users($conn, $email, $password);
    $user = $users->login($conn, $email, $password);

   if (!$user) {
    echo 'Prepared statement failed to return a user. Please check your email and password.';
   } else {
        $_SESSION['id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['username'] = $user['username'];

    // Give feedback to the user
      
        $secure->set_message('<br>'.'You are now logged in. Welcome ' . $_SESSION['username'] . '!');


        header('location: /cmsPHP/php-ContentManagementSystem/dashboard.php');
        die();
   }

  

} 



?>

<?php require 'includes/header.php'; ?>

<?php require 'includes/navigation.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <form method="post">
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

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                <!-- Checkbox -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                    <label class="form-check-label" for="form1Example3"> Remember me </label>
                </div>
                </div>

                <div class="col">
                <!-- Simple link -->
                <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
        </div>
    </div>
</div>


<?php require 'includes/footer.php'; ?>


