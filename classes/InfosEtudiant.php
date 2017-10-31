<?php
	require 'Etudiant.php';
	class InfosEtudiant {
		public $etudiant;
		public $civilite;
		public $annee;
		public $formation;
		public $niveau;
		public $nature;
		public $priseEnCharge;
		public $nomDept;
		public $nomOption;
		public $resultat;
		public $dateDeliberation;
		public $matricule;
		
		public function __construct() {}


		public function construct(Etudiant $etudiant, $civilite ,$annee, $formation, $niveau, $nature, $pEC, $nD, $nO, $dD, $matricule) {
			$this->etudiant = $etudiant;
			$this->civilite = $civilite;
			$this->annee = $annee;
			$this->etudiant = $etudiant;
			$this->formation = $formation;
			$this->niveau = $niveau;
			$this->nature = $nature;
			$this->priseEnCharge = $pEC;
			$this->nomDept = $nD;

			$this->nomOption = $nO;
			$this->dateDeliberation = $dD;
			$this->matricule = $matricule;
		}

		public function convertirPourRech(InfosEtudiant $filtre) {
			$infosEtud = new InfosEtudiant();
			$infosEtud->etudiant = new Etudiant();
			$infosEtud->etudiant->nom = Utilitaires::convertChampBD($this->etudiant->nom, $filtre->etudiant->nom);
			$infosEtud->etudiant->prenom = Utilitaires::convertChampBD($this->etudiant->prenom, $filtre->etudiant->prenom);
			$infosEtud->etudiant->cni = Utilitaires::convertChampBD($this->etudiant->cni, $filtre->etudiant->cni);
			$infosEtud->etudiant->numTel = Utilitaires::convertChampBD($this->etudiant->numTel, $filtre->etudiant->numTel);
			$infosEtud->etudiant->serieBac = Utilitaires::convertChampBD($this->etudiant->serieBac, $filtre->etudiant->serieBac);
			$infosEtud->etudiant->sexe = Utilitaires::convertChampArrBD($this->etudiant->sexe);
			$infosEtud->etudiant->paysNaiss = Utilitaires::convertChampArrBD($this->etudiant->paysNaiss);
			$infosEtud->etudiant->lieuNaiss = Utilitaires::convertChampArrBD($this->etudiant->lieuNaiss);
			$infosEtud->etudiant->nationalite = Utilitaires::convertChampArrBD($this->etudiant->nationalite);
			$infosEtud->etudiant->dateNaiss[0] = Utilitaires::convertChampDateBD($this->etudiant->dateNaiss[0], $filtre->etudiant->dateNaiss[0]);
			$infosEtud->etudiant->dateNaiss[1] = Utilitaires::convertChampDateBD($this->etudiant->dateNaiss[1], $filtre->etudiant->dateNaiss[1]);
			$infosEtud->etudiant->dateNaiss[2] = Utilitaires::convertChampDateBD($this->etudiant->dateNaiss[2], $filtre->etudiant->dateNaiss[2]);
			$infosEtud->civilite = Utilitaires::convertChampArrBD($this->civilite);
			$infosEtud->annee = Utilitaires::convertChampArrBD($this->annee);
			$infosEtud->formation = Utilitaires::convertChampArrBD($this->formation);
			$infosEtud->niveau = Utilitaires::convertChampArrBD($this->niveau);
			$infosEtud->nature = Utilitaires::convertChampArrBD($this->nature);
			$infosEtud->priseEnCharge = Utilitaires::convertChampArrBD($this->priseEnCharge);
			$infosEtud->nomDept = Utilitaires::convertChampArrBD($this->nomDept);
			$infosEtud->nomOption = Utilitaires::convertChampArrBD($this->nomOption);
			$infosEtud->matricule = Utilitaires::convertChampBD($this->matricule, $filtre->matricule);
			return $infosEtud;
		}
	}
?>
