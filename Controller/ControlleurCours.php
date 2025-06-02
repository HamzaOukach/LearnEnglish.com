<?php
require_once('../Config/configBDD.php');
class ControlleurCours
{
    private $model;
    function __construct()
    {
        $this->model = new PDO("mysql:host=localhost;dbname=projet", DB_USER, DB_PASS);
    }

    function getCours($id)
    {
        $req = "SELECT * FROM cours WHERE id = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($_GET['id']));
        $coursToEdit = $row->fetch(PDO::FETCH_ASSOC);
        return $coursToEdit;
    }

    function getCoursById($id) {
        $req = $this->model->prepare("SELECT * FROM cours WHERE id = ?");
        $req->execute([$id]);
        return $req->fetch(PDO::FETCH_ASSOC);
    }
    

    function getVideo($id_video)
    {
        $req = "SELECT * FROM video WHERE id = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($id_video));
        $videoToEdit = $row->fetch(PDO::FETCH_ASSOC);
        return $videoToEdit;
    }

    function getPdf($id_pdf)
{
    $req = "SELECT * FROM pdf WHERE id = ?";
    $stmt = $this->model->prepare($req);
    $stmt->execute([$id_pdf]);
    return $stmt->fetch(PDO::FETCH_ASSOC); 
}


    function getVideos($id_cours)
    {
        $req = "SELECT * FROM video WHERE id_cours = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($id_cours)); 
        $videos = $row->fetchAll(PDO::FETCH_ASSOC);
        return $videos;
    }

    function getPdfs($id_cours)
    {
        $req = "SELECT * FROM pdf WHERE id_cours = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($id_cours)); 
        $pdfs = $row->fetchAll(PDO::FETCH_ASSOC);
        return $pdfs;
    }

    function verifieInscription($id_utilisateur, $id_cours) {
        $sql = "SELECT * FROM inscription WHERE id_utilisateur = ? AND id_cours = ?";
        $stmt = $this->model->prepare($sql);
        $stmt->execute([$id_utilisateur, $id_cours]);
        return $stmt->rowCount() > 0;
    }
    
    function inscrireEtudiant($id_utilisateur, $id_cours) {
        $sql = "INSERT INTO inscription (id_utilisateur, id_cours) VALUES (?, ?)";
        $stmt = $this->model->prepare($sql);
        $stmt->execute([$id_utilisateur, $id_cours]);
    }

    function enregistrerProgression($id_utilisateur, $id_cours, $id_video = null, $id_pdf = null)
{
    
    $sql = "SELECT * FROM progression WHERE id_utilisateur = ? AND id_cours = ? AND ";
    $sql .= $id_video ? "id_video = ?" : "id_pdf = ?";
    $check = $this->model->prepare($sql);
    $check->execute([$id_utilisateur, $id_cours, $id_video ?? $id_pdf]);

    
    if ($check->rowCount() === 0) {
        $insert = "INSERT INTO progression (id_utilisateur, id_cours, id_video, id_pdf, vu, date_consultation) 
                   VALUES (?, ?, ?, ?, true, NOW())";
        $stmt = $this->model->prepare($insert);
        $stmt->execute([$id_utilisateur, $id_cours, $id_video, $id_pdf]);
    }
}

function getProgressionPourcentage($id_utilisateur, $id_cours) {
    
    $sql = "SELECT COUNT(*) AS viewed 
            FROM progression 
            WHERE id_utilisateur = $id_utilisateur AND id_cours = $id_cours";

    $stmt = $this->model->query($sql); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $viewedItems = $row['viewed'];

    $totalItems = 7;
    $percentage = ($viewedItems / $totalItems) * 100;
    return round($percentage);
}
function getPdfById($id_pdf)
{
    $sql = "SELECT * FROM pdf WHERE id = ?";
    $stmt = $this->model->prepare($sql);
    $stmt->execute([$id_pdf]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function countCompletedCourses($id_user) {
    $sqlCourses = "SELECT DISTINCT id_cours FROM progression WHERE id_utilisateur = ?";
    $stmtCourses = $this->model->prepare($sqlCourses);
    $stmtCourses->execute([$id_user]);
    $courses = $stmtCourses->fetchAll(PDO::FETCH_COLUMN);

    $completed = 0;

    foreach ($courses as $id_cours) {
        
        $sqlTotalVideos = "SELECT COUNT(*) FROM video WHERE id_cours = ?";
        $stmtTotal = $this->model->prepare($sqlTotalVideos);
        $stmtTotal->execute([$id_cours]);
        $totalVideos = $stmtTotal->fetchColumn();

        
        $sqlViewedVideos = "SELECT COUNT(DISTINCT id_video) FROM progression WHERE id_utilisateur = ? AND id_cours = ? AND vu = 1";
        $stmtViewed = $this->model->prepare($sqlViewedVideos);
        $stmtViewed->execute([$id_user, $id_cours]);
        $viewedVideos = $stmtViewed->fetchColumn();

        if ($totalVideos > 0 && $viewedVideos == $totalVideos) {
            $completed++;
        }
    }

    return $completed;
}
private function compareCertificateLevel($new, $current) {
    $levels = ['A1' => 1, 'A2' => 2, 'B1' => 3, 'B2' => 4, 'C1' => 5, 'C2' => 6];

    return $levels[$new] - $levels[$current];
}

public function giveCertificate($id_user) {
    $completedCourses = $this->countCompletedCourses($id_user);

    
    $certificates = [
        2 => 'A1',
        4 => 'A2',
        6 => 'B1',
        8 => 'B2',
        10 => 'C1',
        12 => 'C2'
    ];

    foreach ($certificates as $coursesRequired => $niveau) {
        if ($completedCourses >= $coursesRequired) {
            
            $check = $this->model->prepare("SELECT * FROM certificats WHERE id_utilisateur = ? AND niveau = ?");
            $check->execute([$id_user, $niveau]);

            
            if ($check->rowCount() == 0) {
                $insert = $this->model->prepare("INSERT INTO certificats (id_utilisateur, niveau, date_obtention) VALUES (?, ?, NOW())");
                $insert->execute([$id_user, $niveau]);
            }
        }
    }
}



public function getCertificates($id_user) {
    $sql = "SELECT * FROM certificats WHERE id_utilisateur = ?";
    $stmt = $this->model->prepare($sql);
    $stmt->execute([$id_user]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}







}
