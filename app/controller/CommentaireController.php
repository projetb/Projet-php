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
		$this->view->commentaire = Commentaire::getFromId($id);
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
	public function supCom(){
		$id=$this->route["params"]["id"];
		$this->view->commentaire = Commentaire::getCom($id);
		$value=$this->view->commentaire->album;
		echo $value;
		$this->view->album=Album::getFromId($value);
		Commentaire::supCom($id);
		$this->view->display();
	}
	
	public function note(){
		if (!isset($_SESSION['pseudo'])){session_start();}
		$this->view->note=$this->route["params"]["note"];
		$this->view->album=$this->route["params"]["album"];
		//echo $_SESSION['pseudo'];
		$idAlbum=Album::getNom($this->view->album);
		$db = Database::getInstance();
		$sql = "select * from Note where pseudo=:pseudo and album=:album";
		$stmt = $db->prepare($sql);
		$stmt->execute(array(":album"=>$idAlbum->idAlbum,":pseudo"=>$_SESSION['pseudo']));
		$array = $stmt->fetchALL();
		$nb = count($array);
		if ($nb<1){
			$sql = "INSERT INTO Note(`valeur`, `dateNote`, `album`, `pseudo`) values(:note,NOW(),:album,:pseudo)";
			$stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
	  	$stmt->execute(array(":note" => $this->view->note,
			":album"=>$idAlbum->idAlbum,
			":pseudo"=>$_SESSION['pseudo']));
		}
		else{
			$sql = "UPDATE `Note` SET `valeur`=:note,`dateNote`=NOW() where pseudo=:pseudo and album=:album";
			$stmt = $db->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
			$stmt->execute(array(":note" => $this->view->note,
			":pseudo"=>$_SESSION['pseudo'],
			":album"=>$idAlbum->idAlbum));	
		}
		Album::noteGeneral($idAlbum);
		$this->view->display();
		return $stmt->fetch();
	}
}
?>