<?php
	include 'navbar.php';
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" type="image/gif/png" href="icon0.png">
	<title>Previous Rides-Driver</title>
</head>
<body>
	<div class="container-fluid col-lg-12 col-md-12 col-sm-12" style="padding-top: 80px";>
		<?php
			$arrive = 420;
			$timestamp1 = date("Y-m-d H:i:s");
			$timestamp = strtotime($timestamp1);
			$user = $_SESSION['d_id'];
			$current_ride = "SELECT * FROM `rides` WHERE `driverid` = '".$user."' AND ('".$timestamp."' - `unixtime`) > '".$arrive."'";
			$ride_data = mysqli_query($connect, $current_ride);
			if(mysqli_num_rows($ride_data) != "")
			{
				echo "
				<center>
				<div class='table-responsive' style='width: 100% padding-top:150 px'>
					<table class='table table-bordered'>
					<tr>
					<th width='10%'>Ride No</th>
					<th width='20%'>Source</th>
					<th width='20%'>Destination</th>
					<th width='15%'>Booked D&T</th>
					<th width='10%'>Fare</th>
					<th width='15%'>Customer Contact No</th>
					<th width='10%'>Status</th>
					</tr>
				";
				$ride_no = 1;
				while($row_posts = mysqli_fetch_array($ride_data))
				{			
					if($row_posts['status']=="0"){
						$status = "On-going";
					}	
					elseif($row_posts['status']=="1"){
						$status = "Canceled by user";
					}
					else{
						$status = "Canceled by driver";

					}				
					echo '<tr>';
						echo "<td>";
							echo $ride_no;
						echo "</td>";
						echo "<td><center>";
							echo $row_posts['source'];
						echo "</center></td>";
						echo "<td>";
							echo $row_posts['destin'];
						echo "</td>";
						echo "<td>";
							echo '<div id="timestamp">';
								echo $row_posts['timestamp1'];
							echo '</div>';
						echo "</td>";
						echo "<td>";
							echo $row_posts['fare'];
						echo "</td>";
						echo "<td>";
							echo $row_posts['mobile'];
						echo "</td>";
						echo "<td>";
							echo $status;
						echo "</td>";
					echo '</tr>';
					$ride_no = $ride_no+1;
				}
				echo " 
					</table>
					</div>
					</center>
				";
			}
			else
			{
				echo "
					<div class='card'>
						<h5 class='card-header'>Hello There!</h5>
						<div class='card-body'>
							<h5 class='card-title'>No customers rode your cab!.</h5>
						</div>
					</div>
				";
			}
		?>
	</div>
</body>
</html>