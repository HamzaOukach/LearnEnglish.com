<?php
session_start();
require_once('../model/modelBDD.php');
require_once('../Controller/ControlleurCours.php');

$controller = new ControlleurCours();
$model = new ModelBDD();

$id_cours = $_GET['id_cours'] ?? null;
$id_user = $_SESSION['id'] ?? null;


$course = $controller->getCoursById($id_cours);
$estInscrit = $controller->verifieInscription($id_user, $id_cours);

if (isset($_POST['inscrire']) && $id_user && $id_cours) {
    $controller->inscrireEtudiant($id_user, $id_cours);
    header("Location: CoursVideos.php?id_cours=$id_cours");
    exit;
}

$videos = $estInscrit ? $controller->getVideos($id_cours) : [];
$pdfs = $estInscrit ? $controller->getPdfs($id_cours) : [];

if ($estInscrit) {
    $progress = $controller->getProgressionPourcentage($id_user, $id_cours);
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../Style/StyleCours.css">
    <link rel="icon" type="image/png" href="../Media/file (3).png">
    <title><?php echo $course['titre']; ?></title>
</head>
<body>
<div class="container">
   
    <aside>
        <div class="toggle">
            <div class="logo">
                <h2>LearnEnglish<span class="danger">.com</span></h2>
            </div>
            <div class="close" id="close-btn">
                <span class="material-icons-sharp">close</span>
                <h3>Fermer</h3>
            </div>
        </div>
        <div class="sidebar">
            <a href="DashboardBasic.php">
                <span class="material-icons-sharp">arrow_back</span>
                <h3>Retour</h3>
            </a>
            <a href="#" id="dcnx">
                <span class="material-icons-sharp">logout</span>
                <h3>Déconnexion</h3>
            </a>
        </div>
    </aside>
    <script>
        document.getElementById('dcnx').addEventListener('click', () => {
            window.location.href = '../index.php?action=deconnexion';
        });
    </script>

       
    <main>
        <h1><?php echo $course['titre']; ?></h1>
        
        <div class="right-section">
            <div class="user-profile">
                <div>
                    <h2>Description du cours</h2>
                    <p><?php echo $course['description']; ?></p>
                </div>
            </div>
        </div>


        <div class="course-meta">
            <div class="meta-item">Catégorie : <?php echo $course['categorie']; ?></div>
            <div class="meta-item">Prix : <?php echo $course['prix']; ?> €</div>
        </div>

        <hr>

        <?php if (!$estInscrit): ?>
            <form method="POST">
                <button type="submit" name="inscrire" class="inscription-btn">S'inscrire au cours</button>
            </form>
        <?php else: ?>
            <section>
            <h2>Vidéos disponibles</h2>
                <div class="video-list">
                    <?php foreach ($videos as $video): ?>
                        <div class="video-card" onclick="window.location.href='video.php?id=<?php echo $video['id']; ?>'">
                            <h3><?php echo $video['titre']; ?></h3>
                        </div>
                    <?php endforeach; ?>
                </div>


                <h2 class="pdf-title">PDFs disponibles</h2>
                    <div class="pdf-list">
                        <?php foreach ($pdfs as $pdf): ?>
                            <div class="video-card" onclick="window.location.href='progressionPDF.php?id_pdf=<?php echo $pdf['id']; ?>&id_cours=<?php echo $course['id']; ?>'">
                                <h3 class="pdf-title"><?php echo $pdf['titre']; ?></h3>
                            </div>
                        <?php endforeach; ?>
                    </div>  

            </section>
        <?php endif; ?>
    <?php if ($estInscrit): ?> 
        <div class="analyse">
                <div class="sales">
                    <div class="status">
                        <div class="info">
                            <h1><?php
                               echo "<p>Progression : $progress%</p>";
                                ?>
                            </h1>
                        </div>
                        <div class="progresss">
                            <svg>
                                <circle cx="38" cy="38" r="36"></circle>
                            </svg>
                            <div class="percentage">
                                <p><?php echo "<p>$progress%</p>";  ?></p>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php endif; ?>
    </main>

    
    <div class="right-section">
        <div class="nav">
            <button id="menu-btn">
                <span class="material-icons-sharp">menu</span>
            </button>
            <div class="profile">
                <div class="info">
                    <p>Salut, <b><?php echo $_SESSION['prenom']; ?></b></p>
                    <small class="text-muted">Étudiant</small>
                </div>
                <div class="profile-photo">
                    <img src="../<?php echo $_SESSION['photo']; ?>">
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
