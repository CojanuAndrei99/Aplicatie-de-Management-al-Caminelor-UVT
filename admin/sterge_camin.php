
<html>

<head>
    <link rel="stylesheet" href="css/editare_camine_style.css" type="text/css">
    <link rel="stylesheet" href="css/admin_styles.css" type="text/css">

</head>

<body style="overflow-y: auto;">
<div><br></div>
    <?php
        require_once("nav_bar.php");
    ?>
    <table id="tabel"  style="position:relative;top:5%;">
            
        <tr>
            <th >ID_camin</th>
            <th >Nume</th>
            <th >Adresa</th>
            <th >Capacitate</th>
        </tr>
        <?php
            include('../config.php');
            
            $sql = "SELECT * FROM Camine";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
            // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["ID_camin"]. "</td><td>" .$row["Nume"] . "</td><td>". $row["Adresa"]. "</td><td>". $row["Nr_camere"]. "</td></tr>";
            }
            } else { echo "<tr><td>No result</td><td>No result</td><td>No result</td><td>No result</td></tr>"; }
            $conn->close();
        ?>
    </table>
    <div class="center_div"></div>
    <form name="form" action="php_form/sterge_camin_form.php" method="post">
        <div class="center_div modificarepanel" style="float: left;">
            <div style="padding-left: 10%;">
                <p>Stergere camin</p>
            </div>
            <Label for="coloana">Sterge caminul cu  </Label>
            <select id="coloana" name="coloana">
                <option value="ID_camin">ID</option>
                <option value="nume">Nume</option>
                <option value="adresa">Adresa</option>
                <option value="Nr_camere">Numar camere</option>
            </select>
            <input type="text" id="text" name="text">
            <br><br>
            <button style="float:right;" type="submit" class="addbutton">Sterge</button>

        </div>
        
        <div style="padding-bottom: 500px;"><br></div>
    </form>
</body>

</html>