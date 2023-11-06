<?php
session_start();
if( isset($_SESSION["s_name"])) {
    if( isset($_SESSION["s_pswd"]))
    {
        echo '<script type="text/javascript"> window.open("Profile.php"); </script>' ;
    }
}
// session_destroy();
?>

<?php

$pswdErr = $uidErr = "";
$pswd = $uid = "";
$dbpswd = "" ;

function isRegi($email) {
    $q = "SELECT * FROM logindata WHERE email='" . $email ."';" ; 
    $conn = mysqli_connect("localhost","root", "", "webdb");
    if(!$conn) {
        echo "Connection error occured." ;
        return false ;
    }
    $r = mysqli_query($conn, $q); 
    if(!$r) { 
        echo "Server Error 301" ;
        mysqli_close($conn) ;
        return false;
    }
    if( $row = $r->fetch_assoc() ) {
        $dbpswd = $row["pass"];
        mysqli_close($conn) ; 
        echo "dbpswd saved<br>" ; 
        return $dbpswd; 
    }
    mysqli_close($conn) ;
    return false ;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// form validations 
if( $_SERVER["REQUEST_METHOD"] == "POST" ) { 
    $uid = test_input($_POST["userid"]) ; 
    $pswd = test_input($_POST["pswd"]) ;
    $dbpswd=isRegi($uid) ;
    if( empty( $uid ) ) {
        $uidErr = "Please enter user ID." ;
    }
    elseif( !filter_var($uid, FILTER_VALIDATE_EMAIL) ) {
        $uidErr = "User ID invalid." ;
    }
    elseif( !$dbpswd ) {
        $uidErr = "User not Registered." ;
    }
    elseif( empty($pswd) ) { 
        $pswdErr = "Password invalid." ; 
    }
    elseif( $pswd != $dbpswd ) {
        $pswdErr = "Password invalid. = $dbpswd " ; 
    }
    else {
        $_SESSION["s_name"] = $uid ;
        $_SESSION["s_pswd"] = $pswd ;
        echo '<script type="text/javascript"> location.assign("Profile.php"); </script>' ;
        //login successful.
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="task3.css">
    <title>log in page</title>
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
            <a href="SignUp.php">
                <div class="nav-link">Sign up</div>
            </a>
            <a><div class="nav-link">About</div></a>
            <a><div class="nav-link">Gallery</div></a>
            <a><div class="nav-link">Contact us</div></a>
        </nav>
        
    </header>
    
    <main>
        <h2>Log In</h2>

        <div style="text-align: left; margin: 5px 20px;">
            <span class="req">* Required field. </span>
        </div>

        <section class="form-section">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Email Id:</label>
                    <input type="text" name="userid" value="<?php echo $uid; ?>">
                </div>
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Password:</label>
                    <input type="password" maxlength="15" minlength="8"
                    name="pswd" value="<?php echo $pswd; ?>" >
                </div>
                <div class="form-elements submit-button">
                    <input type="submit" value="LOGIN">
                </div>
            </form>
            <div>
                Don't have account? 
                <a href="SignUp.php" style="color: green;">Create New!</a>
            </div>
        </section>

        <div>
            <?php
            if( $uidErr != "" ) {
                echo '<br><span class="req">' . $uidErr . '</span>';
            }
            elseif( $pswdErr != "" ) {
                echo '<br><span class="req">' . $pswdErr . '</span>';
            }
            ?>
        </div>
    </main>

</body>
</html>