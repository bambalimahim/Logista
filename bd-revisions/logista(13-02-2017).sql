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
) CHARACTER SET utf8 COLLATE utf8_general_ci;

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
	email varchar(255),
	nom varchar(255),
	prenom varchar(255),
	password varchar(255),
	statut varchar(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE predefinedMessages (
  id int PRIMARY KEY AUTO_INCREMENT,
  object varchar(50),
  content varchar(255)
) CHARACTER SET utf8 COLLATE utf8_general_ci;
*/
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



-- TRIGGERS

DELIMITER /
CREATE TRIGGER after_update_infosAnnuelles AFTER UPDATE
ON infosAnnuelles FOR EACH ROW
BEGIN
	DECLARE annee_cours integer ;
	DECLARE nouv_Annee varchar(10);
	DECLARE nouv_Niveau varchar(255);
	DECLARE nouv_Formation varchar(50);
	IF (OLD.resultat IS NOT NULL AND OLD.resultat!='Passe' AND NEW.resultat IS NOT NULL AND NEW.resultat='Passe') OR (OLD.resultat IS NULL AND NEW.resultat='Passe') THEN
		SET annee_cours = CAST(SUBSTR(NEW.annee, 6, 4) AS SIGNED INTEGER);
		SET nouv_Annee = CONCAT(CONCAT(SUBSTR(NEW.annee, 6, 4), '-'), CAST((annee_cours+1) AS CHAR(4)));
		IF SUBSTR(NEW.formation,1,3)='DUT' OR SUBSTR(NEW.formation,1,3)='DST' THEN
			IF SUBSTR(NEW.niveau,1,1)='1' THEN
				SET nouv_Niveau = '2ème année';
			END IF;
		ELSEIF SUBSTR(NEW.formation,1,3)='DIC' OR SUBSTR(NEW.formation,1,3)='DESCAF' THEN
			IF SUBSTR(NEW.niveau,1,1)='1' THEN
				SET nouv_Niveau = '2ème année';
			ELSEIF SUBSTR(NEW.niveau,1,1)='2' THEN
				SET nouv_Niveau = '3ème année';
			END IF;

		END IF;
		SET nouv_Formation = NEW.formation;
	END IF;

	IF (OLD.resultat IS NOT NULL AND OLD.resultat!='Selectionne' AND NEW.resultat IS NOT NULL AND NEW.resultat='Selectionne') OR (OLD.resultat IS NULL AND NEW.resultat='Selectionne') THEN
		SET annee_cours = CAST(SUBSTR(NEW.annee, 6, 4) AS SIGNED INTEGER);
		SET nouv_Annee = CONCAT(CONCAT(SUBSTR(NEW.annee, 6, 4), '-'), CAST((annee_cours+1) AS CHAR(4)));
		IF SUBSTR(NEW.formation, 1,3)='DUT' OR SUBSTR(NEW.formation,1,3)='DST' THEN
		      
			IF SUBSTR(NEW.niveau,1,1)='2' THEN
		      IF SUBSTR(NEW.nomDept,1,4)!='GEST' THEN
				SET nouv_Formation = 'DIC';
				SET nouv_Niveau = '1ème année';
			END IF;
			  IF SUBSTR(NEW.nomDept,1,4)='GEST' THEN
				SET nouv_Formation = 'DESCAF';
				SET nouv_Niveau = '1ème année';
			END IF;
			END IF;
		END IF;
	END IF;

	IF (OLD.resultat IS NOT NULL AND OLD.resultat!='Redouble' AND NEW.resultat IS NOT NULL AND NEW.resultat='Redouble') OR (OLD.resultat IS NULL AND NEW.resultat='Redouble') THEN
		SET annee_cours = CAST(SUBSTR(NEW.annee, 6, 4) AS SIGNED INTEGER);
		SET nouv_Annee = CONCAT(CONCAT(SUBSTR(NEW.annee, 6, 4), '-'), CAST((annee_cours+1) AS CHAR(4)));
		SET nouv_Formation = NEW.formation;
		SET nouv_niveau= NEW.niveau;  
	END IF;
   


	IF (nouv_Niveau IS NOT NULL) THEN
		INSERT INTO infosAnnuelles1(idEtudiant, civilite, annee, nomDept, nomOption, formation, niveau, nature, priseEnCharge, resultat)
			VALUES(NEW.idEtudiant, NEW.civilite, nouv_Annee, NEW.nomDept, NEW.nomOption, nouv_Formation, nouv_Niveau, NEW.nature, '', '');
	END IF;
END /



CREATE TRIGGER after_insert_infosAnnuelles AFTER INSERT
ON infosAnnuelles FOR EACH ROW
BEGIN
	DECLARE annee_cours integer ;
	DECLARE nouv_Annee varchar(10);
	DECLARE nouv_Niveau varchar(255);
	DECLARE nouv_Formation varchar(50);
	IF (NEW.resultat IS NOT NULL AND NEW.resultat='Passe') THEN
		SET annee_cours = CAST(SUBSTR(NEW.annee, 6, 4) AS SIGNED INTEGER);
		SET nouv_Annee = CONCAT(CONCAT(SUBSTR(NEW.annee, 6, 4), '-'), CAST((annee_cours+1) AS CHAR(4)));
		IF SUBSTR(NEW.formation,1,3)='DUT' OR SUBSTR(NEW.formation,1,3)='DST' THEN
			IF SUBSTR(NEW.niveau,1,1)='1' THEN
				SET nouv_Niveau = '2ème année';
			END IF;
		ELSEIF SUBSTR(NEW.formation,1,3)='DIC' OR SUBSTR(NEW.formation,1,3)='DESCAF' THEN
			IF SUBSTR(NEW.niveau,1,1)='1' THEN
				SET nouv_Niveau = '2ème année';
			ELSEIF SUBSTR(NEW.niveau,1,1)='2' THEN
				SET nouv_Niveau = '3ème année';
			END IF;

		END IF;
		SET nouv_Formation = NEW.formation;
	END IF;

	IF (NEW.resultat IS NOT NULL AND NEW.resultat='Selectionne') THEN
		SET annee_cours = CAST(SUBSTR(NEW.annee, 6, 4) AS SIGNED INTEGER);
		SET nouv_Annee = CONCAT(CONCAT(SUBSTR(NEW.annee, 6, 4), '-'), CAST((annee_cours+1) AS CHAR(4)));
		IF SUBSTR(NEW.formation, 1,3)='DUT' OR SUBSTR(NEW.formation,1,3)='DST' THEN
			IF SUBSTR(NEW.niveau,1,1)='2' THEN
				SET nouv_Formation = 'DIC';
				SET nouv_Niveau = '1ème année';
			END IF;
		END IF;
	END IF;

	IF (nouv_Niveau IS NOT NULL) THEN
		INSERT INTO infosAnnuelles1(idEtudiant, civilite, annee, nomDept, nomOption, formation, niveau, nature, priseEnCharge, resultat)
			VALUES(NEW.idEtudiant, NEW.civilite, nouv_Annee, NEW.nomDept, NEW.nomOption, nouv_Formation, nouv_Niveau, NEW.nature, '', '');
	END IF;
END /


DELIMITER ;
