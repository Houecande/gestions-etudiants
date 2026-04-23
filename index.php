<?php
require_once 'db.php';

// Récupération des filières depuis la base de données
try {
    $query = $pdo->query("SELECT * FROM filieres");
    $filieres = $query->fetchAll();

    // Récupération des étudiants avec leur filière
    $queryEtudiants = $pdo->query("
        SELECT e.*, f.nom as filiere_nom 
        FROM etudiants e 
        LEFT JOIN filieres f ON e.filiere_id = f.id
        ORDER BY e.id DESC
    ");
    $etudiants = $queryEtudiants->fetchAll();
} catch (PDOException $e) {
    $filieres = [];
    $etudiants = [];
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
    <div class="main-container">
        <div class="form-container">
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

        <div class="list-container">
            <h1>Liste des Étudiants</h1>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Filière</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($etudiants as $etudiant): ?>
                        <tr>
                            <td><?= htmlspecialchars($etudiant['nom']) ?></td>
                            <td><?= htmlspecialchars($etudiant['prenom']) ?></td>
                            <td><?= htmlspecialchars($etudiant['filiere_nom']) ?></td>
                            <td class="actions">
                                <a href="update.php?id=<?= $etudiant['id'] ?>" class="btn-edit">Modifier</a>
                                <a href="delete.php?id=<?= $etudiant['id'] ?>" class="btn-delete" onclick="return confirm('Êtes-vous sûr ?')">Supprimer</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($etudiants)): ?>
                        <tr>
                            <td colspan="4" style="text-align: center;">Aucun étudiant enregistré.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
