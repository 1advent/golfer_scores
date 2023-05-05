<?php
$page_name = "Scorecard";
require('header.php');


//make a new player:
?>
<!--script for updating information in the database-->
<script>
 $(function() {
//twitter bootstrap script
 $("button#submitUpdate").click(function(){
         $.ajax({
     type: "POST",
 url: "update_tables.php",
 data: $('form.form-horizontal').serialize(),
         success: function(msg){
                  alert("Updated.");
         },
 error: function(){
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
            $("#score").val(data.score);
            $("#NineholeHandicap").val(data['NineholeHandicap']);
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
          <select name='selected_player'>
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
                <label for="NineholeHandicap">9-Hole Handicap: </label> <input type='number' class="form-control" id="NineholeHandicap"/>
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
          </div>
<?php
require('footer.php');
?>
