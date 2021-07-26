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
            <th>Matricola</th> 
            <th>Nume</th>	
            <th>CNP</th>	
            <th>Sex</th>	
            <th>Data nasterii</th>	
            <th>Adresa</th>	
            <th>E-mail</th>	
            <th>Telefon</th>	
            <th>Facultatea</th>	
            <th>Specializarea</th>	
            <th>An curent</th>
            <th>Bugetat</th>	
            <th>Medie admitere</th>	
            <th>Nume camin</th>	
            <th>Numar camera</th>
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
    <div><br><br></div>
    <form id="form" name="form" action="php_form/modificare_student_form.php" method="post">
        <div id="int_form" class="center_div modificarepanel" style="float: left;">
            <div  style="padding-left: 3%;left:50%;">
                <p>Modificare student</p>
            </div>
            <Label for="coloana_modificat">Modifica </Label>
            <select onchange="val_modif()" id="coloana_modificat" name="coloana_modificat">
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
                <option value="ID_spec">Specializarea</option>
            </select><div>in </div>
            <input type="text" id="modificat" name="modificat">
            <input type="date" id="modificat_date" name="modificat_date" style="position:relative;display:none;">
            <select id="specializarea_modif" name="specializarea_modif" style="position:relative;display:none;width:250px;">
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
                            echo "<option disabled style='background-color:#333;' value='".$row["ID_fac"]."'>".$row["nume"]."</option>";
                            $sql1="SELECT ID_spec,nume from specializari where ID_fac='$row[ID_fac]'";
                            $result1=$conn->query($sql1);
                            if($result1->num_rows>0)
                            {
                                while($row1=$result1->fetch_assoc())
                                {
                                    echo "<option style='padding-left:10px;' value='".$row1["ID_spec"]."'>".$row1["nume"]."</option>";
                                }
                            }
                            else{
                                echo "<option value='no_result'>No Result</option>";
                            }
                        }
                    }
                    else{
                        echo "<option value='no_result'>No Result</option>";
                    }
                    $conn->close();
                ?>
            </select>
            <script>
                function val_modif()
                {
                    var scroll_orig=document.getElementById("coloana_modificat");
                    var str_orig=scroll_orig.options[scroll_orig.selectedIndex].value;
                    if(str_orig=="ID_spec"){
                        document.getElementById("modificat_date").style.display="none";
                        document.getElementById("modificat").style.display="none";
                        document.getElementById("specializarea_modif").style.display="block";
                    }else if(str_orig=="data_nasterii"){
                        document.getElementById("modificat_date").style.display="block";
                        document.getElementById("modificat").style.display="none";
                        document.getElementById("specializarea_modif").style.display="none";
                    }else{
                        document.getElementById("modificat_date").style.display="none";
                        document.getElementById("modificat").style.display="block";
                        document.getElementById("specializarea_modif").style.display="none";
                    }
                }
            </script>
            <div>pentru studentii cu </div><select onchange="val_orig()" id="coloana_original" name="coloana_original">
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
                <option value="ID_spec">Specializarea</option>
            </select><br>
            <input type="text" id="original" name="original" style="position:relative;top:10px;">
            <input type="date" id="original_date" name="original_date" style="position:relative;top:10px;display:none;">
            <select id="specializarea_orig" name="specializarea_orig" style="position:relative;top:10px;display:none;width:250px;">
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
                            echo "<option disabled style='background-color:#333;' value='".$row["ID_fac"]."'>".$row["nume"]."</option>";
                            $sql1="SELECT ID_spec,nume from specializari where ID_fac='$row[ID_fac]'";
                            $result1=$conn->query($sql1);
                            if($result1->num_rows>0)
                            {
                                while($row1=$result1->fetch_assoc())
                                {
                                    echo "<option style='padding-left:10px;' value='".$row1["ID_spec"]."'>".$row1["nume"]."</option>";
                                }
                            }
                            else{
                                echo "<option value='no_result'>No Result</option>";
                            }
                        }
                    }
                    else{
                        echo "<option value='no_result'>No Result</option>";
                    }
                    $conn->close();
                ?>
            </select>
            <script>
                function val_orig()
                {
                    var scroll_orig=document.getElementById("coloana_original");
                    var str_orig=scroll_orig.options[scroll_orig.selectedIndex].value;
                    if(str_orig=="ID_spec"){
                        document.getElementById("original_date").style.display="none";
                        document.getElementById("original").style.display="none";
                        document.getElementById("specializarea_orig").style.display="block";
                    }else if(str_orig=="data_nasterii"){
                        document.getElementById("original_date").style.display="block";
                        document.getElementById("original").style.display="none";
                        document.getElementById("specializarea_orig").style.display="none";
                    }else{
                        document.getElementById("original_date").style.display="none";
                        document.getElementById("original").style.display="block";
                        document.getElementById("specializarea_orig").style.display="none";
                    }

                }
            </script><div><br></div>
            <button style="float:right;" type="submit" class="addbutton">Modifica</button>

        </div>
        <div style="padding-bottom: 500px;"><br></div>
    </form>
</body>

</html>