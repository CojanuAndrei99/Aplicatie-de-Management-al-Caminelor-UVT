
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
    <div class="center_div"></div>
    <form name="form" action="php_form/sterge_secretar_form.php" method="post">
        <div class="center_div modificarepanel" style="float: left;">
            <div style="padding-left: 10%;">
                <p>Stergere secretar</p>
            </div>
            <Label for="id">Sterge secretarul cu  </Label>
            <select onchange="val()" id="coloana" name="coloana">
                <option value="ID_secretar">ID</option>
                <option value="nume">Nume</option>
                <option value="telefon">Telefon</option>
                <option value="E_mail">E-mail</option>
                <option value="ID_fac">Facultatea</option>
            </select>
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
            <input type="text" id="text" name="text">
            <script>
                function val()
                {
                    var scroll_orig=document.getElementById("coloana");
                    var str_orig=scroll_orig.options[scroll_orig.selectedIndex].value;
                    if(str_orig=="ID_fac")
                    {
                        document.getElementById("text").style.display="none";
                        document.getElementById("facultatea").style.display="block";
                   } 
                    else{
                        document.getElementById("facultatea").style.display="none";
                        document.getElementById("text").style.display="block";
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