SET serveroutput on;
DROP TABLE ART;
DROP TABLE PHOTOGRAPHY;
DROP TABLE HISTORIC;
DROP TABLE AUTHOR;
DROP TABLE TYPE;
DROP TABLE MATERIAL;
DROP TABLE DESIGN;
DROP TABLE COMPOSE;
DROP TABLE ARCHITECT;
DROP TABLE PARTICIPATE;
DROP TABLE VIDEO;
DROP TABLE REPORT;
DROP TABLE LOCATION;
DROP TABLE LOCATED;

CREATE TABLE TYPE (
  name VARCHAR(32),
  CONSTRAINT PK_TYPE PRIMARY KEY (name)
);

CREATE TABLE LOCATION (
  name VARCHAR(150),
  longitude VARCHAR(32),
  latitude VARCHAR(32),
  CONSTRAINT PK_Location PRIMARY KEY (name)
);

CREATE TABLE ART (
  id INTEGER,
  name VARCHAR(150),
  creationYear INTEGER,
  presentationHTMLFile VARCHAR(1000),
  historicHTMLFile VARCHAR(1000),
  soundFile VARCHAR(1000),
  isPublic INTEGER,
  imageFile VARCHAR(1000),
  nameLocation VARCHAR(500),
    type VARCHAR(32),
  CONSTRAINT PK_Art PRIMARY KEY (id),
  CONSTRAINT FK_Art_Type FOREIGN KEY (type) 
    REFERENCES TYPE(name) ON DELETE CASCADE,
  CONSTRAINT FK_Art_Location FOREIGN KEY (nameLocation) 
    REFERENCES LOCATION(name) ON DELETE CASCADE,
  CONSTRAINT uc_art_name UNIQUE (name)
);

CREATE SEQUENCE seq_auto_increment_art START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER trg_auto_increment_art
  BEFORE INSERT ON art
  FOR EACH ROW
BEGIN
  :NEW.id := seq_auto_increment_art.nextval;
END;
/

CREATE TABLE VIDEO (
  id INTEGER,
  titleFile VARCHAR(1000),
  idArt INTEGER,
  CONSTRAINT PK_Video PRIMARY KEY (id),
  CONSTRAINT FK_Video_Art FOREIGN KEY (idArt) 
    REFERENCES ART(id) ON DELETE CASCADE,
  CONSTRAINT uc_video_titleFile_idArt UNIQUE (titleFile, idArt)
);

CREATE SEQUENCE seq_auto_increment_video START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER trg_auto_increment_video
  BEFORE INSERT ON video
  FOR EACH ROW
BEGIN
  :NEW.id := seq_auto_increment_video.nextval;
END;
/

CREATE TABLE ARCHITECT (
  fullName VARCHAR(100),
  CONSTRAINT PK_Architect PRIMARY KEY (fullname)
);

CREATE TABLE PARTICIPATE (
  fullName VARCHAR(100),
  idArt INTEGER,
  CONSTRAINT PK_Participate PRIMARY KEY (fullName, idArt),
  CONSTRAINT FK_Participate_Art FOREIGN KEY (idArt) 
    REFERENCES ART(id) ON DELETE CASCADE,
  CONSTRAINT FK_Participate_Architect FOREIGN KEY (fullName) 
    REFERENCES ARCHITECT(fullName) ON DELETE CASCADE
);

CREATE TABLE PHOTOGRAPHY (
  id INTEGER,
  nameFile VARCHAR(1000),
  idArt INTEGER,
  CONSTRAINT PK_Photography PRIMARY KEY (id),
  CONSTRAINT FK_Photographie_Art FOREIGN KEY (idArt) 
    REFERENCES ART(id) ON DELETE CASCADE,
  CONSTRAINT uc_photography_nameFile_idArt UNIQUE (nameFile, idArt)
);

CREATE SEQUENCE seq_auto_increment_photography START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER trg_auto_increment_photography
  BEFORE INSERT ON photography
  FOR EACH ROW
BEGIN
  :NEW.id := seq_auto_increment_photography.nextval;
END;
/

CREATE TABLE HISTORIC (
  id INTEGER,
  nameFile VARCHAR(1000),
  idArt INTEGER,
  CONSTRAINT PK_Historic PRIMARY KEY (id),
  CONSTRAINT FK_Historic_Art FOREIGN KEY (idArt) 
    REFERENCES ART(id) ON DELETE CASCADE,
  CONSTRAINT uc_historic_nameFile_idArt UNIQUE (nameFile, idArt)
);

CREATE SEQUENCE seq_auto_increment_historic START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER trg_auto_increment_historic
  BEFORE INSERT ON historic
  FOR EACH ROW
BEGIN
  :NEW.id := seq_auto_increment_historic.nextval;
END;
/

CREATE TABLE AUTHOR (
  fullName VARCHAR(200),
  yearBirth INTEGER,
  yearDeath INTEGER,
  CONSTRAINT PK_Author PRIMARY KEY (fullName)
);

CREATE TABLE DESIGN (
  nameAuthor VARCHAR(200),
  idArt INTEGER,
  biographyHTMLFile VARCHAR(1000),
  CONSTRAINT PK_Design PRIMARY KEY (nameAuthor, idArt),
  CONSTRAINT FK_Design_Art FOREIGN KEY (idArt) 
    REFERENCES ART(id) ON DELETE CASCADE,
  CONSTRAINT FK_Design_Author FOREIGN KEY (nameAuthor) 
    REFERENCES AUTHOR(fullName) ON DELETE CASCADE
); 

CREATE TABLE MATERIAL (
  name VARCHAR(32),
  CONSTRAINT PK_Material PRIMARY KEY (name)
);

CREATE TABLE COMPOSE (
  nameMaterial VARCHAR(32),
  idArt INTEGER,
  CONSTRAINT PK_Compose PRIMARY KEY (idArt, nameMaterial),
  CONSTRAINT FK_Compose_Art FOREIGN KEY (idArt) 
    REFERENCES ART(id) ON DELETE CASCADE,
  CONSTRAINT FK_Compose_Material FOREIGN KEY (nameMaterial) 
    REFERENCES MATERIAL(name) ON DELETE CASCADE
);

CREATE TABLE ADMIN (
  id_admin INTEGER,
  email_admin VARCHAR(64),
  mdp_admin VARCHAR(64),
  token_admin VARCHAR(120),
  CONSTRAINT PK_Admin PRIMARY KEY (id_admin)
);

CREATE SEQUENCE seq_auto_increment_admin START WITH 1 INCREMENT BY 1;

CREATE OR REPLACE TRIGGER trg_auto_increment_admin
  BEFORE INSERT ON admin
  FOR EACH ROW
BEGIN
  :NEW.id_admin := seq_auto_increment_admin.nextval;
END;
/

INSERT INTO ADMIN(email_admin, mdp_admin) VALUES('admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3');
INSERT INTO TYPE VALUES('Architecture');
INSERT INTO TYPE VALUES('Arts décoratifs');
INSERT INTO TYPE VALUES('Arts numériques');
INSERT INTO TYPE VALUES('Cinéma');
INSERT INTO TYPE VALUES('Musique');
INSERT INTO TYPE VALUES('Peinture');
INSERT INTO TYPE VALUES('Photographie');
INSERT INTO TYPE VALUES('Sculpture');