<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos services - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
.button-container {
    display: flex;
    flex-wrap: wrap; 
    /*justify-content: center; */
    gap: 15px;
    padding: 20px; 
    align-content: space-around;
    align-items: space-around;
    padding: auto 20px; 
   
    
}

.button {
    display: inline-block;
    padding: 10px 20px; 
    margin-top: 10px;
    margin-bottom: 15px; 
    background-color: #4CAF50;
    color: white; 
    text-align: center;
    text-decoration: none;
    border-radius: 15px;
    font-size: 28px; 
    transition: background-color 0.3s, transform 0.2s; 
    width: 300px;
    height: 100px;
    
}

.button:hover {
    background-color: #45a049; 
    transform: scale(1.05); 
}

.button:active {
    transform: scale(0.95); 
}
p{
    font-size: 28px;
    margin-top: 55px;
    word-spacing: 10px;
}
h2{
    font-size: 55px;
    color: black;
}
.tit h1{
    font-size: 40;
    margin-top: 20px;
    margin-left: 150px;
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
        <main>
            <h2>Nos services</h2>
            <p>Notre plateforme en ligne permet un suivi en temps réel de vos besoins en sécurité ou besoins<br>
                 que ce soit pour la surveillance d'événements Nous nous engageons à créer des environnements<br>
                  sûrs grâce à une approche proactive et des technologies de pointe. Faites confiance à notre expertise<br>
                   pour garantir votre sécurité et celle de votre entourage.</p><br><br><br><br>

            <div class="button-container">
                <a href="client.php" class="button">Demande de Service</a>
                <a href="agent.php" class="button">Portail des Agents</a>
                <a href="post.php" class="button">Suivi des Postes</a><br>
                <a href="contrat.php" class="button">Contrats et Accords</a>
                <a href="fonction.php" class="button">Fonction occuper</a>

            </div>
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
