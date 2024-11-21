<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Fonctions - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Supprimer une fonction si l'ID est passé en GET
        if (isset($_GET['delete'])) {
            $numero_matricule = intval($_GET['delete']);
            $stmt = $bdd->prepare("DELETE FROM fonction WHERE numero_matricule = :numero_matricule");
            $stmt->bindParam(':numero_matricule', $numero_matricule);
            if ($stmt->execute()) {
                // Redirection vers la même page pour mettre à jour la liste
                header("Location: vuefonction.php");
                exit();
            } else {
                echo "<p>Erreur lors de la suppression de la fonction.</p>";
            }
        }
    ?>
    <style>
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .delete-link {
            color: red;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <h1>Liste des Fonctions</h1>
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="propos.php">À propos de</a></li>
                <li><a href="service.php">Nos services</a></li>
                <li><a href="publication.php">Publications</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Fonctions Enregistrées</h2>
        <table>
            <thead>
                <tr>
                    <th>Numéro Matricule</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Vérifier la requête pour afficher les fonctions
                    $stmt = $bdd->query("SELECT numero_matricule, role FROM fonction");
                    if (!$stmt) {
                        // Afficher l'erreur
                        echo "<tr><td colspan='3'>Erreur lors de la récupération des données.</td></tr>";
                        die(print_r($bdd->errorInfo())); // Afficher les détails de l'erreur
                    }

                    $fonctions = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($fonctions as $fonction): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($fonction['numero_matricule']); ?></td>
                        <td><?php echo htmlspecialchars($fonction['role']); ?></td>
                        <td>
                            <a class="delete-link" href="?delete=<?php echo $fonction['numero_matricule']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette fonction ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
