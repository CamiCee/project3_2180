<!DOCTYPE HTML>
<html>
	<head> 
		<title> Home </title>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js" type="text/javascript"></script>
	</head>
	<body>
			<h2>Compose</h2>
			<div id="container2">
				<form method="POST" action="compose2.php">
					<label for="recipients">Recipient&nbsp;</label> 
					<input type="text" name="recipients" id="recipients" required/>
					<br>
					<label for="subject">Subject &nbsp;&nbsp;&nbsp;&nbsp;</label> 
					<input type="text" name="subject" id="subject" required/>
					<br>
					<textarea name="msg" id="msg" rows="16" cols="100"></textarea>
					
					<br>
					<input type="submit" name="submit" value="Send">
				</form>
			</div>
	</body>
</html>