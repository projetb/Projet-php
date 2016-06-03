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
            $result["controller"] = "Index";
            $result["action"] = "afficherListe";
            //$result["params"]["slug"] = $parts[1];            
			  }
			  if ( (count($parts) == 3) 
				  && ($parts[1] == "afficher")
				  && ($parts[0] == "Album")){

					  $result["controller"] = "Album";
					  $result["action"] = "afficherAlbum";
					  $result["params"]["id"] = $parts[2];            
				  }
			  //

			  if ((count($parts) == 3) && ($parts[1] == "modifier")){

				  $result["controller"] = "Album";
				  $result["action"] = "modifierAlbum";
				  $result["params"]["id"]= $parts[2];
				  $result["params"]["post"]= $_POST;
			  }
			  //
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
		}
		if($parts[0] == "Utilisateur")  {
			  if (count($parts) == 1){
				  $result["controller"] = "Utilisateur";
				  $result['action'] = "afficherListe";
			  }
		}
		if($parts[0] == "Deconnexion")  {
			  if (count($parts) == 1){
				  $result["controller"] = "Deconnexion";
				  $result['action'] = "Deconnexion";
			  }
		}
	  }
	  return $result;
   }
}
?>
