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
                <th >ID_secretari</th>
                <th >Nume</th>
                <th >Telefon</th>
                <th >E-mail</th>
                <th >Facultate</th>
            </tr>
            <?php
                include('../config.php');
            
                $sql = "SELECT * FROM Secretari";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $arg=$row["ID_fac"];
                        $sql2 = "SELECT nume FROM facultati where ID_fac='$arg'";
                        $result2 = $conn->query($sql2);
                        if($result2->num_rows>0)
                            $row_fac=$result2->fetch_assoc();
                        else
                            $row_fac["nume"]="No result";
                        
                        echo "<tr><td>" . $row["ID_secretar"]. "</td><td>". $row["Nume"]. "</td><td>". $row["Telefon"]. "</td><td>". $row["E_mail"]."</td><td>" .$row_fac["nume"]. "</td></tr>";
                }
                } else { echo "<tr><td>No result</td><td>No result</td><td>No result</td><td>No result</td><td>No result</td></tr>"; }
                $conn->close();
            ?>
        </table>
    <div><br><br></div>
    <form id="form" name="form" action="php_form/modificare_secretari_form.php" method="post">
        <div id="int_form" class="center_div modificarepanel" style="float: left;">
            <div  style="padding-left: 3%;left:50%;">
                <p>Modificare secretar</p>
            </div>
            <Label for="coloana_modificat">Modifica </Label><select onchange="val_modif()" id="coloana_modificat" name="coloana_modificat">
                <option value="nume">Nume</option>
                <option value="telefon">Telefon</option>
                <option value="E_mail">E-mail</option>
                <option value="ID_fac">Facultatea</option>
            </select><div>in </div>
            <input type="text" id="modificat" name="modificat">
            <select id="facultatea_modif" name="facultatea_modif" style="display:none;width:250px;">
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
            <script>
                function val_modif()
                {
                    var scroll_orig=document.getElementById("coloana_modificat");
                    var str_orig=scroll_orig.options[scroll_orig.selectedIndex].value;
                    if(str_orig=="ID_fac")
                    {
                        document.getElementById("modificat").style.display="none";
                        document.getElementById("facultatea_modif").style.display="block";
                   } 
                    else{
                        document.getElementById("facultatea_modif").style.display="none";
                        document.getElementById("modificat").style.display="block";
                    }

                }
            </script>
            <div>pentru secretarele cu </div><select onchange="val_orig()" id="coloana_original" name="coloana_original">
                <option value="ID_secretar">ID</option>
                <option value="nume">Nume</option>
                <option value="telefon">Telefon</option>
                <option value="E_mail">E-mail</option>
                <option value="ID_fac">Facultatea</option>
            </select><br>
            <input type="text" id="original" name="original" style="position:relative;top:10px;">
            <select id="facultatea_orig" name="facultatea_orig" style="position:relative;top:10px;display:none;width:250px;">
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
            <script>
                function val_orig()
                {
                    var scroll_orig=document.getElementById("coloana_original");
                    var str_orig=scroll_orig.options[scroll_orig.selectedIndex].value;
                    if(str_orig=="ID_fac")
                    {
                        document.getElementById("original").style.display="none";
                        document.getElementById("facultatea_orig").style.display="block";
                   } 
                    else{
                        document.getElementById("facultatea_orig").style.display="none";
                        document.getElementById("original").style.display="block";
                    }

                }
            </script><div><br></div>
            <button style="float:right;" type="submit" class="addbutton">Modifica</button>

        </div>
        <div style="padding-bottom: 500px;"><br></div>
    </form>
</body>

</html>