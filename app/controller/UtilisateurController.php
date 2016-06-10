<?php

class UtilisateurController extends Controller {
	
	public function afficherListe(){
		$this->view->list = Utilisateur::getList();
		$this->view->display(); 

	}
	public function afficherUser() {
		$pseudo = $this->route["params"]["pseudo"];
		$this->view->utilisateur = Utilisateur::getFromPseudo($pseudo);
		$this->view->listNote= Note::getFromPseudo($pseudo);
		$this->view->listCom= Commentaire::getListFromPseudo($pseudo);
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
