<?php
    include('../../config.php');
            
    $original=$modificat=$fac_orig=$fac_modif=$spec_modif=$spec_orig=$data="";
    $original=$_POST['original'];
    $modificat=$_POST['modificat'];
    $coloana_orig=$_POST['coloana_original'];
    $coloana_modif=$_POST['coloana_modificat'];
    if($coloana_orig=="ID_spec")
    {
        $spec_orig=$_POST['specializarea_orig'];
    }
    if($coloana_modif=="ID_spec")
    {
        $spec_modif=$_POST['specializarea_modif'];
    }
    if($coloana_orig=="data_nasterii")
    {
        $data_orig=$_POST["original_date"];
    }
    if($coloana_modif=="data_nasterii")
    {
        $data_modif=$_POST["modificat_date"];
    }
    if($original==null && $spec_orig!=null)
    {
        $original=$spec_orig;
    }
    if($modificat==null && $spec_modif!=null)
    {
        $modificat=$spec_modif;
    }
    if($modificat==null && $data_modif!=null)
    {
        $modificat=$data_modif;
    }
    if($original==null && $data_orig!=null)
    {
        $original=$data_orig;
    }
    if($original!=null and $modificat!=null)
    {
        if($coloana_modif=="ID_spec")
        {
            $sql_fac="select ID_fac from specializari where ID_spec='$modificat'";
            $result=$conn->query($sql_fac);
            if($result->num_rows>0)
            {
                $id_fac=$result->fetch_assoc()["ID_fac"];
            }
            $sql = "update studenti set $coloana_modif='$modificat', ID_fac='$id_fac' where $coloana_orig='$original'";
            if ($conn->query($sql) == TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Valoare modificata cu succes!");';
                echo 'window.location = "../modifica_student.php";';
                echo '</script>';
            } 
            else {
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql,'");';
                echo 'window.location = "../modifica_student.php";';
                echo '</script>';
            }
        }
        $sql = "update studenti set $coloana_modif='$modificat' where $coloana_orig='$original'";
        if ($conn->query($sql) == TRUE) {
            echo '<script language="javascript">';
            echo 'alert("Valoare modificata cu succes!");';
            echo 'window.location = "../modifica_student.php";';
            echo '</script>';
        } 
        else {
            echo '<script language="javascript">';
            echo 'alert("Error:',$sql,'");';
            echo 'window.location = "../modifica_student.php";';
            echo '</script>';
        }
    }
    else {
            echo '<script language="javascript">';
            echo 'alert("Campuri necompletate in formular!");';
            echo 'window.location = "../modifica_student.php";';
            echo '</script>';
        }
     $conn->close();
?>