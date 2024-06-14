CREATE TABLE Participants(
   Id_Participant INT,
   Nom VARCHAR(30),
   Prenom VARCHAR(30),
   Date_De_Naissance DATE,
   Nationnalite VARCHAR(30),
   PRIMARY KEY(Id_Participant)
);

CREATE TABLE Entraineurs(
   Num_Entraineur INT,
   Diplome VARCHAR(50),
   Id_Participant INT NOT NULL,
   PRIMARY KEY(Num_Entraineur),
   FOREIGN KEY(Id_Participant) REFERENCES Participants(Id_Participant)
);

CREATE TABLE Membres_De_Comite(
   Num_Membres_Comite INT,
   Mot_De_Passe VARCHAR(50),
   Id_Participant INT NOT NULL,
   PRIMARY KEY(Num_Membres_Comite),
   FOREIGN KEY(Id_Participant) REFERENCES Participants(Id_Participant)
);

CREATE TABLE Athletes(
   Num_Athlete INT,
   Poids INT,
   Taille INT,
   Num_Entraineur INT NOT NULL,
   Id_Participant INT NOT NULL,
   PRIMARY KEY(Num_Athlete),
   FOREIGN KEY(Num_Entraineur) REFERENCES Entraineurs(Num_Entraineur),
   FOREIGN KEY(Id_Participant) REFERENCES Participants(Id_Participant)
);

CREATE TABLE Equipes(
   Num_Equipe VARCHAR(50),
   Nom_Equipe VARCHAR(50),
   Num_Entraineur INT NOT NULL,
   PRIMARY KEY(Num_Equipe),
   FOREIGN KEY(Num_Entraineur) REFERENCES Entraineurs(Num_Entraineur)
);

CREATE TABLE Ville(
   Num_Ville INT,
   Nom_Ville VARCHAR(50),
   PRIMARY KEY(Num_Ville)
);

CREATE TABLE Date_(
   Date_ DATE,
   PRIMARY KEY(Date_)
);

CREATE TABLE Categories(
   Num_Categorie INT,
   Nom_Categorie VARCHAR(50),
   Genre VARCHAR(30),
   PRIMARY KEY(Num_Categorie)
);

CREATE TABLE Disciplines(
   Num_Disciplines INT,
   Nom_Discipline VARCHAR(50),
   Num_Categorie INT NOT NULL,
   PRIMARY KEY(Num_Disciplines),
   FOREIGN KEY(Num_Categorie) REFERENCES Categories(Num_Categorie)
);

CREATE TABLE Competitions(
   Num_Competition INT,
   Horaire TIME,
   Avancement VARCHAR(30),
   Num_Disciplines INT NOT NULL,
   Date_ DATE NOT NULL,
   Num_Ville INT NOT NULL,
   PRIMARY KEY(Num_Competition),
   FOREIGN KEY(Num_Disciplines) REFERENCES Disciplines(Num_Disciplines),
   FOREIGN KEY(Date_) REFERENCES Date_(Date_),
   FOREIGN KEY(Num_Ville) REFERENCES Ville(Num_Ville)
);

CREATE TABLE Personnels(
   Num_Personnel INT,
   Fonction VARCHAR(50),
   Id_Participant INT NOT NULL,
   Num_Ville INT NOT NULL,
   PRIMARY KEY(Num_Personnel),
   FOREIGN KEY(Id_Participant) REFERENCES Participants(Id_Participant),
   FOREIGN KEY(Num_Ville) REFERENCES Ville(Num_Ville)
);

CREATE TABLE Arbitres(
   Num_Arbitre INT,
   Num_Personnel INT NOT NULL,
   Num_Competition INT NOT NULL,
   Num_Ville INT NOT NULL,
   PRIMARY KEY(Num_Arbitre),
   FOREIGN KEY(Num_Personnel) REFERENCES Personnels(Num_Personnel),
   FOREIGN KEY(Num_Competition) REFERENCES Competitions(Num_Competition),
   FOREIGN KEY(Num_Ville) REFERENCES Ville(Num_Ville)
);

CREATE TABLE Specialiser(
   Num_Categorie INT,
   Num_Arbitre INT,
   PRIMARY KEY(Num_Categorie, Num_Arbitre),
   FOREIGN KEY(Num_Categorie) REFERENCES Categories(Num_Categorie),
   FOREIGN KEY(Num_Arbitre) REFERENCES Arbitres(Num_Arbitre)
);

