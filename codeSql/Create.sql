--CREATE TYPE Situation AS ENUM ('entrepreneur','freelance','autre');
--CREATE TYPE Limite AS ENUM ('limite','illimite');

BEGIN TRANSACTION;
CREATE TABLE Manager(
	idManager SERIAL PRIMARY KEY,
	Mail VARCHAR(30) UNIQUE NOT NULL,
	Nom VARCHAR(30) NOT NULL,
	Prenom VARCHAR(30) NOT NULL,
	Age INTEGER NOT NULL CHECK(Age > 0)
);

CREATE TABLE Intervenant(
	idIntervenant SERIAL PRIMARY KEY,
	Mail VARCHAR(30) UNIQUE NOT NULL,
	Nom VARCHAR(30) NOT NULL,
	Prenom VARCHAR(30) NOT NULL,
	Age INTEGER NOT NULL CHECK(Age > 0)
);


CREATE TABLE Coworker(
	idCoworker SERIAL PRIMARY KEY,
	Mail VARCHAR(30) UNIQUE NOT NULL,
	Nom VARCHAR(30) NOT NULL,
	Prenom VARCHAR(30) NOT NULL,
	Age INTEGER NOT NULL CHECK(Age > 0),
	Situation_Professionelle Situation NOT NULL,
	Presentation TEXT
);

CREATE VIEW vPersonne AS
	select mail,nom,prenom,age, 'coworker' as type from coworker union all select mail,nom,prenom,age, 'manager' as type from manager union all select mail,nom,prenom,age, 'intervenant' as type from intervenant;

CREATE TABLE Domaines_activite(
	idDomaine SERIAL PRIMARY KEY,
	Info VARCHAR(255)
);

CREATE TABLE Assoc_CoworkerDomaine(
	Info_Domaine INTEGER REFERENCES Domaines_activite(idDomaine),
	Coworker INTEGER REFERENCES Coworker(idCoworker),
	PRIMARY KEY (Info_Domaine, Coworker)
);

CREATE TABLE Espace(
	idEspace SERIAL PRIMARY KEY,
	Adresse VARCHAR(128),
	Surface INTEGER NOT NULL CHECK(Surface > 0),
	Nb_Bureau_Individuel INTEGER NOT NULL CHECK(Nb_Bureau_Individuel > 0),
	Actif BOOLEAN NOT NULL,
	ID INTEGER REFERENCES Manager(idManager)
);

CREATE TABLE Elements_descripteurs(
	idElement SERIAL PRIMARY KEY,
	Info VARCHAR(255)
);

CREATE TABLE Description(
	ID INTEGER REFERENCES Espace(idEspace),
	Descrip INTEGER REFERENCES Elements_Descripteurs(idElement),
	PRIMARY KEY (ID,Descrip)
);

CREATE TABLE Salles_Collectives(
	ID_Salle SERIAL,
	ID_Espace INTEGER REFERENCES Espace(idEspace),
	Nb_Place INTEGER NOT NULL CHECK(Nb_Place > 0),
	PRIMARY KEY (ID_Salle, ID_Espace)
);

CREATE TABLE Actualites(
	Date TIMESTAMP,
	ID_Espace INTEGER REFERENCES Espace(idEspace),
	Info TEXT,
	PRIMARY KEY (Date,ID_Espace)
);


CREATE TABLE Formule(
	Nom VARCHAR(30) PRIMARY KEY,
	Tarif NUMERIC NOT NULL CHECK(Tarif > 0),
	Nb_Jours INTEGER,
	Bureau_Individuel BOOLEAN,
	DateFin DATE,
	Type Limite,
	CHECK (((Type = 'limite') AND (Nb_Jours IS NOT NULL) AND (DateFin IS NULL))
		OR ((Type = 'illimite') AND (Nb_Jours IS NULL) AND (DateFin IS NOT NULL)))

);

CREATE VIEW vLimite AS
	SELECT Type, Nom, Tarif, Nb_Jours
	FROM Formule
	WHERE (Type = 'limite');

CREATE VIEW vIllimite AS
	SELECT Type, Nom, Tarif, Bureau_Individuel, DateFin
	FROM Formule
	WHERE (Type = 'illimite');

CREATE TABLE Assoc_Propose(
	ID_Espace INTEGER REFERENCES Espace(idEspace),
	Nom_Formule VARCHAR(30) REFERENCES Formule(Nom),
	Formule_Active BOOLEAN NOT NULL,
	PRIMARY KEY (ID_Espace, Nom_Formule)--,
);

CREATE TABLE Assoc_CoworkerFormule(
	DateCF DATE,
	Nom_Formule VARCHAR(30) REFERENCES Formule(Nom),
	Coworker INTEGER REFERENCES Coworker(idCoworker),
	PRIMARY KEY(DateCF,Nom_Formule,Coworker)
);

CREATE TABLE Conference(
	Titre VARCHAR(30),
	DateC DATE,
	Resume TEXT NOT NULL,
	Intervenant INTEGER REFERENCES Intervenant(idIntervenant),
	Coworker INTEGER REFERENCES Coworker(idCoworker),
	ID_Espace INTEGER REFERENCES Espace(idEspace),
	PRIMARY KEY (Titre, DateC),
	CHECK (((Intervenant IS NULL) AND (Coworker IS NOT NULL)) OR
		((Intervenant IS NOT NULL) AND (Coworker IS NULL)))
);


CREATE TABLE Assoc_Espace_Ouvert_Conference(
	Titre_conf VARCHAR(30),
	Date_conf DATE,
	ID INTEGER REFERENCES Espace(idEspace),
	FOREIGN KEY (Titre_conf,Date_conf) REFERENCES Conference(Titre,DateC),
	PRIMARY KEY (Titre_conf, Date_conf, ID)
);


COMMIT TRANSACTION;
