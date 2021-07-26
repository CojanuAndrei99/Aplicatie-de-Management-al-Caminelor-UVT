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
    <div class="textpanel" style="position:relative;top:2%;left: 45%; width:140px;">Lista Camine</div>
        <table id="tabel"  style="position:relative;top:5%;">
            
            <tr>
                <th onclick="sortTable(0)">ID_camin</th>
                <th onclick="sortTable(1)">Nume</th>
                <th onclick="sortTable(2)">Adresa</th>
                <th onclick="sortTable(3)">Numar de camere</th>
            </tr>
            <?php
                include('../config.php');
            
                $sql = "SELECT * FROM Camine";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["ID_camin"]. "</td><td>" .$row["Nume"] . "</td><td>". $row["Adresa"]. "</td><td>". $row["Capacitate"]. "</td></tr>";
                }
                } else { echo "<tr><td>No result</td><td>No result</td><td>No result</td><td>No result</td></tr>"; }
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