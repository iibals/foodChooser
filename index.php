<?php 
$host = 'localhost';
$username = 'root';
$password = '';
$db_name = 'food';

$conn = new mysqli($host,$username,$password,$db_name);

if ($conn->connect_error) {
	die("Sorry failed connection to database" . $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {

	$breakfast 	= $_POST["breakfast"];
	$lunch 		= $_POST["lunch"];

	$sqlUpload = "INSERT INTO choices (breakfast, lunch) VALUES(?,?)";
	$stmt = $conn->prepare($sqlUpload);
	$stmt->bind_param("ss",$breakfast,$lunch);
	$stmt->execute();
}


?>

<style>
	
	th {
		 width: 350px;
	} 
	* {
		 font-size: 48px;
	}
	p {
		font-size: ;
	}
	input {
		font-size: 30px !important;
	}
	table tr:last-of-type th {
		color:green;
	}
</style>
<div style="

		margin: 50px auto;
		width: 29%;
		
			">
		<div>
			<h1 style="text-align: center;margin-right:15px"> Your Meals Today is! </h1>
		<table>

			<tr>
				<th>Breakfast</th>
				<th>Lunch</th>
			</tr>	
			<tr>
			<?php 

				date_default_timezone_set("Asia/Riyadh");


					$currentTime = date('H:i');
					$result = $conn->query("SELECT breakfast,lunch FROM choices ORDER BY RAND() LIMIT 1");

						if ($result->num_rows > 0) {

						$row = $result->fetch_assoc();
							echo '<th>' . htmlspecialchars($row["breakfast"]) .'</th>';
							echo '<th>' . htmlspecialchars($row["lunch"]) .'</th>';

						} else {

							echo ' No result';
						}
				$conn->close();

			?>
			</tr>
		</table>
			</div>
			<form action="index.php" method="POST">
			<div style="display: flex; justify-content:center;"> 
				<lable>	
					<span>	Fill Your choice Breakfast </span>
					<input type="text" name="breakfast" placeholder="breakfast"/>
				</lable>			<lable>	
					<span>	Fill Your choice Lunch </span>
					<input type="text" name="lunch" placeholder="lunch" />
				</lable>
			</div>
				<p style="text-align:center;">	
					<input type="submit" name="Send!">
						</p>
			</form>


</div>