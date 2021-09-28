<?php
function main() {
	global $myCalculator;
	echo "
		<div id='head'>
		<label>Target: </label>".$myCalculator->getTarget()."<br>
		<label>Min State: </label>".$myCalculator->minStake."<br>
		<label>Ideal Balance: </label>".$myCalculator->idealBalance()."<br>
		<label>Max Odd: </label>".$myCalculator->maxOdd()."<br> </div>";

	echo "<table><tr><th>Match Day</th> <th>Odds</th> <th>Stake</th> <th>To Win</th></tr>".$myCalculator->formData()."</table>";
}

?>

