<?php
require_once('../Config/configBDD.php');
class ControlleurUser
{
    private $model;
    function __construct()
    {
        $this->model = new PDO("mysql:host=localhost;dbname=projet", DB_USER, DB_PASS);
    }

    function getUser($id)
    {
        $req = "SELECT * FROM utilisateur WHERE id = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($_GET['id']));
        $userToEdit = $row->fetch(PDO::FETCH_ASSOC);
        return $userToEdit;
    }
    function getUserC($id)
    {
        $req = "SELECT * FROM utilisateur WHERE id = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($id)); 
        $userToEdit = $row->fetch(PDO::FETCH_ASSOC);
        return $userToEdit;
    }

    function getVideos($id_cours)
    {
        $req = "SELECT * FROM video WHERE id_cours = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($id_cours)); 
        $videos = $row->fetchAll(PDO::FETCH_ASSOC);
        return $videos;
    }
    function getPdf($id_cours)
    {
        $req = "SELECT * FROM pdf WHERE id_cours = ?";
        $row = $this->model->prepare($req);
        $row->execute(array($id_cours));
        $pdfs = $row->fetchAll(PDO::FETCH_ASSOC); 
        return $pdfs;
    }

    function searchCourses($search)
    {
        $req = "SELECT * FROM cours WHERE titre LIKE ? OR categorie LIKE ?";
        $row = $this->model->prepare($req);
        $searchTerm = "%" . $search . "%"; 
        $row->execute(array($searchTerm, $searchTerm)); 
        $courses = $row->fetchAll(PDO::FETCH_ASSOC);
        return $courses;
    }
}
