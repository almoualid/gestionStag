<!DOCTYPE html>
<html>
<head>
	<title>Authentification</title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
	<h1>Authentification</h1>
	<form method="post" action="authen.php">
		<label for="username">Nom d'utilisateur:</label>
		<input type="text" id="username" name="loginAdmin"><br><br>

		<label for="password">Mot de passe:</label>
		<input type="password" id="password" name="motDePasse"><br><br>

		<input type="submit" value="Se connecter">
	</form>
	
</body>
</html>