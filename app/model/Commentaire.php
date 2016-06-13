<?php

class Commentaire extends Model {
	public $idCommentaire, $texte, $dateCom, $visible,$album;
	public static function setFromId( $id,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Commentaire set texte=:texte,dateCom=:dateCom,visible=visible ,album=:album WHERE idCommentaire = :idCommentaire";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":idCommentaire" => $id,
			":texte"=>$data['texte'],
			":dateCom"=>$data['dateCom'],
			":album"=>$data['album'],
			":visible"=>$data['visible']));
		//return $stmt->fetch();
	}
	public function toHTML()
	{
		return ($this->texte)." le ".($this->dateCom);
	}
	public static function getFromId( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Commentaire WHERE album= :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Commentaire");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}

		public static function getCom( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Commentaire WHERE idCommentaire= :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Commentaire");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}
	
	public static function getList() {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Commentaire";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Commentaire");
		return $stmt->fetchAll();
	}
	public static function getListFromPseudo($pseudo){
		$db = Database::getInstance();
		$sql = "Select * FROM Commentaire WHERE pseudo = :pseudo";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Commentaire");
		$stmt->execute(array(":pseudo" => $pseudo));
		return $stmt->fetchAll();
	}
	public static function supCom($id){
		$db = Database::getInstance();
		$sql = "DELETE FROM Commentaire WHERE idCommentaire = :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Commentaire");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}
	
	public static function getListFromDate($date){
		$db = Database::getInstance();
		$sql = "Select * FROM Commentaire WHERE dateCom >= :date";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Commentaire");
		$stmt->execute(array(":date" => $date));
		return $stmt->fetchAll();
	}
}
?>


