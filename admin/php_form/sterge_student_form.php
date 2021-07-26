<?php
    include('../../config.php');
            
    $fac=$text=$col=$data="";
    $col=$_POST["coloana"];
    $text=$_POST['text'];
    if($col=="ID_fac")
        $fac=$_POST["facultatea"];
    if($col=="data_nasterii")
        $data=$_POST["data"];
    echo '<script language="javascript">';
    echo 'alert("',$text,$fac,$data,'");';
    echo '</script>';
    if(($text!=null and $fac==null and $data==null) or ($text==null and $fac!=null and $data==null) or($text==null and $fac==null and $data!=null))
    {
        if($text==null and $fac!=null)
            $text=$fac;
        if($text==null and $data!=null)
            $text=$data;
        
        $sql_user="select username from studenti where $col='$text';";
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
            $sql = "delete from studenti where $col='$text';";
            if ($conn->query($sql) == TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Student sters cu succes!");';
                echo 'window.location = "../sterge_student.php";';
                echo '</script>';
            } 
            else {
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql,'");';
                echo 'window.location = "../sterge_student.php";';
                echo '</script>';
            }

        }
        else{
            echo '<script language="javascript">';
            echo 'alert("Nu exista student!");';
            echo '</script>';
            return;
        }
        $conn->close();

    }
    else
    {
        echo '<script language="javascript">';
            echo 'alert("Camp incomplet!");';
            echo 'window.location = "../sterge_student.php";';
            echo '</script>';
    }
?>