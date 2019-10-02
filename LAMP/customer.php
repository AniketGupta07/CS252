<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-2.1.4.min.js"></script>
    <script type="text/javascript" src="auto/typeahead.js"></script>
  <style type="text/css">
  	table {
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  opacity: 0.5;
}

th {
  font-family: monospace;
  cursor: pointer;
}

body{
  font-family: fantasy;
}
th, td {
  text-align: left;
  padding: 16px;
}
 body {
  background: url('images/im2.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;

 }
 .panel-heading{
  font-family: monospace;
  font-variant: small-caps;
  font-weight: bold;
  /*cursor: pointer;*/
 }
.panel-transparent {
        background: none;
    }
    .panel-transparent .panel-heading{
        opacity: 0.5;
    }

        .typeahead { border: 2px solid #FFF;border-radius: 4px;padding: 8px 12px;max-width: 150px;min-width: 140px;background: rgba(66, 52, 52, 0.5);color: #FFF;}
  /*.tt-menu { width:300px; }*/
  ul.typeahead{margin:0px;padding:10px 0px;}
  ul.typeahead.dropdown-menu li a {padding: 10px !important;  border-bottom:#CCC 1px solid;color:#FFF;}
  ul.typeahead.dropdown-menu li:last-child a { border-bottom:0px !important; }

  .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
    text-decoration: none;
    background-color: #1f3f41;
    outline: 0;
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
  function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
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
  $di = array();
$ac=array();
	if (isset($_POST['prange'])) {

		$sql = "SELECT dish, price,category,availability,ave FROM menu WHERE price <= :max and price >=:min ";
        // echo $pdo;
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":max", $_POST["max"]);
            $stmt->bindParam(":min", $_POST["min"]);

            // // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                while ($row= $stmt->fetch()) {
                	$b = array($row["dish"],$row["price"],$row["category"],$row["availability"],$row["ave"]);
                	array_push($a, $b);
            }    
        }
        }
  //       echo $a;
	}
  if (isset($_POST['rrange'])) {

    $sql = "SELECT dish, price,category,availability,ave FROM menu WHERE ave <= :max and ave >=:min";
        // echo $pdo;
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":max", $_POST["max"]);
            $stmt->bindParam(":min", $_POST["min"]);

            // // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                while ($row= $stmt->fetch()) {
                  $b = array($row["dish"],$row["price"],$row["category"],$row["availability"],$row["ave"]);
                  array_push($ac, $b);
            }    
        }
        }
  //       echo $a;
  }
	if (isset($_POST['bycategory'])) {
		
		$sql = "SELECT dish, price,category,availability,ave FROM menu WHERE category=:category ";
        // echo $pdo;
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":category", $_POST["cate"]);
            // $stmt->bindParam(":min", $_POST["min"]);

            // // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                while ($row= $stmt->fetch()) {
                	$b = array($row["dish"],$row["price"],$row["category"],$row["availability"],$row["ave"]);
                	array_push($ca, $b);
            }    
        }
        }
	}
  if (isset($_POST['byname'])) {
    
    $sql = "SELECT dish,price,category,availability,ave FROM menu WHERE dish=:dish";
        // echo $pdo;
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":dish", $_POST["dish"]);
            // $stmt->bindParam(":min", $_POST["min"]);

            // // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                while ($row= $stmt->fetch()) {
                  $b = array($row["dish"],$row["price"],$row["category"],$row["availability"],$row["ave"]);
                  array_push($di, $b);
            }    
        }
        }
  }
  if (isset($_POST['rating'])) {
    $sql = "SELECT num,ave FROM menu WHERE dish=:dish";
    if($stmt = $pdo->prepare($sql)){
      // $stmt->bindParam(":status", $st);
      $stmt->bindParam(":dish", $_POST["dish"]);
      // // Attempt to execute the prepared statement
      $res4="Couldn't record";
      debug_to_console("hola");
      if($stmt->execute()){
        if($stmt->rowCount() ==1){
          $row = $stmt->fetch();
          $n=intval($row["num"]);
          $prev=floatval($row["ave"]);
          $prev=$prev*$n;
          $n=$n+1;
          $prev= ($prev + $_POST["rate"])/$n;
          debug_to_console(strval($prev));
          echo $prev;
          $sql2 = "UPDATE menu set num=:numb , ave=:rate WHERE dish=:dish";
          if ($stmt = $pdo->prepare($sql2)) {
            $stmt->bindParam(":numb",$n);
            $stmt->bindParam(":rate",$prev);
            $stmt->bindParam(":dish",$_POST["dish"]);
            if ($stmt->execute()) {
              $res4="Record Updated";
            }
          }
          
        }
      }    
    }
  }


	?>
	<title>HOLA !!</title>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Aniket's</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#"><?php echo $me ?></a></li>
      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Log-Out</a></li>
    </ul>
  </div>
