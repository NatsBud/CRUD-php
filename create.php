<?php

require 'db.php';

$message = '';

if (isset ($_POST['name']) && isset($_POST['email'])){

	$name = $_POST['name'];
	$email = $_POST['email'];

	if(empty($name) && empty($email)){
		$message = "Fill all fields";
		
	}else{

$sql = 'INSERT INTO people(name, email) VALUES(:name, :email)';
	$statement = $connection->prepare($sql);

	if($statement->execute([':name' => $name, ':email' => $email])){
		$message = 'data inserted successfully';

	}

	
	}	
}
?>




<?php require 'header.php'; ?>
<?php require 'navigation.php'; ?>

<div class="container">
	<div class="card mt-5">
		<div class="card-header">
			<h2>Create a person</h2>
		</div>
		
	    <div class="card-body">
	    	<?php if(!empty($message)): ?>
	    		<div class="alert alert-success">
	    		<?= $message; ?>
	    		</div>
	    	<?php endif; ?>	
		<form method="POST">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control">
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" class="form-control">
		</div>
		<div class="form-group">
			
			<button type="submit" class="btn btn-warning">Create a person</button>

		</div>
		</form>
	    </div>
	</div>
</div>



<?php require 'footer.php'; ?>