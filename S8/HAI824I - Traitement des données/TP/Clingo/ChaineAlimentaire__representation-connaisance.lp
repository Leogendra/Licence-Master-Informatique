%TD3 : TP


% QUESTION 4

% Première traduction

% faits
herbacee(bambou).
arbre(bambou).
arbre(eucalyptus).
herbivore(vache).
herbivore(panda).
feuille(fBambou).
mange(panda,fBambou).
partieDe(fBambou, bambou).
feuille(fEucalyptus).
mange(panda,fEucalyptus).
partieDe(fEucalyptus,eucalyptus).
mange(vache,herbePres).
herbacee(herbePres).


% regles
:- animal(X), plante(X).
plante(X) :- arbre(X).
plante(X) :- herbacee(X).
top(X) :- plante(X).
top(X) :- animal(X).
top(X) :- feuille(X).
animal(X) :- herbivore(X).
animal(X) :- mange(X,Y).
partieDe(X,Z) :- partieDe(X,Y), partieDe(Y,Z).
mange(Y,X) :- nourrit(X,Y).
nourrit(Y,X) :- mange(X,Y).
plante(Y) :- feuille(X), partieDe(X,Y).
plante(Y) :- herbivore(X), mange(X,Y).
mange(X,Z) :- mange(X,Y), partieDe(Y,Z), plante(Z).
mange(X,Z) :- mange(X,Y), partieDe(Y,Z), animal(Z).
X=herbePres :- mange(vache,X).


% Réponse : plante(bambou) plante(eucalyptus) plante(herbePres) plante(fEucalyptus) plante(fBambou) animal(vache) animal(panda) arbre(bambou) arbre(eucalyptus) herbacee(bambou) herbacee(herbePres) top(fBambou) top(fEucalyptus) top(vache) top(panda) top(bambou) top(eucalyptus) top(herbePres) feuille(fBambou) feuille(fEucalyptus) herbivore(vache) herbivore(panda) mange(panda,fBambou) mange(panda,fEucalyptus) mange(panda,bambou) mange(vache,herbePres) mange(panda,eucalyptus) partieDe(fBambou,bambou) partieDe(fEucalyptus,eucalyptus) nourrit(herbePres,vache) nourrit(bambou,panda) nourrit(fEucalyptus,panda) nourrit(fBambou,panda) nourrit(eucalyptus,panda)

% QUESTION 5

%mange(vache, farineAnimal).
%partieDe(farineAnimale, unAnimalMort).
%animal(unAnimalMort).


% Réponse : UNSATISFIABLE





% Seconde traduction

% faits
t(bambou, type, herbacee).
t(bambou, type, arbre).
t(eucalyptus, type, arbre).
t(vache, type, herbivore).
t(panda, type, herbivore).
t(fBambou, type, feuille).
t(panda, mange, fBambou).
t(fBambou, partieDe, bambou).
t(fEucalyptus, feuille).
t(panda,mange,fEucalyptus).
t(fEucalyptus,partieDe, eucalyptus).
t(vache,mange,herbePres).
t(herbePres,type,herbacee).
t(arbre, subClass, plante).
t(herbacee, subClass, plante).
t(plante, subClass, top).
t(animal, subClass, top).
t(feuille, subClass, top).
t(herbivore, subClass, animal).
t(mange, domain, animal).
t(feuille, partieDe, plante).
t(herbivore, mange, plante).
t(vache, mange, herbePres).


% regles
:- t(X, type, animal), t(X,type,plante).
t(X, partieDe,Z) :- t(X,partieDe, Y), t(Y,partieDe,Z).
t(Y,mange,X) :- t(X,nourrit, Y).
t(Y, nourrit,X) :- t(X, mange,Y).
t(X,mange,Z) :- t(X, mange,Y), t(Y,partieDe,Z), t(Z, subClass, plante).
t(X,mange,Z) :- t(X,mange,Y), t(Y,partieDe,Z), t(Z, subClass, animal).

% RDFS
t(P1,subProp,P3) :- t(P1,subProp,P2), t(P2,subProp,P3).
t(S,P2,O) :- t(S,P1,O), t(P1,subProp,P2).
t(S1,type,O) :- t(S,subClass,O), t(S1,type,S).
t(S,subClass,O1) :- t(O,subClass,O1), t(S,subClass,O).
t(S1,type,O) :- t(P,domain,O), t(S1,P,O1).
t(P,domain,O1) :- t(P,domain,O), t(O,subClass,O1).
t(P,domain,O) :- t(P,subProp,P1), t(P1,domain,O).

% Réponse : t(bambou,type,herbacee) t(bambou,type,arbre) t(eucalyptus,type,arbre) t(vache,type,herbivore) t(panda,type,herbivore) t(fBambou,type,feuille) t(panda,mange,fBambou) t(fBambou,partieDe,bambou) t(panda,mange,fEucalyptus) t(fEucalyptus,partieDe,eucalyptus) t(vache,mange,herbePres) t(herbePres,type,herbacee) t(arbre,subClass,plante) t(herbacee,subClass,plante) t(plante,subClass,top) t(animal,subClass,top) t(feuille,subClass,top) t(herbivore,subClass,animal) t(mange,domain,animal) t(feuille,partieDe,plante) t(herbivore,mange,plante) t(mange,domain,top) t(herbivore,type,animal) t(vache,type,animal) t(panda,type,animal) t(herbePres,type,plante) t(fBambou,type,top) t(eucalyptus,type,plante) t(bambou,type,plante) t(herbivore,subClass,top) t(herbacee,subClass,top) t(arbre,subClass,top) t(plante,nourrit,herbivore) t(herbePres,nourrit,vache) t(fEucalyptus,nourrit,panda) t(fBambou,nourrit,panda) t(panda,type,top) t(vache,type,top) t(herbivore,type,top) t(bambou,type,top) t(eucalyptus,type,top) t(herbePres,type,top)


#show t/3.