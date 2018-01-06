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

CREATE TABLE departement (
 	id int PRIMARY KEY AUTO_INCREMENT,
 	code varchar(10) NOT NULL,
 	libelle varchar(50) NOT NULL,
 	UNIQUE(code),
 	UNIQUE (libelle)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE option (
 	id int PRIMARY KEY AUTO_INCREMENT,
 	idDept int,
 	code varchar(10) NOT NULL,
 	libelle varchar(50) NOT NULL,
 	UNIQUE(code),
 	UNIQUE (libelle),
 	CONSTRAINT fk_opt_idDepartement_dep FOREIGN KEY(idDept) REFERENCES departement(id) ON DELETE CASCADE
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE formation (
 	id int PRIMARY KEY AUTO_INCREMENT,
 	code varchar(10) NOT NULL,
 	libelle varchar(50) NOT NULL,
 	UNIQUE(code),
 	UNIQUE (libelle)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE niveau (
 	id int PRIMARY KEY AUTO_INCREMENT,
 	code VARCHAR (2) NOT NULL,
 	libelle varchar(50) NOT NULL,
 	UNIQUE(code),
 	UNIQUE (libelle)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE formNiveau (
  id int PRIMARY KEY AUTO_INCREMENT,
 	idForm int NOT NULL,
 	idNiveau int NOT NULL,
 	libelle varchar(100) NOT NULL,
 	UNIQUE (libelle),
 	CONSTRAINT fk_formNiveau_idForm_formation FOREIGN KEY(idForm) REFERENCES formation(id) ON DELETE CASCADE,
 	CONSTRAINT fk_formNiveau_idNiveau_niveau FOREIGN KEY(idNiveau) REFERENCES niveau(id) ON DELETE CASCADE,
) CHARACTER SET utf8 COLLATE utf8_general_ci;

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
	civilite enum ('Monsieur', 'Madame', 'Mademoiselle'),
	annee VARCHAR(255),
	nomDept VARCHAR(255),
	nomOption varchar(255),
	formation varchar(50),
	niveau varchar(255),
	nature enum('Jour', 'Soir'),
	priseEnCharge enum('Etat', 'Tiers'),
	resultat enum('Selectionne','Passe','Redouble','Exclu','Abandonne', 'Admis','Admis Sélectionne'),
	dateDeliberation date,
  matricule varchar(255),
  idFormNiveau int,
  CONSTRAINT fk_inf_idFormiveau_formNiveau FOREIGN KEY(idFormNiveau) REFERENCES formNiveau(id) ON DELETE SET NULL,
	CONSTRAINT fk_inf_idEtudiant_etu FOREIGN KEY(idEtudiant) REFERENCES etudiant(id) ON DELETE CASCADE
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE location (
  	id int PRIMARY KEY AUTO_INCREMENT,
  	pays varchar(50),
	lieu varchar(100),
	latitude real,
	longitude real,
	CONSTRAINT un_location UNIQUE(pays, lieu)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE utilisateurs (
	id int PRIMARY KEY AUTO_INCREMENT,
	prenom varchar(255),
	nom varchar(255),
	email varchar(255),
	password varchar(255),
	statut varchar(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE predefinedMessages (
	id int PRIMARY KEY AUTO_INCREMENT,
	object varchar(255),
	content varchar(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO utilisateurs (id, prenom, nom, email, password, statut) VALUES
(1, 'Test', 'admine', 'admin', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 'Admin'),
(3, 'Directeur', 'Esp', 'directeur', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 'Simple utilisateur'),
(4, 'Hamydu', 'Sall', 'sall', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 'Admin');


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
