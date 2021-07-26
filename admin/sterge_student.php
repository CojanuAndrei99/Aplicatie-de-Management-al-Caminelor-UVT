
<html>

<head>
    <link rel="stylesheet" href="css/editare_secretari_style.css" type="text/css">
    <link rel="stylesheet" href="css/admin_styles.css" type="text/css">

</head>

<body style="overflow-y: auto;">
<div><br></div>
    <?php
        require_once("nav_bar.php");
    ?>
    <table id="tabel"  style="position:relative;top:5%;">
        <tr>
            <th >Matricola</th> 
            <th >Nume</th>	
            <th >CNP</th>	
            <th >Sex</th>	
            <th >Data nasterii</th>	
            <th >Adresa</th>	
            <th >E-mail</th>	
            <th >Telefon</th>	
            <th >Facultatea</th>	
            <th >Specializarea</th>	
            <th >An curent</th>
            <th >Bugetat</th>	
            <th >Medie admitere</th>	
            <th >Nume camin</th>	
            <th >Numar camera</th>
        </tr>
        <?php
            include('../config.php');
            
            $sql = "SELECT * FROM Studenti";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    $id=$row["ID_fac"];
                    $sql1="SELECT nume from facultati where ID_fac='$id'";
                    $result1=$conn->query($sql1);
                    $fac=$result1->fetch_assoc();

                    $id_s=$row["ID_spec"];
                    $sql2="SELECT nume from specializari where ID_spec='$id_s'";
                    $result2=$conn->query($sql2);
                    $spec=$result2->fetch_assoc();

                    $id_c=$row["ID_Camin"];
                    $sql3="SELECT nume from camine where ID_Camin='$id_c'";
                    $result3=$conn->query($sql3);
                    if($result3->num_rows>0)
                      $camin=$result3->fetch_assoc();
                    else
                      $camin["nume"]="0";

                    echo "<tr><td>" . $row["Matricola"]. "</td><td>" .$row["Nume"] . "</td><td>". $row["CNP"]. "</td><td>". $row["Sex"]. "</td><td>". $row["data_nasterii"]. "</td><td>". $row["Adresa"]. "</td><td>". $row["E_mail"]. "</td><td>". $row["Telefon"]. "</td><td>". $fac["nume"]. "</td><td>".$spec["nume"]. "</td><td>". ($row["An_curent"]!=null?$row["An_curent"]:"1"). "</td><td>". ($row["Bugetat"]!=null?$row["Bugetat"]:"0"). "</td><td>". ($row["Media_admitere"]!=null?$row["Media_admitere"]:"0"). "</td><td>".( $camin["nume"]!=null?$camin["nume"]:"-"). "</td><td>". ($row["Numar_camera"]!=null?$row["Numar_camera"]:"-"). "</td></tr>";
            }
            } else { echo "<tr><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td></tr>"; }
            $conn->close();
        ?>
        </table>
    <div class="center_div"></div>
    <form name="form" action="php_form/sterge_student_form.php" method="post">
        <div class="center_div modificarepanel" style="float: left;">
            <div style="padding-left: 10%;">
                <p>Stergere student</p>
            </div>
            <Label for="id">Sterge studentul cu  </Label>
            <select onchange="val()" id="coloana" name="coloana">
                <option value="matricola">Matricola</option>
                <option value="nume">Nume</option>
                <option value="CNP">CNP</option>
                <option value="sex">Sex</option>
                <option value="data_nasterii">Data nasterii</option>
                <option value="adresa">Adresa</option>
                <option value="an_curent">An curent</option>
                <option value="bugetat">Bugetat</option>
                <option value="media_admitere">Media de admitere</option>
                <option value="nume_camin">Nume camin</option>
                <option value="numar_camera">Numar camera</option>
                <option value="telefon">Telefon</option>
                <option value="E_mail">E-mail</option>
                <option value="ID_fac">Facultatea</option>
                <option value="ID_spec">Specializarea</option>
            </select>
            <div><br></div>
            <select id="facultatea" name="facultatea" style="position:relative;top:10px;display:none;width:250px;">
                <?php
                        $conn = mysqli_connect("localhost","root", "","proiect_colectiv");
                        // Check connection
                        if($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql="SELECT ID_fac,nume from facultati";
                        $result=$conn->query($sql);
                        if($result->num_rows>0)
                        {
                            while($row=$result->fetch_assoc())
                            {
                                echo "<option value='".$row["ID_fac"]."'>".$row["nume"]."</option>";
                            }
                        }
                        else{
                            echo "<option value='no_result'>No Result</option>";
                        }
                        $conn->close();
                ?>
            </select>
            <select id="specializarea" name="specializarea" style="position:relative;top:10px;display:none;width:250px;">
                <?php
                        $conn = mysqli_connect("localhost","root", "","proiect_colectiv");
                        // Check connection
                        if($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql="SELECT ID_spec,nume from specializari";
                        $result=$conn->query($sql);
                        if($result->num_rows>0)
                        {
                            while($row=$result->fetch_assoc())
                            {
                                echo "<option value='".$row["ID_spec"]."'>".$row["nume"]."</option>";
                            }
                        }
                        else{
                            echo "<option value='no_result'>No Result</option>";
                        }
                        $conn->close();
                ?>
            </select>
            <input type="text" id="text" name="text">
            <input type="date" id="data" name="data" style="display:none;">
            <script>
                function val()
                {
                    var scroll_orig=document.getElementById("coloana");
                    var str_orig=scroll_orig.options[scroll_orig.selectedIndex].value;
                    if(str_orig=="ID_fac")
                    {
                        document.getElementById("data").style.display="none";
                        document.getElementById("text").style.display="none";
                        document.getElementById("facultatea").style.display="block";
                        document.getElementById("specializarea").style.display="none";
                   } 
                    else if(str_orig=="ID_spec"){
                        document.getElementById("data").style.display="none";
                        document.getElementById("facultatea").style.display="none";
                        document.getElementById("text").style.display="none";
                        document.getElementById("specializarea").style.display="block";
                    }
                    else if(str_orig=="data_nasterii"){
                        document.getElementById("data").style.display="block";
                        document.getElementById("facultatea").style.display="none";
                        document.getElementById("text").style.display="none";
                        document.getElementById("specializarea").style.display="none";
                    }else{
                        document.getElementById("data").style.display="none";
                        document.getElementById("facultatea").style.display="none";
                        document.getElementById("text").style.display="block";
                        document.getElementById("specializarea").style.display="none";
                    }

                }
            </script>
            <div><br></div>
            <button style="float:right;" type="submit" class="addbutton">Sterge</button>

        </div>
        
        <div style="padding-bottom: 500px;"><br></div>
    </form>
</body>

</html>