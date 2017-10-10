<?php   session_start();  ?>

<?php
	if($_SESSION['authenticated'] == False || !isset($_SESSION['authenticated'])){
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html>

<body>

<h2>Welcome page</h2>

<form>

  <div>
	<h4><?php echo "username:".$_SESSION['username']."<br>"."password:".$_SESSION['password']."<br>"."date:".date("Y/m/d")   ?></h4>
	<br/>
	<br/>
    <a href="logout.php">Logout</a>
  </div>
</form>

</body>
</html>
