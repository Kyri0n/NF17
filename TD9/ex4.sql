CREATE OR REPLACE FUNCTION fDemande (num_produit number) RETURN varchar
IS
  qte_vendue NUMBER;
BEGIN
  SELECT sum(lf.qte) INTO qte_vendue
  FROM ligne_fact lf
  WHERE lf.produit = num_produit;
  IF qte_vendue>15 THEN
    RETURN ('forte');
  ELSE
    IF qte_vendue>=11 THEN
        RETURN ('moyenne');
    end if;
  end if;
  RETURN ('faible');
END fDemande;
/

SELECT p.num,p.designation,p.prix,p.stock, fDemande(p.num) 
FROM produit p;

spool......
