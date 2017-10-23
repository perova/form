<?php

if (isset($_POST["name"])){

try {
 
        $conn = new PDO("mysql:host=localhost;dbname=students;charset=utf8","root", "");
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 $stmt =$conn->prepare("INSERT INTO users (name, surname, email, phone)  VALUES (:name, :surname, :email, :phone)");



 //1 variantas
 $stmt->bindParam(":name",$_POST['name']);
 $stmt->bindParam(":surname",$_POST['surname']);
 $stmt->bindParam(":email",$_POST['email']);
 $stmt->bindParam(":phone",$_POST['phone']);
 $stmt->execute();   
        // $conn->query("INSERT INTO users (name, surname, email, phone) VALUES ('".$_POST['name']."','".$_POST['surname']."','".$_POST['email']."','".$_POST['phone']."')");



//2 variantas
 //$stmt->execute($_POST);    
 $conn=null;

    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}
try {
 
    $conn = new PDO("mysql:host=localhost;dbname=students;charset=utf8","root", "");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $q = $conn->query("SELECT * FROM users");
    //$q->execute();
 
    $users = $q->fetchAll(PDO::FETCH_ASSOC);
 
 	$conn=null;

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//print_r($users);

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<title>Form</title>
</head>
<body>
	<!-- start form container -->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h1>User List</h1>
				<table class="table">

<thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
 
                </thead>
                <tdata>
                    <?php
                        foreach ($users as $user) {
                            echo "<tr>
                            <td>".$user['id']."</td>
                            <td>".$user['name']."</td>
                            <td>".$user['surname']."</td>
                            <td>".$user['email']."</td>
                            <td>".$user['phone']."</td>
                            </tr>";
                        }
                    ?>
                </tdata>
            </table>

			</div>
			<div class="col-md-6" action="index.php">
				<div><h1>Registration Form</h1></div>
				<form method="POST">
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Name</label>
						<div class="col-10">
							<input class="form-control" type="text"  id="name" name="name" placeholder="Name">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-text-input" class="col-2 col-form-label">Surname</label>
						<div class="col-10">
							<input class="form-control" type="text" id="surname" name="surname" placeholder="Surname">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-email-input" class="col-2 col-form-label">Email</label>
						<div class="col-10">
							<input class="form-control" type="email"  id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<label for="example-tel-input" class="col-2 col-form-label">Telephone</label>
						<div class="col-10">
							<input class="form-control" type="tel" v id="tel" name="phone" placeholder="Phone number">
						</div>
					</div>
					<input class="btn btn-success" type="submit">
				</form>
			</div>
		</div>

	</div>
	<!-- end form container -->
</body>
</html>