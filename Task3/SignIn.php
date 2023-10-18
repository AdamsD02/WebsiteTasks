<?php
// session_start();
// if( isset(session_name())) {
// }
// session_destroy();

function isRegi($email) {
    $conn = mysqli_connect("loaclhost","root", "", "db_name");
    if($conn) {
        $q = "SELECT * FROM table_name WHERE uid=$email ;" ;
        $r = mysqli_query($conn, $q);
        if($r) {
            
        }
    }
    
    return true;
}
$pswdErr = $uidErr = "";
$pswd = $uid = "";

if( $_SERVER["RQUEST_METHOD"] == "POST" ) {
    if(empty($_POST["userid"])) {
        $uidErr = "Please enter user ID." ;
    }
    elseif( !filter_var($uid, FILTER_VALIDATE_EMAIL) ) {
        $uidErr = "Invalid email id." ;
    }
    elseif( !isRegi($uid) ) {
        $uidErr = "User not Registered." ;
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
            <div>
                <span class="req">* Required field. </span>
                <?php
                if( $uidErr != "" ) {
                    echo '<span class="req">' . $uidErr . '</span>';
                }
                elseif( $pswdErr != "" ) {
                    echo '<span class="req">' . $pswdErr . '</span>';
                }
                ?>
            </div>
        </section>
    </main>

</body>
</html>