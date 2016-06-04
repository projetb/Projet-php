<?php

class CommentaireController extends Controller {
	
	public function afficherListe(){
		$id = $this->route["params"]["id"];
		$this->view->list = Commentaire::getList();
		$this->view->album = Album::getNom($id);
		$this->view->artiste = Artiste::getNom($id);
		$this->view->display(); 

	}
	public function afficherCommentaire() {
		$id = $this->route["params"]["id"];
		$this->view->commentaire = Commentaire::getFromId($id);;
		$this->view->display();
	}
  
  public function commenter(){
     extract($_POST);
      if(isset($commentaire)) {
		   	$db = Database::getInstance();
       	echo "Message envoyé !";
		   	$sql = "INSERT INTO Commentaire(`texte`, `dateCom`, `album`, `pseudo`) values(:texte,NOW(),:album,:pseudo)";
		  	$stmt = $db->prepare($sql);
		  	$stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
	  		$stmt->execute(array(":texte" => $commentaire,
				":album"=>$this->album->idAlbum,
				":pseudo"=>$_SESSION['pseudo']));
	  		return $stmt->fetch();
        }   
  }
}
?>