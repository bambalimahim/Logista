/*CREATE DATABASE logista
CHARACTER SET utf8
COLLATE utf8_general_ci;

USE logista;
*/
CREATE TABLE etudiant (
	id int PRIMARY KEY AUTO_INCREMENT,
	cni varchar(50),
	matricule VARCHAR(255),
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
	resultat enum('Passe','Redouble','Exclu','Abandonne'),
	CONSTRAINT fk_inf_idEtudiant_etu FOREIGN KEY(idEtudiant) REFERENCES etudiant(id) ON DELETE CASCADE
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
