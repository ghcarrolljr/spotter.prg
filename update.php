<!DOCTYPE html>
<html>
    <head>
        <title>Football Spotter Update</title>
        <meta charset="UTF-8">    
		<script>
			function radBruins_clicked() {
				document.getElementById("url").value = "https://www.maxpreps.com/high-schools/pulaski-academy-bruins-(little-rock,ar)/football/roster.htm";
			}
            function radOpp_clicked() {
				document.getElementById("url").value = "https://www.maxpreps.com/high-schools/pulaski-academy-bruins-(little-rock,ar)/football/roster.htm";
			}
		</script>
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    </head>
    
    <body>
    	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			Update which team:
			<label for="radBruins">Bruins</label><input type="radio" name="team" id="radBruins" value="BRoster" onclick="radBruins_clicked()"> 
			<label for="radOpp">Opponent</label><input type="radio" name="team" id="radOpp" value="ORoster" onclick="radOpp_clicked()"><br>
			<label for="url">Maxpreps roster URL: </label><input type="text" name="url" id="url" style="width: 200px;" /><br>
			<input type="submit" value="Submit" />
        </form>
        <div id="topBar">
            <a href ="#" id="load_home"> HOME </a>
        </div>
        <div id ="content">        
        </div>

        <script>
        $(document).ready( function() {
            $("#load_home").on("click", function() {
                $("#content").load("hhttps://www.maxpreps.com/high-schools/pulaski-academy-bruins-(little-rock,ar)/football/roster.htm");
            });
        });
            var s = document.getElementById("content").innerHTML;

            var obj = JSON.parse(s);
            document.getElementById("url").value = obj.lastName;
            
        </script>
		<p>
            <?php 
            
            
            /*
            include '../.sec/config.php';
            if (!empty($_POST["url"])) {

                $table = $_POST["team"];
                
                $url = 'https://www.maxpreps.com/high-schools/pulaski-academy-bruins-(little-rock,ar)/football/roster.htm';
 
                //read json file from url in php
                $readJSONFile = file_get_contents($url);
                //convert json to array in php
                $array = json_decode($readJSONFile);
                var_dump($array); // print array


                
 
                

                
                
                
                
                
                $url = "https://wt-90a32ef8ce619cb1158f5b6850fb1f12-0.sandbox.auth0-extend.com/maxprepsTeamScraper?url=" . $_POST["url"]; // path to the JSON file
                $data = fetch($_POST["url"]);  // load contents of the page 
                $roster = json_decode($data, true); // parse the JSON into an object "firstName":"Josiah","lastName":"Johnson","classYear":12,"jersey":"23","heightInches":10,"heightFeet":5,"weight":195,"position1":"SS","position2":"RB","position3":null,"hasStats":null,"isCaptain":false,"isDeleted":false,"photoUrl":null
                echo $roster;*/
                /*$output = "INSERT INTO $table (Number, Name, Class, Position) VALUES ";
                if (($handle = fopen($table . ".csv", "r")) !== FALSE) {
                       while (($roster = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        //foreach ($roster as $player) {
                                if ($roster[0]){
                                    $output = $output . "('" . $roster[0] . "','" . $roster[1] . "','" . $roster[2] . "','" . $roster[3] . "'), ";
                                    }

                            //}
                       }
                    }
                $output = $output . "(null,null,null,null);";
                
                $conn = mysqli_connect($host_name, $user_name, $password, $database);
                if (mysqli_connect_errno()) {
                  die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
                } 
                else
                {mysqli_query($conn, "DELETE FROM $table;");
                if (mysqli_query($conn, $output) == false) {echo "error" . (mysqli_error($conn));}
                 // Execute the insert statement
                mysqli_close($conn);
                 echo "Completed Successfully";
                } 
            }
            */
            ?>
        </p>
	</body>
</html>
