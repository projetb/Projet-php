<?php

class ArtisteController extends Controller {
	
	public function afficherListe(){
		$this->view->list = Artiste::getList();
		$this->view->display(); 
	}
	
		public function ajouterArtiste(){
		$this->view->display(); 
	}
	
	public function afficherArtiste() {
		$id = $this->route["params"]["id"];
		$this->view->artiste = Artiste::getId($id); // Getfrompseudo
		$this->view->list= Album::getAlbumsFromArtiste($this->view->artiste->idArtiste);
		$this->view->display();
	}
	
	public function insererArtiste(){
     extract($_POST);
      if(isset($pseudo) && isset($description)) {
				echo "<br>";
        if ($pseudo=="" || $description==""){
            echo " Champs incomplets.Veuillez réessayer";
        }
        else if  ($pseudo!="" && $description!="") {
		          $db = Database::getInstance();
						$sql = "select * from Artiste where pseudoArtiste=:pseudo";
						$req = $db->prepare($sql);
						$req->execute(array(":pseudo"=>$pseudo));
						$array = $req->fetchALL();
						$nb = count($array);
					if ($nb<1){
					
       echo "Vous avez ajouter un artiste!";
				if ($url!=null){
		   $sql = "INSERT INTO Artiste(`pseudoArtiste`, `description`, `ajouterPar`, `profil`) values(:pseudo,:description,:user,:profil)";
				$stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
	  	$stmt->execute(array(":pseudo" => $pseudo,
			":description"=>$description,
			":user"=>$_SESSION['pseudo'],
			":profil"=>$url));
				}
			else{
				$sql = "INSERT INTO Artiste(`pseudoArtiste`, `description`, `ajouterPar`) values(:pseudo,:description,:user)";
		   $stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
	  	$stmt->execute(array(":pseudo" => $pseudo,
			":description"=>$description,
			":user"=>$_SESSION['pseudo']));
					}
	  	return $stmt->fetch();
        }
				else {
					echo "Cet Artiste existe déjà ...";
				}
				}
     }
	}
}
?>
