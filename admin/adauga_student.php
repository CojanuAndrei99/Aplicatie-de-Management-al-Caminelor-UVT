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
    <form style="position:relative;top:5%;" name="form" action="php_form/adauga_student_form.php" method="post">
        <div class="modificarepanel center_div textpanel">
            <div style="transform:translate(35%,0%);">
                <p>Adauga student</p><br></div>
            <label for="nume">Nume student:</label>
            <input style="float: right;" type="text" id="nume" name="nume" size="30"><br>
            <label for="cnp">CNP:</label>
            <input style="float: right;" type="text" id="cnp" name="cnp" size="30"><br>
            <label for="sex">Sex:</label>
            <select style="float: right;" id="sex" name="sex">
                <option value="m">M</option>
                <option value="f">F</option>
            </select><br>
            <label for="data_nasterii">Data nasterii:</label>
            <input style="float: right;" type="date" id="data_nasterii" name="data_nasterii" size="30"><br>
            <label for="adresa">Adresa:</label>
            <input style="float: right;" type="text" id="adresa" name="adresa" size="30"><br>
            <label for="email">E-mail:</label>
            <input style="float: right;" type="text" id="email" name="email" size="30"><br>
            <label for="telefon">Telefon:</label>
            <input style="float: right;" type="text" id="telefon" name="telefon" size="30"><br>
            <label for="facultate">Facultate si specializarea:<br></label>
            <select id="specializarea" name="specializarea">
                <?php
                    include('../config.php');
            
                    $sql="SELECT ID_fac,nume from Facultati";
                    $result=$conn->query($sql);
                    if($result->num_rows>0)
                    {
                        while($row=$result->fetch_assoc())
                        {
                            echo "<option disabled style='background-color:#333;' value='".$row["ID_fac"]."'>".$row["nume"]."</option>";
                            $sql1="SELECT ID_spec,nume from Specializari where ID_fac='$row[ID_fac]'";
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