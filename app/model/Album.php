<?php

class Album extends Model {
	public $idAlbum, $titre, $dateSortie, $genre, $noteGeneral,$idArtiste,$pochette;
	public static function setFromId( $id,$data ) {                                                                                                  
		$db = Database::getInstance();
		$sql = "UPDATE Album set 
		titre=:titre,
		dateSortie=:dateSortie,
		genre=:genre,
		noteGeneral=:noteGeneral,
		idArtiste=:idArtiste,
		pochette=:pochette,
		WHERE id = :id";
		$stmt = $db->prepare($sql);
		return $stmt->execute(array(
			":id" => $id,
			":titre"=>$data['titre'],
			":dateSortie"=>$data['dateSortie'],
			":genre"=>$data['genre'],
			":idArtiste"=>$data['idArtiste'],
			":pochette"=>$data['pochette'],
      ":noteGeneral"=>$data['noteGeneral']));
	}

	public static function getFromId( $id ) {
		$db = Database::getInstance();
		$sql = "SELECT * FROM Album WHERE idAlbum = :id";
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
		public static function getListGenre() {
		$db = Database::getInstance();
		$sql = "SELECT DISTINCT genre FROM Album";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		return $stmt->fetchAll();
	}
	
	public static function getPalma(){
		$db = Database::getInstance();
		$sql = "SELECT * FROM `Album` ORDER BY `Album`.`noteGeneral` DESC LIMIT 3";
		$stmt = $db->query($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		return $stmt->fetchAll();
	}
	
	public static function getAlbumsFromArtiste($id){
		$db = Database::getInstance();
		$sql = "SELECT * FROM Album WHERE idArtiste = :id";
		$stmt = $db->prepare($sql);
		$stmt->setFetchMode(PDO::FETCH_CLASS, "Album");
		$stmt->execute(array(":id" => $id));
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