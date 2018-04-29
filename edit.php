<?php
require 'db.php';

$messasge = '';
$id = $_GET['id'];

$sql = 'SELECT * FROM people WHERE id=:id';

$statement = $connection->prepare($sql);

$statement->execute([':id' => $id]);

$person = $statement->fetch(PDO::FETCH_OBJ);

if (isset ($_POST['name']) && isset($_POST['email'])){

	$name = $_POST['name'];
	$email = $_POST['email'];

	$sql = 'UPDATE people SET name=:name, email=:email WHERE id =:id';
	$statement = $connection->prepare($sql);

	if($statement->execute([':name' => $name, ':email' => $email, ':id' =>$id])){
 echo "Person Updated";
		header("Location: index.php");
	}	
}
?>

<?php require 'header.php'; ?>
<?php require 'navigation.php'; ?>

<div class="container">
	<div class="card mt-5">
		<div class="card-header">
			<h2>Update a person</h2>
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
			<input type="text" name="name" id="name" value="<?=$person->name; ?>" class="form-control">
		</div>

		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" name="email" id="email" value="<?=$person->email; ?>" class="form-control">
		</div>
		<div class="form-group">
			
			<button type="submit" class="btn btn-warning">Update person</button>

		</div>
		</form>
	    </div>
	</div>
</div>



<?php require 'footer.php'; ?>