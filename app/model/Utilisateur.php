<?php

class Utilisateur extends Model {
	public $pseudo,$mdp,$email,$nom,$prenom,$valide;
	public static function setFromPseudo( $pseudo,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Utilisateur set mdp=:mdp,email=:email,nom=nom,prenom=prenom,valide=:valide WHERE pseudo = :pseudo";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":pseudo" => $pseudo,
			":mdp"=>$data['mdp'],
			":email"=>$data['email'],
     	":nom"=>$data['nom'],
			":valide"=>$data['valide'],
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
	public static function valideUser($pseudo){
		$db = Database::getInstance();
		$sql = "UPDATE Utilisateur set valide=true WHERE pseudo = :pseudo";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
		$stmt->execute(array(":pseudo" => $pseudo));
		return $stmt->fetch();
	}
	
	public static function supUser($pseudo){
		$db = Database::getInstance();
		$sql = "DELETE FROM Utilisateur WHERE pseudo = :pseudo";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
		$stmt->execute(array(":pseudo" => $pseudo));
		return $stmt->fetch();
	}
}
?>


