<?php
    include('../../config.php');
            
    $nume_err=$cnp_err=$data_nasterii_err=$adresa_err=$telefon_err=$email_err=$specializarea_err=$username_err=$password_err="";
    if($_POST['nume']!=null)
    {
        $nume=$_POST['nume'];
    }
    else{
        $nume_err="Campul nume nu este completat!";
    }
    if($_POST['cnp']!=null)
    {
        $cnp=$_POST['cnp'];
    }
    else{
        $cnp_err="Campul cnp nu este completat!";
    }
    if($_POST['data_nasterii']!=null)
    {
        $data_nasterii=$_POST['data_nasterii'];
    }
    else{
        $data_nasterii_err="Campul data_nasterii nu este completat!";
    }
    if($_POST['adresa']!=null)
    {
        $adresa=$_POST['adresa'];
    }
    else{
        $adresa_err="Campul adresa nu este completat!";
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
    if($_POST['specializarea']!=null)
    {
        $specializarea=$_POST['specializarea'];
    }
    else{
        $specializarea_err="Campul specializarea nu este completat!";
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
    $sex=$_POST["sex"];
        
    if($nume_err==null and $cnp_err==null and $data_nasterii_err==null and $adresa_err==null and $telefon_err==null and $email_err==null and $specializarea_err==null and $username_err==null and $password_err==null)
    {
        $sql1="select username from user where username='$username'";
        $res1=$conn->query($sql1);
        if($res1->num_rows==0){
            $sql_id="select ID_fac from specializari where ID_spec='$specializarea'";
            $res_id=$conn->query($sql_id);
            $ID_fac=$res_id->fetch_assoc()["ID_fac"];
            $sql_user="insert into user(username,password,tip_cont) values ('$username','$password',2);";
            if ($conn->query($sql_user) == TRUE) {
                echo '<script language="javascript">';
                echo 'alert("Un nou user a fost adaugat cu succes!");';
                echo '</script>';
            } 
            else{
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql_user,'");';
                echo 'window.location = "../adauga_student.php";';
                 echo '</script>';
                 return;

            }
            $sql_secr="insert into studenti(username,nume,cnp,sex,data_nasterii,adresa,e_mail,telefon,ID_fac,ID_spec, An_curent, Bugetat, Media_admitere, ID_Camin, Numar_camera) values ('$username','$nume','$cnp','$sex','$data_nasterii','$adresa','$email','$telefon','$ID_fac','$specializarea','1','0','0','0','0');";
            if ($conn->query($sql_secr) == TRUE) {
                
                echo '<script language="javascript">';
                echo 'alert("Un nou student a fost adaugat cu succes!");';
                echo 'window.location = "../adauga_student.php";';
                echo '</script>';
                return;
            } 
            else{
                echo '<script language="javascript">';
                echo 'alert("Error:',$sql_secr,'");';
                echo 'window.location = "../adauga_student.php";';
                 echo '</script>';
                 return;
            }
        }
        else{
            echo '<script language="javascript">';
                echo 'alert("Mai exista username identic!");';
                echo 'window.location = "../adauga_student.php";';
                 echo '</script>';
                 return;
        }
    }
    else{
         echo '<script language="javascript">';
    echo 'alert("',$nume_err,'\n ',$cnp_err,'\n ',$data_nasterii_err,'\n ',$adresa_err,'\n' ,$telefon_err,'\n' ,$email_err,'\n' ,$specializarea_err,'\n' ,$username_err,'\n ',$password_err,'");';
    echo 'window.location = "../adauga_student.php";';
    echo '</script>';
    }
   
     $conn->close();
?>