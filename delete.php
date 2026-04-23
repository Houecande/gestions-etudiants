<?php
require_once 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        
        // Redirection vers la page principale après suppression
        header("Location: index.php?status=success&message=Etudiant+supprime");
        exit();
    } catch (PDOException $e) {
        // En cas d'erreur, on peut rediriger avec un message d'erreur
        header("Location: index.php?status=error&message=Erreur+lors+de+la+suppression");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>