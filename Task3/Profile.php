<?php
session_start();
if( !isset($_SESSION["s_name"]) || $_SESSION["s_name"]=="" ) {
    //session_destroy();
    echo '<script type="text/javascript"> location.assign("Start.php"); </script>' ;
}
elseif( !isset($_SESSION["s_pswd"]) ) {
    session_destroy();
    echo '<script type="text/javascript"> location.assign("Start.php"); </script>' ;
}
else { 
    $s_email = $_SESSION["s_name"] ;
    $s_pass = $_SESSION["s_pswd"] ;
    $q = "SELECT * FROM logindata where email='$s_email';" ;
    $conn = mysqli_connect("localhost", "root", "", "webdb");
    if($conn) {
        $r = mysqli_query($conn, $q) ;
        if($r) {
            if($row = $r->fetch_assoc()) {
                $uname = $row["name"];
                $uemail = $row["email"];
                $upass = $row["pass"] ;
                $ugender = $row["gender"];
                $ucntry = $row["country"];
                if( $s_pass != $upass ) { 
                    mysqli_close($conn) ;
                    // "passwords donot match." ; 
                    echo '<script type="text/javascript"> locatio.assign("Start.php"); </script>' ;
                }
                echo `<script type="text/javascript">iconOn();</script>` ;
            }
        }
    }
    mysqli_close($conn) ;
}
?>

<?php
if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $_SESSION["s_name"] = "" ;
    $_SESSION["s_pswd"] = "" ;
    session_destroy();
    $uname = $uemail = $upass = $ugender = $ucntry = $upass = "" ;
    echo '<script type="text/javascript"> location.assign("SignIn.php"); </script>' ;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
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
            <a href="SignIn.php" id="login">
                <div class="nav-link">Log in</div>
            </a>
            <a href="Profile.php" id="picon" style="display:none;">
                <div><i class="fa-regular fa-user" style="color: #111b2c;"></i></div>
            </a>
            <a><div class="nav-link">About</div></a>
            <a href="Start.php"><div class="nav-link">Home</div></a>
            <a><div class="nav-link">Contact us</div></a>
        </nav>
        
    </header>
    <main>
        <h2> Welcome <?php echo $uname ; ?></h2>
        <section>
            <div>
                Your Profile
            </div>
            <div>
                <span>Name: </span><?php echo $uname ; ?>
                <br>
                <span>email: </span><?php echo $uemail ; ?>
                <br>
                <span>Gender: </span><?php echo $ugender ; ?>
                <br>
                <span>Country: </span><?php echo $ucntry ; ?>
            </div>
        </section>
        <section class="profile-form">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="submit-button">
                    <input type="submit" value="LOGOUT"><i class="fa-solid fa-arrow-right-from-bracket" style="color: #125429;"></i>
                </div>
            </form>
        </section>
    </main>
    <footer></footer>
</body>

</html>