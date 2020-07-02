<!DOCTYPE html>
<!--	Author:
		Date:
		File:	currency.php
		Purpose:
		
-->

<html>
<head>
	<title>Currency Converter</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>

<body>

	<?php
		$country = $_POST['country'];

		print("<h1>Currency Converter: $country</h1>");

		if ($country == "Chile")
		{
				$currency = "PESO";
				$conversionFactor = 496.831;
		}
		elseif ($country == "Egypt")
		{
				$currency = "POUND";
				$conversionFactor = 5.520;
		}
		elseif ($country == "Italy")
		{
				$currency = "EURO";
				$conversionFactor = 0.6778;
		}
		elseif ($country == "Japan")
		{
				$currency = "YEN";
				$conversionFactor =  108.645;
		}
		elseif ($country == "Spain")
		{
				$currency =  "EURO";
				$conversionFactor = 0.6778;
		}
		 

	?>

</body>
</html>
