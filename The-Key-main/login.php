<?php


// Database connection
$host = 'localhost';
$dbname = 'securitydb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}

// Function to authenticate user
function authenticate($pdo, $user, $pass) {
    // Prepare SQL statement
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $user]);
    $user = $stmt->fetch();

    // Verify password
    if ($user) {
        // Check if the password is already hashed
        if (password_verify($pass, $user['password'])) {
            return $user;
        } 
        // If the password is not hashed (plain text), update it with a hashed version
        elseif ($user['password'] === $pass) {
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $update_stmt = $pdo->prepare("UPDATE users SET password = :hashed_password WHERE username = :username");
            $update_stmt->execute(['hashed_password' => $hashed_password, 'username' => $user['username']]);
            return $user;
        }
    }
    return false;
}


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate user
    $user = authenticate($pdo, $username, $password);

    if ($user) {
        // Successful login
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Failed login
        $error = "Nom d'utilisateur ou mot de passe incorrect";
    }
}

include "header.php";
?>


    <main class="main">


    

        <div class="flex-container">
            <div class="content-container">
              <div class="form-container">
                <form action="login.php" method="POST">
                  <h1 style="text-align: center">
                    Se Connecter
                  </h1>
                  <br>
                  <p style="color: red; font-size: small"></p>
                  <br>
                  <span class="subtitle">Nom d'utilisateur:</span>
                  <br>
                  <input type="text" name="username" value="">
                  <br>
                  <span class="subtitle">Mot de Passe :</span>
                  <br>
                  <input type="password" name="password" value="">
                  <br><br>
                  <input type="submit" value="Connexion" class="button-flex">
                </form>
              </div>
            </div>
          </div>

          </main>

          <?php include "footer.php" ?>