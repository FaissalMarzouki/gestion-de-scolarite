/*==============================================================*/
/* BD_MINI_PROJET       GESTION DE SCOLARITE                   */
/* WITH II:BDCC , II:CCN , GLSID , STUDENTS                    */
/*==============================================================*/


/*==============================================================*/
/* Table: DEPARTEMENT                                           */
/*==============================================================*/
create table DEPARTEMENT
(
    ID_DEPARTEMENT       VARCHAR(100)  PRIMARY key    not null ,
    NOM_DEPARTEMENT      VARCHAR(100)  not null ,
    DESCRIPTION_D         VARCHAR(100)
);

/*==============================================================*/
/* Table: DISPENSER                                              */
/*==============================================================*/
create table DISPENSER
(
    ID_SALLE             VARCHAR(100)         not null,
    ID_MATIERE           VARCHAR(100)         not null,
constraint PK_DISPENSER primary key (ID_SALLE, ID_MATIERE), -- on peut aussi creer les clé primaire avec les contrainte

constraint FK_DISPENSER foreign key (ID_SALLE)
      references SALLE (ID_SALLE),   -- creation de clé etrangère en utilisant les contrainte

 FOREIGN KEY (ID_SALLE) REFERENCES SALLE (ID_SALLE) -- autre methode de creation de foreign key 

 /*Par suite on creera les clé étrangère après la creattion de toute les table c a d avec ALTER table ADD constraint fk_....*/
);

/*==============================================================*/
/* Table: ENSEIGNANT                                            */
/*==============================================================*/
create table ENSEIGNANT
(
    ID_ENSEIGNANT        VARCHAR(100)         not null,
    ID_DEPARTEMENT       VARCHAR(100)         not null,
    NOM                  VARCHAR(100),
    PRENOM               VARCHAR(100),
    SPECIALITE           VARCHAR(100),
	PRIMARY key (ID_ENSEIGNANT)  -- une autre methode de definir la clé
);

/*==============================================================*/
/* Table: ENSEIGNER                                             */
/*==============================================================*/
create table ENSEIGNER
(
    ID_ENSEIGNANT        VARCHAR(100)         not null,
    ID_MATIERE           VARCHAR(100)         not null,
constraint PK_ENSEIGNER primary key (ID_ENSEIGNANT, ID_MATIERE)
);

/*==============================================================*/
/* Table: ETUDIANT                                              */
/*==============================================================*/
create table ETUDIANT
(
    ID_ETUDIANT          VARCHAR(100)         not null,
    ID_SALLE             VARCHAR(100),
    ID_CLASSE            VARCHAR(100)         not null,
    NOM                  VARCHAR(100),
    PRENOM               VARCHAR(100),
    DATE_DE_NAISSANCE    DATE,
    ADRESSE              VARCHAR(100),
    DATE_PRESENCE              DATE,
constraint PK_ETUDIANT primary key (ID_ETUDIANT)
);

/*==============================================================*/
/* Table: EVALUER                                               */
/*==============================================================*/
create table EVALUER
(
    ID_MATIERE           VARCHAR(100)         not null,
    ID_ETUDIANT          VARCHAR(100)         not null,
    NOTE                 FLOAT,
constraint PK_EVALUER primary key (ID_MATIERE, ID_ETUDIANT)

);

/*==============================================================*/
/* Table: FILIERE                                               */
/*==============================================================*/
create table FILIERE
(
    ID_CLASSE            VARCHAR(100)         not null,
    ID_DEPARTEMENT       VARCHAR(100)         not null,
    NOM_FILIERE          VARCHAR(100),
    NIVEAU               VARCHAR(11),
constraint PK_FILIERE primary key (ID_CLASSE)
);

/*==============================================================*/
/* Table: MATIERE                                               */
/*==============================================================*/
create table MATIERE
(
    ID_MATIERE           VARCHAR(100)     NOT NULL,
    NOM_MATIERE          VARCHAR(100),
    CREDITS              VARCHAR(100),
constraint PK_MATIERE primary key (ID_MATIERE)
);

/*==============================================================*/
/* Table: SALLE                                                 */
/*==============================================================*/
create table SALLE
(
    ID_SALLE             VARCHAR(100)         not null,
    NUMERO               VARCHAR(100),
    CAPPACITE            INTEGER,
constraint PK_SALLE primary key (ID_SALLE)
);

/*Ajout des clé etrangère sur differents tables */


alter table DISPENSER
   add constraint FK_DISPENSER_DISPENSER2_MATIERE foreign key (ID_MATIERE)
      references MATIERE (ID_MATIERE);

alter table ENSEIGNANT
   add constraint FK_ENSEIGNA_FAIRE_PAR_DEPARTEM foreign key (ID_DEPARTEMENT)
      references DEPARTEMENT (ID_DEPARTEMENT);

alter table ENSEIGNER
   add constraint FK_ENSEIGNE_ENSEIGNER_ENSEIGNA foreign key (ID_ENSEIGNANT)
      references ENSEIGNANT (ID_ENSEIGNANT);

alter table ENSEIGNER
   add constraint FK_ENSEIGNE_ENSEIGNER_MATIERE foreign key (ID_MATIERE)
      references MATIERE (ID_MATIERE);

alter table ETUDIANT
   add constraint FK_ETUDIANT_APPARTENI_FILIERE foreign key (ID_CLASSE)
      references FILIERE (ID_CLASSE);

alter table ETUDIANT
   add constraint FK_ETUDIANT_PRESENTE_SALLE foreign key (ID_SALLE)
      references SALLE (ID_SALLE);

alter table EVALUER
   add constraint FK_EVALUER_EVALUER_MATIERE foreign key (ID_MATIERE)
      references MATIERE (ID_MATIERE);

alter table EVALUER
   add constraint FK_EVALUER_EVALUER2_ETUDIANT foreign key (ID_ETUDIANT)
      references ETUDIANT (ID_ETUDIANT);

alter table FILIERE
   add constraint FK_FILIERE_AVOIIR_DEPARTEM foreign key (ID_DEPARTEMENT)
      references DEPARTEMENT (ID_DEPARTEMENT);

