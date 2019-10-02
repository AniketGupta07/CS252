<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
   <style type="text/css">
    table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th {
  cursor: pointer;
}


th, td {
  text-align: left;
  padding: 16px;
}

  </style>
  <script>
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
  <?php
  session_start();

  if($_SESSION["loggedin"]==0){
    header("location:login.php");
  }
  elseif ($_SESSION["category"] !=0 ) {
    if($_SESSION["category"]==1)
      header("location: chef.php");
    else
      header("location: manager.php");
  }
  require_once "customer_config.php";
   $me= "HELLO ".$_SESSION["username"];
  $a = array();
  $ca = array();
  if (isset($_POST['prange'])) {

    $sql = "SELECT dish, price,category FROM menu WHERE price <= :max and price >=:min and availability=1";
        // echo $pdo;
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":max", $_POST["max"]);
            $stmt->bindParam(":min", $_POST["min"]);

            // // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                while ($row= $stmt->fetch()) {
                  $b = array($row["dish"],$row["price"],$row["category"]);
                  array_push($a, $b);
            }    
        }
        }
        echo "<script>$('#myModal').modal('show')</script>";
  //       echo $a;
  }
  if (isset($_POST['bycategory'])) {
    
    $sql = "SELECT dish, price,category FROM menu WHERE category=:category and availability=1";
        // echo $pdo;
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":category", $_POST["cate"]);
            // $stmt->bindParam(":min", $_POST["min"]);

            // // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                while ($row= $stmt->fetch()) {
                  $b = array($row["dish"],$row["price"],$row["category"]);
                  array_push($ca, $b);
            }    
        }
        }
  }
  ?>

</head>
<body>

<div class="container">
  <h2>Modal Example</h2>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <div class="panel panel-info" style="padding-top: 50px">
      <div class="panel-heading">Dishes in a Price Range</div>
      <div class="panel-body"><form name="form" method="post">
    Min price: <input type="number" name="min" min="100" max="500" value="100"><br>
    Max price: <input type="number" name="max" min="100" max="500" value="500"><br>
    <input type="submit" class="btn btn-primary btn-md" name="prange" data-toggle="modal" data-target="#myModal" value="Submit">
  </form>
  <div>
    <?php if (count($a) > 0): ?>
    <table class="table table-striped" id="myTable">
      <thead>
        <tr>
          <th onclick="sortTable(0)">Dish</th>
          <th onclick="sortTable(1)">Price</th>
          <th onclick="sortTable(2)">Category</th>
        </tr>
      </thead>
      <tbody>
    <?php foreach ($a as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
    <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div></div>
    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<script type="text/javascript"> $( "form" ).submit(function( event ) {
  var modal = document.getElementById("myModal");
  modal.style.display="block";
});
</script>
</body>
</html>
