%swipl

homme(albert).
homme(jean).
homme(paul).
homme(bertrand).
homme(louis).
homme(benoit).
homme(edgar).

femme(germaine).
femme(christiane).
femme(simone).
femme(marie).
femme(sophie).
femme(madeleine).

parent(albert,jean).
parent(jean,paul).
parent(paul,bertrand).
parent(paul,sophie).
parent(jean,simone).
parent(louis,benoit).
parent(paul,edgar).

parent(germaine,jean).
parent(christiane,simone).
parent(christiane,paul).
parent(simone,benoit).
parent(marie,bertrand).
parent(marie,sophie).
parent(madeleine,edgar).

/*
a) Est-ce que paul est un homme ?
homme(paul).

b) Est-ce que benoit est une femme ?
homme(benoit).

c) Quelles sont les femmes ?
femme(X).

d) Est-ce que marie est la mère de sophie ?
mere(marie, sophie).

e) Qui est la mère de jean ?
parent(X,jean), femme(X).

f) Quels sont les enfants de paul ?
parent(paul, X).

g) Quels sont les hommes qui ont des enfants ?
parent(X, _), homme(X).

%(A.ii) Définir les prédicats suivants :
*/
%a) mere(X,Y) :X est la mère de Y ;
mere(X,Y) :- parent(X, Y), femme(X).

%b) pere(X,Y) : X est le père de Y ;
mere(X,Y) :- parent(X, Y), homme(X).

%c) grand_pere(X,Y) : X est le grand-père de Y ;
grand_pere(X,Y) :-pere(X,P), parent(P,Y).

%d) grand_pere_maternel(X,Y) : X est le grand père maternel de Y ;
grand_pere_maternel(X,Y) :- pere(X,P), mere(P,Y).

%e) Demi-frere(X,Y) : X est le demi-frère de Y ; X est différent de Y et X et Y ont le même père ou la même mère --- les deux clauses correspondent au « ou » des clauses car (A=>C)&(B=> C) équivaut à (AvB) => 
demi_frere(X,Y) :- X\==Y, homme(X), mere(Z,X), mere(Z,Y).
demi_frere(X,Y) :- X\==Y, homme(X), pere(Z,X), pere(Z,Y).

/*
f) oncle(X,Y) X est le demi-frère de la mère ou du père de Y
(A.iii) Définir (récursivement si besoin) les prédicats suivants :
a) ancetre(X,Y) : X est un ancêtre de Y ;
ancetre(X,Y ) :-parent(X,Y).
ancetre(X,Y) :-parent(X,I),ancetre(I,Y).
b) descendant(X,Y) : X est un descendant de Y ;
*/

%%%%%%%%%%%%%%%%%%%%%%
%%%   EXERCICE B   %%%
%%%%%%%%%%%%%%%%%%%%%%

p([1|Z],Z).
q(X,Z) :- p(X,Y),p(Y,Z).

/*
[trace]  ?- q(U, []).
   Call: (10) q(_36496, []) ? creep
   Call: (11) p(_36496, _37678) ? creep
   Exit: (11) p([1|_37678], _37678) ? creep
   Call: (11) p(_37678, []) ? creep
   Exit: (11) p([1], []) ? creep
   Exit: (10) q([1, 1], []) ? creep
U = [1, 1].

[trace]  ?- q(U, [1,2,3]).
   Call: (10) q(_56892, [1, 2, 3]) ? creep
   Call: (11) p(_56892, _58116) ? creep
   Exit: (11) p([1|_58116], _58116) ? creep
   Call: (11) p(_58116, [1, 2, 3]) ? creep
   Exit: (11) p([1, 1, 2, 3], [1, 2, 3]) ? creep
   Exit: (10) q([1, 1, 1, 2, 3], [1, 2, 3]) ? creep
U = [1, 1, 1, 2, 3].
*/

lg([],0).
lg([_|L],N1) :- lg(L,N), N1 is N+1.

