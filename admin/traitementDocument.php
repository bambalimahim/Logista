<?php	
   
  function XX_Moi_XXXX($date) /* Transformation d'une date sous la forme XX_Jour_XXXX */
    {
        $tab_jours = array('dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');
        $tab_mois = array('00'=>'','01'=>'Janvier', '02'=>'Février', '03'=>'Mars', '04'=>'Avril', '05'=>'Mai', '06'=>'Juin', '07'=>'Juillet', '08'=>'Août', '09'=>'Septembre', '10'=>'Octobre', '11'=>'Novembre', '12'=>'Decembre');
        $date_ch = strval($date); /* Rcupération de la variable sous format chaîne*/
        $jour = substr($date_ch, 8,2);
        $mois = $tab_mois[substr($date_ch, 5,2)];
        $annee = substr($date_ch, 0,4);
        $resultat = $jour.' '.$mois.' '.$annee;
        return $resultat;
    }
  
  
  ?>