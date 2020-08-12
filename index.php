<?php
include 'config.php';
$host = $protocol . $_SERVER['HTTP_HOST'];

// Create connection
$conn = new mysqli($servername, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";


// Managing data in browser with js, it's just me no need to make it scaleable right? ¯\_(ツ)_/¯
$sqlF = 'SELECT * FROM `Personal_records`';
$sqlW = 'SELECT * FROM `Weight_records`';
$resultF = $conn->query($sqlF);
$resultW = $conn->query($sqlW);
$conn->close();
echo "test";
?>
<?php include 'head.php'; ?>
<canvas id="myChart" width="400" height="400"></canvas>
<script>
var fitnes = <?php # ?>;
var weight = [<?php 
	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $resultW->fetch_assoc()) {
			echo "{x: " . $row["date"]. ",y: " . $row["weight"]. "},";
		}
	}else {
		echo "0 rows";
	}
?>];
var ctx = document.getElementById('myChart').getContext('2d');
var myLineChart = new Chart(ctx, {
    type: 'line',
    data: weight,
    options: options
});
</script>

</body>
