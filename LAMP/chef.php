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
    <title>HOLA CHEF!!</title>
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
  session_start();

  if($_SESSION["loggedin"]==0){
    header("location:login.php");
  }
  elseif ($_SESSION["category"] !=1 ) {
    if($_SESSION["category"]==2)
      header("location: manager.php");
    else
      header("location: customer.php");
  }
  require_once "chef_config.php";
  $me= "HELLO ".$_SESSION["username"];
  $a = array();
  $ca = array();

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

  if (isset($_POST['chngprice'])) {
    $sql = "update  menu set price=:price WHERE dish=:dish and chef=:chf";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":price", $_POST["pnew"]);
      $stmt->bindParam(":dish", $_POST["dish"]);
      $stmt->bindParam(":chf", $_SESSION["username"]);
      // // Attempt to execute the prepared statement
      $res2="Couldn't Update";
      if($stmt->execute()){
        if($stmt->rowCount() ==1)
          $res2="Successfully Updated";
      }    
    }
  }
  if (isset($_POST['chngavail'])) {
    $sql = "update  menu set availability=:avail WHERE dish=:dish and chef=:chf";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":avail", $_POST["avail"]);
      $stmt->bindParam(":dish", $_POST["dish"]);
      $stmt->bindParam(":chf", $_SESSION["username"]);

      // // Attempt to execute the prepared statement
      $res="Couldn't Update";
      if($stmt->execute()){
        if($stmt->rowCount() ==1)
          $res="Successfully Updated";
      }    
    }
  }
  if (isset($_POST['newd'])) {

    if($_POST["dish"]==""){
      $res4="please name the dish";
    }
    else{
    $sql = "select * from menu  WHERE dish=:dish";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindParam(":dish", $_POST["dish"]);
      $res4="Couldn't Introduce";
      $pa=1;
      if($stmt->execute()){
        if($stmt->rowCount() ==1){
          $res4="Dish Already exists";
          $pa=0;
      }   
       }

      if($pa==1){
        $sql2 = "INSERT into menu (dish,price,category,availability,chef,num,ave) values (:dish,:price,:category,0,:chf,1,5)";
          if($stmt=$pdo->prepare($sql2)){
            $stmt->bindParam(":dish",$_POST["dish"]);
            $stmt->bindParam(":price",$_POST["price"]);
            $stmt->bindParam(":category",$_POST["cate"]);
            $stmt->bindParam(":chf",$_SESSION["username"]);
          
          if($stmt->execute()){
            if($stmt->rowCount()==1)
              $res4="Introduced";
          }
      }
    }
    }}

  }
  $di=array();
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
  ?>
  <title></title>
</head>
<body >
 
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
      <div class="panel-heading" data-target="#prange">Dishes in a Price Range</div>
      <div class="panel-body " id="prange"><form  method="post">
    Min price: <input class="form-control typeahead" type="number" name="min" min="100" max="500" value="100" style="width: 150px"><br>
    Max price: <input class="form-control typeahead" type="number" name="max" min="100" max="500" value="500" style="width: 150px"><br>
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
      <div class="panel-heading" data-target="#cate">Dishes in a category</div>
      <div class="panel-body " id="cate"><form method="post">
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
    <input type="submit"  class="btn btn-primary btn-md"name="bycategory" value="Submit">
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
      <div class="panel-heading" data-target="#sdish">Search Dish</div>
      <div class="panel-body " id="sdish"><form method="post">
   <div class="bgcolor">
    Enter Name:<br/> <input type="text" autocomplete="off" name="dish" id="dish" class="form-control typeahead"/>
  </div>
    <br>
    <input type="submit" class="btn btn-primary btn-md" name="byname" value="Submit">
  </form>

  <div>
    <?php if (count($di) > 0): ?>
    <table class="table table-striped" id="myTable">
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
      <div class="panel-heading" data-target="#chp">Change Price</div>
      <div class="panel-body " id="chp"><form class="form-inline" method ="post">
      Change Price of dish <select name="dish">
      <?php 
          $stmt = $pdo->prepare("SELECT  dish FROM menu WHERE chef=:chf");
          $stmt->bindParam(":chf", $_SESSION["username"]);
          $stmt->execute();
          while ($row = $stmt->fetch()){
          echo "<option value=". $row['dish'] .">" . $row['dish'] . "</option>";
          }
        ?> </select>
        to<input class="form-control form-group typeahead" type="number" name="pnew" min="100" max="500" value="100" style="width: 150px">      
    <input type="submit" name="chngprice" class="btn btn-primary btn-md" value="Confirm">
    </form>
    
  </div>
  <div>
    <?php 
      echo $res2;
    ?>
  </div></div>

    <div class="panel panel-default panel-transparent">
      <div class="panel-heading" data-target="#chavail">Change Availability</div>
      <div class="panel-body " id="chavail"><form method ="post">
      Change Availability of dish <select name="dish">
      <?php 
          $stmt = $pdo->prepare("SELECT  dish FROM menu WHERE chef=:chf");
          $stmt->bindParam(":chf", $_SESSION["username"]);
          $stmt->execute();
          while ($row = $stmt->fetch()){
          echo "<option value=". $row['dish'] .">" . $row['dish'] . "</option>";
          }
        ?> </select> to <select name="avail">
      <option value="1">Yes</option>
      <option value="0">No</option>
    </select>
    <button type="submit" name="chngavail" class="btn btn-primary btn-md">
      <span class="glyphicon glyphicon-edit"></span>
    </button>
    </form>
    
  </div>
  <div>
    <?php 
      echo $res;
    ?>
  </div></div>

    <div class="panel panel-default panel-transparent">
      <div class="panel-heading" data-target="#ndish">Introduce dish</div>
      <div class="panel-body " id="ndish"><form class="form-inline" method ="post">
      Introduce Dish <input type="text" autocomplete="off" name="dish" id="indish" class="form-control typeahead"/> 
   with price <input class="form-group form-control typeahead" type="number" name="price" min="100" max="500" value="100" style="width: 150px">
    in category: <select name="cate">
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
      <option value="D">D</option>
      <option value="E">E</option>
      <option value="F">F</option>
      <option value="G">G</option>
      <option value="H">H</option>
    </select> 
    <button type="submit" name="newd" class="btn btn-primary btn-md">
      <span class="glyphicon glyphicon-plus"></span>
    </button>

    <!-- <input type="submit" name="newd" class="btn btn-primary btn-md" value="Confirm"> -->
    </form>
    
  </div>
  <div>
    <?php 
      echo $res4;
    ?>
  </div></div>

    
</body>
<script>
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