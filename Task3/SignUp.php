<?php
session_start();
if( isset($_SESSION["s_name"])) {
    if( isset($_SESSION["s_pswd"]))
    {
        echo '<script type="text/javascript"> window.open("Profile.php");' ;
    }
}
?>

<?php
$pswd = $uid = $cpswd = "" ;
$pswdErr = $uidErr = $cpswdErr = "" ;
$dbpswd = "" ;

function isRegi($email) {
    $conn = mysqli_connect("loaclhost","root", "", "db_name");
    if($conn) {
        $q = "SELECT * FROM table_name WHERE uid=$email ;" ; 
        $r = mysqli_query($conn, $q); 
        if($r) { 
           return true;
        }
    }
    return false;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    if( empty($_POST["userid"]) ) {
        $uidErr = "Please enter user ID." ;
    }
    else {
        $uid = test_input($_POST["userid"]) ;
        if( !filter_var($uid, FILTER_VALIDATE_EMAIL) ) {
            $uidErr = "User ID invalid." ;
        }
        elseif( isRegi($uid) ) {
            $uidErr = "User is Registered. Try to login." ;
        }
        else{
            if( empty($_POST["pswd"]) ) { 
                $pswdErr = "Please enter Password." ; 
            }
            elseif( empty($_POST["c_pswd"]) ) {
                $cpswdErr = "Please confirm password" ;
            }
            else {
                $pswd = test_input($_POST["pswd"]) ;
                $cpswd = test_input($_POST["c_pswd"]) ;
                if( $pswd != $cpswd ) {
                    $cpswdErr = "Password not matching" ; 
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
    <title>Sign up page</title>
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
        <h2>Sign Up</h2>

        <div style="text-align: left; margin: 5px 20px;">
            <span class="req">* Required field. </span>
        </div>

        <section class="form-section">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Email Id:
                    </label>
                    <input type="text" name="userid" value="<?php echo $uid; ?>">
                </div>
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Enter Password:
                    </label>
                    <input type="password" maxlength="15" minlength="8"
                    name="pswd" value="<?php echo $pswd; ?>" >
                </div>
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Confirm Password:
                    </label>
                    <input type="password" maxlength="15" minlength="8"
                    name="c_pswd" value="<?php echo $pswd; ?>" >
                </div>
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Gender: 
                    </label>
                    <input type="radio" name="gen" value="m" > Male.
                    <input type="radio" name="gen" value="f" > Female.
                    <input type="radio" name="gen" value="o" checked > Others.
                </div>
                <div class="form-elements submit-button">
                    <input type="submit" value="REGISTER">
                </div>
            </form>
            <div>
                Already have account? 
                <a href="SignIn.php" style="color: green;">Login</a>
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