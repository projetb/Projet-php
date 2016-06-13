<?php
class Router {
   public static function analyze( $query ) {
      $result = array(
         "controller" => "Error",
         "action" => "error404",
         "params" => array()
	 );
      if( $query === "" || $query === "/" ) {
         $result["controller"] = "Index";
		 $result["action"] = "index";
      } else {
		  $parts = explode("/", $query);
		  if($parts[0] == "Album")  {
			  if (count($parts) == 1){
				  $result["controller"] = "Album";
				  $result['action'] = "afficherListe";
			  }
			  if ((count($parts) == 2) && ($parts[1] == "afficher")){
            $result["controller"] = "Album";
            $result["action"] = "description";
            //$result["params"]["slug"] = $parts[1];            
			  }
				if ((count($parts) == 2) && ($parts[1] == "ajouter")){
            $result["controller"] = "Album";
            $result["action"] = "ajouterAlbum";
            //$result["params"]["slug"] = $parts[1];            
			  }
			  if ( (count($parts) == 3) 
				  && ($parts[1] == "afficher")
				  && ($parts[0] == "Album")){

					  $result["controller"] = "Album";
					  $result["action"] = "description";
					  $result["params"]["id"] = $parts[2];            
				  }
				if ( (count($parts) == 4) 
				  && ($parts[2] == "note")
				  && ($parts[0] == "Album")){

					  $result["controller"] = "Album";
					  $result["action"] = "Note";
						$result["params"]["album"] = $parts[1]; 
					  $result["params"]["note"] = $parts[3];            
				  }
			
				}
					if ((count($parts) == 3 ) && ($parts[0] == "Commentaire") && ($parts[1] == "supCom")) {
					$result["controller"] = "Album";
					$result["action"] = "supCom";
					$result["params"]["id"] = $parts[2];
		  }
		if($parts[0] == "Inscription")  {
			if (count($parts) == 1){
				$result["controller"] = "Inscription";
				$result['action'] = "Inscription";
			}
		}
		if($parts[0] == "Connexion")  {
			  if (count($parts) == 1){
				  $result["controller"] = "Connexion";
				  $result['action'] = "Connexion";
			  }
		}
		if($parts[0] == "Artiste")  {
			  if (count($parts) == 1){
				  $result["controller"] = "Artiste";
				  $result['action'] = "afficherListe";
			  }
				if ((count($parts) == 2) && ($parts[1] == "ajouter")){
            $result["controller"] = "Artiste";
            $result["action"] = "ajouterArtiste";            
			  }
				  if ( (count($parts) == 3) 
				  && ($parts[1] == "afficher")
				  && ($parts[0] == "Artiste")){

					  $result["controller"] = "Artiste";
					  $result["action"] = "afficherArtiste";
					  $result["params"]["id"] = $parts[2];            
				  }
		}
		if (count($parts) == 1){
					if($parts[0] == "Utilisateur")  {
				  $result["controller"] = "Utilisateur";
				 $result["action"] = "afficherListe";
			  }
			}
				if ((count($parts) == 3 ) && ($parts[0] == "Utilisateur") && ($parts[1] == "afficher")) {
					$result["controller"] = "Utilisateur";
					$result["action"] = "afficherUser";
					$result["params"]["pseudo"] = $parts[2];
				}
			if ((count($parts) == 3 ) && ($parts[0] == "Utilisateur") && ($parts[1] == "valideUser")) {
					$result["controller"] = "Utilisateur";
					$result["action"] = "valideUser";
					$result["params"]["pseudo"] = $parts[2];
				}
	if ((count($parts) == 3 ) && ($parts[0] == "Utilisateur") && ($parts[1] == "supUser")) {
					$result["controller"] = "Utilisateur";
					$result["action"] = "supUser";
					$result["params"]["pseudo"] = $parts[2];
				}
		if($parts[0] == "Deconnexion")  {
			  if (count($parts) == 1){
				  $result["controller"] = "Deconnexion";
				  $result['action'] = "Deconnexion";
			  }
		}
		if($parts[0] == "About")  {
			  if (count($parts) == 1){
				  $result["controller"] = "About";
				  $result['action'] = "rapport";
			  }
		}
	  }
	  return $result;
   }
}
?>
