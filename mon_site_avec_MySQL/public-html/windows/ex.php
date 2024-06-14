<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="" type="text/css" href="">
        <title>Oracle</title>
    </head>
    <body>

        <form method="POST">
            <input type="submit" id="connect" name="connect" value="conect">
        </form>

        <?php
        
            if (isset($_POST["connect"])){
                echo " hiiiiiiii <br>";
                $conn = oci_connect('system', 'Oracle2024', 'localhost:1521/oracle');
                if (!$conn) {
                    $m = oci_error();echo $m['message'], "\n";exit;
                }else {                      
                    print "Connected to Oracle DB!";
                }
                oci_close($conn);
            }

        ?>
        

    </body>
</html>