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
    <div><br></div>
    <div class="textpanel" style="position:relative;top:5%;left: 45%; width:120px;">Lista Secretari</div>
        <table id="tabel"  style="position:relative;top:5%;">
            <tr>
                <th onclick="sortTable(0)">ID_secretari</th>
                <th onclick="sortTable(1)">Nume</th>
                <th onclick="sortTable(2)">Telefon</th>
                <th onclick="sortTable(3)">E-mail</th>
                <th onclick="sortTable(4)">Facultate</th>
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
        
        <script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("tabel");
  switching = true;
  dir = "asc";
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
      if (dir == "asc") {
        if(!isNaN(parseInt(x.innerHTML)) && !isNaN(parseInt(y.innerHTML)))
        {
          if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
          shouldSwitch = true;
          break;
          }
        }
        else{
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          shouldSwitch = true;
          break;
        }
        }
        
      } else if (dir == "desc") {
        if(!isNaN(parseInt(x.innerHTML)) && !isNaN(parseInt(y.innerHTML)))
        {
          if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
          shouldSwitch = true;
          break;
          }
        }
        else{
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
    </body>
</html>