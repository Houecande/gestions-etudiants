<?php
require_once 'db.php';

$message = "";
$status = "";

if (isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    if (!empty($nom) && !empty($prenom) && !empty($filiere_id)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
            $stmt->execute([$nom, $prenom, $filiere_id]);
            $message = "Étudiant ajouté avec succès !";
            $status = "success";
        } catch (PDOException $e) {
            $message = "Erreur lors de l'ajout : " . $e->getMessage();
            $status = "error";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
        $status = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Résultat de l'opération</h1>
        <?php if ($message): ?>
            <div class="alert alert-<?= $status ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>
        <a href="index.php">Retour au formulaire</a>
    </div>
</body>
</html>
