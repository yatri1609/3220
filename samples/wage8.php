<!DOCTYPE html>
<!--	Author: Mike O'Kane
		Date:	August 15, 2007
		File:	wage8.php
		Purpose:This example demonstrates the use of a simple if..else structure
				with the OR operator to process a weekly wage with a bonus.
				A 0.00 bonus is assigned if either the hourlyWage is greater than 25.00
				or the hours worked is less than 20, otherwise a bonus of
				50.00 is assigned.
		Input: 	hourlyWage, hoursWorked
		Output: HTML document that displays hourlyWage, hoursWorked, bonus, weeklyWage
-->

<html>
<head>
	<title>Wage Report</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>
<body>
	<?php
		$hourlyWage = $_POST['hourlyWage'];
		$hoursWorked = $_POST['hoursWorked'];

		print("<h1>Wage Report</h1>");

		if ( empty($hourlyWage) OR empty($hoursWorked) )
			print("ERROR: Input is missing!");
		elseif ( !is_numeric($hourlyWage) OR !is_numeric($hoursWorked) )
			print("ERROR: Non-numeric input found!");
		elseif ($hourlyWage < 7.25)
			print("ERROR: Hourly wage is below minimum wage!");
		elseif ($hoursWorked <= 0 )
			print("ERROR: Hours worked is less than 0!");
		else
		{
			if ($hourlyWage < 8.00)
				$hourlyWage = 8.00;

			if (($hourlyWage >= 25.00 AND $hoursWorked < 35)
				$bonus = 25.00;
			else
				$bonus = 50.00;

			$weeklyWage = $hourlyWage * $hoursWorked + $bonus;
			print("<p>Your hourly wage is $$hourlyWage and you worked
				$hoursWorked hours.</p>");
			print("<p>Your bonus is $$bonus.</p>");
			print("<p>Your weekly wage is $$weeklyWage.</p>");
		}

		print ("<p><a href=\"wage8.html\">Return to form</a></p>");
	?>
</body>
</html>

