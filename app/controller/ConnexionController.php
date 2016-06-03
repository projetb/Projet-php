<?php
class ConnexionController extends Controller {
   
   public function Connexion() {
      $this->view->display();
   }

  public function seConnecter(){
    $message='';
    extract($_POST);
    if (empty($login) || empty($pass) )
    {
        $message = '<p>une erreur s\'est produite pendant votre identification.
	Vous devez remplir tous les champs</p>
	<p>Cliquez <a href="./connexion.php">ici</a> pour revenir</p>';
    }
    else 
    {
      $db = Database::getInstance();
        $query=$db->prepare('SELECT mdp,pseudo
        FROM Utilisateur WHERE pseudo= :pseudo');
        $query->bindValue(':pseudo',$login, PDO::PARAM_STR);
        $query->execute();
        $data=$query->fetch();
	if ($data['mdp'] == ($pass)) {
	    $_SESSION['pseudo'] = $data['pseudo'];
	    $message = "<p>Bienvenue ".$data['pseudo'].", 
			Redirection vers les albums ..</p>";  
			header('Refresh: 2;/public/Album');
	}
	else 
	{
	    $message = "<p>Une erreur s'est produite 
	    pendant votre identification.<br /> Le mot de passe ou le pseudo 
            entré n\'est pas correcte.</p><p>
            Veuillez réessayer ou cliquez <a href='".BASE_URL."'/Inscription'.>ici</a> 
	    pour revenir à la page d'accueil</p>";
	}
    $query->CloseCursor();
    echo $message;
      }
}
}
?>
