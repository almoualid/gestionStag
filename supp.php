<?php
// Vérifier si un ID de produit est passé en paramètre dans l'URL
if (isset($_GET['id'])) {
    $IdStagiaire = $_GET['id'];

    // Connexion à la base de données
    include_once("conn.php");

    // Récupération des informations du produit à partir de la base de données
    $query = "SELECT * FROM stagiaire WHERE IdStagiaire = :IdStagiaire";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':IdStagiaire', $IdStagiaire);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le produit existe
    if ($row) {
        // Vérifier si le formulaire de confirmation a été soumis
        if (isset($_POST['confirm'])) {
            // Supprimer le produit de la base de données
            $deleteQuery = "DELETE FROM stagiaire WHERE IdStagiaire = :IdStagiaire";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bindParam(':IdStagiaire', $IdStagiaire);
            $stmt->execute();

            // Fermeture de la connexion à la base de données
            $conn = null;

            // Redirection vers la page d'accueil
            header('Location: acceuil.php');
            exit();
        }
    } else {
        // Si le produit n'existe pas, rediriger vers la page d'accueil
        header('Location: acceuil.php');
        exit();
    }
} else {
    // Si aucun ID de produit n'est passé en paramètre dans l'URL, rediriger vers la page d'accueil
    header('Location: acceuil.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un produit</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            text-align: center;
        }

        button[type="submit"] {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        a {
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
            text-decoration: none;
        }

        button[type="submit"]:hover, a:hover {
            opacity: 0.8;
        }
    </style>
</head>
<body>
    <h1>Supprimer un Stagiaire</h1>
    <p>Êtes-vous sûr de vouloir supprimer le stagiaire <?php echo $row['nom']; ?> ?</p>
    <form method="POST">
        <button type="submit" name="confirm">Confirmer</button>
        <a href="acceuil.php">Annuler</a>
    </form>
</body>
</html>
