<?php
include_once('conn.php');
session_start();

// Vérifier si l'utilisateur est authentifié
if (!isset($_SESSION['loginAdmin'])) {
    header('Location: index.php');
    exit();
}

// Récupération du nom et du prénom du propriétaire depuis la base de données
$query = "SELECT nom, prenom FROM Compteu WHERE loginAdmin = :loginAdmin";
$stmt = $conn->prepare($query);
$stmt->bindParam(':loginAdmin', $_SESSION['loginAdmin']);
$stmt->execute();

// Récupérer le résultat
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le résultat est vide
if ($row) {
    $nom = $row['nom'];
    $prenom = $row['prenom'];
} else {
    // Si aucun résultat n'est trouvé, définir des valeurs par défaut
    $nom = "Nom";
    $prenom = "Prénom";
}

// Récupérer l'heure actuelle du système
$heure = date("H");

// Déterminer le message de salutation en fonction de l'heure
if ($heure >= 6 && $heure < 18) {
    $salutation = "Bonjour";
} else {
    $salutation = "Bonsoir";
}

// Connexion à la base de données


// Récupération des produits triés par libellé


// Fermeture de la connexion à la base de données

?>

<!DOCTYPE html>
<html>
<head>
    <title>Application de gestion de stock</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f1;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        ul li {
            margin-left: 40px;
        }

        ul li a {
            text-decoration: none;
            color: #000;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        ul li a:hover {
            background-color: #f2f2f2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="855793d11c" crossorigin="anonymous" />

</head>
<body>
    <h1>Menu principal</h1>
    <ul>
        <?php echo $salutation . ", " . $nom . " " . $prenom ;   ?>  
        <li id="Me"><a href="acceuil.php">Accueil</a></li>
        <li id="Me"><a href="ajouter.php">Ajouter Stagiaire</a></li>
        <li id="Me"><a href="logout.php">Déconnexion</a></li>
    </ul>

    <h2>Liste des Stagiaire</h2>
    <table border="2">
        <tr>
            <th>Id Stagiaire</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Date de Naissance</th>
            <th>photo</th>
            <th>Filiere</th>
            <th>Action</th>

        </tr>
        <?php
        // Affichage des produits dans le tableau
        
$stmt = $conn ->query('SELECT * FROM stagiaire ORDER BY IdStagiaire');
$stmt->setFetchMode(PDO::FETCH_NUM);

        foreach ($stmt as $row) {
            echo "<tr>";
            echo "<td>" . $row[0] . "</td>";
            echo "<td>" . $row[1] . "</td>";
            echo "<td>" . $row[2] . "</td>";
            echo "<td>" . $row[3] . "</td>";
          echo'<td><img src="' . $row[4] . '" alt="Photo de ' . $row[1] . ' "></td>';
            echo "<td>" . $row[5] . "</td>";
            echo "<td>";
            echo "<a href='modifier.php?id=" . $row[0] . "'><i class='fas fa-edit'></i></a> | ";
            echo "<a href='supp.php?id=" . $row[0] . "'><i class='fas fa-trash-alt'></i></a>";

            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
