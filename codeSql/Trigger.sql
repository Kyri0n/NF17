CREATE OR REPLACE FUNCTION autoAjoutActu() RETURNS TRIGGER AS $$
DECLARE 
  	Info VARCHAR(255);
	adr VARCHAR(50);
BEGIN
	SELECT adresse INTO adr FROM espace where idEspace=new.ID;
	Info = 'Conférence ' || new.Titre_conf || ': ' || adr;
	INSERT INTO Actualites values(new.Date_conf,new.ID,Info);
END;
$$ LANGUAGE plpgsql;

CREATE TRIGGER trActualite
BEFORE INSERT ON Assoc_Espace_Ouvert_Conference
FOR EACH ROW 
EXECUTE PROCEDURE autoAjoutActu();
