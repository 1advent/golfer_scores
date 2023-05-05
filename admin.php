<?php
$page_name = "Scorecard";
require('header.php');


//make a new player:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the new player name from the form data
  $newplayer = mysqli_real_escape_string($conn, $_POST['newplayer']);

  // Insert the new player into the database
  $sql = "INSERT INTO ".$table." (players) VALUES ('$newplayer')";
  if ($conn->query($sql) === TRUE) {
      echo "New player added successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
?>
<!--script for updating information in the database-->
<script>
 $(function() {
//twitter bootstrap script
$("button#submitUpdate").click(function(){
    var formData = $('form.form-horizontal').serialize();
    console.log(formData); // Log the form data being sent
    $.ajax({
        type: "POST",
        url: "update_tables.php",
        data: { 
          selected_player: $("select[name='selected_player']").val(),
          golferScore: $("#golferScore").val(),
          nineHandicap: $("#nineHandicap").val(),
          handicap: $("#handicap").val(),
          par: $("#par").val()
        },
        dataType: "json",
        success: function(data) {
            console.log(data); // Log the server response to the console
            alert("Updated.");
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            alert("failure");
        }
    });
});

 
 // AJAX request to get player info based on selected player
 $("select[name='selected_player']").change(function() {
    var selected_player = $(this).val();
    $.ajax({
        type: "POST",
        url: "get_player_info.php",
        data: {selected_player: selected_player},
        dataType: "json",
        success: function(data) {
            console.log(data); // Log the server response to the console
            // Populate the form fields with the retrieved player info
            $("#golferScore").val(data.golferScore);
            $("#nineHandicap").val(data['nineHandicap']);
            $("#handicap").val(data.handicap);
            $("#par").val(data.par);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
        }
    });
 });
});
</script>




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
          <select name='selected_player'>
          <option value=''>Select a player</option>
          <?php
            foreach ($players as $player) {
              echo "<option value='$player'>$player</option>";
            }
          ?>
          </select>
          <form>
            <div class="form-group">
              <label for="golferScore">Golfer Score: </label> <input type='number' class="form-control" id="golferScore"/>
            </div>
            <div class="form-group">
                <label for="nineHandicap">9-Hole Handicap: </label> <input type='number' class="form-control" id="nineHandicap"/>
            </div>
            <div class="form-group">
                <label for="handicap">Handicap: </label> <input type='number' class="form-control" id="handicap"/>
            </div>
            <div class="form-group">
                <label for="par">Par: </label> <input type='number' class="form-control" id="par"/>
            </div>
            <button id="submitUpdate" type="submit" class="btn btn-primary">Submit</button>
          </form>
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <button type="upload" class="btn btn-primary">Upload CSV</button>
            <br>
            <br>
            <button type="submit" class="btn btn-primary">Add New Team</button>
            <br>
            <br>
            <form action="admin.php" method="post">
              <label for="player">New Player Name:</label>
              <input type="text" name="newplayer" id="newplayer" value="John Doe/Jane Doe">
              <input type="submit" value="Add Player">
            </form>
          </div>
<?php
require('footer.php');
?>
