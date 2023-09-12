% instance
herbacee(bambou).
arbre(bambou).
arbre(eucalyptus).
herbacee(herbePres).
feuille(fBambou).
partieDe(fBambou, bambou).
feuille(fEucalytpus).
partieDe(fEucalyptus, eucalyptus).
herbivore(vache).
herbivore(panda).
mange(panda, fBambou).
mange(panda, fEucalyptus).
mange(vache, herbePres).

% règles
:- animal(X), plante(X).
plante(X) :- arbre(X).
plante(X) :- herbacee(X).
% Et on ajoute :
top(X) :- plante(X).
top(X) :- animal(X).
top(X) :- feuille(X).
animal(X) :- herbivore(X).
animal(X) :- mange(X, Y).
partieDe(X, Z) :- partieDe(X, Y), partieDe(Y, Z).
mange(Y, X) :- nourrit(X, Y).
nourrit(Y, X) :- mange(X, Y).
plante(Y) :- feuille(X), partieDe(X, Y).
plante(Y) :- herbivore(X), mange(X, Y).
mange(X, Z) :- mange(X, Y), partieDe(Y, Z), plante(Z).
mange(X, Z) :- mange(X, Y), partieDe(Y, Z), animal(Z).

% Vache bouffe de la farine animale
animal(animalMort).
partieDe(farineAnimale, animalMort).
mange(vache, farineAnimale).

% Insatisfiable car elle mange que des plantes