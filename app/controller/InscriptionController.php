<<<<<<< Updated upstream
<?php
class InscriptionController extends Controller {
   
   public function Inscription() {
      $this->view->display();
   }
}
=======
<?php
class InscriptionController extends Controller {
   
   public function Inscription() {
      $this->view->display();
   }
  public function verifChamp(){
     extract($_POST);
      if(isset($login) && isset($pass) && isset($pass2) && isset($mail) && isset($fname) && isset($name)) {
        if ($login=="" || $pass=="" || $pass2=="" || $mail=="" || $fname=="" || $name==""){
               if ($pass!=$pass2){
                   echo "<br>Mot de passe incorrect.";
                }
            echo "<br>Champs incomplets.Veuillez réessayer";
        }
        else if  ($login!="" || $pass!="" || $mail!="" || $fname!="" || $name!="") {
             echo "<br>Inscription Réussi.";
          $db = Database::getInstance();
		     $sql = "INSERT INTO Utilisateur values(:login,:pass,:mail,:fname,:name)";
		     $stmt = $db->prepare($sql);
		  $stmt->setFetchMode(PDO::FETCH_CLASS, "Utilisateur");
	  	$stmt->execute(array(":login" => $login,
			":pass"=>$pass,
			":mail"=>$mail,
     	":fname"=>$fname,
			":name"=>$name));
	  	return $stmt->fetch();
        }       
      }
  }
}
?>
>>>>>>> Stashed changes
