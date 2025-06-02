<?php
session_start();
require_once('../Controller/ControlleurCours.php');


$titre = 'LearnEnglish.com';
$CSS = '../Style/pdf.css'; 
$JS = '../Assets/js/ConnexionInscription.js';


$conn = new ControlleurCours();


$id_pdf = $_GET['id'] ?? null;


if (!$id_pdf) {
    
    header("Location: CoursVideo.php");
    exit;
}


$pdf = $conn->getPdf($id_pdf);


if (!$pdf) {
    die("PDF introuvable.");
}

ob_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="<?php echo $CSS; ?>">
    <link rel="icon" type="image/png" sizes="64x64" href="../Media/file (3).png">
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="post" action="../index.php?action=adminEditPdf" enctype="multipart/form-data" id="pdfForm">
                <h1>Modifier le PDF</h1>

                <input type="text" name="id" value="<?php echo $pdf['id']; ?>" hidden>

                <input type="text" placeholder="Titre" name="titre" value="<?php echo htmlspecialchars($pdf['titre']); ?>" required>

                <input type="file" id="filename" name="pdf" accept="application/pdf" onchange="validateFileType1()">

                <p id="msg-error" hidden></p>

                <button type="submit" name="modifier">Modifier</button>
                <button type="button" onclick="setActionAndSubmit('../index.php?action=adminRemovePdf')">Supprimer</button>
            </form>
        </div>

        <div class="form-container sign-up">
            <form method="post" action="../index.php?action=connexion">
                <h1>Connexion</h1>
                <input type="email" placeholder="Email" name="email" required>
                <input type="password" placeholder="Mot de passe" name="mdp" required>
                <button type="submit" name="connexion">Connexion</button>
            </form>
        </div>

        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left"></div>
                <div class="toggle-panel toggle-right">
                    <h1>Modification de PDF</h1>
                    <p>Vous êtes sur le point de modifier un document PDF !</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setActionAndSubmit(actionUrl) {
            const form = document.getElementById('pdfForm');
            form.action = actionUrl;
            form.submit();
        }
    </script>

    <script src="<?php echo $JS; ?>"></script>
</body>
</html>

<?php
$contenu = ob_get_clean();
echo $contenu;
?>
