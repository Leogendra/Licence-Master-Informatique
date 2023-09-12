% Règles façon 2

% instance
triplet(garfield, type, chatPersan).
triplet(garfield, sur, b1).
triplet(garfield, tient, b2).
triplet(b1, type, canape).
triplet(b2, type, bouteille).
triplet(b1, aCouleur, rouge).
triplet(b2, aCouleur, blanc).
triplet(chatPersan, subclass, chat).
triplet(chat, subclass, animal).
triplet(canape, subclass, objet).
triplet(bouteille, subclass, objet).
triplet(sur, subproperty, proche).
triplet(tient, subproperty, proche).

% règles
triplet(P1, subclass, P3) :- triplet(P1, subclass, P2), triplet(P2, subclass, P3).
triplet(S, P2, O) :- triplet(P1, subproperty, P2), triplet(S, P1, O).
triplet(S2, type, O) :- triplet(S1, subclass, O), triplet(S2, type, S1).
triplet(S, subclass, O2) :- triplet(S, subclass, O1), triplet(O1, subclass, O2).

% Question 2 : Quels sont les faits inférés ?
% Autrement dit, donnez la base de faits saturée sans les faits initiaux.

% Question 3. Peut-on exprimer les requêtes suivantes ?
% (q1) Quels sont les animaux et couleurs tels que l’animal est proche d’un objet qui a cette couleur ?
animalEstProcheDeCouleur(X, Z) :- triplet(X, proche, Y), triplet(X, type, animal), triplet(Y, aCouleur, Z).
% #show animalEstProcheDeCouleur/2.

% (q2) Quels sont les animaux et proprietes tels que l’animal est lie par cette propriété à 
% un objet et que cette propriété soit une sous-propriete de la propriete “proche” ? 
% Donnez la forme logique de ces requêtes conjonctives
animalLieaAUnObjetPar(X, Y) :- triplet(X, type, animal), triplet(Y, subproperty, proche), triplet(Z, type, objet), triplet(X, Y, Z).
#show animalLieaAUnObjetPar/2.