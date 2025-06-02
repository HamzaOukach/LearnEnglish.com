<?php
session_start();
$titre = 'LearnEnglish.com';
$CSS = '../Style/video.css'; 
$JS = '../Assets/js/ConnexionInscription.js';

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

    <body>

        <div class="container" id="container">
            <div class="form-container sign-in">
                <form method="post" action="../index.php?action=adminAjoutVideo" enctype="multipart/form-data">
                    <h1>Video</h1>
                    <input type="number" placeholder="id_cours" name="id_cours" value="<?php echo $_GET['id_cours'] ?>" hidden>
                    <input type="text" placeholder="Titre" name="titre" required>
                    <input type="text" placeholder="Lien YouTube" name="video_link" required>
                    <p id="msg-error" hidden></p>
                    <button type="submit" name="inscription">Ajouter</button>
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
                    <div class="toggle-panel toggle-left">
                        <h1>Content de vous revoir!</h1>
                        <p>Connectez-vous à votre compte et explorez vos cours préférés en toute facilité</p>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Ajout Vidéo</h1>
                        <p>Vous êtes sur le point d'ajouter un Vidéo!</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?php echo $JS; ?>"></script>
    </body>

</html>
<?php
$contenu = ob_get_clean();
echo $contenu;
?>