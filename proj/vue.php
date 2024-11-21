<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage des Contacts</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Supprimer un contact si l'ID est passé en GET
        if (isset($_GET['delete'])) {
            $id_contact = intval($_GET['delete']);
            $stmt = $bdd->prepare("DELETE FROM contact WHERE id_contact = :id_contact");
            $stmt->bindParam(':id_contact', $id_contact);
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
        <h1>Contacts</h1>
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
        <h2>Liste des contacts</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Vérifier la requête
                    $stmt = $bdd->query("SELECT id_contact, nom, email, telephone FROM contact");
                    if (!$stmt) {
                        // Afficher l'erreur
                        echo "<tr><td colspan='5'>Erreur lors de la récupération des données.</td></tr>";
                        die(print_r($bdd->errorInfo())); // Afficher les détails de l'erreur
                    }

                    $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($contacts as $contact): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($contact['id_contact']); ?></td>
                        <td><?php echo htmlspecialchars($contact['nom']); ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td><?php echo htmlspecialchars($contact['telephone']); ?></td>
                        <td>
                            <a class="delete-link" href="?delete=<?php echo $contact['id_contact']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    
</body>
</html>
