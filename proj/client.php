<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Client - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');
    ?>
</head>
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
<body>
    <header>
        <div class="tit"><h1>The KEY SECURITY</h1></div>
        <div class="lnk">
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="propos.php">À propos de</a></li>
                    <li><a href="service.php">Nos services</a></li>
                    <li><a href="publication.php">Publications</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <div class="container">
        <main id="client">
            <h2>Ajout d'un Client</h2>
            <form action="" method="POST">
                <label for="nom_client">Nom du Client:</label>
                <input type="text" id="nom_client" name="nom_client" required>

                <label for="nombre_agent">Nombre d'Agents:</label>
                <input type="number" id="nombre_agent" name="nombre_agent" required>

                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" required>

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

    <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom_client = $_POST['nom_client'];
            $nombre_agent = $_POST['nombre_agent'];
            $adresse = $_POST['adresse'];

            // Préparer la requête
            $stmt = $bdd->prepare("INSERT INTO client (nom_client, nombre_agent, adresse) VALUES (:nom_client, :nombre_agent, :adresse)");
            $stmt->bindParam(':nom_client', $nom_client);
            $stmt->bindParam(':nombre_agent', $nombre_agent);
            $stmt->bindParam(':adresse', $adresse);
            
            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection vers affichage-client.php
                header("Location: affichage-client.php");
                exit();
            } else {
                echo "<p>Erreur lors de l'ajout du client.</p>";
            }
        }
    ?>
</body>
</html>
