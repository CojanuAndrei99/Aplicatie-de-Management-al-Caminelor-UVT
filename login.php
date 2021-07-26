<?php
session_start();

    $conn = mysqli_connect("localhost", "id13557163_system", "L++QjA\$rAr~d21J3", "id13557163_camine");

    if($conn === false){
        die("EROARE: " . mysqli_connect_error());
    }
    $username = $password = $tip_cont = "";
    $username_err = $password_err = "";
	
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }


    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT username, password, tip_cont FROM User WHERE username ='$username'";
        $result=$conn->query($sql);
        if($result->num_rows> 0){                    
            $res=$result->fetch_assoc();
            if($password== $res["password"]){
                $tip_cont=$res["tip_cont"];
                switch($tip_cont)
                {
                    case 0:{
                        header("location: admin/home.php");
                        break;
                    }
                    case 1:{
                        header("location: secretar/secretar.html");
                        break;
                    }
                    case 2:{
                        header("location: student/student.html");
                        break;
                    }
                }
                

            } else{
                $password_err = "The password you entered was not valid.";
            } 
        } else{
            $username_err = "No account found with that username.";
        }
        $conn->close();
    }
    //Alert box for errors
    echo '<script language="javascript">';
    echo 'alert("',$username_err,'\n',$password_err,'");';
    echo 'window.location = "index.html";';
    echo '</script>';

?>