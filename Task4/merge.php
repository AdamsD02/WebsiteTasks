<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php 
$len1 = $len2 =0;
$op = "";
$arr1 ; $arr2 ;
$txt1 =  $txt2 = "" ;
if( isset($_POST['submit'])) {
    $txt1 = $_POST['text1'] ;
    $txt2 = $_POST['text2'] ;
    if(!empty($txt1) && !empty($txt2) ) { 
        $arr1 = explode("\n", $txt1) ;
        $arr2 = explode("\n", $txt2) ;

        $len1 = count($arr1);
        $len2 = count($arr2);
        for($i=0 ;$i<$len1;$i++) {
            for($j=0 ;$j<$len2;$j++)
            {
                $str = trim($arr1[$i]) . $arr2[$j] ;
                $op .= $str ;
                // echo strlen($str);
            }
            $op .= "\n"; 
        }
        
    }
}
?>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" >
    <h1>Merge Words</h1>
    <p>Merge words, fast and easy.Use it for domain registrations,Google Adwords, whatever.</p>
    <textarea name="text1" rows="10" cols="30" ><?php echo $txt1 ; ?></textarea>
    <textarea name="text2" rows="10" cols="30" ><?php echo $txt2 ; ?></textarea>
    <br><br>
    No. of combinations: <?php echo $len1*$len2 ; ?>
    <br>
    <textarea name="text3" rows="10" cols="30" ><?php echo $op ; ?></textarea>
    <br><br>
    <input type="submit" name="submit" value="submit">
    </form>
</body>

</html>