<!DOCTYPE html>
<html>

<head>
    <title>Repas</title>
    <link rel="stylesheet" href="repas.css">
</head>

<body>

<header>
    <div class="header">
        <div class="section-header">
            <div><h1 class="titre1">SOYEZ LE BIENVENU CHEZ NOUS</h1></div>
        <div><p class="paragraph">Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum </p></div>
        <button class="button">Explorer</button>
    </div>
        <div class="header-image"></div>
    </div>
</header>


    <?php
    function afficherProduit($row) {
        echo $row["Prix"] . "<br/>"; 
        echo $row["Titre"] . "<br/>"; 
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'"/>' . "<br/>";

        // echo "<div class='parent'>";
        // echo "<div class='child'>" . $row["Prix"] .'<br/>' .$row["Titre"]."</div>";
        // echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['Image'] ).'"/>';
        // echo "</div>";

    }

    $servername = "localhost";
    $username = "root";
    $database = "restauration";
    $password = "rootroot";

    //Création de connexion
    $conn = new mysqli($servername, $username, $password, $database);

    //Verification de la connexion
    if ($conn->connect_error) {
        die("la connexion a échoué: " . $connect->connect_error);
    }

    $product = "SELECT * FROM produit ORDER BY time desc limit 1";
    $res = mysqli_query($conn, $product);
    $produit= mysqli_fetch_array($res);

    $time1 = strtotime("now");
    $time2 = strtotime($produit["Time"]); 
    $day = strtotime('+1 day', $timestamp);

    if (count($produit) > 0 && $time1 - $time2 <= $day) {
        $productQuery = "select * from repas where id = ". $produit['id'];
        $productRes = mysqli_query($conn, $productQuery);
        $selectedProduct = mysqli_fetch_array($productRes);

        afficherProduit($selectedProduct);
        print_r($selectedProduct, true);
    } else {

        $query = "SELECT * FROM repas ORDER BY RAND() LIMIT 1";
        echo $query;
        $result= mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        afficherProduit($row);
        $insert_product= "INSERT INTO produit values (". $row['id']. ", CURRENT_TIMESTAMP)";
        $result = mysqli_query($conn, $insert_product);
    }

    ?>
    

    <?php 
if(isset($_POST['submit'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $subjet = $_POST['subjet'];

if (empty($nom)|| empty($prenom)|| empty($telephone) || empty($adresse)|| empty($email) || empty($subject)){
    echo "Tous les champs sont obligatoires";
}else{
    $to = "hanane.elkaaba1@gmail.com";
    $body ="";
    $body .= "From:" .$nom."," . $prenom. "\r\n";
    $body .= "Email:" .$email. "\r\n";
    $body .= "Adresse:" .$adresse ."\r\n";
    $body .= "Telephone:" .$telephone."\r\n";
    mail($to,$subject,$body);
    echo "<script type='text/javascript'>alert('Your message sent successfly')</script>";

}

}

?>
    <form method="post" action="email.php">
    </div>
        <div><label for="Nom" name="nom">Nom</label>
        <input type="text">
    </div>
    <div><label for="Prenom" name="prenom">Prénom</label>
        <input type="text">
    </div>
    <div><label for="Telephone" name="telephone">Télephone</label>
        <input type="number">
    </div>
    <div><label for="Adresse" name="adresse">Adresse</label>
        <input type="text">
    </div>
    <div><label for="email" name="email">Email</label>
        <input type="email">
    </div>
    <button type="submit" name="submit">Commander</button>
    </form>
</body>

</html>