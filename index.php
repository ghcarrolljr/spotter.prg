<?php

if (!empty($_POST)) { // Checks to see if it received a form submission
	$broster = fopen("BRoster.csv","r");

	while(! feof($broster)) {
		$player = fgetcsv($broster);
		if ($player[0] == $_POST["num"]) {
			$bplayer = $player[1];
		}
	}
	fclose($broster);
	
	$names = $_POST["names"] + $bplayer + "/r/n";
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Football Spotter Program</title>
		<script type="text/javascript">
			function num_keypress(e) {
				var keynum;

				if (window.event) { // IE                    
				  keynum = e.keyCode;
				} else if (e.which) { // Netscape/Firefox/Opera                   
				  keynum = e.which;
				}
				var key = String.fromCharCode(keynum);
				
				if (key == "+") { // Lookup Bruins
					form1.submit(); // I don't remember if this is how its done
					return false;
				} else if (key == "-") { // Lookup other team 
					// You don't have this yet, so we'll just do the same thing for now
					form1.submit(); // I don't remember if this is how its done
					return false;
				}
				else if (keynum == "13") {
					// Clear the value of players
					getElementById("names").value = "";
					return false;
				}
			}
		</script>
    </head>
    <body>
    	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="number" name="num" onkeypress="num_keypress">
			<textarea name="names" id="names">
				<?= $names ?>
			</textarea>
    	</form>    
    </body>
   
</html>
