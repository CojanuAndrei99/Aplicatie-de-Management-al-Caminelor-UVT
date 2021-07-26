<?php
    include('../../config.php');
            
    $nume_err=$telefon_err=$email_err=$facultate_err=$username_err=$password_err="";
    if($_POST['nume']!=null)
    {
        $nume=$_POST['nume'];
    }
    else{
        $nume_err="Campul nume nu este completat!";
    }
    if($_POST['telefon']!=null)
    {
        $telefon=$_POST['telefon'];
    }
    else{
        $telefon_err="Campul tefefon nu este completat!";
    }
    if($_POST['email']!=null)
    {
        $email=$_POST['email'];
    }
    else{
        $email_err="Campul email nu este completat!";
    }
    if($_POST['facultate']!=null)
    {
        $ID_fac=$_POST['facultate'];
    }
    else{
        $facultate_err="Campul facultate nu este completat!";
    }
    if($_POST['username']!=null)
    {
        $username=$_POST['username'];
    }
    else{
        $username_err="Campul username nu este completat!";
    }
    if($_POST['password']!=null)
    {
        $password=$_POST['password'];
    }
    else{
        $password_err="Campul password nu este completat!";
    }
    
        
    if($nume_err==null and $telefon_err==null and $email_err==null and $facultate_err==null and $username_err==null and $password_err==null)
    {
        $sql1="select username from User where username='$username'";
        $res1=$conn->query($sql1);
        if($res1->num_rows==0){
            
            $sql_user="insert into User(username,password,tip_cont) values ('$username','$password',1);";
            if ($conn->query($sql_user) == TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Un nou user a fost adaugat cu succes!");';
                echo '</script>';
            } 
            else{
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql,'");';
                echo 'window.location = "../adauga_secretar.php";';
                echo '</script>';
                return;

            }
            $sql_secr="insert into Secretari(username,ID_fac,Nume,Telefon,E_mail) values ('$username','$ID_fac','$nume','$telefon','$email');";echo '<script language="javascript">';
                echo 'alert("Un nou user a fost adaugat cu succes!");';
                echo '</script>';
            if ($conn->query($sql_secr) == TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Un nou secretar a fost adaugat cu succes!");';
                echo 'window.location = "../adauga_secretar.php";';
                echo '</script>';
            } 
            else{
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql,'");';
                echo 'window.location = "../adauga_secretar.php";';
                 echo '</script>';
                 return;
            }
        }
        else{
            echo '<script language="javascript">';
                echo 'alert("Mai exista un username identic!");';
                echo 'window.location = "../adauga_secretar.php";';
                 echo '</script>';
        }
    }
    else{
        echo '<script language="javascript">';
        echo 'alert("',$username_err,'\n',$password_err,'\n',$nume_err,'\n',$telefon_err,'\n',$email_err,'\n',$facultate_err,'");';
        echo 'window.location = "../adauga_secretar.php";';
        echo '</script>';
    }
   
     $conn->close();
?>