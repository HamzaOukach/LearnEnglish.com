<?php
$titre = 'LearnEnglish.com';
$CSS = 'Style/Acceuil.css'; 
$lienQcm = 'View/Qcm.php';
$lienCntct = 'View/Contact.php';
session_start();
require_once('../Controller/ControlleurCours.php');

$controller = new ControlleurCours();

$id_user = $_SESSION['id'] ?? null;


$id_video = $_GET['id'] ?? null;


if ($id_video) {
    $_SESSION['last_video_id'] = $id_video;
} else {
    $id_video = $_SESSION['last_video_id'] ?? null;
}


if (!$id_video) {
    die('Aucune vidéo sélectionnée ou disponible.');
}


$video = $controller->getVideo($id_video);

if (!$video) {
    die('Aucune vidéo sélectionnée ou disponible.');
}


$id_cours = $video['id_cours'] ?? null;
if ($id_user && $id_cours) {
    $controller->enregistrerProgression($id_user, $id_cours, $id_video);
    $controller->giveCertificate($id_user);
}

ob_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>watch</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
   <link rel="stylesheet" href="../style/styleStudent.css">
   <link rel="icon" type="image/png" sizes="64x64" href="../Media/file (3).png">
   <title><?php echo $titre; ?></title>
</head>

<body>

   <div class="side-bar">
      <div id="close-btn">
         <i class="fas fa-times"></i>
      </div>

      <div class="profile">
         <img src="../<?php echo htmlspecialchars($_SESSION['photo']); ?>" class="image">
         <h3 class="name">
            <p>Salut, <b><?php echo htmlspecialchars($_SESSION['prenom']); ?></b></p>
         </h3>
         <p class="role">étudiant</p>
         <a href="Certificats.php" class="btn">Voir les certificats</a>
      </div>

      <nav class="navbar">
         <a href="DashboardBasic.php"><i class="fas fa-home"></i><span>Accueil</span></a>
         <a href="#" id="dcnx"><i class="fas fa-sign-out-alt"></i><span>Déconnexion</span></a>
      </nav>
   </div>

   <script>
      let dcnx = document.getElementById('dcnx');
      dcnx.addEventListener('click', () => {
          document.location.href = '../index.php?action=deconnexion';
      });
   </script>

   <section class="watch-video">
      <div class="video-container">
         <div class="video">
          <iframe id="video" width="100%" height="500" src="<?php echo htmlspecialchars($video['path']); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
         </div>
         <h3 class="title"><?php echo htmlspecialchars($video['titre']); ?></h3>
         <div class="info">
            <p class="date"><i class="fas fa-calendar"></i><span>17/04/2025</span></p>
            <p class="date"><i class="fas fa-heart"></i><span>153 likes</span></p>
         </div>
      </div>
   </section>

</body>

</html>
<?php
$contenu = ob_get_clean();
echo $contenu;
?>
