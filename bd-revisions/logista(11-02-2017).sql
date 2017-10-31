CREATE DATABASE logista
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE logista;

-- ici on a enleve la table anneee academique et on en a fait un attribut dan infosannuelles

/*
 * Tables  :
 * Departement : IdDepartement, NomDepartement
 * Option : IdOption, LibOption, IdDepartement
 * Formation : IdFormation, IdOption, LibFormation, Nature, EtatTier
 * 
 * LieuNaissance : IdLieuNaiss, LieuNaiss, PaysNaiss
 * Etudiant : IdEtudiant, Prenom, Nom, DateNaiss, LieuNaiss, PaysNaiss, Sexe, Matricule, Formation, Nature, EtatTiers, Niveau
 * AnneeAcademique : IdAnnee, Annee
**/

/*
CREATE TABLE departement (
 	id int PRIMARY KEY AUTO_INCREMENT,
 	libelle varchar(5),
 	nomDept varchar(50)
 	) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE option (
 	id int PRIMARY KEY AUTO_INCREMENT,
 	idDept int,
 	libelle varchar(50),
 	nomOption varchar(50),
 	CONSTRAINT fk_opt_idDepartement_dep FOREIGN KEY(idDept) REFERENCES departement(id) ON DELETE CASCADE
 	) CHARACTER SET utf8 COLLATE utf8_general_ci;
*/
CREATE TABLE etudiant (
	id int PRIMARY KEY AUTO_INCREMENT,
	cni varchar(50),
	nationalite VARCHAR(255),
	prenom varchar(50),
	nom varchar(30),
	sexe enum('Masculin', 'Feminin'),
	dateNaiss date,
	paysNaiss varchar(50),
	lieuNaiss varchar(50),
	numTel varchar(20),
	serieBac varchar(5)
	)CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE infosAnnuelles (
	id int PRIMARY KEY AUTO_INCREMENT,
	idEtudiant int,
	civilite VARCHAR(255),
	annee VARCHAR(255),
	nomDept VARCHAR(255),
	nomOption varchar(255),
	formation varchar(50),
	niveau varchar(255),
	nature enum('Jour', 'Soir'),
	priseEnCharge enum('Etat', 'Tiers'),
	resultat enum('Selectionne','Passe','Redouble','Exclu','Abandonne'),
	dateDeliberation date,
  	matricule varchar(255),
	CONSTRAINT fk_inf_idEtudiant_etu FOREIGN KEY(idEtudiant) REFERENCES etudiant(id) ON DELETE CASCADE
) CHARACTER SET utf8 COLLATE utf8_general_ci

CREATE TABLE infosAnnuelles1 (
	id int PRIMARY KEY AUTO_INCREMENT,
	idEtudiant int,
	civilite VARCHAR(255),
	annee VARCHAR(255),
	nomDept VARCHAR(255),
	nomOption varchar(255),
	formation varchar(50),
	niveau varchar(255),
	nature enum('Jour', 'Soir'),
	priseEnCharge enum('Etat', 'Tiers'),
	resultat enum('Selectionne','Passe','Redouble','Exclu','Abandonne'),
	dateDeliberation date,
  	matricule varchar(255),
	CONSTRAINT fk_inf_idEtudiant_etu1 FOREIGN KEY(idEtudiant) REFERENCES etudiant(id) ON DELETE CASCADE
) CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE utilisateurs (
	id int PRIMARY KEY AUTO_INCREMENT,
	email varchar(255),
	password varchar(255),
	statut varchar(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

/*
INSERT INTO departement (libelle, nomDept) VALUES('DGCBA','GENIE CHIMIQUE ET BIOLOGIE APPLIQUE');
INSERT INTO departement (libelle, nomDept) VALUES('DGC','GENIE CIVIL');
INSERT INTO departement (libelle, nomDept) VALUES('DGE','GENIE ELECTRIQUE');
INSERT INTO departement (libelle, nomDept) VALUES('DGI','GENIE INFORMATIQUE');
INSERT INTO departement (libelle, nomDept) VALUES('DGM','GENIE MECANIQUE');
INSERT INTO departement (libelle, nomDept) VALUES('DG','GESTION');
INSERT INTO option (idDept, libelle, nomOption) VALUES(1, 'AB', 'ANALYSES BIOLOGIQUES');
INSERT INTO option (idDept, libelle, nomOption) VALUES(1, 'GCH', 'GENIE CHIMIQUE');
INSERT INTO option (idDept, libelle, nomOption) VALUES(1, 'IA', 'INDUSTRIES ALIMENTAIRES');
INSERT INTO option (idDept, libelle, nomOption) VALUES(2, 'GCI', 'GENIE CIVIL');
INSERT INTO option (idDept, libelle, nomOption) VALUES(3, 'GE', 'GENIE ELECTRIQUE');
INSERT INTO option (idDept, libelle, nomOption) VALUES(4, 'INF', 'INFORMATIQUE');
INSERT INTO option (idDept, libelle, nomOption) VALUES(4, 'TR', 'TELECOMMUNICATIONS ET RESEAUX');
INSERT INTO option (idDept, libelle, nomOption) VALUES(5, 'GM', 'GENIE MECANIQUE');
INSERT INTO option (idDept, libelle, nomOption) VALUES(6, 'GEST', 'GESTION');
INSERT INTO option (idDept, libelle, nomOption) VALUES(6, 'FC', 'FINANCES-COMPTABILITE');
INSERT INTO option (idDept, libelle, nomOption) VALUES(6, 'TC', 'TECHNIQUES DE COMMERCIALISATION');
*/