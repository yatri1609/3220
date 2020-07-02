<?php
	session_start();
?>

<!--	Author: Mike O'Kane
		Date:	December 2007
		File:	math-quiz.php
		Purpose: Web session example
-->

<html>
<head>
	<title>Math Quiz</title>
	<link rel ="stylesheet" type="text/css" href="sample.css">
</head>

<body>
<?php
	if (!isset($_SESSION['score']))
	{
		$_SESSION['score'] = 0;
		$_SESSION['count'] = 0;
		print (" <h1>Welcome to the Math Quiz!</h1> ");
	}

	if (isset($_POST['userAnswer']))
	{
		$_SESSION['count'] = $_SESSION['count'] + 1;
		$userAnswer = $_POST['userAnswer'];
		$correctAnswer = $_SESSION['num1'] + $_SESSION['num2'];
		if ($correctAnswer == $userAnswer)
		{
			$_SESSION['score'] = $_SESSION['score'] + 1;
			print (" <h1>That is correct!</h1> ");
		}
		else
			print ("<h1>Sorry! The correct sum of ".$_SESSION['num1']." and ".$_SESSION['num2'].
				" is $correctAnswer</h1>");
	}

	print("<p>CURRENT SCORE: ".$_SESSION['score']." OUT OF A POSSIBLE ".$_SESSION['count']."</p>");

	print ("<h1>Can you add these numbers?</h1>");
	print ("<form action = \"math-quiz.php\" method = \"post\" >");
	$_SESSION['num1'] = rand(1, 20);
	$_SESSION['num2'] = rand(1, 20);

	print("<p>".$_SESSION['num1']." + ".$_SESSION['num2']." = ");
	print("<input type = \"text\" size = \"10\" name = \"userAnswer\"></p>");
	print("<p><input type = \"submit\" value = \"Submit\"></p></form>");
	print("<p><a href=\"math-quit.php\">Ready to quit?</a></p>");
?>
</body>
</html>