/*
[trace]  ?- lg([a,b,c],2).
   Call: (10) lg([a, b, c], 2) ? creep
   Call: (11) lg([b, c], _30626) ? creep
   Call: (12) lg([c], _31382) ? creep
   Call: (13) lg([], _32138) ? creep
   Exit: (13) lg([], 0) ? creep
   Call: (13) _31382 is 0+1 ? creep
   Exit: (13) 1 is 0+1 ? creep
   Exit: (12) lg([c], 1) ? creep
   Call: (12) _30626 is 1+1 ? creep
   Exit: (12) 2 is 1+1 ? creep
   Exit: (11) lg([b, c], 2) ? creep
   Call: (11) 2 is 2+1 ? creep
   Fail: (11) 2 is 2+1 ? creep
   Fail: (10) lg([a, b, c], 2) ? creep
false.

[trace]  ?- lg([a,b,c],3).
   Call: (10) lg([a, b, c], 3) ? creep
   Call: (11) lg([b, c], _56088) ? creep
   Call: (12) lg([c], _56844) ? creep
   Call: (13) lg([], _57600) ? creep
   Exit: (13) lg([], 0) ? creep
   Call: (13) _56844 is 0+1 ? creep
   Exit: (13) 1 is 0+1 ? creep
   Exit: (12) lg([c], 1) ? creep
   Call: (12) _56088 is 1+1 ? creep
   Exit: (12) 2 is 1+1 ? creep
   Exit: (11) lg([b, c], 2) ? creep
   Call: (11) 3 is 2+1 ? creep
   Exit: (11) 3 is 2+1 ? creep
   Exit: (10) lg([a, b, c], 3) ? creep
true.

[trace] [1]  ?- lg([a,b,c,d],P).
   Call: (18) lg([a, b, c, d], _11444) ? creep
   Call: (19) lg([b, c, d], _12690) ? creep
   Call: (20) lg([c, d], _13446) ? creep
   Call: (21) lg([d], _14202) ? creep
   Call: (22) lg([], _14958) ? creep
   Exit: (22) lg([], 0) ? creep
   Call: (22) _14202 is 0+1 ? creep
   Exit: (22) 1 is 0+1 ? creep
   Exit: (21) lg([d], 1) ? creep
   Call: (21) _13446 is 1+1 ? creep
   Exit: (21) 2 is 1+1 ? creep
   Exit: (20) lg([c, d], 2) ? creep
   Call: (20) _12690 is 2+1 ? creep
   Exit: (20) 3 is 2+1 ? creep
   Exit: (19) lg([b, c, d], 3) ? creep
   Call: (19) _11444 is 3+1 ? creep
   Exit: (19) 4 is 3+1 ? creep
   Exit: (18) lg([a, b, c, d], 4) ? creep
P = 4.
*/

%%%%%%%%%%%%%%%%%%%%%%
%%%   EXERCICE C   %%%
%%%%%%%%%%%%%%%%%%%%%%

%(C.i) Définir le prédicat appartient(X,L) qui est vrai lorsque l’élément X appartient à la liste L.
appartient(X,[X|_]).
appartient(X,[_|L]) :- appartient(X,L).

 
%(C.ii) Définir le prédicat non_appartient(X,L) qui est vrai lorsque l’élément X n’appartient pas à la liste L — on peut utiliser fail et !.
non_appartient(X, L) :- appartient(X, L), !, fail.
non_appartient(_, _).
%ou



notin(_, []).
notin(X, [Y|L]) :- X\==Y, notin(X, L).
%avec X\==Y : X et Y syntaxiquement différents
%la dernière clause s’écrit aussi notin(X,[Y|L]):-X\=Y,notin(X,L). avec X\=Y : X et Y non unifiables

%(C.iii) Définir le prédicat sans_repetition(L) qui est vrai lorsque la liste L ne contient pas deux fois le même élément.
sans_repetition([_]).
sans_repetition([X|L]) :- non_appartient(X,L), sans_repetition(L).

%(C.iv) Définir le prédicat ajout_tete(X,L1,L2) qui est vrai lorsque L2 est la liste obtenue à partir de L1 par ajout en tête de l’élément X.
ajout_tete(X, L1, [X|L1]).

