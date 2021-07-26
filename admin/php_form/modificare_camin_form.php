<?php
    include('../../config.php');
            
    $original=$_POST['original'];
    $modificat=$_POST['modificat'];
    $coloana_orig=$_POST['coloana_original'];
    $coloana_modif=$_POST['coloana_modificat'];
    if($_POST['original']!=null and $_POST['modificat']=!null)
    {
        $sql = "update camine set $coloana_modif='$modificat' where $coloana_orig='$original'";
        if ($conn->query($sql) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Valoare modificata cu succes!");';
            echo 'window.location = "../modificare_camin.php";';
            echo '</script>';
        } 
        else {
            echo '<script language="javascript">';
            echo 'alert("Error:',$sql,'");';
            echo 'window.location = "../modificare_camin.php";';
            echo '</script>';
        }
    }
    else {
            echo '<script language="javascript">';
            echo 'alert("Campuri necompletate in formular!");';
            echo 'window.location = "../modificare_camin.php";';
            echo '</script>';
        }
     $conn->close();
?>