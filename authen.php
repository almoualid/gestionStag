<?php
include_once('conn.php');

session_start(); // Démarrer la session

if (isset($_POST['loginAdmin']) && isset($_POST['motDePasse'])) { // Vérifier que le formulaire a été soumis

    // Récupérer les informations d'identification soumises
    $loginAdmin = $_POST['loginAdmin'];
    $motDePasse = $_POST['motDePasse'];

    if (empty($loginAdmin) || empty($motDePasse)) { // Si le login ou le mot de passe est vide

        // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur
        header('Location: index.php?erreur=1');
        exit();
    } else {

        // Vérifier si l'utilisateur existe dans la base de données
        $query = "SELECT * FROM Compteu WHERE loginAdmin=:loginAdmin AND motDePasse=:motDePasse";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':loginAdmin', $loginAdmin);
        $stmt->bindParam(':motDePasse', $motDePasse);
        $stmt->execute();


        
        if ($stmt->rowCount() == 1) { // Si l'utilisateur existe

            // Créer une session pour l'utilisateur
            $_SESSION['loginAdmin'] = $loginAdmin;

            // Rediriger l'utilisateur vers la page d'accueil
            header('Location: acceuil.php');
            exit();
        } else { // Si l'utilisateur n'existe pas ou les informations d'identification sont incorrectes

            // Rediriger l'utilisateur vers la page de connexion avec un message d'erreur
            header('Location: index.php?erreur=2');
            exit();
        }

        // Fermer la connexion à la base de données
        $conn = null;
    }
}
?>
