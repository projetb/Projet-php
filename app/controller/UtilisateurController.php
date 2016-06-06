<?php

class UtilisateurController extends Controller {
	
	public function afficherListe(){
		$this->view->list = Utilisateur::getList();
		$this->view->display(); 

	}
	public function afficherUtilisateur() {
		$id = $this->route["params"]["id"];
		$this->view->utilisateur = Utilisateur::getFromId($id);
		$this->view->display();
	}
	public function valideUser(){
		$pseudo=$this->route["params"]["pseudo"];
		Utilisateur::valideUser($pseudo);
		$this->view->utilisateur = Utilisateur::getFromPseudo($pseudo);
		$this->view->display();
	}
	public function supUser(){
		$pseudo=$this->route["params"]["pseudo"];
		$this->view->utilisateur = Utilisateur::getFromPseudo($pseudo);
		Utilisateur::supUser($pseudo);
		$this->view->display();
	}
}
?>
