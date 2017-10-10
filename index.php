<!--
Name: Aziz
course:WDM assignment # 3
description: creating basic login form that display to the screen results
-->
<?php   session_start();  ?>

<?php
	if(isset($_SESSION['authenticated'])){
		if($_SESSION['authenticated'] == True){
			header("Location:welcome.php");
		}
	}
?>
<!DOCTYPE html>

<html>

<body>

<?php
	require "connection.php";
?>

<h2>Login Form</h2>

<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">

  <div>

         <?php
            $msg = '';
			if(isset($_SESSION['report'])){
				$reportarray = $_SESSION['report'];
			}else{
				$reportarray = array();
			}

			if(!isset($_SESSION['counter'])){
				$_SESSION['counter'] = 0;
			}

            /*
			$passarray["Aziz"] = "pwd1";
			$passarray["John"] = "12345";
			$passarray["user1"] = "54321";
			*/

            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])){

				$name = $_POST['username'];
				$pwd = md5($_POST['password']);
				$found = False;
				/*
				foreach($passarray as $x => $x_value) {
					if(($x == $name) && ($x_value == $pwd)){
						$found = True;
					}
				}
				*/

				// call php function
				$pdo = db_connect();
				$sql = "SELECT username, password FROM users WHERE username = ? AND password = ?";
				$query = $pdo->prepare($sql);
				$query->execute(array($name, $pwd));

			    if ($query->rowCount() >= 1){
				  //$msg = 'Welcome '.$name;
				  $_SESSION['authenticated'] = True;
				  $_SESSION['username'] = $name;
				  $_SESSION['password'] = $_POST['password'];
				  header("Location:welcome.php");

			    }else{
				  $msg = 'Wrong username or password';
				  //array_merge($reportarray, array($name => $pwd));
				  $reportarray = $reportarray + array($name => $pwd);
				  $_SESSION['report'] = $reportarray;
				  $_SESSION['counter'] ++;
				  $msg = $msg."<br/>"."Attempt no:".$_SESSION['counter'];
				  if($_SESSION['counter'] >= 6){
					  $msg = $msg."<br/>"."You have been banned for 1 hour!!!";
				  }
			    }
			}
         ?>

      </div>

      <div class = "container">

         <form role = "form" action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method = "post">
            <h4><?php echo $msg; ?></h4>
            <input type = "text" name = "username" placeholder = "username" required autofocus></br>
            <input type = "password" name = "password" placeholder = "password" required>
			   <br/>
            <button type = "submit" name = "login">Login</button>
			   <br/>
			   <button type="reset">Clear</button>
			   <br/>

			   <br/>
			   <a href="logout.php">Logout</a>
			   <br/>
			   <a href="register.php">Register</a>
         </form>
		 <br/>
		 <form role="report" action="report.php" method="post">
				   <br/>

				<button type="submit" name = "report">Report</button>
				<br/>
			</form>
      </div>

  </div>
</form>

</body>
</html>
