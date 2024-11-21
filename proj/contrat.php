<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents - The KEY SECURITY</title>
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
        <main id="agent">
            <h2>Publication du jour</h2>
            <form action="" method="POST">
                <label for="date_signature">La date de signature</label>
                <input type="date" id="date_signature" name="date_signature" required>
                <label for="contenu">Article</label>
                <input type="text" id="contenu" name="contenu" required>
                <label for="date_expiration">La date de expiration</label>
                <input type="date" id="date_expiration" name="date_expiration" required>
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
            $Recupdate = $_POST['date_signature'];
            $Recucontenu = $_POST['contenu'];
            $Recupdate2 = $_POST['date_expiration'];

            // Préparer la requête
            $stmt = $bdd->prepare("INSERT INTO contrat (date_signature, contenu , date_expiration) VALUES (:date_signature, :contenu, :date_expiration)");
            $stmt->bindParam(':date_signature', $Recupdate);
            $stmt->bindParam(':contenu', $Recucontenu);
            $stmt->bindParam(':date_expiration', $Recupdate2);
            
            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection vers affichage.php
                header("Location: vuecontrat.php");
                exit();
            } else {
                echo "<p>Erreur lors de l'ajout de la publication.</p>";
            }
        }
    ?>
</body>
</html>
