<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un Stagiaire</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Ajouter un Stagiaire</h1>

    <?php
    // Connexion à la base de données
    include_once('conn.php');

    // Récupération des catégories depuis la base de données
    $query = "SELECT IdF, intitule FROM filiere";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Vérifier si le formulaire a été soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $IdStagiaire = $_POST["IdStagiaire"];
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $dateDeNaissance = $_POST["dateDeNaissance"];
        $IdF = $_POST["IdF"];
        $photo = $_FILES["photo"]["name"];
        $photoTmp = $_FILES["photo"]["tmp_name"];

        // Transférer l'image vers le dossier "images"
        $dossierDestination = "image/";
        $cheminDestination = $dossierDestination . $photo;
        move_uploaded_file($photoTmp, $cheminDestination);

        // Ajouter les données dans la base de données
        $query = "INSERT INTO stagiaire (IdStagiaire, prenom, nom, dateDeNaissance, photo, IdF) VALUES (:IdStagiaire, :prenom, :nom, :dateDeNaissance, :photo, :IdF)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':IdStagiaire', $IdStagiaire);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':dateDeNaissance', $dateDeNaissance);
        $stmt->bindParam(':photo', $cheminDestination);
        $stmt->bindParam(':IdF', $IdF);
        $stmt->execute();

        // Redirection vers la page d'accueil
        header('Location: acceuil.php');
        exit();
    }
    ?>

    <form method="POST" enctype="multipart/form-data">
        <label>ID :</label>
        <input type="text" name="IdStagiaire" required><br> <br>

        <label>Prenom:</label>
        <input type="text" name="prenom" required><br> <br>

        <label>Nom:</label>
        <input type="text" name="nom" required><br> <br>

        <label>Date de Naissance:</label>
        <input type="date" name="dateDeNaissance" required><br> <br>

        <label>Photo du Stagiare:</label>
        <input type="file" name="photo" required><br> <br>

        <label>Filiere:</label>
        <select name="IdF">
            <?php
            // Affichage des options de la liste déroulante avec les dénominations de chaque catégorie
            foreach ($categories as $category) {
                echo "<option value='" . $category['IdF'] . "'>" . $category['intitule'] . "</option>";
            }
            ?>
        </select><br>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>
