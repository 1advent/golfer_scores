<?php
$page_name = "Scorecard";
require('header.php');

//make a new player:
?>
<form action="admin.php" method="post">
<label for="player">New Player Name:</label>
<input type="text" name="newplayer" id="newplayer" value="John Doe/Jane Doe">
<input type="submit" value="Add Player">
<br>
<?php
//create select box for players
$sql = "select players from ".$table;
$result = $conn->query($sql);
$players = array();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    //add row["player"] to $players array
    array_push($players,$row["players"]);
  }
}
?>
<div class="container features">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <select name='player'>
          <?php
            foreach ($players as $player) {
              echo "<option value='$player'>$player</option>";
            }
          ?>
          </select>
          <form>
            <div class="form-group">
              <label for="score">Golfer Score: </label> <input type='number' class="form-control" id="score"/>
            </div>
            <div class="form-group">
                <label for="9holeHandicap">9-Hole Handicap: </label> <input type='number' class="form-control" id="9holeHandicap"/>
            </div>
            <div class="form-group">
                <label for="handicap">Handicap: </label> <input type='number' class="form-control" id="handicap"/>
            </div>
            <div class="form-group">
                <label for="par">Par: </label> <input type='number' class="form-control" id="par"/>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <button type="upload" class="btn btn-primary">Upload CSV</button>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Add New Team</button>
          </div>
<?php
require('footer.php');
?>
