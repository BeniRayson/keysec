<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Supprimer un client si l'ID est passé en GET
        if (isset($_GET['delete'])) {
            $id_client = intval($_GET['delete']);
            $stmt = $bdd->prepare("DELETE FROM client WHERE id_client = :id_client");
            $stmt->bindParam(':id_client', $id_client);
            if ($stmt->execute()) {
                // Redirection vers la même page pour mettre à jour la liste
                header("Location: affichage-client.php");
                exit();
            } else {
                echo "<p>Erreur lors de la suppression du client.</p>";
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
        <h1>Liste des Clients</h1>
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
        <h2>Clients Enregistrés</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom du Client</th>
                    <th>Nombre d'Agents</th>
                    <th>Adresse</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Vérifier la requête pour afficher les clients
                    $stmt = $bdd->query("SELECT id_client, nom_client, nombre_agent, adresse FROM client");
                    if (!$stmt) {
                        // Afficher l'erreur
                        echo "<tr><td colspan='5'>Erreur lors de la récupération des données.</td></tr>";
                        die(print_r($bdd->errorInfo())); // Afficher les détails de l'erreur
                    }

                    $clients = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($clients as $client): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($client['id_client']); ?></td>
                        <td><?php echo htmlspecialchars($client['nom_client']); ?></td>
                        <td><?php echo htmlspecialchars($client['nombre_agent']); ?></td>
                        <td><?php echo htmlspecialchars($client['adresse']); ?></td>
                        <td>
                            <a class="delete-link" href="?delete=<?php echo $client['id_client']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