%(C.v) Définir le prédicat ajout_queue(X,L1,L2) qui est vrai lorsque L2 est la liste obtenue à partir de L1 par ajout en queue de l’élément X.
ajout_queue(X, [], [X]).
ajout_queue(X, [_|L1], [_|L2]) :- ajout_queue(X, L1, L2).


%(C.vi) Définir le prédicat supprimer(X,L1,L2) qui est vrai lorsque L2 est la liste obtenue à partir de L1 en supprimant la première occurrence de X s’il y en a une, et, lorsqu’il n’y en a pas lorsque L1=L2=[].
supprimer(_, [], []).
supprimer(X, [X|L1], L1).
supprimer(X, [Y|L1], [Y|L2]) :- X \== Y, supprimer(X, L1, L2).

%(C.vii) Définir le prédicat supprimer_fin(L1,L2) qui est vrai lorsque L2 est la liste obtenue à partir de L1 en supprimant son dernier élément, ou lorsque L1=L2=[].
supprimer_fin([], []).
supprimer_fin([_], []).
supprimer_fin([X|L1], [X|L2]) :- supprimer_fin(L1, L2).

%(C.viii) Définir le prédicat fusion(L1,L2,L3) qui est vrai lorsque L3 est obtenue à partir de L1 et L2 en prenant alternativement un élément dans L1 et un dans L2 et en adjoignant en queue les éléments non encore utilisés de la liste la plus longue parmi L1 et L2.
fusion([], L, L).
fusion(L, [], L).
fusion([X|L1], [Y|L2], [X,Y|L3]) :- fusion(L1, L2, L3).

%(C.ix) Définir le prédicat concatener(L1,L2,L3) qui est vrai lorsque L3 est la liste dont les éléments sont d’abord ceux de L1 puis ceux de L2
concatener([], L, L).
concatener([X|L1], L2, [X|L3]) :- concatener(L1, L2, L3).

%(C.x) Définir le prédicat inverser(L1,L2) qui est vrai lorsque L2 est constituée des même éléments que L1 mais en sens inverse.
inverser(L1, L2) :- inverser_aux(L1, [], L2).
inverser_aux([], L, L).
inverser_aux([X|L1], Acc, L2) :- inverser_aux(L1, [X|Acc], L2).

%(C.xi) Définir le prédicat commun(L1,L2,L3) qui est vrai lorsque L3 est la liste sans répétition des éléments communs à L1 et à L2. telle que l’ordre d’apparition des éléments dans L3 est l’ordre de leur première apparition dans L1 suivie de L2.
commun(L1, L2, L3) :- concatener(L1, L2, L), sans_repetition(L, L3).
sans_repetition([], []).
sans_repetition([X|L1], L2) :- appartient(X, L1), !, sans_repetition(L1, L2).
sans_repetition([X|L1], [X|L2]) :- sans_repetition(L1, L2).

%(C.xii) Définir le prédicat ens(L1,L2) qui est vrai lorsque L2 est obtenue à partir de L1 par suppression de toutes les occurrences d’un élément sauf la dernière. La liste L2 a les même éléments que L1, mais sans répétition.
ens(L1, L2) :- inverser(L1, L1_inv), sans_repetition(L1_inv, L2_inv), inverser(L2_inv, L2).

%(C.xiii) Définir le prédicat reunion(L1,L2,L3) qui, en supposant que L1 et L2 sont sans répétition, est vrai lorsque L3 est sans répétition et contient tous les éléments de L1 et de L2 dans l’ordre où ils apparaissent dans L1 suivie de L2.
reunion(L1, L2, L3) :- concatener(L1, L2, L), sans_repetition(L, L3).

%(C.xiv) Définir le prédicat reunionbis(L1,L2,L3) qui est vrai lorsque L3 contient tous les éléments de L1 et de L2, au plus une fois, et dans l’ordre dans leur dernière apparition
reunionbis(L1, L2, L3) :- concatener(L1, L2, L), ens(L, L3).