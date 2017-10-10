<?php   session_start();  ?>

<?php
	if(isset($_SESSION['authenticated'])){

		if($_SESSION['authenticated'] == True){

			header("Location:welcome.php");
		}
	}
?>
<?php
	require_once 'connection.php';
?>

<!DOCTYPE html>

<html>

<body>
<h2>Registration form</h2>
<div>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
        <div>

			<?php
				$msg = '';

				if (isset($_POST['register']) && !empty($_POST['username']) && !empty($_POST['password'])){

					$name = $_POST['username'];
					$pwd = $_POST['password'];

					// check minimum security standard for password
					$uppercase = preg_match('@[A-Z]@', $pwd);
					$lowercase = preg_match('@[a-z]@', $pwd);
					$number    = preg_match('@[0-9]@', $pwd);

					if(!$uppercase || !$lowercase || !$number || strlen($pwd) < 8) {
					  $msg = 'Password must be minimum 8 character, contain 1 upper case, 1 lower case and 1 number';

					}else{

						$pdo = db_connect();
						$sql = "SELECT username FROM users WHERE username = ?";
						$query = $pdo->prepare($sql);
						$query->execute(array($name));

						if ($query->rowCount() == 0){

							$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
							$query = $pdo->prepare($sql);
							$pwd = md5($pwd);
							$query->execute(array($name, $pwd));
							// delete next 3 rows to avoid automatic login
							$_SESSION['authenticated'] = True;
							$_SESSION['username'] = $name;
							$_SESSION['password'] = $_POST['password'];
							header("Location:index.php");

						}else{
							$msg = 'username already exists in database!';
						}
					}
				}

			?>
			<div>
            <form role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
				<br/>
				<h4><?php echo $msg; ?></h4>
				<br/>
				<br/>
                <input type = "text" name = "username" placeholder = "username" required autofocus>
				</br>
				<input type = "password" name = "password" placeholder = "password" required>
				<br/>
                <button type = "submit" name = "register">Register</button>
            </form>
			</div>

        </div>
    </div>
	</form>
	</body>
</html>
