<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Agents - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Supprimer un agent si l'ID est passé en GET
        if (isset($_GET['delete'])) {
            $id_agent = intval($_GET['delete']);
            $stmt = $bdd->prepare("DELETE FROM post WHERE id_post = :id_post");
            $stmt->bindParam(':id_post', $id_agent);
            if ($stmt->execute()) {
                // Redirection vers la même page pour mettre à jour la liste
                header("Location: vuepost.php");
                exit();
            } else {
                echo "<p>Erreur lors de la suppression de l'agent.</p>";
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
        <h1>Liste des Agents</h1>
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
        <h2>Agents Enregistrés</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Numéro Matricule</th>
                    <th>Adresse Mission</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Vérifier la requête pour afficher les agents
                    $stmt = $bdd->query("SELECT id_post, nom_agent, numero_matricule, adresse_mission FROM post");
                    if (!$stmt) {
                        // Afficher l'erreur
                        echo "<tr><td colspan='5'>Erreur lors de la récupération des données.</td></tr>";
                        die(print_r($bdd->errorInfo())); // Afficher les détails de l'erreur
                    }

                    $agents = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($agents as $agent): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($agent['id_post']); ?></td>
                        <td><?php echo htmlspecialchars($agent['nom_agent']); ?></td>
                        <td><?php echo htmlspecialchars($agent['numero_matricule']); ?></td>
                        <td><?php echo htmlspecialchars($agent['adresse_mission']); ?></td>
                        <td>
                            <a class="delete-link" href="?delete=<?php echo $agent['id_post']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
