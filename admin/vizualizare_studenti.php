<html>
    <head>
        <link rel="stylesheet" href="css/editare_studenti_style.css" type="text/css">
        <link rel="stylesheet" href="css/admin_styles.css" type="text/css">
    </head>
    <body style="overflow-y: auto;">
    <div><br></div>
    <?php
        require_once("nav_bar.php");
    ?>
    <div><br></div>
    <div class="textpanel" style="position:relative;top:5%;left: 45%; width:120px;">Lista Studenti</div>
    
    <table id="tabel"  style="position:relative;top:5%;">
        <tr>
            <th onclick="sortTable(0)">Matricola</th> 
            <th onclick="sortTable(1)">Nume</th>	
            <th onclick="sortTable(2)">CNP</th>	
            <th onclick="sortTable(3)">Sex</th>	
            <th onclick="sortTable(4)">Data nasterii</th>	
            <th onclick="sortTable(5)">Adresa</th>	
            <th onclick="sortTable(6)">E-mail</th>	
            <th onclick="sortTable(7)">Telefon</th>	
            <th onclick="sortTable(8)">Facultatea</th>	
            <th onclick="sortTable(9)">Specializarea</th>	
            <th onclick="sortTable(10)">An curent</th>
            <th onclick="sortTable(11)">Bugetat</th>	
            <th onclick="sortTable(12)">Medie admitere</th>	
            <th onclick="sortTable(13)">Nume camin</th>	
            <th onclick="sortTable(14)">Numar camera</th>
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