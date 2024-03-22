<?php
// Check if the user submitted the form
if (isset($_POST['username']) && isset($_POST['password'])) {
    // Connect to the database
   require_once "db_connect.php";
    // Prepare the query
    $query = $pdo->prepare('SELECT * FROM account WHERE username = :username');
    $query->bindValue(':username', $_POST['username']);
    $query->execute();

    // Check if the user exists
    if ($query->rowCount() > 0) {
        $user = $query->fetch();

        // Check if the password is correct
        if (password_verify($_POST['password'], $user['password'])) {
            // Set the session variable
            $_SESSION['username'] = $user['username'];

            // Redirect to the Home page
            header('Location: \WEB PROJECT\Home.html');
            exit;
        }
    }

    // Display an error message and redirect to the registration.html page
    echo "<script>alert('Invalid username or password'); window.location.href = /WEB PROJECT/registration.html ;</script>";
    exit;
}
