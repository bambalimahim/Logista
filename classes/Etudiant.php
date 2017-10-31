<?php 	
	class Etudiant {
		public $nom;
		public $prenom;
		public $cni;
		public $sexe;   
		public $dateNaiss;
		public $paysNaiss;
		public $lieuNaiss;
		public $nationalite;
		public $numTel;
		public $serieBac;

		public function __construct() {
		}

		public function construct($nom, $prenom, $cni, $sexe, $dN, $pN, $lN, $nationalite, $nT, $sB) {
			$this->nom = $nom;
			$this->prenom = $prenom;
			$this->cni = $cni;
			$this->sexe = $sexe;
			$this->dateNaiss = $dN;
			$this->paysNaiss = $pN;
			$this->lieuNaiss = $lN;
			$this->nationalite = $nationalite;
			$this->numTel = $nT;
			$this->serieBac = $sB;
		}



	}
 ?>