</nav>
  <br>
  <!-- <form action="logout.php" method="post"> -->
    <!-- <input type="submit" name ="logout" value="log-out"> -->
  <!-- </form> -->
  <div class="panel panel-default panel-transparent" style="padding-top: 50px">
      <div class="panel-heading" data-target="#prange" >Dishes in a Price Range</div>
      <div class="panel-body  " id="prange"><form  method="post">
    Min price: <input type="number" style="width:150px;" class="form-group form-control typeahead" name="min" min="100" max="500" value="100"><br>
    Max price: <input type="number" style="width:150px;" class="form-group form-control typeahead" name="max" min="100" max="500" value="500"><br>
    <input type="submit" class="btn btn-primary btn-md" name="prange" value="Submit">
  </form>
  <div>
    <?php if (count($a) > 0): ?>
    <table class="table table-striped table-hover" id="myTable">
      <thead>
        <tr>
          <th onclick="sortTable(0)">Dish</th>
          <th onclick="sortTable(1)">Price</th>
          <th onclick="sortTable(2)">Category</th>
          <th onclick="sortTable(3)">Availability</th>
          <th onclick="sortTable(4)">Rating</th>
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
  
  <div class="panel panel-default panel-transparent">
      <div class="panel-heading"  data-target="#rrange" >Dishes in a Rating Range</div>
      <div class="panel-body  " id="rrange"><form  method="post">
    Min rating: <input type="number" step="0.1" style="width:150px;" class="form-group form-control typeahead" name="min" min="1" max="5" value="1"><br>
    Max rating: <input type="number" step="0.1" style="width:150px;" class="form-group form-control typeahead" name="max" min="1" max="5" value="5"><br>
    <input type="submit" class="btn btn-primary btn-md" name="rrange" value="Submit">
  </form>
  <div>
    <?php if (count($ac) > 0): ?>
    <table class="table table-striped table-hover" id="myTable">
      <thead>
        <tr>
          <th onclick="sortTable(0)">Dish</th>
          <th onclick="sortTable(1)">Price</th>
          <th onclick="sortTable(2)">Category</th>
          <th onclick="sortTable(3)">Availability</th>
          <th onclick="sortTable(4)">Rating</th>
        </tr>
      </thead>
      <tbody>
    <?php foreach ($ac as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
    <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div></div>
    </div>


  <div class="panel panel-default panel-transparent">
      <div class="panel-heading" data-target="#cate" >Dishes in a category</div>
      <div class="panel-body  " id="cate"><form method="post">
   Select Category: <select name="cate">
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
      <option value="D">D</option>
      <option value="E">E</option>
      <option value="F">F</option>
      <option value="G">G</option>
      <option value="H">H</option>
    </select>
    <br>
    <input type="submit" class="btn btn-primary btn-md" name="bycategory" value="Submit">
  </form>

  <div>
    <?php if (count($ca) > 0): ?>
    <table class="table table-striped table-hover" id="myTable">
      <thead>
        <tr>
          <th onclick="sortTable(0)">Dish</th>
          <th onclick="sortTable(1)">Price</th>
          <th onclick="sortTable(2)">Category</th>
          <th onclick="sortTable(3)">Availability</th>
          <th onclick="sortTable(4)">Rating</th>
        </tr>
      </thead>
      <tbody>
    <?php foreach ($ca as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
    <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div></div>
    </div>
  <div class="panel panel-default panel-transparent">
      <div class="panel-heading"  data-target="#sdish">Search Dish</div>
      <div id="sdish" class="panel-body  "><form method="post">
   <div class="bgcolor">
    Enter Name:<br/> <input type="text" autocomplete="off" name="dish" id="dish" class="form-control typeahead"/>
  </div>
    <br>
    <input type="submit" class="btn btn-primary btn-md" name="byname" value="Submit">
  </form>

  <div>
    <?php if (count($di) > 0): ?>
    <table class="table table-striped table-hover" id="myTable">
      <thead>
        <tr>
          <th onclick="sortTable(0)">Dish</th>
          <th onclick="sortTable(1)">Price</th>
          <th onclick="sortTable(2)">Category</th>
          <th onclick="sortTable(3)">Availability</th>
          <th onclick="sortTable(4)">Rating</th>
        </tr>
      </thead>
      <tbody>
    <?php foreach ($di as $row): array_map('htmlentities', $row); ?>
        <tr>
          <td><?php echo implode('</td><td>', $row); ?></td>
        </tr>
    <?php endforeach; ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div></div>
    </div>

      <div class="panel panel-default panel-transparent">
      <div data-target="#radish" class="panel-heading" >Rate Dishes</div>
      <div id="radish"class="panel-body  "><form class="form-inline" method ="post">
   
    Rate: <input type="text" autocomplete="off" name="dish" id="ratdish" class="form-control form-group typeahead">
   with <select name="rate">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select> star(s) 
    <br><br>
    <input type="submit" class="btn btn-primary btn-md" name="rating" value="Submit">
  </form>
    
  </div>
  <div>
    <?php 
      echo $res4;
    ?>
  </div>
</div>
</body>



<script>
    $(document).ready(function () {
        $('#ratdish').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "auto/dish.php",
          data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
    $(document).ready(function () {
        $('#dish').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "auto/dish.php",
          data: 'query=' + query,            
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
            result($.map(data, function (item) {
              return item;
                        }));
                    }
                });
            }
        });
    });
</script>
</html>