<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
        $bdd = new PDO('mysql:host=localhost;dbname=key_sec;charset=utf8', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode d'erreur PDO
    ?>
    <script>
        function validatePhone() {
            const tel = document.getElementById('tel').value;
            const regex = /^\d{5}$/;
            if (!regex.test(tel)) {
                alert("Le numéro de téléphone doit contenir exactement 5 chiffres.");
                return false; // Empêche l'envoi du formulaire
            }
            return true; // Autorise l'envoi du formulaire
        }
    </script>
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
            <h2>Ajout d'un Agent</h2>
            <form action="" method="POST" onsubmit="return validatePhone();">
                <label for="nom">Nom de l'Agent:</label>
                <input type="text" id="nom" name="nom_agent" required>

                <label for="tel">Téléphone:</label>
                <input type="text" id="tel" name="tel" required>

                <label for="adr">Adresse:</label>
                <input type="text" id="adr" name="adr" required>

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
            $nom_agent = $_POST['nom_agent'];
            $tel = $_POST['tel'];
            $adr = $_POST['adr'];

            // Vérifier si le numéro de téléphone existe déjà
            $stmt = $bdd->prepare("SELECT COUNT(*) FROM agent WHERE tel = :tel");
            $stmt->bindParam(':tel', $tel);
            $stmt->execute();
            
            if ($stmt->fetchColumn() > 0) {
                echo "<p>Erreur : Ce numéro de téléphone est déjà utilisé.</p>";
            } else {
                // Préparer l'insertion
                $stmt = $bdd->prepare("INSERT INTO agent (nom_agent, tel, adr) VALUES (:nom_agent, :tel, :adr)");
                $stmt->bindParam(':nom_agent', $nom_agent);
                $stmt->bindParam(':tel', $tel);
                $stmt->bindParam(':adr', $adr);
                
                // Exécuter la requête
                try {
                    if ($stmt->execute()) {
                        // Redirection vers affichage-agent.php
                        header("Location: affichage-agent.php");
                        exit();
                    } else {
                        echo "<p>Erreur d'insertion.</p>";
                    }
                } catch (PDOException $e) {
                    // Affiche une erreur si l'insertion échoue
                    echo "<p>Erreur d'insertion : " . $e->getMessage() . "</p>";
                }
            }
        }
    ?>
</body>
</html>
