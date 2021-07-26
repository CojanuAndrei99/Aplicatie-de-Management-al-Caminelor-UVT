<?php
    include('../../config.php');
            
        $nume=$_POST['nume'];
        $adresa=$_POST['adresa'];
        $capacitate=$_POST['capacitate'];
        if($_POST['nume']!=null and $_POST['adresa']!=null and $_POST['capacitate']!=null)
        {
            $sql = "INSERT INTO Camine(nume,adresa,nr_camere) VALUES ('$nume','$adresa','$capacitate')";
        if ($conn->query($sql) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("New record created successfully");';
            echo 'window.location = "../adauga_camin.php";';
            echo '</script>';
        } 
        else {
            echo '<script language="javascript">';
            echo 'alert("Error:',$sql,'");';
            echo 'window.location = "../adauga_camin.php";';
            echo '</script>';
        }
    }
    else {
            echo '<script language="javascript">';
            echo 'alert("Valori nule in formular!");';
            echo 'window.location = "../adauga_camin.php";';
            echo '</script>';
        }
     $conn->close();
?>