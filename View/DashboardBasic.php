<?php
$titre = 'LearnEnglish.com';
$lienQcm = 'View/Qcm.php';
$lienCntct = 'View/Contact.php';
session_start();

require_once('../Controller/ControlleurUser.php');
$conn = new ControlleurUser();
if (isset($_GET['id_cours'])) {
    $videos = $conn->getVideos($_GET['id_cours']);
    $pdfs = $conn->getPdf($_GET['id_cours']);
}
if (isset($_SESSION['searchResults'])) {

    $searchResults = $_SESSION['cours'];
} else {
    
    $searchResults = $_SESSION['cours'];
    $_SESSION['searchResults'] = $_SESSION['cours'];
}
$searchResults = isset($_SESSION['searchResults']) ? $_SESSION['searchResults'] : $_SESSION['cours'];


ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="../Style/DashboardBasic.css">
    <link rel="icon" type="image/png" sizes="64x64" href="../Media/file (3).png">

    <title><?php echo $titre; ?></title>
</head>

<body onload="onload('<?php if (isset($_GET['section'])) {
                            echo $_GET['section'];
                        } ?>')">
    <div class="sidebar">
        <a href="#" class="logo">
            <div class="logo-name"><span>LearnEnglish</span>.com</div>
        </a>
        <ul class="side-menu">
            <li class="active"><a href="DashboardBasic.php" id="dashboard" onclick="onDashboardClick()"><i class='bx bxs-dashboard'></i>Tableau de bord</a></li>
            <li><a href="#" id="Qcm" onclick="onQcmClick()"><i class='bx bx-analyse'></i>Qcm</a></li>
            <li><a href="#" id="Forum" onclick="onForumClick()"><i class='bx bx-message-square-dots'></i>Forum</a></li>

        </ul>
        <script>
            function reload() {
                let input = document.querySelector('.content form .form-input input');
                if (input.value === "") { 
                    window.location.href = 'DashboardBasic.php'; 
                } else {
                    window.location.href = 'DashboardBasic.php'; 
                }
            }
        </script>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout" id="dcnx">
                    <i class='bx bx-log-out-circle'></i>
                    Déconnexion
                </a>
            </li>
        </ul>
    </div>
    <?php
    echo "<script>";
    echo "let dcnx = document.getElementById('dcnx');";
    echo "dcnx.addEventListener('click', () => {
                    document.location.href = '../index.php?action=deconnexion';
                });";
    echo "</script>";
    ?>
    
    <div class="content">
        <nav>
            <i class='bx bx-menu'></i>
            <form method="post">
                <div class="form-input">
                    <input type="search" placeholder="Search..." name="search" id="searchInput" value="<?php echo isset($_POST['search']) ? htmlspecialchars($_POST['search']) : ''; ?>">
                    <button class="search-btn" onclick="reload()" type="submit" name="submit" id="searchButton"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <p>
                <?php
                $searchTerm = isset($_POST['search']) ? $_POST['search'] : '';

                if (isset($_POST['submit'])) {
                    $searchResults = $conn->searchCourses($searchTerm); 
                }
                ?>



            </p>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="profile">
                <img src="../<?php echo $_SESSION['photo'] ?>">
            </a>
        </nav>


        <main>
            <div class="header">
                <div class="left">
                    <h1>Tableau de bord</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">
                                Discussion
                            </a></li>
                        /
                        <li><a href="#" class="active">Forum</a></li>
                    </ul>
                </div>

            </div>
            <ul class="insights discussion4">
                <?php if (isset($_SESSION['discussions']) && !empty($_SESSION['discussions'])) {
                    for ($i = 0; $i <= 3; $i++) {
                        $discussion = $_SESSION['discussions'][$i];
                ?>
                        <li onclick="afficherDiscussion(<?php echo $discussion['id'] ?>)">
                            <span class="info">
                                <h3>
                                    <?php echo $discussion['sujet'] ?>
                                </h3>
                                
                            </span>
                        </li>
                <?php }
                } ?>
            </ul>
            <ul class="insights discussionAll">
                <?php if (isset($_SESSION['discussions']) && !empty($_SESSION['discussions'])) {
                    

                    
                    foreach ($_SESSION['discussions'] as $discussion) {
                ?>
                        <li onclick="afficherDiscussion(<?php echo $discussion['id'] ?>)">
                            
                            <span class="info">
                                <h3>
                                    <?php echo $discussion['sujet'] ?>
                                </h3>
                                
                            </span>
                        </li>
                <?php }
                } ?>
            </ul>


            <div class="bottom-data">
                <div class="orders cours3">
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Cours Disponibles</h3>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Titre</th>
                            </tr>
                        </thead>

                        <tbody>
                       
                            <?php
                            if (!empty($searchResults)) {
                                
                                foreach ($searchResults as $cours) {
                                    $idUtilisateur = $cours['id_utilisateur'];
                                    $user = $conn->getUserC($idUtilisateur);
                                   
                                    echo '<tr>';
                            
                echo "<td><a href='CoursVideos.php?id_cours={$cours['id']}'>" . $cours['titre'] . "</a></td>";

                                    $_SESSION['searchResults'] = $_SESSION['cours'];
                                }
                            } else {
                                echo "<tr><td colspan='3'>Aucun cours trouvé.</td></tr>";
                            }

                            if (isset($_GET['id_cours_pdf'])) {
                                $id_cours_pdf = $_GET['id_cours_pdf'];
                                $pdf = $conn->getPdf($id_cours_pdf);
                                if ($pdf !== null) {
                                    header('Location: ../' . $pdf['path']);
                                    exit;
                                } else {
                                    echo "Aucun PDF trouvé pour ce cours.";
                                }
                            }
                            ?>


                        </tbody>
                    </table>


                </div>
                <div class="orders coursAll" hidden>
                    <div class="header">
                        <i class='bx bx-receipt'></i>
                        <h3>Cours Récents</h3>
                        <!-- <i class='bx bx-filter'></i>
                        <i class='bx bx-search'></i> -->
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Prof</th>
                                <th>Titre</th>
                                <!-- <th>Status</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_SESSION['cours']) && !empty($_SESSION['cours'])) {
                                foreach ($_SESSION['cours'] as $cours) {
                                    $idUtilisateur = $cours['id_utilisateur'];
                                    $user = $conn->getUserC($idUtilisateur);
                                    echo "<tr>";
                                    echo "<td>{$cours['titre']}</td>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Aucun utilisateur trouvé.</td></tr>";
                            }
                            if (isset($_GET['id_cours_pdf'])) {
                                $id_cours_pdf = $_GET['id_cours_pdf'];
                                $pdf = $conn->getPdf($id_cours_pdf);
                                if ($pdf !== null) {
                                    header('Location: ../' . $pdf['path']);
                                    exit;
                                } else {
                                    echo "Aucun PDF trouvé pour ce cours.";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="reminders qcm3">
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Qcm </h3>
                    </div>
                    <ul class="task-list">
                        <?php foreach ($_SESSION['qcm'] as $qcm) : ?>
                            <li class="completed" onclick="qcm('<?= isset($qcm['path']) ? 'path=' . urlencode($qcm['path']) . '&' : '' ?>')">
                                <div class="task-title">
                                    <i class='bx bx-check-circle'></i>
                                    <a>
                                        <p><?= $qcm['titre'] ?></p>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="reminders qcmAll" hidden>
                    <div class="header">
                        <i class='bx bx-note'></i>
                        <h3>Qcm</h3>
                    </div>
                    <ul class="task-list">
                        <?php foreach ($_SESSION['qcm'] as $qcm) : ?>
                            <li class="completed" onclick="qcm('<?= isset($qcm['path']) ? 'path=' . urlencode($qcm['path']) . '&' : '' ?>')">
                                <div class="task-title">
                                    <i class='bx bx-check-circle'></i>
                                    <a>
                                        <p><?= $qcm['titre'] ?></p>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>

        </main>
        <?php
        ?>
    </div>
    <?php
    ?>
    <script src="../Assets/js/DashboardBasic.js"></script>
</body>

</html>
<?php
$contenu = ob_get_clean();
echo $contenu;
?>