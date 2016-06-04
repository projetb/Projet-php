<?php

class Album extends Model {
	public $idAlbum, $titre, $dateSortie, $genre, $noteGeneral,$idArtiste;
	public static function setFromId( $id,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Album set titre=:titre,dateSortie=:dateSortie,genre=:genre,noteGeneral=:noteGeneral,idArtiste=:idArtiste ,WHERE id = :id";
		$stmt = $db->prepare($sql);
		//$stmt->setFetchMode(PDO::FETCH_CLASS, "Contact");
		return $stmt->execute(array(
			":id" => $id,
			":titre"=>$data['titre'],
			":dateSortie"=>$data['dateSortie'],
			":genre"=>$data['genre'],
			":idArtiste"=>$data['idArtiste'],
      ":noteGeneral"=>$data['noteGeneral']));
		//return $stmt->fetch();
	}

	public static function getFromId( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Album WHERE id = :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}

	public static function getList() {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Album";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		return $stmt->fetchAll();
	}
	
	public static function getNom( $id ){
		$db = Database::getInstance();
		$sql = "SELECT * FROM Album WHERE titre= :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		$stmt->execute(array(":id" => $id));
		return $stmt->fetch();
	}
}
?>