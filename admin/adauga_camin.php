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
        <div class="  center_div"></div>
        <div class="add center_div textpanel">
            <form style="position:relative;top:5%;" name="form" action="php_form/adauga_camin_form.php" method="post">
                <div style="padding-left: 30%;">
                    <p>Adauga camin</p><br></div>
                <label for="nume">Nume camin:</label>
                <input style="float: right;" type="text" id="nume" name="nume" size="30"><br>
                <label for="adresa">Adresa:</label>
                <input style="float: right;" type="text" id="adresa" name="adresa" size="30"><br>
                <label for="capacitate">Numar de camere:</label>
                <input style="float: right;" type="number" id="capacitate" name="capacitate" size="30"><br>
                <br><br>
                <button style="float: right;" type="submit" class="addbutton">Adauga</button>

            </form>
        </div>
</body>

</html>