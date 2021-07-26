<html>

<head>
    <link rel="stylesheet" href="css/admin_styles.css" type="text/css">
    <link rel="stylesheet" href="css/editare_secretari_style.css" type="text/css">
</head>

<body style="overflow-y: auto;">
<div><br></div>
    <?php
        require_once("nav_bar.php");
    ?>
    <div class="  center_div"></div>
    <form style="position:relative;top:5%;" name="form" action="php_form/adauga_secretar_form.php" method="post">
        <div class="modificarepanel center_div textpanel">
            <div style="transform:translate(35%,0%);">
                <p>Adauga secretar</p><br></div>
            <label for="nume">Nume secretar:</label>
            <input style="float: right;" type="text" id="nume" name="nume" size="30"><br>
            <label for="telefon">Telefon:</label>
            <input style="float: right;" type="text" id="telefon" name="telefon" size="30"><br>
            <label for="email">E-mail:</label>
            <input style="float: right;" type="text" id="email" name="email" size="30"><br>
            
            <label for="facultate">Facultate:<br></label>
            <select id="facultate" name="facultate">
                <?php
                    include('../config.php');
            
                    $sql="SELECT nume from Facultati";
                    $result=$conn->query($sql);
                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc())
                        {
                            echo "<option value='".$row["nume"]."'>".$row["nume"]."</option>";
                        }
                    }
                    else{
                        echo "<option value='no_result'>No Result</option>";
                    }
                    $conn->close();
                ?>
            </select><br>
            <label for="username">Username:</label>
            <input style="float: right;" type="text" id="username" name="username" size="30"><br>
            <label for="password">Password:</label>
            <input style="float: right;" type="text" id="password" name="password" size="30"><br>

            <br><br>
            <button style="float: right;" type="submit" class="addbutton">Adauga</button>

        </div>
    </form>
</body>

</html>