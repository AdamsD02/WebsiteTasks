<?php
// session_start();
// if( !isset($_SESSION["s_name"])) {
//     echo '<script type="text/javascript"> window.open("SignIn.php");' ;
// }
// elseif( !isset($_SESSION["s_pswd"]) ) {
//     echo '<script type="text/javascript"> window.open("SignIn.php");' ;
// }
?>

<?php
// if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
//     $_SESSION["s_name"] = "" ;
//     $_SESSION["s_pswd"] = "" ;
//     session_destroy();
//     echo '<script type="text/javascript"> window.open("SignIn.php");' ;
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="task3.css"/>
    <title>Profile</title>
</head>

<body>
    <header>
        <div>
            <div class="space">logo</div>
            <h1>
                Tome
            </h1>
        </div>
        <nav>
            <a href="SignIn.php">
                <div class="nav-link">Log in</div>
            </a>
            <a><div class="nav-link">About</div></a>
            <a><div class="nav-link">Gallery</div></a>
            <a><div class="nav-link">Contact us</div></a>
        </nav>
        
    </header>
    <main>
        <h2> Your Profile</h2>
        <section class="profile-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="submit-button">
                    <input type="submit" value="LOGOUT">
                </div>
            </form>
        </section>
    </main>
    <footer></footer>
</body>

</html>