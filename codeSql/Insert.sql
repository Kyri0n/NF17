BEGIN TRANSACTION;
-- Manager
INSERT INTO Manager(idManager, Mail, Nom, Prenom, Age)
VALUES (1000, 'jtarot@gmail.fr', 'Tarot', 'Jean', 25);

INSERT INTO Manager(idManager, Mail, Nom, Prenom, Age)
VALUES (1001, 'prd.lafitte@gmail.fr', 'Lafitte', 'Prudence', 23);

INSERT INTO Manager(idManager, Mail, Nom, Prenom, Age)
VALUES (1002, 'karim.sinbad@gmail.fr', 'Sinbad', 'Karim', 25);

-- Intervenant
INSERT INTO Intervenant(idIntervenant, Mail, Nom, Prenom, Age)
VALUES(2000, 'geo.duf@gmail.fr', 'Dufoin', 'Georges', 35);

INSERT INTO Intervenant(idIntervenant, Mail, Nom, Prenom, Age)
VALUES(2001, 'CesGoy@gmail.fr', 'Goyat', 'Cesar', 35);

-- Coworker
INSERT INTO Coworker(idCoworker, Mail, Nom, Prenom, Age, Situation_Professionelle, Presentation)
VALUES(3000, 'JH.boucher@gmail.fr', 'Boucher', 'Jean-Henri', 43,'autre','Une vie de chien');

INSERT INTO Coworker(idCoworker, Mail, Nom, Prenom, Age, Situation_Professionelle, Presentation)
VALUES(3001, 'PhareAOn@gmail.fr', 'Pharaon', 'Jacob', 68,'entrepreneur','Royalties et papier peint');

INSERT INTO Coworker(idCoworker, Mail, Nom, Prenom, Age, Situation_Professionelle, Presentation)
VALUES(3002, 'mimi@gmail.fr', 'Drucker', 'Michel', 72,'freelance','Mort aux vaches !');

-- Domaine Activite
INSERT INTO Domaines_activite(idDomaine, Info)
VALUES(500,'Chien');

INSERT INTO Domaines_activite(idDomaine, Info)
VALUES(501,'Boucher');

INSERT INTO Domaines_activite(idDomaine, Info)
VALUES(502,'Pharaon');

-- Assoc_CoworkerDomaine
INSERT INTO Assoc_CoworkerDomaine(Info_Domaine, Coworker)
VALUES(500,3000);

INSERT INTO Assoc_CoworkerDomaine(Info_Domaine, Coworker)
VALUES(501,3000);

INSERT INTO Assoc_CoworkerDomaine(Info_Domaine, Coworker)
VALUES(502,3001);

-- Espace
INSERT INTO Espace(idEspace, Adresse, Surface, Nb_Bureau_Individuel, Actif, ID)
VALUES(100,'5 rue des chevaux bleus', 1250, 12, true, 1000);

INSERT INTO Espace(idEspace, Adresse, Surface, Nb_Bureau_Individuel, Actif, ID)
VALUES(200,'6 avenue des manches à balai', 3000, 25, true, 1000);

INSERT INTO Espace(idEspace, Adresse, Surface, Nb_Bureau_Individuel, Actif, ID)
VALUES(300,'18 rue des chevaux bleus', 1250, 5, true, 1001);

-- Elements Descripteurs
INSERT INTO Elements_descripteurs(idElement, Info)
VALUES(30,'Cafeteria');

INSERT INTO Elements_descripteurs(idElement, Info)
VALUES(31,'Salle de torture');

-- Description
INSERT INTO Description(ID, Descrip)
VALUES(200,30);

INSERT INTO Description(ID, Descrip)
VALUES(300,31);

-- Actualites
INSERT INTO Actualites(Date, ID_Espace, Info)
VALUES(TO_DATE('01-01-2016','DD-MM-YYYY'),100,'Defile de mode');

INSERT INTO Actualites(Date, ID_Espace, Info)
VALUES(TO_DATE('01-02-2016','DD-MM-YYYY'),100,'Coktail des anciens');

INSERT INTO Actualites(Date, ID_Espace, Info)
VALUES(TO_DATE('07-09-2016','DD-MM-YYYY'),300,'Accueil des nouveaux');

-- Salles Collectives
INSERT INTO Salles_Collectives(ID_Salle, ID_Espace, Nb_Place)
VALUES(15,100,50);

INSERT INTO Salles_Collectives(ID_Salle, ID_Espace, Nb_Place)
VALUES(23,300,190);

-- Formule
INSERT INTO Formule(Nom, Tarif, Nb_Jours, Bureau_Individuel, DateFin, Type)
VALUES('Magique',100, NULL, true, TO_DATE('01-01-2050','DD-MM-YYYY'), 'illimite');

INSERT INTO Formule(Nom, Tarif, Nb_Jours, Bureau_Individuel, DateFin, Type)
VALUES('A Sion',10 ,7, false, NULL, 'limite');

-- Assoc_CoworkerFormule
INSERT INTO Assoc_CoworkerFormule(DateCF, Nom_Formule, Coworker)
VALUES(TO_DATE('01-05-2016','DD-MM-YYYY'),'Magique',3000);

INSERT INTO Assoc_CoworkerFormule(DateCF, Nom_Formule, Coworker)
VALUES(TO_DATE('06-03-2016','DD-MM-YYYY'),'A Sion',3001);

-- Assoc_Propose
INSERT INTO Assoc_Propose(ID_Espace,Nom_Formule,Formule_Active)
VALUES(100,'Magique',false);

INSERT INTO Assoc_Propose(ID_Espace,Nom_Formule,Formule_Active)
VALUES(100,'A Sion',true);

INSERT INTO Assoc_Propose(ID_Espace,Nom_Formule,Formule_Active)
VALUES(300,'Magique',true);

-- Conference
INSERT INTO Conference(Titre, DateC, Resume, Intervenant, Coworker, ID_Espace)
VALUES('Moustiques hivernaux', TO_DATE('01-06-2016','DD-MM-YYYY'),'...', 2000, NULL, 100);

INSERT INTO Conference(Titre, DateC, Resume, Intervenant, Coworker, ID_Espace)
VALUES('La cuisine de Maite', TO_DATE('23-12-2016','DD-MM-YYYY'),'...', NULL, 3002, 100);

INSERT INTO Conference(Titre, DateC, Resume, Intervenant, Coworker, ID_Espace)
VALUES('Sandales et cacahuetes', TO_DATE('05-07-2016','DD-MM-YYYY'),'...', NULL, 3002, 300);

-- Assoc_Espace_Ouvert_Conference
INSERT INTO Assoc_Espace_Ouvert_Conference(Titre_conf, Date_conf, ID)
VALUES('Moustiques hivernaux', TO_DATE('01-06-2016','DD-MM-YYYY'), 100);

INSERT INTO Assoc_Espace_Ouvert_Conference(Titre_conf, Date_conf, ID)
VALUES('La cuisine de Maite', TO_DATE('23-12-2016','DD-MM-YYYY'), 100);

INSERT INTO Assoc_Espace_Ouvert_Conference(Titre_conf, Date_conf, ID)
VALUES('Sandales et cacahuetes', TO_DATE('05-07-2016','DD-MM-YYYY'), 300);

COMMIT TRANSACTION;
