DELIMITER /
CREATE TRIGGER after_update_infosAnnuelles AFTER UPDATE
ON infosAnnuelles FOR EACH ROW
BEGIN
	DECLARE annee_cours integer ;
	DECLARE nouv_Annee varchar(10);
	DECLARE nouv_Niveau varchar(255);
	DECLARE nouv_Formation varchar(50);
	IF (OLD.resultat IS NOT NULL AND OLD.resultat!='Passe' AND NEW.resultat IS NOT NULL NEW.resultat='Passe') OR (OLD.resultat IS NULL AND NEW.resultat='Passe') THEN
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

	IF (OLD.resultat IS NOT NULL AND OLD.resultat!='Selectionne' AND NEW.resultat IS NOT NULL NEW.resultat='Selectionne') OR (OLD.resultat IS NULL AND NEW.resultat='Selectionne') THEN
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





--CONCAT('DIC', SUBSTR(NEW.formation,4,LENGTH(NEW.formation)-4))