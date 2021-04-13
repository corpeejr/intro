<?php include '../hub/db.php'; ?>

<?php 

session_start();
ob_start();

function logOut() {
	if(isset($_POST['logOut'])){
		session_destroy();
		echo "<script> window.location = '/practice/login.php'</script>";
	}
}

function checkUser(){
	if(isset($_SESSION['fullName'])){
	if(isset($_SESSION['email'])){
		echo "<script> alert('Welcome : " . $_SESSION['fullName'] . " ')</script>";
	}
	}else{
		echo "<script> window.location = '/practice/login.php'</script>";
	}
		
	}

// add user 
function addUser(){
	global $con;

	if (isset($_POST['addUser'])) {
		
		$fullname 	= $_POST['fullname'];
		$email 		= $_POST['email'];
		
		$image 		= 	time().$_FILES['image']['name'];
		$image_tmp 	= 	$_FILES['image']['tmp_name'];

		$phone 		= $_POST['phone'];
		$password 	= $_POST['password'];
		$role 		= $_POST['role'];
		$status 	= $_POST['status'];

		move_uploaded_file($image_tmp, "../img/users/$image");

		$sql = "INSERT INTO users( fullname, email, image, phone, password, role, status)VALUES ('{$fullname}', '{$email}', '{$image}', '{$phone}', '{$password}', '{$role}', '{$status}')";

		if ($con->query($sql) === TRUE) {
			// echo "<script> window.location = 'users.php'</script>";
		}else{
			echo "Error " . $con->error;
		}
	}
}




// view users function 
function viewUsers(){

	//make the $con virable accessable everwhere
	global $con;  


	// select all users from the database tobe process
	$selectQuery = "SELECT * FROM users";
	// create's an array of users in the results virable 
	$results = mysqli_query($con, $selectQuery);

	// loop through the results array and return in a table
	while ($rows = mysqli_fetch_assoc($results)) {
		echo "<tr>"
			    ."<th>".$rows['id']."</th>"
				."<th>".$rows['fullname']."</th>"
				."<th>"."<img class='img img-thumbnail' src='../img/users/{$rows['image']}' width='100px'>"."</th>"
				."<th>".$rows['email']."</th>"
				."<th>".$rows['phone']."</th>"
				."<th>".$rows['status']."</th>"
				."<th>"."<a href='users.php?page=editUser&id={$rows['id']}'>edit</th>".
			 	"</tr>";
	}
}




// update user function

function updateUser(){
	global $con;

	if(isset($_POST['editUser'])) {

		$id = $_POST['userId'];
		$fullname = $_POST['fullname'];
		$email = $_POST['email'];
		$image = $_POST['image'];
		$phone = $_POST['phone'];
		$password = $_POST['password'];
		$role = $_POST['role'];
		$status = $_POST['status'];

		$sql = "UPDATE users SET 

		fullname = '{$fullname}',
		email = '{$email}',
		image = '{$image}',
		phone = '{$phone}',
		password = '{$password}',
		role = '{$role}',
		status = '{$status}'
		WHERE id = '{$id}' ";


		if ($con->query($sql) === TRUE) {
			echo "<script> window.location = 'users.php'</script>";
		}else{
			echo "Error " . $con->error;
		}

	}

	

}


// deleteuser user function

// function deleteUser(){
// 	global $con;



// }





// PORTFOLIO CROUD

function addPortfolio(){
	global $con;

	if (isset($_POST['addPortfolio'])) {
		
		$title = $_POST['title'];

		$image 		= 	time().$_FILES['image']['name'];
		$image_tmp 	= 	$_FILES['image']['tmp_name'];

		$date = $_POST['date'];
		$content = $_POST['content'];
		$categories = $_POST['categories'];
		$status = $_POST['status'];


		move_uploaded_file($image_tmp, "../img/portfolio/$image");

		$sql = "INSERT INTO portfolios ( title, image, date, content, categories, status) VALUES ( '{$title}', '{$image}', '{$date}', '{$content}', '{$categories}', '{$status}'  )";


		if ($con->query($sql) === TRUE) {
			echo "<script> window.location = 'portfolios.php'</script>";
		}else{
			echo "error" . $con->error;
		}


	}

}

function viewPortfolios(){
	global $con;

	$sql = "SELECT * FROM portfolios";
	$portfolios = mysqli_query($con, $sql);

	while ($rows = mysqli_fetch_assoc($portfolios)) {
		echo "<tr>"
			    ."<th>".$rows['id']."</th>"
				."<th>".$rows['title']."</th>"
				."<th>".  "<img src='../img/portfolio/{$rows['image']}' width='100px'>" ."</th>"
				."<th>".$rows['date']."</th>"
				."<th>".$rows['content']."</th>"
				."<th>".$rows['categories']."</th>"
				."<th>".$rows['status']."</th>"
				."<th>"."<a href='portfolios.php?page=editPortfolio&id={$rows['id']}'>edit</th>".
			 	"</tr>";
	}
}

function editPortfolio(){
		global $con;

	if (isset($_POST['editPortfolio'])) {
		$id = $_POST['id'];
		$title = $_POST['title'];

		$image 		= 	time().$_FILES['image']['name'];
		$image_tmp 	= 	$_FILES['image']['tmp_name'];

		$date = $_POST['date'];
		$content = $_POST['content'];
		$categories = $_POST['categories'];
		$status = $_POST['status'];


		move_uploaded_file($image_tmp, "../img/portfolio/$image");

		$sql = "UPDATE portfolios SET 

		title = '{$title}',
		image = '{$image}',
		date = '{$date}',
		content = '{$content}',
		categories = '{$categories}',
		status = '{$status}'
		WHERE id = '{$id}' ";


		if ($con->query($sql) === TRUE) {
			echo "<script> window.location = 'portfolios.php'</script>";
		}else{
			echo "error" . $con->error;
		}


	}
}

// function deletePortfolio(){
	
// }

?>
