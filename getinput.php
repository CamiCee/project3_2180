<!DOCTYPE>
<html>
    <head>
        <!--<script src="login.js" type="text/javascript"></script>-->
    </head>
        
    <body>
        <form action="login.php" form method="POST">
            
            Username: <input type="text" name="username"  id="username" required/>
            <br><br>
             Password: <input type="password" name="password" id="password" pattern="[A-Za-z0-9~!#()_+=\-\[\];',\.]+" required />
			<br> <br>
			
			<button id="submitBtn">Submit</button>
        </form>
    </body>
</html>