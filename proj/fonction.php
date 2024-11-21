<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Fonction - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        // Connexion à la base de données
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');

        // Vérifier si le formulaire a été soumis
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Récupérer les données du formulaire
            $numero_matricule = $_POST['numero_matricule'];
            $role = $_POST['role'];

            // Préparer la requête d'insertion
            $stmt = $bdd->prepare("INSERT INTO fonction (numero_matricule, role) VALUES (:numero_matricule, :role)");
            $stmt->bindParam(':numero_matricule', $numero_matricule);
            $stmt->bindParam(':role', $role);
            
            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection vers la page d'affichage
                header("Location: vuefonction.php");
                exit();
            } else {
                echo "<p>Erreur lors de l'ajout de la fonction.</p>";
            }
        }
    ?>
    <style>
        form {
            display: flex;
            flex-direction: column;
            max-width: 400px; 
            margin: 20px auto; 
        }
        h2 {
            color: green;
        }
        label {
            margin-bottom: 5px; 
            font-weight: bold; 
        }
        input {
            margin-bottom: 15px; 
            padding: 10px; 
            border: 1px solid #ccc; 
            border-radius: 5px; 
        }
        button {
            background-color: #e74c3c; 
            color: white; 
            padding: 10px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            transition: background-color 0.3s; 
            margin-left: 70px;
            font-size: 19px;
        }
        button:hover {
            background-color: #c0392b; 
        }
    </style>
</head>
<body>
    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
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

    <div class="container">
        <main id="agent">
            <h2>Informations sur la Fonction</h2>
            <form action="" method="POST">
                <label for="numero-matricule">Numéro Matricule</label>
                <input type="number" id="numero-matricule" name="numero_matricule" required>
                <label for="role">Role</label>
                <input type="text" id="role" name="role" required>
                <button type="submit">Envoyer</button>
            </form>
        </main>

        <footer>
            <p>The KEY SECURITY<br>
                Bujumbura, Commune Mukaza, Avenue du progrès<br>
                Téléphone: 22224501/72002005<br>
                email: <a href="mailto:keysec2024@gmail.com">keysec2024@gmail.com</a>
            </p>
        </footer>
    </div>
</body>
</html>
