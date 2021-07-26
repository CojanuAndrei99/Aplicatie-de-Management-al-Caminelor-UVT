<?php
    include('../../config.php');
            
    $col=$_POST["coloana"];
    $text=$_POST['text'];
    if($_POST['text']!=null)
    {
        $sql = "delete from camine where $col='$text';";
        if ($conn->query($sql) == TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Camin sters cu succes!");';
            echo 'window.location = "../sterge_camin.php";';
            echo '</script>';
        } 
        else {
            echo '<script language="javascript">';
            echo 'alert("Error:',$sql,'");';
            echo 'window.location = "../sterge_camin.php";';
            echo '</script>';
        }
         $conn->close();

    }
    else
    {
        echo '<script language="javascript">';
            echo 'alert("Camp incomplet!");';
            echo 'window.location = "../sterge_camin.php";';
            echo '</script>';
    }
?>