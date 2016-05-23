SELECT cl.num, cl.nom, cl.prenom, NVL(sum(lf.qte*p.prix),0) as total,
CASE WHEN sum(lf.qte*p.prix) > 500 THEN 'VIP' 
     WHEN sum(lf.qte*p.prix) > 50 THEN 'client ordinaire'
     ELSE 'client à potentiel' END AS Cat
FROM (((client cl FULL OUTER JOIN facture f on f.client = cl.num) 
                  FULL OUTER JOIN ligne_fact lf on lf.facture = f.num)
                  FULL OUTER JOIN produit p on p.num = lf.produit)
               
GROUP BY cl.num,cl.nom, cl.prenom
ORDER BY cl.num;


CREATE view v_chiffre_affaire
(code_client, nom, prenom, chiffre_affaire, cat)
AS SELECT cl.num, cl.nom, cl.prenom, NVL(sum(lf.qte*p.prix),0),
     CASE WHEN sum(lf.qte*p.prix) > 500 THEN 'VIP' 
     WHEN sum(lf.qte*p.prix) > 50 THEN 'client ordinaire'
     ELSE 'client à potentiel' END AS Cat
   FROM (((client cl FULL OUTER JOIN facture f on f.client = cl.num) 
                  FULL OUTER JOIN ligne_fact lf on lf.facture = f.num)
                  FULL OUTER JOIN produit p on p.num = lf.produit)
   GROUP BY cl.num,cl.nom, cl.prenom
   ORDER BY cl.num;

SELECT * FROM v_chiffre_affaire
WHERE nom=lower('morin');
