<?php

function validerEtChiffrerMotDePasse($motDePasse)
{
    // Vérifier la longueur du mot de passe
    if (strlen($motDePasse) < 6 || strlen($motDePasse) > 10) {
        return "Erreur : Le mot de passe doit avoir entre 6 et 10 caractères.";
    }

    // Définir le salt statique
    $salt = "ABC1234@";

    // Concaténer le salt au mot de passe
    $motDePasseAvecSalt = $motDePasse . $salt;

    // Chiffrer le mot de passe avec sha256 (vous pouvez utiliser un algorithme de chiffrement plus sécurisé si nécessaire)
    $motDePasseChiffre = hash('sha256', $motDePasseAvecSalt);

    // Message de succès
    $message = "Mot de passe chiffré : " . $motDePasseChiffre;

    // Tester le mot de passe (par exemple, ici nous supposons un mot de passe correct)
    if ($motDePasse === "MotDePasseCorrect") {
        $message = "Mot de passe correct : " . $motDePasseChiffre;
    }

    return $message;
}

// Gérer le formulaire soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $motDePasse = $_POST["mot_de_passe"];
    $resultat = validerEtChiffrerMotDePasse($motDePasse);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation du mot de passe</title>
</head>
<body>
    <h1>Validation du mot de passe</h1>
    <?php if (isset($resultat)) : ?>
        <p><?php echo $resultat; ?></p>
    <?php endif; ?>

    <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
        <label for="mot_de_passe">Mot de passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>
        <button type="submit">Valider</button>
    </form>
</body>
</html>