<?php
    include('../../config.php');
            
    $fac=$text=$col="";
    $col=$_POST["coloana"];
    $text=$_POST['text'];
    if($col=="ID_fac")
        $fac=$_POST["facultatea"];
    if(($text!=null  and $fac==null) or ($fac!=null))
    {
        if($text==null)
            $text=$fac;
        $sql_user="select username from secretari where $col='$text';";
        $result=$conn->query($sql_user);
        if($result->num_rows>0)
        {
            while($row=$result->fetch_assoc())
            {
                $username=$row["username"];
                $sql_del = "delete from user where username='$username';";
                if ($conn->query($sql_del) != TRUE) {
                    echo '<script language="javascript">';
                    echo 'alert("User nesters!");';
                    echo '</script>';
                }
    
            }
            $sql = "delete from secretari where $col='$text';";
            if ($conn->query($sql) == TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Secretar sters cu succes!");';
                echo 'window.location = "../sterge_secretar.php";';
                echo '</script>';
            } 
            else {
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql,'");';
                echo 'window.location = "../sterge_secretar.php";';
                echo '</script>';
            }

        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Nu exista secretari!");';
            echo 'window.location = "../sterge_secretar.php";';
            echo '</script>';
            return;
        }
        $conn->close();

    }
    else
    {
        echo '<script language="javascript">';
            echo 'alert("Camp incomplet!");';
            echo 'window.location = "../sterge_secretar.php";';
            echo '</script>';
    }
?>