CREATE TABLE tSession(
	deb TIMESTAMP,
	fin TIMESTAMP,
	num INTEGER,
	PRIMARY KEY(num),
	CHECK(deb<fin and
		fin is NOT NULL	
	)
);

CREATE TABLE tGroupe(
	pkLogin CHAR(7) PRIMARY KEY,
	aPassword VARCHAR(8),
	session INTEGER REFERENCES tSession(num),
	CHECK(aPassword is NOT NULL)
);
