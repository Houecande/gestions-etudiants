<?php
require_once 'db.php';

$etudiant = null;
$filieres = [];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        // Récupération des informations de l'étudiant
        $stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
        $stmt->execute([$id]);
        $etudiant = $stmt->fetch();

        // Récupération des filières pour la liste déroulante
        $query = $pdo->query("SELECT * FROM filieres");
        $filieres = $query->fetchAll();
    } catch (PDOException $e) {
        $error = "Erreur : " . $e->getMessage();
    }
}

if (!$etudiant) {
    header("Location: index.php?status=error&message=Etudiant+introuvable");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Étudiant</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Modifier l'Étudiant</h1>
        
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
        
        <a href="index.php">Annuler et retourner à la liste</a>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
