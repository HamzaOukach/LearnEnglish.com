<?php
session_start();
require_once('../Controller/ControlleurCours.php');

$controller = new ControlleurCours();
$id_user = $_SESSION['id'] ?? null;

if (!$id_user) {
    die("Utilisateur non connecté.");
}

$certificats = $controller->getCertificates($id_user);
$titre = 'Mes Certificats';
$CSS = '../Style/Certificats.css'; 
ob_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $titre; ?></title>
    <link rel="stylesheet" href="<?php echo $CSS; ?>">
    <link rel="icon" type="image/png" sizes="64x64" href="../Media/file (3).png">
</head>

<body>

<div class="container" id="container">
    <div class="certificates-container">
        <h1>🎓 Mes Certificats</h1>

        <?php if (!empty($certificats)): ?>
            <div class="certificates-list">
                <?php foreach ($certificats as $certificat): ?>
                    <div class="certificate-card">
                        <h2>🏆 Certificat <?= htmlspecialchars($certificat['niveau']) ?></h2>
                        <p>Obtenu le : <?= htmlspecialchars($certificat['date_obtention']) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Vous n'avez pas encore de certificats. Terminez plus de cours ! 🚀</p>
        <?php endif; ?>

        <a href="video.php" class="btn">Retour</a>
    </div>
</div>

</body>
</html>

<?php
$contenu = ob_get_clean();
echo $contenu;
?>
