<?php
session_start();
if( isset($_SESSION["s_name"])) {
    if( isset($_SESSION["s_pswd"]))
    {
        echo '<script type="text/javascript"> window.open("Profile.php");' ;
    }
}
// session_destroy();
?>

<?php

$pswdErr = $uidErr = "";
$pswd = $uid = "";
$dbpswd = "" ;

function isRegi($email) {
    $conn = mysqli_connect("localhost","root", "", "webdb");
    if($conn) {
        $q = "SELECT * FROM logindata WHERE email='" . $email ."';" ; 
        $r = mysqli_query($conn, $q); 
        if($r) { 
            if( $row = $r->fetch_assoc() ) {
                $dbpswd = $row["pass"];
            }
            else {
                mysqli_close($conn) ;
                return false ;
            }
            mysqli_close($conn) ; 
           return true;
        }
        else {
            echo "failed.<br>" ;
        }
        mysqli_close($conn) ; 
    }
    return false;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
// form validations 
if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    if( empty($_POST["userid"]) ) {
        $uidErr = "Please enter user ID." ;
    }
    else {
        $uid = test_input($_POST["userid"]) ;
        if( !filter_var($uid, FILTER_VALIDATE_EMAIL) ) {
            $uidErr = "User ID invalid." ;
        }
        elseif( !isRegi($uid) ) {
            $uidErr = "User not Registered." ;
        }
        else{
            if( empty($_POST["pswd"]) ) { 
                $pswdErr = "Password invalid." ; 
            }
            else {
                $pswd = test_input($_POST["pswd"]) ;
                if( $pswd != $dbpswd ) {
                    $pswdErr = "Password invalid." ; 
                }
                else {
                    $_SESSION["s_name"] = $uid ;
                    $_SESSION["s_pswd"] = $pswd ;
                    echo '<script type="text/javascript"> window.open("Profile.php"); </script>' ;
                    //login successful.
                }
            }
        }
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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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