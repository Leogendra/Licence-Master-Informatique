%TD3 : TP


% QUESTION 1

% Première traduction

% faits
chatPersan(garfield).
canape(b1).
bouteille(b2).
sur(garfield,b1).
aCouleur(b1,rouge).
aCouleur(b2,blanc).
tient(garfield,b2).

% regles
chat(X) :- chatPersan(X).
animal(X) :- chat(X).
objet(X) :- canape(X).
proche(X,Y) :- sur(X,Y).
proche(X,Y) :- tient(X,Y).

% Réponse : chatPersan(garfield) chat(garfield) animal(garfield) canape(b1) objet(b1) sur(garfield,b1) proche(garfield,b2) proche(garfield,b1) tient(garfield,b2) bouteille(b2) aCouleur(b1,rouge) aCouleur(b2,blanc)


% Deuxième traduction

%faits
t(garfield,type,chatPersan).
t(garfield,sur,b1).
t(garfield,tient,b2).
t(b1,type,canape).
t(b2,type,bouteille).
t(b1,aCouleur,rouge).
t(b2,aCouleur,blanc).
t(chatPersan,subClass,chat).
t(chat,subClass,animal).
t(canape,subClass,objet).
t(bouteille,subClass,objet).
t(sur, subProp,proche).
t(tient, subProp, proche).


%regles
t(P1,subProp,P3) :- t(P1,subProp,P2), t(P2,subProp,P3).
t(S,P2,O) :- t(S,P1,O),t(P1,subProp,P2).
t(S1,type,O) :- t(S,subClass,O),t(S1,type,S).
t(S,subClass,O1) :- t(O,subClass,O1),t(S,subClass,O).

%t(garfield,type,chatPersan) t(garfield,sur,b1) t(garfield,tient,b2) t(b1,type,canape) t(b2,type,bouteille) t(b1,aCouleur,rouge) t(b2,aCouleur,blanc) t(chatPersan,subClass,chat) t(chat,subClass,animal) t(canape,subClass,objet) t(bouteille,subClass,objet) t(sur,subProp,proche) t(tient,subProp,proche) t(b2,type,objet) t(b1,type,objet) t(garfield,type,chat) t(garfield,proche,b2) t(garfield,proche,b1) t(chatPersan,subClass,animal) t(garfield,type,animal)



% QUESTION 2 :

%#show t/3.


% QUESTION 3 :

%Q1
q1_premier(X,Y) :- aCouleur(O,Y), animal(X), proche(X,O).
%Y couleur %O objet %Z typeanimal %X animal %P typeProp
q1_second(X,Y) :- t(O,aCouleur,Y), t(Z,subClass,animal), t(X,type,Z), t(P,subProp,proche), t(X,P,O).

%#show q1_premier/2.
%#show q1_second/2.

% Réponse : q1_premier(garfield,rouge) q1_premier(garfield,blanc) q1_second(garfield,rouge) q1_second(garfield,blanc)


%Q2
%X animal
%Y propriete
%O objet
%Z typeAnimal
% On ne peut pas avec la premiere traduction
q2_second(X,Y) :- t(X,type,Z), t(Z,subClass,animal), t(X,Y,O), t(Y,subProp, proche).

%#show q2_second/2.

% Réponse : q2_second(garfield,sur) q2_second(garfield,tient)
