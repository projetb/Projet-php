<?php

class AlbumController extends Controller {
	
	public function afficherListe(){
		$this->view->list = Album::getList();
		$this->view->listArtiste=Artiste::getList();
		$this->view->listGenre=Album::getListGenre();
		$this->view->display(); 

	}
	
	public function ajouterAlbum(){
		$this->view->list = Artiste::getList();
		$this->view->display(); 
	}
	
	public function afficherAlbum() {
		$id = $this->route["params"]["id"];
		$this->view->album = Album::getFromId($id);
		$this->view->display();
	}
	
	public function insererAlbum(){
     extract($_POST);
      if(isset($titre) && isset($artiste) && isset($genre) && isset($date)) {
				echo "<br>";
        if ($titre=="" || $artiste=="" || $genre=="" || $date==""){
            echo " Champs incomplets.Veuillez réessayer";
        }
        else if  ($titre!="" && $artiste!="" && $genre!="" && $date!="") {
		        $db = Database::getInstance();
						$sql = "select * from Album natural join Artiste where titre=:titre and pseudoArtiste=:id";
						$req = $db->prepare($sql);
						$req->execute(array(":titre"=>$titre,":id"=>$artiste));
						$array = $req->fetchALL();
						$nb = count($array);
					if ($nb<1){
				$this->artiste = Artiste::getId($artiste);
       echo "Vous avez ajouter un album!";
			if($url!=""){
		   $sql = "INSERT INTO Album(`titre`, `dateSortie`, `genre`, `idArtiste`, `pochette`) values(:titre,:date,:genre,:artiste,:pochette)";
		   $stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
	  	$stmt->execute(array(":titre" => $titre,
			":date"=>$date,
			":genre"=>$genre,
     	":artiste"=>$this->artiste->idArtiste,
			":pochette"=>$url));
			}
			else{
				$sql = "INSERT INTO Album(`titre`, `dateSortie`, `genre`, `idArtiste`) values(:titre,:date,:genre,:artiste)";
		   $stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
	  	$stmt->execute(array(":titre" => $titre,
			":date"=>$date,
			":genre"=>$genre,
     	":artiste"=>$this->artiste->idArtiste));
			}
	  	return $stmt->fetch();
        }
				else {
					echo "Cet Album existe déjà ...";
				}
				}
      }
	}
	public function description(){
		$id = $this->route["params"]["id"];
		$this->view->list = Commentaire::getList();
		$this->view->album = Album::getNom($id);
		$this->view->artiste = Artiste::getNom($id);
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
		// Inutile , utilisation de 2 trigger Album::noteGeneral($idAlbum);
		$this->view->display();
		return $stmt->fetch();
	}
}
?>
