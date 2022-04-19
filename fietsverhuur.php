<html>
    <head>
        <title>fietsverhuur de elstar</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <h1>Start</h1> 
        <script>function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  div = document.getElementById("myDropdown");
  a = div.getElementsByTagName("a");
  for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      a[i].style.display = "";
    } else {
      a[i].style.display = "none";
    }
  }
}
</script>
        <?php
        $tabelData = '<table border="1" width="500px"><tr>
            <td>ID</td>
            <td>merk_ID</td>
            <td>heren_dames_uni</td>
            <td>maat</td>
            <td>prijs</td>
            <td>fiets_serienummer</td>
            <td colspan="2">opties</td>
        </tr>';
            include("connect.php");
            $stmt = $pdo->query("SELECT * FROM fiets");

            foreach ($stmt as $rij){
                $tabelData .= '<tr>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['ID'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['IDmerk'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['heren_dames_uni'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['maat'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['prijs'];
                    $tabelData .= '</td>';
                    $tabelData .= '<td>';
                        $tabelData .= $rij['fiets_serienummer'];
                    $tabelData .= '</td>';
                $tabelData .= '</tr>';
                $tabelData .= '<div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">Dropdown</button>
                <div id="myDropdown" class="dropdown-content">
                  <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                  <a href="#about">About</a>
                  <a href="#base">Base</a>
                  <a href="#blog">Blog</a>
                  <a href="#contact">Contact</a>
                  <a href="#custom">Custom</a>
                  <a href="#support">Support</a>
                  <a href="#tools">Tools</a>
                </div>
              </div>';
            }
            $tabelData .= '</table>';
            echo $tabelData;
        ?>
    </body>
</html>