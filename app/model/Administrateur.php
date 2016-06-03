<?php

class Administrateur extends Model {
	public $id;
	/*public static function setFromId( $id,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE contacts set nom=:nom,prenom=:prenom,email=:email WHERE id = :id";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":id" => $id,
			":nom"=>$data['nom'],
			":prenom"=>$data['prenom'],
			":email"=>$data['email']));
		//return $stmt->fetch();
	}*/
	public function toHTML()
	{
		return (" Admin:".($this->id);
	}
	public static function getFromId( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Administrateur WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Administrateur");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}

	public static function getList() {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Administrateur";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Administrateur");
		return $stmt->fetchAll();
	}
}
?>


