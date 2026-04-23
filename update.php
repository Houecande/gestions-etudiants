<?php
require_once 'db.php';

$etudiant = null;
$filieres = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        $etudiant = $stmt->fetch();

        $query = $pdo->query("SELECT * FROM filieres");
        $filieres = $query->fetchAll();
    } catch (PDOException $e) {
        // Gérer l'erreur si nécessaire
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Modifier l'Étudiant</h1>
        <?php if ($etudiant): ?>
            <form action="traitement.php" method="POST">
                <input type="hidden" name="id" value="<?= htmlspecialchars($etudiant['id']) ?>">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($etudiant['nom']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" value="<?= htmlspecialchars($etudiant['prenom']) ?>" required>
                </div>
                <div class="form-group">
                    <label for="filiere">Filière :</label>
                    <select id="filiere" name="filiere_id" required>
                        <?php foreach ($filieres as $filiere): ?>
                            <option value="<?= htmlspecialchars($filiere['id']) ?>" <?= $filiere['id'] == $etudiant['filiere_id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($filiere['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="modifier">Enregistrer les modifications</button>
            </form>
        <?php else: ?>
            <div class="alert alert-error">Étudiant non trouvé.</div>
        <?php endif; ?>
        <a href="index.php">Retour à l'accueil</a>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
