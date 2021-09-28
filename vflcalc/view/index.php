<?php
//The first thing to be loaded
include('../controller/calculator.php');
include('main.inc.php');

if(isset($_POST['go'])&&!empty($_POST['target'])) {
	$target = $_POST['target'];

	$myCalculator = @new Calculator($target);
}


?>

<form method="post" action="">
	Target: <input name="target" type="text" />
	<input type="submit" name="go" value="GO!!!" />
</form>

<?php 
if (isset($target)) {
	main();
	}

?>


