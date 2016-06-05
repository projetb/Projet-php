<?php

class AlbumController extends Controller {
	
	public function afficherListe(){
		$this->view->list = Album::getList();
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
						$sql = "select * from Album where titre=:titre and idArtiste=:id";
						$req = $db->prepare($sql);
						$req->execute(array(":titre"=>$titre,":id"=>$artiste));
						$array = $req->fetchALL();
						$nb = count($array);
					if ($nb<1){
				$this->artiste = Artiste::getId($artiste);
       echo "Vous avez ajouter un album!";
		   $sql = "INSERT INTO Album(`titre`, `dateSortie`, `genre`, `idArtiste`) values(:titre,:date,:genre,:artiste)";
		   $stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
	  	$stmt->execute(array(":titre" => $titre,
			":date"=>$date,
			":genre"=>$genre,
     	":artiste"=>$this->artiste->idArtiste));
	  	return $stmt->fetch();
        }
				else {
					echo "Cet Album existe déjà ...";
				}
				}
      }
	}
}
?>
