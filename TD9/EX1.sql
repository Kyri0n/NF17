SELECT facture.num,client.nom,client.prenom, produit.designation, produit.prix, ligne_fact.qte
FROM ligne_fact, client, facture, produit 
WHERE ligne_fact.facture = facture.num 
AND ligne_fact.produit = produit.num 
AND facture.client = client.num
ORDER BY facture.num;

SELECT f.num, sum(LF.qte*p.prix)
FROM ligne_fact LF, facture F, produit P
WHERE lf.facture = f.num
AND p.num = lf.produit
GROUP BY f.num
ORDER BY f.num;


