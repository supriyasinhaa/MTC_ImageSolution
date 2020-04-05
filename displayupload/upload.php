<!DOCTYPE html>
<html>
<head>
	<title></title>

	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	
	<div class="container">
		<br>
		<h1 class="text-center text-white bg-dark"> Registered Name with Profile </h1>
	<br>
	<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover">

		<thead class="bg-dark text-white">
			<th>Id</th>
			<th>Username</th>
			<th>Profile Pic</th>
		</thead>


		<tbody>
	<?php

	$con = mysqli_connect('localhost','root');
	mysqli_select_db($con, 'displayupload');

	if(isset($_POST['submit'])){

		$username = $_POST['username'];
		$files = $_FILES['file'];

		print_r($username);
		echo "<br>";
		//print_r($files);

		$filename = $files['name'];
		$fileerror = $files['error'];
		$filetmp = $files['tmp_name'];

		$fileext = explode('.',$filename);
		$filecheck = strtolower(end($fileext));

		$fileextstored = array('png', 'jpg', 'jpeg');

		if(in_array($filecheck,$fileextstored)){

			$destinationfile ='upload/'.$filename;
			move_uploaded_file($filetmp,$destinationfile);

			$q = "INSERT INTO `imgupload`(`username`, `image`) VALUES ('$username','$destinationfile')";
			
			$query = mysqli_query($con,$q);

			$displayquery = "select * from imgupload ";
			$querydisplay = mysqli_query($con,$displayquery);

			// $row = mysqli_num_rows($querydisplay);

			while ( $result = mysqli_fetch_array($querydisplay)){

				?>
				<tr>
					<td> <?php echo $result ['id']; ?> </td>
					<td> <?php echo $result ['username']; ?> </td>
					<td> <img src="<?php echo $result ['image']; ?>" height="100px" width="100px"> </td>

				</tr>
				<?php
			}
	}else{
			echo "Extension is not matching.";
	}

	?>
		</tbody>
	</table>
	</div>
	</div>

</body>
</html>
