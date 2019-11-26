<!DOCTYPE html>
<html>
    <head>
        <title>Football Spotter Update</title>
        <meta charset="UTF-8">    
		<script>
			function radBruins_clicked() {
				document.getElementById("url").value = "https://www.maxpreps.com/high-schools/pulaski-academy-bruins-(little-rock,ar)/football/roster.htm";
			}
		</script>
    </head>
    
    <body>
    	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			Update which team:
			<label for="radBruins">Bruins</label><input type="radio" name="team" id="radBruins" value="BRoster" onclick="radBruins_clicked()"> 
			<label for="radOpp">Opponent</label><input type="radio" name="team" id="radOpp" value="ORoster" checked="checked"><br>
			<label for="url">Maxpreps roster URL: </label><input type="text" name="url" id="url" style="width: 200px;" /><br>
			<input type="submit" value="Submit" />
        </form>
		<p>
<?php

	if (!empty($_POST["url"])) {
		$table = $_POST["team"];
		$url = "https://wt-90a32ef8ce619cb1158f5b6850fb1f12-0.sandbox.auth0-extend.com/maxprepsTeamScraper?url=" . $_POST["url"]; // path to the JSON file
		$data = file_get_contents($url);  // load contents of the page 
		$roster = json_decode($data, true); // parse the JSON into an object
		
		// Build insert statement
		$output = "INSERT INTO $table (Number, Name, Position) VALUES ";
		foreach ($roster as $player) {
			if ($player[jersey]){
				$output = $output . "('" . $player[jersey] . "','" . $player[name] . "','" . $player[position] . "'), ";
			}

		}
		$output = $output . "(null,null,null);";

		// Load config values
		include 'config.php';
		if ($host_name == "") {
			die("<h3>You need to make a copy of the 'config.example.php' and name it 'config.php', then edit that file with the appropriate database access parameters.</h3>");
		}
		
		$conn = mysqli_connect($host_name, $user_name, $password, $database);
		if (mysqli_connect_errno()) {
		  die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
		} 
		else

		{mysqli_query($conn, "DELETE FROM $table;");
		if (mysqli_query($conn, $output) == false) {echo "error" . (mysqli_error($conn));}
		 // Execute the insert statement
		mysqli_close($conn);
		}
	}

?></p>
	</body>
</html>
