<?php 
	if (isset($_GET['id'])) {
		$pId = $_GET['id'];
	}

	$sql = "SELECT * FROM portfolios WHERE id = {$pId} ";
	$results = mysqli_query($con, $sql);

	while ($row = mysqli_fetch_assoc($results)) {

		$id = $row['id'];
		$title = $row['title'];
		$image = $row['image'];
		$date = $row['date'];
		$content = $row['content'];
		$categories = $row['categories'];
		$status = $row['status'];
 ?>

<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-title text-center">
				<h3 class="display-3">Edit Portfolio Form</h3>
			</div>
			<div class="card-body">
				<?php updateUser(); ?>

				<form class="row g-3" method="POST" >
					<input type="hidden" name="userId" value="<?= $id; ?>">
				  <div class="col-md-12">
				    <label for="title" class="form-label">Please Enter Full Name</label>
				    <input type="text" class="form-control form-control-lg" name="fullname" value="<?= $title; ?>">
				  </div>
				  <div class="col-md-6">
				    <label for="image" class="form-label">Email</label>
				    <input type="file" class="form-control form-control-lg" name="image">
				  </div>
				  <div class="col-md-6">
				    <label for="date" class="form-label">Select Date</label>
				    <input type="date" class="form-control form-control-lg" name="date"  value="<?= $date; ?>">
				  </div>
				  <div class="col-md-6">
				    <label for="content" class="form-label">Content</label>
				    <input type="content" class="form-control form-control-lg" name="content" value="<?= $content; ?>">
				  </div>
				  
				  <div class="col-lg-6">
				  	<label for="status" class="form-label">Select User Role</label>
				    <select class="form-control form-control-lg" name="role">
				    	<option value="<?= $categories; ?>"><?= $categories; ?></option>
				    	<option value="admin">Admin</option>
				    	<option value="subscriber">Subscriber</option>
				    </select>
				  </div>
				  <div class="col-lg-6">
				    <label for="status" class="form-label">Select User Status</label>
				    <select class="form-control form-control-lg" name="status">
				    	<option value="<?= $status; ?>"><?= $status; ?></option>
				    	<option value="active">Active</option>
				    	<option value="draft">Draft</option>
				    </select>
				  </div>
				  
				  	<div style="width: 100%"> 
				  		<br><br>
				  		<button type="submit" class="btn btn-lg btn-primary" name="editUser">Save Changes</button>
				  	
				  		<!-- Button trigger modal -->
						<button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#exampleModal" style="float: right;">
						  Delete User
						</button>
				  	</div>
				   
				</form>
			</div>
		</div>
	</div> <!-- col-lg-8 ends -->
	<div class="col-lg-4">
		<div class="card">
			<div class="card-body">
				<img class="img img-thumbnail" src="../img/portfolio/<?= $image; ?>" width="100%">
			</div>
		</div>
	</div>
</div>



<?php } ?>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Portfolio Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are u sure u want to delete <b><?= $title ?> </b>?</p>
      </div>
      <div class="modal-footer">
      	<form method="POST">
      		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        	<button name="deletePortfolio" type="submit" class="btn btn-danger">Yes</button>
      	</form>
      </div>
    </div>
  </div>
</div>

<?php 

	if (isset($_POST['deletePortfolio'])) {
		$sql = "DELETE FROM portfolios  WHERE id = {$id} ";
		if($con->query($sql) === TRUE){
			echo "<script> window.location = 'portfolios.php'</script>";
		}else {
			echo "Error ". $con->error;
		}
	}
 ?>


