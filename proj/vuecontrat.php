<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Documents - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Supprimer un document si l'ID est passé en GET
        if (isset($_GET['delete'])) {
            $id_contrat = intval($_GET['delete']);
            $stmt = $bdd->prepare("DELETE FROM contrat WHERE id_contrat = :id_contrat");
            $stmt->bindParam(':id_contrat', $id_contrat);
            if ($stmt->execute()) {
                // Redirection vers la même page pour mettre à jour la liste
                header("Location: vuecontrat.php");
                exit();
            } else {
                echo "<p>Erreur lors de la suppression du document.</p>";
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
        <h1>Liste des Documents</h1>
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
        <h2>Documents Enregistrés</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de Signature</th>
                    <th>Contenu</th>
                    <th>Date d'Expiration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Vérifier la requête pour afficher les documents
                    $stmt = $bdd->query("SELECT id_contrat, date_signature, contenu, date_expiration FROM contrat");
                    if (!$stmt) {
                        // Afficher l'erreur
                        echo "<tr><td colspan='5'>Erreur lors de la récupération des données.</td></tr>";
                        die(print_r($bdd->errorInfo())); // Afficher les détails de l'erreur
                    }

                    $documents = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($documents as $document): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($document['id_contrat']); ?></td>
                        <td><?php echo htmlspecialchars($document['date_signature']); ?></td>
                        <td><?php echo htmlspecialchars($document['contenu']); ?></td>
                        <td><?php echo htmlspecialchars($document['date_expiration']); ?></td>
                        <td>
                            <a class="delete-link" href="?delete=<?php echo $document['id_contrat']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
    
    <footer>
        <p>The KEY SECURITY<br>
            Bujumbura, Commune Mukaza, Avenue du progrès<br>
            Téléphone: 22224501/72002005<br>
            email: <a href="mailto:keysec2024@gmail.com">keysec2024@gmail.com</a>
        </p>
    </footer>
</body>
</html>
