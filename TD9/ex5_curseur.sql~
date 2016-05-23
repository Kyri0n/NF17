CREATE OR REPLACE FUNCTION nbfact(num_client NUMBER) RETURN NUMBER
IS 
  nbfact NUMBER;
BEGIN
  SELECT COUNT(f.num) into nbfact
  from facture f
  WHERE f.client = num_client;
  return nbfact;
END nbfact;
/
SHOW ERRORS

CREATE OR REPLACE FUNCTION ca(num_client NUMBER) RETURN NUMBER
IS
  chiffreDAffaire Number;
begin
  SELECT NVL(sum(lf.qte*p.prix),0) into chiffreDAffaire 
  FROM (((client cl FULL OUTER JOIN facture f on f.client = cl.num) 
                  FULL OUTER JOIN ligne_fact lf on lf.facture = f.num)
                  FULL OUTER JOIN produit p on p.num = lf.produit)
  WHERE num_client = cl.num;
  return chiffreDAffaire;
END ca;
/
SHOW ERRORS

SET SERVEROUTPUT ON
DECLARE 
  client NUMBER; 
BEGIN
   client:=1;
   DBMS_OUTPUT.PUT_LINE('nbfact '||nbfact(client));
   
   DBMS_OUTPUT.PUT_LINE('chiffre affaire '||ca(client));
END;
/

SET SERVEROUTPUT ON
DECLARE 
  CURSOR c_client IS SELECT num FROM client;
BEGIN
   for cl in c_client LOOP
    DBMS_OUTPUT.PUT_LINE('Client '|| cl.num);
    DBMS_OUTPUT.PUT_LINE(nbfact(cl.num)||' / '||ca(cl.num));
    DBMS_OUTPUT.PUT_LINE('------------------');
   end loop;
END;
/

CREATE OR REPLACE PROCEDURE show
IS 
  CURSOR c_client IS SELECT num FROM client;
BEGIN
   for cl in c_client LOOP
    DBMS_OUTPUT.PUT_LINE('Client '|| cl.num);
    DBMS_OUTPUT.PUT_LINE(nbfact(cl.num)||' / '||ca(cl.num));
    DBMS_OUTPUT.PUT_LINE('------------------');
   end loop;
END show;
/
SHOW ERRORS

SET SERVEROUTPUT ON
DECLARE
BEGIN
show();
END;
/
