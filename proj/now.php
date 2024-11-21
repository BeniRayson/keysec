<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agents - The KEY SECURITY</title>
    <link rel="stylesheet" href="styles.css">
    <?php 
          $bdd = new PDO('mysql:host=localhost;dbname=gestion_securite;charset=utf8', 'root', '');

     ?>

</head>
<style>



    
    form {
    display: flex;
    flex-direction: column;
    max-width: 400px; /* Largeur maximale du formulaire */
    margin: 20px auto; /* Centre le formulaire */
}
h2{
    color: green;

}

label {
    margin-bottom: 5px; /* Espacement entre le label et le champ */
    font-weight: bold; /* Met le texte en gras */
}

input {
    margin-bottom: 15px; /* Espacement entre les champs */
    padding: 10px; /* Espacement intérieur */
    border: 1px solid #ccc; /* Bordure du champ */
    border-radius: 5px; /* Arrondi des coins */
}

button {
    background-color: #e74c3c; /* Couleur de fond du bouton */
    color: white; /* Couleur du texte */
    padding: 10px; /* Espacement intérieur */
    border: none; /* Supprime la bordure */
    border-radius: 5px; /* Arrondi des coins */
    cursor: pointer; /* Change le curseur au survol */
    transition: background-color 0.3s; /* Animation lors du survol */
    margin-left: 70px;
    
}

button:hover {
    background-color: #c0392b; /* Couleur de fond au survol */
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
            <h2>Informations sur les Employeés</h2>
            
<form action="" method="POST">
            
                <label for="nom_employe">Nom:</label>
                <input type="text" id="nom_employe" name="nom_employe" required>
                <label for="adresse">Adresse:</label>
                <input type="text" id="adresse" name="adresse" required>

                <label for="age">Âge:</label>
                <input type="number" id="age" name="age" required>

                <label for="statut">Statut:</label>
                <input type="text" id="statut" name="statut" required>

                <input name="valider" type="submit" VALUE="Envoyer">
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

        if(isset($_POST['valider']))
        {
            $Recupname=$_POST['nom_employeee'];
            $Recupadresse=$_POST['adresse'];
            $Recupage=$_POST["age"];
            $Recupstatut=$_POST['statut'];
            
            $InsertionMessage = "INSERT INTO employe(nom_employe)VALUES('$Recupname')";
			
			/*,age,statut,adresse)
            VALUES('$Recupname',$Recupage,''$Recupstatut','$Recupadresse')";*/
            $bdd->exec($InsertionMessage ); 
        }
        


?>

</body>

</html>
