<!DOCTYPE html>
<html>
<head>
    <title>Modifier un Stagiaire</title>
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

        button[type="submit"] {
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

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Modifier un Stagiaire</h1>

    <?php
    // Vérifier si un ID de produit est passé en paramètre dans l'URL
    if (isset($_GET['id'])) {
        $IdStagiaire = $_GET['id'];

        // Connexion à la base de données
        include_once("conn.php");

        // Récupération des informations du produit à partir de la base de données
        $query = "SELECT * FROM stagiaire WHERE IdStagiaire  = :IdStagiaire";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':IdStagiaire', $IdStagiaire);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérer les données du formulaire
            $prenom = $_POST["prenom"];
            $nom = $_POST["nom"];
            $dateDeNaissance = $_POST["dateDeNaissance"];
            $IdF = $_POST["IdF"];

            // Mettre à jour les données du produit dans la base de données
            $query = "UPDATE stagiaire SET prenom = :prenom, nom = :nom, dateDeNaissance = :dateDeNaissance, IdF = :IdF WHERE IdStagiaire = :IdStagiaire";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':dateDeNaissance', $dateDeNaissance);
            $stmt->bindParam(':IdF', $IdF);
            $stmt->bindParam(':IdStagiaire', $IdStagiaire);
            $stmt->execute();

            // Fermeture de la connexion à la base de données
            $conn = null;

            // Redirection vers la page d'accueil
            header('Location: acceuil.php');
            exit();
        }
    } else {
        // Si aucun ID de produit n'est passé en paramètre dans l'URL, rediriger vers la page d'accueil
        header('Location: acceuil.php');
        exit();
    }
    ?>

    <form method="POST">
        <label>ID :</label>
        <input type="text" name="IdStagiaire" value="<?php echo $row['IdStagiaire']; ?>" readonly><br>

        <label>Libellé:</label>
        <input type="text" name="prenom" value="<?php echo $row['prenom']; ?>" required><br>

        <label>Prix unitaire:</label>
        <input type="text" name="nom" value="<?php echo $row['nom']; ?>" required><br>

        <label>Date de Naissance :</label>
        <input type="date" name="dateDeNaissance" value="<?php echo $row['dateDeNaissance']; ?>" required><br>

        <label>Filiere:</label>
        <select name="IdF">
            <?php
            // Récupération de toutes les catégories depuis la base de données
            $query = "SELECT IdF, intitule FROM filiere";
            $stmt = $conn->prepare($query);
            $stmt->execute();

            // Affichage des options de la liste déroulante avec les dénominations de chaque catégorie
            while ($catRow = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $selected = ($catRow['IdF'] == $row['IdF']) ? "selected" : "";
                echo "<option value='" . $catRow['IdF'] . "' " . $selected . ">" . $catRow['intitule'] . "</option>";
            }
            ?>
        </select><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
