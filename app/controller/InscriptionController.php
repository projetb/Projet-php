<?php

class InscriptionController extends Controller {
   
   public function Inscription() {
      $this->view->display();
   }
  public function verifChamp(){
     extract($_POST);
      if(isset($login) && isset($pass) && isset($pass2) && isset($mail) && isset($fname) && isset($name)) {
				echo "<br>";
        if ($login=="" || $pass=="" || $pass2=="" || $mail=="" || $fname=="" || $name==""){
              
            echo " Champs incomplets.Veuillez réessayer";
        }
				 if ($pass!=$pass2){
                   echo "Mot de passe incorrect<br>";
                }
        else if  ($login!="" && $pass!="" && $mail!="" && $fname!="" && $name!="" && ($pass==$pass2)) {
		          $db = Database::getInstance();
						$sql = "select * from Utilisateur where pseudo=:pseudo ";
						$req = $db->prepare($sql);
						$req->execute(array(":pseudo"=>$login));
						$array = $req->fetchALL();
						$nb = count($array);
					if ($nb<1){
					
       echo "Inscription Réussie!";
		   $sql = "INSERT INTO Utilisateur values(:login,:pass,:mail,:fname,:name,:valide)";
		   $stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
	  	$stmt->execute(array(":login" => $login,
			":pass"=>$pass,
			":mail"=>$mail,
     	":fname"=>$fname,
			":name"=>$name,
			":valide"=>false));
	  	return $stmt->fetch();
        }       
				
				else {
					echo "Ce pseudo est déja utilisé..Veuillez en choisir un autre.";
				}
				}
      }
  }
}
?>