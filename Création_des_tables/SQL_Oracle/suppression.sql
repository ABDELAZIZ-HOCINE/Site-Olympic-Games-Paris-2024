-- SUPPRESSION_TABLES

DROP TABLE Reserver_Pour_Participants;

DROP TABLE Chambres;

DROP TABLE Palmares_Equipe;

DROP TABLE Palmares_Individuel;

DROP TABLE Pratiquer_Equipe;

DROP TABLE Pratiquer_Ind;

DROP TABLE Inscrire_Equipe;

DROP TABLE Inscrire_Individuel;

DROP TABLE Appartient_Avec_Remplacent;

DROP TABLE Specialiser;

DROP TABLE Arbitres;

DROP TABLE Personnels;

DROP TABLE Competitions;

DROP TABLE Disciplines;

DROP TABLE Categories;

DROP TABLE Date_;

DROP TABLE Ville;

DROP TABLE Equipes;

DROP TABLE Athletes;

DROP TABLE Membres_De_Comite;

DROP TABLE Entraineurs;

DROP TABLE Participants;

/*
En supprimant les tables dans cet ordre,
nous eviterons les erreurs de dependance car les tables referencees
seront supprimees avant les tables qui les referencent.
Cela garantit que toutes les contraintes de cles etrangeres
sont respectees et que les tables peuvent etre supprimees en toute securite.
*/
