<?php
session_start(); 

if( isset($_SESSION["s_name"]) && isset($_SESSION["s_pswd"]) ) {
    $s_email = $_SESSION["s_name"] ;
    $s_pass = $_SESSION["s_pswd"] ;
    $q = "SELECT * FROM logindata where email='$s_email';" ;
    if( $s_email!="" && $s_pass!="" ) { 
        $conn = mysqli_connect("localhost", "root", "", "webdb"); 
        if($conn) {
            $r = mysqli_query($conn, $q) ;
            if(!$r) {
                mysqli_close($conn) ; 
            }
            elseif($row = $r->fetch_assoc()) {
                $upass = $row["pass"] ;
                if( $s_pass == $upass ) { // "passwords match." ; 
                    echo `<script></script>`;
                }
                else {}
            }
            mysqli_close($conn) ;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link type="text/css" rel="stylesheet" href="task3.css"/>
    <title>Home</title>
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
            <a href="Profile.php" id="" style="display:none;">
                <div><i class="fa-regular fa-user" style="color: #111b2c;"></i></div>
            </a>
            <a><div class="nav-link">About</div></a>
            <a><div class="nav-link">Home</div></a>
            <a><div class="nav-link">Contact us</div></a>
        </nav>
        
    </header>
    <main>
        <h2 class="home-head"> A place where literature meets creativity. </h2>
        <section>
            <div class="book-list">
                <div class="books">
                    <div class="book-cover"></div>
                </div>
                <div class="books">
                    <div class="book-cover"></div>
                </div>
                <div class="books">
                    <div class="book-cover"></div>
                </div>
                <div class="books">
                    <div class="book-cover"></div>
                </div>
                <div class="books">
                    <div class="book-cover"></div>
                </div>
                <div class="books">
                    <div class="book-cover"></div>
                </div>
            </div>
        </section>
    </main>
    <footer></footer>
</body>

</html>