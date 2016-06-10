<?php

class Note extends Model {
	public $valeur,$dateNote,$album,$pseudo;
	public static function setFromId( $pseudo,$album,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Note set valeur=:valeur,dateNote=:dateNote WHERE pseudo = :pseudo AND album= :album";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":pseudo" => $pseudo,
			":album"=>$album,
			":valeur"=>$data['valeur'],
			":dateNote"=>$data['dateNote']));
		//return $stmt->fetch();
	}
	public function toHTML()
	{
		return ($this->valeur)." le ".($this->dateNom);
	}
	public static function getFromId( $pseudo,$album ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Note WHERE pseudo= :pseudo AND album= :album";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		$stmt->execute(array(
			":pseudo" => $pseudo,
			":album" => $album	));
		return $stmt->fetch();
	}

	public static function getList() {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Note";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		return $stmt->fetchAll();
	}
	public static function getFromPseudo($pseudo) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Note where pseudo=:pseudo";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Note");
		$stmt->execute(array(
			":pseudo" => $pseudo));
		return $stmt->fetchAll();
	}
}
?>


