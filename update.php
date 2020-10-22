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
                var school = document.getElementById("school").value;
				document.getElementById("url").value = "https://www.maxpreps.com/high-schools/" + school + "/football/roster.htm";
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
			<br>
            <select id="school">
                <option value = "little-rock-christian-academy-warriors-(little-rock,ar)">Little Rock Christian Academy</option>
                <option value="harrison-goblins-(harrison,ar)">Harrison</option>
                <option value="valley-view-blazers-(jonesboro,ar)">Valley View</option>
                <option value="maumelle-hornets-(maumelle,ar)">Maumelle</option>
                <option value="lakeside-rams-(hot-springs,ar)">Lakeside</option>
                <option value="forrest-city-mustangs-(forrest-city,ar)">Forrest City</option>
                <option value="arkansas-razorbacks-(texarkana,ar)">Arkansas</option>
                <option value="vilonia-eagles-(vilonia,ar)">Vilonia</option>
                <option value="magnolia-panthers-(magnolia,ar)">Magnolia</option>
                <option value="white-hall-bulldogs-(white-hall,ar)">White Hall</option>
                <option value="morrilton-devil-dogs-(morrilton,ar)">Morrilton</option>
                <option value="farmington-cardinals-(farmington,ar)">Farmington</option>
                <option value="high-schools/nettleton-raiders-(jonesboro,ar)">Nettleton</option>
                <option value="wynne-yellowjackets-(wynne,ar)">Wynne</option>
                <option value="camden-fairview-cardinals-(camden,ar)">Camden Fairview</option>
                <option value="hot-springs-trojans-(hot-springs,ar)">Hot Springs</option>
                <option value="greenbrier-panthers-(greenbrier,ar)">Greenbrier</option>
                <option value="watson-chapel-wildcats-(pine-bluff,ar)">Watson Chapel</option>
                <option value="alma-airedales-(alma,ar)">Alma</option>
                <option value="mcclellan-crimson-lions-(little-rock,ar)">McClellan</option>
                <option value="clarksville-panthers-(clarksville,ar)">Clarksville</option>
                <option value="parkview-patriots-(little-rock,ar)">Parkview</option>
                <option value="batesville-pioneers-(batesville,ar)">Batesville</option>
                <option value="blytheville-chickasaws-(blytheville,ar)">Blytheville</option>
                <option value="greene-county-tech-golden-eagles-(paragould,ar)">Greene County Tech</option>
                <option value="/beebe-badgers-(beebe,ar)">Beebe</option>
                <option value="/huntsville-eagles-(huntsville,ar)">Huntsville</option>
                <option value="hope-bobcats-(hope,ar)">Hope</option>
                <option value="paragould-rams-(paragould,ar)">Paragould</option>
                <option value="fair-war-eagles-(little-rock,ar)">Fair</option>
                <option value="de-queen-leopards-(de-queen,ar)">De Queen</option>
                <option value="robinson-senators-(little-rock,ar)">Robinson</option>
            </select>
            <label for="radOpp">Opponent</label><input type="radio" name="team" id="radOpp" value="ORoster" onclick="radOpp_clicked()"><br> 
			<label for="url">Maxpreps roster URL: </label><input type="text" name="url" id="url" style="width: 600px;" /><br>
			<input type="submit" value="Submit" />
        </form>

        
        
		<p>
            <?php 
            include '../.sec/config.php';
            $output = "";
            if (!empty($_POST["url"])) {
            $table = $_POST["team"];
            $url = $_POST["url"];
            //read json file from url in php
            $readJSONFile = file_get_contents($url, true);
            $num1 = strpos($readJSONFile, '<script id="__NEXT_DATA__" type="application/json">') + 51;
            $json = substr($readJSONFile, $num1);
            $num2 = strpos($json, '</script>');
            $json = substr($readJSONFile, $num1, $num2);
            $array = json_decode($json,true);// [roster], firstName, lastName, jersey, classYear, position1, position2, position3
            //echo "<pre>";
            $roster = $array[props][pageProps][roster];
            //print_r($roster);
            $i=0;
            $output = "INSERT INTO $table (Number, Name, Class, Position) VALUES ";
            foreach ($roster as $player) {
                if ($roster[$i][jersey]) {
                    $nameHold = Preg_replace("/[^a-zA-Z0-9_ -]/s"," ",$roster[$i][formattedName]);
                    $output = $output . " ('" . $roster[$i][jersey] . "','" . $nameHold . "','" . $roster[$i][formattedClassYear] . "','" . $roster[$i][formattedPositions] . "'), ";
                    }
                $i=$i+1;
                }

            $output = $output . "(null,null,null,null);";
            $conn = mysqli_connect($host_name, $user_name, $password, $database);
            if (mysqli_connect_errno()) {
                    die('<p>Failed to connect to MySQL: '.mysqli_connect_error().'</p>');
                    } 
                else
                    {mysqli_query($conn, "DELETE FROM $table;");
                    if (mysqli_query($conn, $output) == false) {
                        echo "-ERROR- " . (mysqli_error($conn));}
                        // Execute the insert statement
                     else {
                        mysqli_close($conn);
                        echo "Completed Successfully";}
                    } 
            }
            ?>
        </p>
	</body>
</html>

