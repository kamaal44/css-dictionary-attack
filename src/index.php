<?php
$inputValues = array('pwd' => '');
$errorMessages = array('pwd' => '');
if (isset($_SERVER['REQUEST_METHOD']) && strtolower($_SERVER['REQUEST_METHOD']) === 'post') {
    if (isset($_POST['pwd'])) {
        $inputValues['pwd'] = htmlentities($_POST['pwd'], ENT_QUOTES, 'UTF-8');
        $parameters = array('pwd' => $_POST['pwd']);
        mb_internal_encoding('UTF-8');
        $error = false;
        if (mb_strlen($parameters['pwd']) < 1) {
            $errorMessages['pwd'] = 'Please enter password';
            $error = true;
        } else if (mb_strlen($parameters['pwd']) > 50) {
            $errorMessages['password'] = 'Password is exceeding 50 characters';
            $error = true;
        }
        if (!$error) {
            $errorMessages['pwd'] = "Last submitted: {$inputValues['pwd']}";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>CSS Dictionary</title>
		<meta name="description" content="CSS dictionary.">
		<meta name="keywords" content="HTML, CSS, dictionary">
		<meta name="author" content="Ivan Šincek">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="./css/main.css" hreflang="en" type="text/css" media="all">
	</head>
	<body>
		<div class="front-form">
			<div class="layout">
				<header>
					<h1 class="title">CSS Dictionary</h1>
				</header>
				<form method="post" action="./index.php">
					<label for="pwd">Password</label>
					<!-- attack is only possible if the sent value is echoed back -->
					<input name="pwd" id="pwd" type="password" maxlength="50" value="<?php echo $inputValues['pwd']; ?>">
					<p class="error"><?php echo $errorMessages['pwd']; ?></p>
					<input type="submit" value="Submit">
				</form>
			</div>
		</div>
	</body>
</html>
