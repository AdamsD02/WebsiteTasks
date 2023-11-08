<?php
session_start();
if( isset($_SESSION["s_name"]) && isset($_SESSION["s_pswd"]) ) {
    $semail = $_SESSION["s_name"];
    $spass = $_SESSION["s_pswd"];
    $conn = mysqli_connect("localhost", "root", "", "webdb") ;
    if($conn) { 
        $q = "SELECT * FROM logindata WHERE email='$semail';" ;
        $r = mysqli_query($conn, $q) ;
        if(!$r){
            mysqli_close($conn) ;
        }
        elseif($row = $r->fetch_assoc()) {
            $dbpass = $row["pass"] ;
            if( $dbpass == $spass && $spass != "" ) {
                //alert that user is logged in and then goto profile.
            }
            else {
                // hide profile icon. 
            }
        }
        mysqli_close($conn) ;
    }
    else {
        //script to display connection error. and refresh page.
    }
}
?>
 
<?php
$name = $email = $pswd = $cpswd = $gender = $country = "" ;
$nameErr = $emailErr = $pswdErr = $cntyErr = "" ;

function isRegi($email) {
    $conn = mysqli_connect("localhost","root", "", "webdb");
    if($conn) {
        $q = "SELECT * FROM logindata WHERE email='$email' ;" ; 
        $r = mysqli_query($conn, $q); 
        if($r) { 
            if( $row = $r->fetch_assoc() ) {
                mysqli_close($conn) ;
                return true;
            }
            mysqli_close($conn) ; 
            return false;
        }
    }
    mysqli_close($conn) ; 
    return false;
}

function usrRegistration($q) {
    $qr = "" ;
    $conn = mysqli_connect("localhost", "root", "", "webdb") ;
    if($conn) {
        $qr = mysqli_query($conn, $q) ;
        if(!$qr) {
            echo "<br><span class='req'>Error:" . mysqli_error($conn) ."</span><br>";
            mysqli_close($conn) ; 
            return false;
        }
    }
    mysqli_close($conn) ; 
    return true;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    $name = test_input($_POST["u_name"]) ;
    $email = test_input($_POST["userid"]) ;
    $pswd = test_input($_POST["pswd"]) ; 
    $cpswd = test_input($_POST["c_pswd"]) ; 
    $gender = test_input($_POST["gen"]) ;
    $country = test_input($_POST["cntry"]) ;

    if( empty($name) ) {
        $nameErr = "Please enter valid name." ;
    }
    elseif( empty($email) ) {
        $uidErr = "Please enter email." ;
    }
    elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) ) {
        $emailErr = "User email invalid." ;
    }
    elseif( isRegi($email) ) {
        $emailErr = "User is Registered. Try to login." ;
    }
    elseif( empty($_POST["pswd"]) ) { 
        $pswdErr = "Please enter Password." ; 
    }
    elseif( empty($_POST["c_pswd"]) ) {
        $pswdErr = "Please confirm password" ;
    }
    elseif( $pswd != $cpswd ) {
        $pswdErr = "Password not matching" ; 
    }
    elseif( $country == "" ) {
        $cntyErr = "Please select country." ;
    }
    else {
        $_SESSION["s_name"] = $email ;
        $_SESSION["s_pswd"] = $pswd ;
        $q = "INSERT INTO logindata(name, email, pass, country, gender) VALUES('$name', '$email', '$pswd', '$country', '$gender');" ;
        if(usrRegistration($q)) {
            echo '<script type="text/javascript"> window.open("Profile.php"); </script>' ;
            //login successful.
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
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Name :
                    </label>
                    <input type="text" name="u_name" value="<?php echo $name; ?>">
                </div>
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Email Id:
                    </label>
                    <input type="text" name="userid" value="<?php echo $email; ?>">
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
                <div class="form-elements">
                    <label>
                        <span class="req">*</span>
                        Country :
                    </label>
                    <select name="cntry">
                        <option value="" selected>- - </option>
                        <option value="Argentina">Argentina</option>
                        <option value="Canada">Canada</option>
                        <option value="Denmark">Denmark</option>
                        <option value="India">India</option>
                        <option value="USA">U.S.A. </option>
                    </select>
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
            if( $nameErr != "" ) {
                echo '<br><span class="req">' . $nameErr ."</span>" ;
            }
            elseif( $emailErr != "" ) {
                echo '<br><span class="req">' . $emailErr . '</span>';
            }
            elseif( $pswdErr != "" ) {
                echo '<br><span class="req">' . $pswdErr . '</span>';
            }
            elseif( $cntyErr != "" ) {
                echo '<br><span class="req">' . $cntyErr . '</span>';
            }
            ?>
        </div>
    </main>
</body>
</html>