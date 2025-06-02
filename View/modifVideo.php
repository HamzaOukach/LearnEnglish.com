<?php
session_start();
$titre = 'LearnEnglish.com';
$CSS = '../Style/video.css'; 
$JS = '../Assets/js/ConnexionInscription.js';

require_once('../Controller/ControlleurCours.php');
$conn = new ControlleurCours();
$video = $conn->getVideo($_GET['id_video']);

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
    <title><?php echo $titre; ?></title>
</head>

<body>



    <div class="container" id="container">
        <div class="form-container sign-in">
            <form method="post" action="../index.php?action=adminEditVideo" enctype="multipart/form-data" id="videoForm">
                <h1>Video</h1>

                <input type="text" name="titre" placeholder="Titre" value="<?php echo $video['titre']; ?>" required>
                <input type="text" name="video_link" placeholder="Lien YouTube" value="<?php echo $video['path']; ?>">
                <input type="hidden" name="id" value="<?php echo $video['id']; ?>">
                <button type="submit" name="inscription">Modifer</button>
                <button type="submit" name="inscription" onclick="setAction3('../index.php?action=adminRemoveVideo')">Supprimer</button>
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
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Modification Vidéo</h1>
                    <p>Vous êtes sur le point de modifier une Vidéo!</p>
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