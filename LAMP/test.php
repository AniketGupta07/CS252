<!DOCTYPE html>
<html>
<title>Welcome</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
  background-image: url('images/back.jpg');
  min-height: 100%;
  background-position: center;
  background-size: cover;
}
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

<body>

<div class="bgimg w3-display-container w3-text-white">
  <div class="w3-display-middle w3-jumbo">
    <p>Aniket's</p>
  </div>
  <div class="w3-display-topleft w3-container w3-xlarge">
    <p><button onclick="document.getElementById('menu').style.display='block'" class="w3-button w3-black">menu</button></p>
    <p><button onclick="document.getElementById('contact').style.display='block'" class="w3-button w3-black">contact</button></p>
    <a href="#" onclick="$('#myModal').modal({'backdrop': 'static'});"
  class="btn">Launch demo modal</a>
  </div>
  <div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge">monday - friday 10-23 | saturday 14-02</p>
    <p class="w3-large">42 village St, New York</p>
  </div>
</div>



 
<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Modal header</h3>
  </div>
  <div class="modal-body">
    <p>One fine body…</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    <button class="btn btn-primary">Save changes</button>
  </div>
</div>
<!-- Menu Modal -->
<div id="menu" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black w3-display-container">
      <span onclick="document.getElementById('menu').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Look in a range</h1>
    </div>
    <div class="panel panel-info" style="padding-top: 50px">
      <div class="panel-heading">Dishes in a Price Range</div>
      <div class="panel-body"><form  method="post">
    Min price: <input type="number" name="min" min="100" max="500" value="100"><br>
    Max price: <input type="number" name="max" min="100" max="500" value="500"><br>
    <input type="submit" class="btn btn-primary btn-md" name="prange" value="Submit">
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
</div>

<!-- Contact Modal -->
<div id="contact" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black">
      <span onclick="document.getElementById('contact').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Contact</h1>
    </div>
    <div class="w3-container">
      <p>Reserve a table, ask for today's special or just send us a message:</p>
      <form action="/action_page.php" target="_blank">
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Name" required name="Name"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="number" placeholder="How many people" required name="People"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="datetime-local" placeholder="Date and time" required name="date" value="2017-11-16T20:00"></p>
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Message \ Special requirements" required name="Message"></p>
        <p><button class="w3-button" type="submit">SEND MESSAGE</button></p>
      </form>
    </div>
  </div>
</div>

</body>
</html>

