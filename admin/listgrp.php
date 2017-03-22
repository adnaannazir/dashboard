 <?php


  require 'connect.php' ;
  require 'core.php' ;
  if(!loggedinadm())
  {
    header('Location:adminloginpage.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Student List</title> 

    </head>
  <body>
      <?php
      $title="Search Students"; 
      include 'include.inc.php';?>
<center>
<br>
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    <input class="mdl-textfield__input" type="text" id="myInput" onkeyup="myFunction2()">
    <label class="mdl-textfield__label" for="myInput">Search...</label>
  </div>

      <br><br>
<table class="mdl-data-table mdl-js-data-table mdl-shadow--6dp" id=myTable>
  <thead>
    <tr>
      <th>ID</th>
      <th class="mdl-data-table__cell--non-numeric">Name</th> 
       
    </tr>
  </thead>
  <tbody>
 
  <?php

    $stud = "SELECT * FROM groups ";

    $students=$db->query($stud);
    

  if (!$students->num_rows)
  {   
    echo ('NO Student to show ');
  }         
    else
    {

          $rows=$students->fetch_all(MYSQLI_ASSOC);
          

          foreach($rows as $row)
          {

            echo "<tr>
                  <td>".$row['id']."</td>
                  <td class=\"mdl-data-table__cell--non-numeric\">".$row['name']."</td>
                  </tr>";
          }
  
    }


   ?>

  </tbody>
</table>
</center>
<br><br>
    </div>
  </main>
</div>

<script>
function myFunction2() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[1];
    td2 = tr[i].getElementsByTagName("td")[0];
    if (td1||td2) {

      if (td1.innerHTML.toUpperCase().indexOf(filter) > -1||td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } 
      else 
      {
        tr[i].style.display = "none";
      }
    

    }


  }
}
</script>
</body>
</html>

