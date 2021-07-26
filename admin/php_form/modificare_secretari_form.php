<?php
    include('../../config.php');
            
    $original=$modificat=$fac_orig=$fac_modif="";
    $original=$_POST['original'];
    $modificat=$_POST['modificat'];
    $coloana_orig=$_POST['coloana_original'];
    $coloana_modif=$_POST['coloana_modificat'];
    if($coloana_orig=="ID_fac")
    {
        $fac_orig=$_POST['facultatea_orig'];
    }
    if($coloana_modif=="ID_fac")
    {
        $fac_modif=$_POST['facultatea_modif'];
    }
    if(($original!=null and $modificat!=null and $fac_modif==null and $fac_orig==null) or ($fac_modif!=null and $fac_orig==null and $original!=null)or($fac_orig!=null and $fac_modif==null and $modificat!=null)or( $fac_modif!=null and $fac_orig!=null))
    {
        if($original==null)
        {
            $original=$fac_orig;
        }
        if($modificat==null)
        {
            $modificat=$fac_modif;
        }
        $sql = "update secretari set $coloana_modif='$modificat' where $coloana_orig='$original'";
        if ($conn->query($sql) === TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Valoare modificata cu succes!");';
            echo 'window.location = "../modifica_secretar.php";';
            echo '</script>';
        } 
        else {
            echo '<script language="javascript">';
            echo 'alert("Error:',$sql,'");';
            echo 'window.location = "../modifica_secretar.php";';
            echo '</script>';
        }
    }
    else {
            echo '<script language="javascript">';
            echo 'alert("Campuri necompletate in formular!");';
            echo 'window.location = "../modifica_secretar.php";';
            echo '</script>';
        }
     $conn->close();
?>