<?php 
	class Utilitaires {
		/*
		public static function champSaisiValide($champ, $typeFiltre, $element) {
			if ($champ == '' && $typeFiltre!='est')
				return true;
			if ($typeFiltre =='est') 
				return preg_match('#^'.$champ.'$#i', $element);
			if ($typeFiltre == 'ne contient pas') 
				return !preg_match('#'.$champ.'#i', $element);
			if ($typeFiltre == 'contient') 
				return preg_match('#'.$champ.'#i', $element);
			if ($typeFiltre == 'commence par')
				return preg_match('#^'.$champ.'#i', $element);
			if ($typeFiltre == 'termine par')
				return preg_match('#'.$champ.'$#i', $element);
			return true;
		}


		public static function champEntierValide($champ, $typeFiltre, $element) {
			if ($typeFiltre == 'est')
				return preg_match('#^'.$champ.'$#i', $element);
			if ($typeFiltre == 'different') 
				return !preg_match('#^'.$champ.'$#i', $element);
			if ($typeFiltre == 'superieur ou egal')
				if ($champ<=$element)
					return true;
				else
					return false;
			if ($typeFiltre == 'inferieur ou egal') 
				if ($champ>=$element)
					return true;
				else
					return false;
			return true;
		}
		*/
		public static function convertChampBD($champ, $typeFiltre) {
			if ($typeFiltre=='est')
				return '"'.$champ.'"';
			if ($typeFiltre=='contient')
				return '"%'.$champ.'%"';
			if ($typeFiltre=='commencepar')
				return '"'.$champ.'%"';
			if ($typeFiltre=='terminepar')
				return '"%'.$champ.'"';
			return '"%'.$champ.'%"';
		}

		public static function convertChampArrBD($champ) {
			$i = 1;
			$resultat = '';
			if (count($champ)>0) {
				$resultat = '("'.$champ[0].'"';
				while ($i<count($champ)) {
					$resultat .= ', "'.$champ[$i].'"';
					$i++;
				}
				$resultat .= ')';
				return $resultat;
			}
			else
				return '';
		}

		public static function convertChampDateBD($champ, $typeFiltre) {
			if ($champ=='') 
				return $champ;
			if ($typeFiltre=='eg')
				return '="'.$champ.'"';
			if ($typeFiltre=='supoeg')
				return '>="'.$champ.'"';
			if ($typeFiltre=='infoeg')
				return '<="'.$champ.'"';
			return '="'.$champ.'"';
		}
	}

?>