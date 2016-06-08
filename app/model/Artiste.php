<?php

class Artiste extends Model {
	public $idArtiste, $pseudoArtiste, $description,$profil,$ajouterPar;
	public static function setFromId( $id ,$data) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Artiste set id=:id,pseudoArtiste=:pseudoArtiste,description=:description ,profil=:profil,ajouterPar=:ajouterPar WHERE id = :id";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":id" => $id,
			":pseudoArtiste"=>$data['pseudoArtiste'],
			":profil"=>$data['profil'],
			":ajouterPar"=>$data['ajouterPar'],
			":description"=>$data['description']));
		//return $stmt->fetch();
	}
	
	public static function getFromId( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Artiste WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}

	public static function getList() {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Artiste";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
		return $stmt->fetchAll();
	}
	
	public static function getNom( $id ){
		$db = Database::getInstance();
		$sql = "SELECT * FROM Album natural join Artiste WHERE titre= :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}
	
	public static function getId( $id ){
		$db = Database::getInstance();
		$sql = "SELECT * FROM Artiste WHERE pseudoArtiste= :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Artiste");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}
}
?>