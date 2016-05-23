CREATE TYPE tyClient AS OBJECT(
  num integer,
  nom varchar(30),
  prenom varchar(30),
  adr varchar(50),
  date_nais date,
  tel varchar(30),
  sexe char
);
CREATE TYPE tyProduit AS OBJECT(
  num integer,
  des varchar(255),
  prix numeric,
  stock integer
);
CREATE TYPE tyLigneFact AS OBJECT(
  produit REF tyProduit,
  qte integer
);
CREATE TYPE tylignesFact AS TABLE OF tyLigneFact;
CREATE TYPE tyFacture AS OBJECT(
  num integer,
  client REF tyClient,
  lignes tylignesFact,
  date_et date,
  MEMBER FUNCTION Total return numeric
)
CREATE TABLE tCLient of tyclient(
  primary key (num),
  check(num is not null and prenom is not null and adr is not null and tel is not null and (sexe='m' or sexe='f'))
)
CREATE TABLE tProduit of tyProduit(
  PRIMARY KEY (num),
  check(prix>=0 and stock>=0)
)
CREATE TABLE tFacture of tyFacture(
  PRIMARY KEY (num),
  check (date_et is not null)
)NESTED TABLE lignes STORE AS tFacture_stockage;

CREATE OR REPLACE TYPE BODY tyFacture IS 
  MEMBER FUNCTION total RETURN numeric 
  IS 
  resultat numeric;
  BEGIN
    SELECT SUM(p.prix * fs.qte) INTO resultat 
    FROM tproduit p, tfacture f, table(f.lignes) fs
    WHERE p.num = fs.produit.num and self.num=f.num;
  return resultat;
  END total; 
END;


-------------------------------------------------------------
INSERT INTO TCLIENT VALUES(2,'Bernard','Morin','120, square Zola',TO_DATE('11-03-1916','DD-MM-YYYY'),'95569','f')
-------------------------------------------------------------
DECLARE
  refclient REF tyClient; 
  refProduit1 ref tyProduit;
  refProduit2 ref tyProduit;
  BEGIN
  SELECT REF(c) INTO refClient
  FROM tClient c
  WHERE c.num=1;
  
  SELECT REF(p) INTO refProduit1
  FROM tProduit p
  WHERE p.num=1;
  
  SELECT REF(p) INTO refProduit2
  FROM tProduit p
  WHERE p.num=2;
  
  INSERT INTO tFacture (num, client, lignes, date_et) 
  VALUES (
    1, 
    refClient,
    tyLignesFact(
      tyLigneFact(refProduit1,3),
      tyLigneFact(refProduit2,1)
    ),
    sysdate
  );
END;
-------------------------------------------------------------
--select dans OID
SELECT f.num,f.client.nom,f.client.prenom 
FROM tfacture f;

SELECT f.num,f.client.nom,f.total()
FROM tfacture f;
-------------------------------------------------------------
--Interroger une base RO : Utilisation des méthodes 
--Q1
CREATE OR REPLACE PROCEDURE tototal
IS 
  nbFact integer;
  ttotal numeric;
BEGIN
  SELECT count(f.num), sum(f.total()) into nbfact,ttotal
  from tfacture f;
  DBMS_OUTPUT.PUT_LINE(nbFact ||'   ' || ttotal);
END tototal;
/

SET SERVEROUTPUT ON

DECLARE
BEGIN
tototal();
END;
---------------------------------------------------------------
--Q2
SELECT sum(f.total())/count(f.num) AS moyen  from tfacture f 
where f.client.prenom = 'Christophe' ;
