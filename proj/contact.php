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
        margin-bottom: 35px; 
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
        margin-left: 30px;
        font-size: 29px;
        margin-top: 5px;
        width: 200px;
        
    }
    button:hover {
        background-color: #c0392b; 
    }
    footer{
        margin-top: 20px;
        height: 200px;
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
            <h2>Contactez-nous</h2>
            <form action="" method="POST">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="telephone">Téléphone</label>
                <input type="tel" id="telephone" name="telephone" required>
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
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];

            // Préparer la requête
            $stmt = $bdd->prepare("INSERT INTO contact (nom, email, telephone) VALUES (:nom, :email, :telephone)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':telephone', $telephone);
            
            // Exécuter la requête
            if ($stmt->execute()) {
                // Redirection vers affichage.php
                header("Location: vue.php");
                exit();
            } else {
                echo "<p>Erreur lors de l'ajout du contact.</p>";
            }
        }
    ?>
</body>
</html>
