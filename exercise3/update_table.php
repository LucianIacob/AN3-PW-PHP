<html>
<body>

<?php

	$teamCollections = array($_POST['club'], $_POST['club1'], $_POST['club2'], $_POST['club3'], $_POST['club4'], $_POST['club5'], $_POST['club6'], 
		$_POST['club7'], $_POST['club8'], $_POST['club9'], $_POST['club10'], $_POST['club11'], $_POST['club12'], $_POST['club13']);

	$scoresCollection = array($_POST['goals1'], $_POST['goals2'], $_POST['goals3'], $_POST['goals4'], $_POST['goals5'], $_POST['goals6'], 
		$_POST['goals7'], $_POST['goals8'], $_POST['goals9'], $_POST['goals10'], $_POST['goals11'], $_POST['goals12'], $_POST['goals13'], $_POST['goals14']);

	updateTable($teamCollections, $scoresCollection);

	function updateTable($teamCollections, $scoresCollection) {
		if (!scoresAreOK($scoresCollection))
			echo '<span style="color:red;text-align:center;">Scorurile trebuie sa fie intre 0 - 9!</span>';
		else {
			if(!teamsAreUnique($teamCollections))
				echo '<span style="color:red;text-align:center;">Intr-o etapa o echipa joaca un singur meci impotriva oricarei alte echipe!</span>';
			else {
				for ($count = 0; $count < 14; $count=$count+2) {
		    		if ($scoresCollection[$count] == $scoresCollection[$count + 1])
		    			resolveDrawn($teamCollections[$count], $scoresCollection[$count], $teamCollections[$count + 1]);
		    		else if ($scoresCollection[$count] > $scoresCollection[$count + 1])
		    			resolveWin($teamCollections[$count], $scoresCollection[$count], $scoresCollection[$count + 1], $teamCollections[$count + 1]);
		    		else
		    			resolveWin($teamCollections[$count + 1], $scoresCollection[$count + 1], $scoresCollection[$count], $teamCollections[$count]);
				}
			}
		}
	}

	function resolveDrawn($team1, $goals, $team2) {
		
		$servername = "localhost";
		$username = "root";
        $password = "root";
        $dbname = "premierleague";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE premierleague.premierleague SET played=played+1, draws=draws+1, goals_for=goals_for+".$goals.", goals_against=goals_against+".$goals.", points=points+1 WHERE club='". $team1 ."';";
        if ($conn->query($sql) === TRUE) {
    		echo "Record updated successfull<br>";
		} 
		else {
    		echo "Error updating record: " . $conn->error;
		}

		$sql = "UPDATE premierleague.premierleague SET played=played+1, draws=draws+1, goals_for=goals_for+".$goals.", goals_against=goals_against+".$goals.", points=points+1 WHERE club='". $team2 ."';";
        if ($conn->query($sql) === TRUE) {
    		echo "Record updated successfull<br>";
		} 
		else {
    		echo "Error updating record: " . $conn->error;
		}

		$conn->close();
	}

	function resolveWin($winner, $scoreWinner, $scoreLooser, $looser) {
		
		$servername = "localhost";
		$username = "root";
        $password = "root";
        $dbname = "premierleague";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE premierleague.premierleague SET played=played+1, wins=wins+1, goals_for=goals_for+".$scoreWinner.", goals_against=goals_against+".$scoreLooser.", points=points+3 WHERE club='". $winner ."';";
        if ($conn->query($sql) === TRUE) {
    		echo "Record updated successfully<br>";
		} 
		else {
    		echo "Error updating record: " . $conn->error;
		}

		$sql = "UPDATE premierleague.premierleague SET played=played+1, loses=loses+1, goals_for=goals_for+".$scoreLooser.", goals_against=goals_against+".$scoreWinner." WHERE club='". $looser ."';";
        if ($conn->query($sql) === TRUE) {
    		echo "Record updated successfully<br>";
		} 
		else {
    		echo "Error updating record: " . $conn->error;
		}

		$conn->close();

	}

	function scoresAreOK($scoresCollection) {
		foreach ($scoresCollection as $value) {
			if (ctype_digit($value) != 1)
				return false;
			if ($value > 9)
   				return false;
		}
		return true;
	}

	function teamsAreUnique($teamCollections) {
		if(count(array_unique($teamCollections)) < count($teamCollections))
		{
		    return false;
		}
		return true;
	}
?>

	<form action="labPHP_leagueTable.php">        
        <input type="submit" value="Return to League Table">
    </form>
</body>
</html>