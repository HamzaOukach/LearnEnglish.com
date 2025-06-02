<?php
require_once('model/modelBDD.php');
class ControlleurAdmin
{
    private $model;
    function __construct()
    {
        $this->model = new ModelBDD();
    }

    function adminAjoutCours()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['id'])) {
        return false; 
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $titre = $_POST['titre'] ?? '';
        $categorie = $_POST['categorie'] ?? '';
        $prix = $_POST['prix'] ?? '';
        $description = $_POST['description'] ?? '';
        $id_utilisateur = $_SESSION['id'];

        if (empty($titre) || empty($categorie) || empty($prix) || empty($description)) {
            return false;
        }

        $sql = "INSERT INTO cours (titre, categorie, prix, id_utilisateur, description)
                VALUES ('$titre', '$categorie', '$prix', '$id_utilisateur', '$description')";

        $this->model->execute_query($sql);
        $this->getCours();

        return true; 
    }

    return false;
}






    function getUsers()
    {
        $req = $this->model->execute_query("SELECT * FROM utilisateur WHERE role ='basic' ORDER BY id DESC");
        $_SESSION['users'] = $req->fetchAll(PDO::FETCH_ASSOC);;
    }

    function getAdmin()
    {
        $id = $_SESSION['id_utilisateur'];
        $req = $this->model->execute_query("SELECT * FROM utilisateur WHERE role ='admin' AND id!=$id ORDER BY id DESC");
        $_SESSION['admin'] = $req->fetchAll(PDO::FETCH_ASSOC);
    }

    function getCours()
    {
        $req = $this->model->execute_query("SELECT * FROM cours ORDER BY id ASC");
        $_SESSION['cours'] = $req->fetchAll(PDO::FETCH_ASSOC);;
    }
    function getPdf()
    {
        $req = $this->model->execute_query("SELECT * FROM pdf ORDER BY id ASC");
        $_SESSION['pdf'] = $req->fetchAll(PDO::FETCH_ASSOC);;
    }
    function getQcm()
    {
        $req = $this->model->execute_query("SELECT * FROM qcm ORDER BY id ASC");
        $_SESSION['qcm'] = $req->fetchAll(PDO::FETCH_ASSOC);;
    }

    function adminAjoutUser()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['mdp'];
            $image = $_FILES['image'];
            $file_p = "Media/" . $image['name'];
            move_uploaded_file($image["tmp_name"], $file_p);

            $sql = "INSERT INTO utilisateur (nom,prenom,email,mdp,role,photo) VALUES ('$nom','$prenom','$email','$password','basic','$file_p')";
            echo "<pre>SQL DEBUG: $sql</pre>";
            $this->model->execute_query($sql);
            $this->getUsers();
            return true;
        }
    }


    function adminAjoutVideo()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titre = $_POST['titre'];
            $id_cours = $_POST['id_cours'];
            $video_link = $_POST['video_link'];
             

            
            $sql = "INSERT INTO video (titre, path, id_cours) VALUES ('$titre', '$video_link', '$id_cours')";
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $this->getCours();
            return true;
        }
    }

    function adminAjoutPdf()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titre = $_POST['titre'];
            $id_cours = $_POST['id_cours'];
            $pdf = $_FILES['pdf'];
            $file_p = "Media/" . $pdf['name'];
            move_uploaded_file($pdf["tmp_name"], $file_p);
            $idUser = $_SESSION['id_utilisateur']; 

            
            $sql = "INSERT INTO pdf (titre, path, id_cours) VALUES ('$titre', '$file_p', '$id_cours')";
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $this->getCours();
            return true;
        }
    }


    function adminAjoutQcm()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $titre = $_POST['titre'];
            $qcm = $_FILES['qcm'];
            $file_p = "Assets/xml/" . $qcm['name'];
            move_uploaded_file($qcm["tmp_name"], $file_p);
            $idUser = $_SESSION['id']; 

            
            $sql = "INSERT INTO qcm (titre, path, id_utilisateur) VALUES ('$titre', '$file_p', '$idUser')";
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $this->getQcm();
            return true;
        }
    }

    function adminEditCours()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $categorie = $_POST['categorie'];
            $prix = $_POST['prix'];
            if (isset($_FILES['cours']) && !empty($_FILES['cours']['name'])) {
                $cours = $_FILES['cours'];
                $file_p = "Media/" . $cours['name'];
                move_uploaded_file($cours["tmp_name"], $file_p);
                $sql = "UPDATE cours SET titre='$titre',categorie='$categorie', prix='$prix', path='$file_p' WHERE id=$id";
            } else {
                $sql = "UPDATE cours SET titre='$titre',categorie='$categorie', prix='$prix' WHERE id=$id";
            }
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            
            $this->getCours();
            return true;
        }
    }

    function adminEditVideo()
    {
        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
    
            if (!empty($_POST['video_link'])) {
                
                $video_link = $_POST['video_link'];
                $sql = "UPDATE video SET titre='$titre', path='$video_link' WHERE id=$id";
            } else {
                
                $sql = "UPDATE video SET titre='$titre' WHERE id=$id";
            }
    
            echo "<pre>SQL DEBUG: $sql</pre>";
    
            $this->model->execute_query($sql);
            $this->getCours();
            return true;
        }
    }
    

    function adminEditPdf()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            if (isset($_FILES['pdf']) && !empty($_FILES['pdf']['name'])) {
                $pdf = $_FILES['pdf'];
                $file_p = "Media/" . $pdf['name'];
                move_uploaded_file($pdf["tmp_name"], $file_p);
                $sql = "UPDATE pdf SET titre='$titre', path='$file_p' WHERE id=$id";
            } else {
                $sql = "UPDATE pdf SET titre='$titre' WHERE id=$id";
            }
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $this->getCours();
            return true;
        }
    }

    function adminEditQcm()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            if (isset($_FILES['qcm']) && !empty($_FILES['qcm']['name'])) {
                $qcm = $_FILES['qcm'];
                $file_p = "Assets/xml/" . $qcm['name'];
                move_uploaded_file($qcm["tmp_name"], $file_p);
                $sql = "UPDATE qcm SET titre='$titre', path='$file_p' WHERE id=$id";
            } else {
                $sql = "UPDATE qcm SET titre='$titre' WHERE id=$id";
            }
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $this->getQcm();
            return true;
        }
    }



    function requestEditUser($id)
    {
        $req = "SELECT * FROM utilisateur WHERE id = $id";
        $row = $this->model->execute_query($req);
        $userToEdit = $row->fetch(PDO::FETCH_ASSOC);
        $_SESSION['userToEdit'] = $userToEdit;
        return true;

    }

    function adminEditUser()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $username = $_POST['nom'];
            $newprenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['mdp'];
            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $image = $_FILES['image'];
                $file_p = "Media/" . $image['name'];
                move_uploaded_file($image["tmp_name"], $file_p);
                $sql = "UPDATE utilisateur SET nom='$username',prenom='$newprenom', email='$email', mdp='$password', photo='$file_p' WHERE id=$id";
            } else {
                $sql = "UPDATE utilisateur SET nom='$username',prenom='$newprenom', email='$email', mdp='$password' WHERE id=$id";
            }
            echo "<pre>SQL DEBUG: $sql</pre>";

            $this->model->execute_query($sql);
            $this->getUsers();
            return true;
        }
    }
    function adminRemoveUser()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_utilisateur = $_POST['id'];
            $requete = "DELETE FROM utilisateur WHERE id = $id_utilisateur ";
            $this->model->execute_query($requete);
            $this->getUsers();
            return true;
        }
    }


    function adminRemoveVideo()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $requete = "DELETE FROM video WHERE id = $id ";
            $this->model->execute_query($requete);
            $this->getCours();
            return true;
        }
    }

    function adminRemovePdf()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $requete = "DELETE FROM pdf WHERE id = $id";
            $this->model->execute_query($requete);
            $this->getCours();
            return true;
        }
    }


    function adminRemoveCours()
{
    echo "Connected successfully";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['id'];

        
        $this->model->execute_query("DELETE FROM progression WHERE id_cours = $id");
        $this->model->execute_query("DELETE FROM inscription WHERE id_cours = $id");
        $this->model->execute_query("DELETE FROM video WHERE id_cours = $id");
        $this->model->execute_query("DELETE FROM pdf WHERE id_cours = $id");

        
        $this->model->execute_query("DELETE FROM cours WHERE id = $id");

        $this->getCours();
        return true;
    }
}


    function adminRemoveQcm()
    {

        echo "Connected successfully";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $requete = "DELETE FROM qcm WHERE id = $id ";
            $this->model->execute_query($requete);
            $this->getQcm();
            return true;
        }
    }

    function getVideos($id_cours)
    {
        $req = $this->model->execute_query("SELECT * FROM video WHERE id_cours=$id_cours");
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
