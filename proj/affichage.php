<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des Publications</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Supprimer une publication si l'ID est passé en GET
        if (isset($_GET['delete'])) {
            $id_pub = intval($_GET['delete']);
            $stmt = $bdd->prepare("DELETE FROM publication WHERE id_pub = :id_pub");
            $stmt->bindParam(':id_pub', $id_pub);
            $stmt->execute();
            header("Location: affichage.php");
            exit();
        }
    ?>
    <style>
        /* Styles pour affichage.php */
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
        <h1>Publications</h1>
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
        <h2>Liste des publications</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date de publication</th>
                    <th>Article</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Vérifier la requête
                    $stmt = $bdd->query("SELECT id_pub, date_pub, article FROM publication");
                    if (!$stmt) {
                        // Afficher l'erreur
                        echo "<tr><td colspan='4'>Erreur lors de la récupération des données.</td></tr>";
                        die(print_r($bdd->errorInfo())); // Afficher les détails de l'erreur
                    }

                    $publications = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($publications as $publication): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($publication['id_pub']); ?></td>
                        <td><?php echo htmlspecialchars($publication['date_pub']); ?></td>
                        <td><?php echo htmlspecialchars($publication['article']); ?></td>
                        <td>
                            <a class="delete-link" href="?delete=<?php echo $publication['id_pub']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette publication ?');">Supprimer</a>
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
