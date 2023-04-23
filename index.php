<?php
include("database.php");
include("header.html");
?>

<body>

    <div style="width: 50%;" class="container my-5">
        <form class="form-floating" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <h1 style='text-align:center;' class="mb-3">Welcome to Fakebook</h1>
            <div class="form-floating mb-3">
                <input name="username" type="text" class="form-control" id="floatingInput" placeholder="name123">
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating">
                <input name="password" type="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-dark mt-3 mb-3">Register</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

            if (!empty($username) && !empty($password)) {

                $hash = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (user, password)
                      VALUES ('$username', '$hash')";

                mysqli_query($conn, $query);

                echo "Hello {$username}. You're successfully registered.";

                mysqli_close($conn);
            } else {
                echo "<span class='text-danger mt-5'>Please don't leave any field blank.</span>";
            }
        }
        ?>
    </div>
</body>
<?php
include("footer.html");
?>
</html>