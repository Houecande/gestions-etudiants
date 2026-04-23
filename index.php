<?php
require_once 'db.php';

// Récupération des filières depuis la base de données
try {
    $query = $pdo->query("SELECT * FROM filieres");
    $filieres = $query->fetchAll();
} catch (PDOException $e) {
    // Si la table n'existe pas encore ou erreur, on initialise un tableau vide
    $filieres = [];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Étudiants</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Ajouter un Étudiant</h1>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-<?= htmlspecialchars($_GET['status'] ?? 'success') ?>">
                <?= htmlspecialchars($_GET['message']) ?>
            </div>
        <?php endif; ?>

        <form action="traitement.php" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="filiere">Filière :</label>
                <select id="filiere" name="filiere_id" required>
                    <option value="">-- Choisir une filière --</option>
                    <?php foreach ($filieres as $filiere): ?>
                        <option value="<?= htmlspecialchars($filiere['id']) ?>">
                            <?= htmlspecialchars($filiere['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" name="ajouter">Ajouter l'étudiant</button>
        </form>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