CREATE TABLE Appartient_Avec_Remplacent(
   Num_Athlete INT,
   Num_Athlete_1 INT,
   Num_Equipe VARCHAR(50),
   PRIMARY KEY(Num_Athlete, Num_Athlete_1, Num_Equipe),
   FOREIGN KEY(Num_Athlete) REFERENCES Athletes(Num_Athlete),
   FOREIGN KEY(Num_Athlete_1) REFERENCES Athletes(Num_Athlete),
   FOREIGN KEY(Num_Equipe) REFERENCES Equipes(Num_Equipe)
);

CREATE TABLE Inscrire_Individuel(
   Num_Athlete INT,
   Num_Competition INT,
   PRIMARY KEY(Num_Athlete, Num_Competition),
   FOREIGN KEY(Num_Athlete) REFERENCES Athletes(Num_Athlete),
   FOREIGN KEY(Num_Competition) REFERENCES Competitions(Num_Competition)
);

CREATE TABLE Inscrire_Equipe(
   Num_Competition INT,
   Num_Equipe VARCHAR(50),
   PRIMARY KEY(Num_Competition, Num_Equipe),
   FOREIGN KEY(Num_Competition) REFERENCES Competitions(Num_Competition),
   FOREIGN KEY(Num_Equipe) REFERENCES Equipes(Num_Equipe)
);

CREATE TABLE Pratiquer_Ind(
   Num_Athlete INT,
   Num_Disciplines INT,
   PRIMARY KEY(Num_Athlete, Num_Disciplines),
   FOREIGN KEY(Num_Athlete) REFERENCES Athletes(Num_Athlete),
   FOREIGN KEY(Num_Disciplines) REFERENCES Disciplines(Num_Disciplines)
);

CREATE TABLE Pratiquer_Equipe(
   Num_Disciplines INT,
   Num_Equipe VARCHAR(50),
   PRIMARY KEY(Num_Disciplines, Num_Equipe),
   FOREIGN KEY(Num_Disciplines) REFERENCES Disciplines(Num_Disciplines),
   FOREIGN KEY(Num_Equipe) REFERENCES Equipes(Num_Equipe)
);

CREATE TABLE Palmares_Individuel(
   Num_Palmares_I INT,
   Type_Medaille VARCHAR(30),
   Meilleurs_Resultat VARCHAR(50),
   Num_Athlete INT NOT NULL,
   Num_Disciplines INT NOT NULL,
   Date_ DATE NOT NULL,
   PRIMARY KEY(Num_Palmares_I),
   FOREIGN KEY(Num_Athlete) REFERENCES Athletes(Num_Athlete),
   FOREIGN KEY(Num_Disciplines) REFERENCES Disciplines(Num_Disciplines),
   FOREIGN KEY(Date_) REFERENCES Date_(Date_)
);

CREATE TABLE Palmares_Equipe(
   Num_Palmares_E INT,
   Type_Medaille VARCHAR(30),
   Meilleurs_Resultat VARCHAR(50),
   Num_Disciplines INT NOT NULL,
   Date_ DATE NOT NULL,
   Num_Equipe VARCHAR(50) NOT NULL,
   PRIMARY KEY(Num_Palmares_E),
   FOREIGN KEY(Num_Disciplines) REFERENCES Disciplines(Num_Disciplines),
   FOREIGN KEY(Date_) REFERENCES Date_(Date_),
   FOREIGN KEY(Num_Equipe) REFERENCES Equipes(Num_Equipe)
);

CREATE TABLE Chambres(
   Num_Chambre INT,
   Num_Batiment INT,
   Nbr_Lits INT,
   Nbr_Place_Libre INT,
   Ville VARCHAR(50),
   PRIMARY KEY(Num_Chambre)
);

CREATE TABLE Reserver_Pour_Participants(
   Id_Participant INT,
   Date_Entre DATE,
   Date_Sortie DATE,
   Num_Chambre INT NOT NULL,
   PRIMARY KEY(Id_Participant),
   FOREIGN KEY(Id_Participant) REFERENCES Participants(Id_Participant),
   FOREIGN KEY(Num_Chambre) REFERENCES Chambres(Num_Chambre)
);