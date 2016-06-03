<?php

class Utilisateur extends Model {
	public $pseudo,$mdp,$email,$nom,$prenom;
	public static function setFromPseudo( $pseudo,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Utilisateur set mdp=:mdp,email=:email,nom=nom,prenom=prenom WHERE pseudo = :pseudo";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":pseudo" => $pseudo,
			":mdp"=>$data['mdp'],
			":email"=>$data['email'],
     	":nom"=>$data['nom'],
			":prenom"=>$data['prenom']));
		//return $stmt->fetch();
	}
	public function toHTML()
	{
		return ($this->prenom)." ".($this->nom);
	}
	public static function getFromPseudo( $pseudo ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Utilisateur WHERE pseudo = :pseudo";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
		$stmt->execute(array(":pseudo" => $pseudo));
		return $stmt->fetch();
	}

	public static function getList() {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Utilisateur";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
		return $stmt->fetchAll();
	}
}
?>


