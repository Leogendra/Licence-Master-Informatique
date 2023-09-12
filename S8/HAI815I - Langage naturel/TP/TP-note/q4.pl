s(X,Z):-gn(X,Y),gv(Y,Z).


gn(X,Y) :- gnf(X,Y).
gn(X,Y) :- gnm(X,Y).

gnf(X,Y) :- detf(X,Z),nf(Z,Y).
gnf(X,Z) :- detf(X,Y),nf(Y,W),propqui(W,Z).
gnf(X,Z) :- detf(X,Y),nf(Y,W),propque(W,Z).
gnf(X,Y) :- det(X,Z),nf(Z,Y).
gnf(X,Z) :- det(X,Y),nf(Y,W),propqui(W,Z).
gnf(X,Z) :- det(X,Y),nf(Y,W),propque(W,Z).

gnm(X,Y) :- detm(X,Z),nm(Z,Y).
gnm(X,Z) :- detm(X,Y),nm(Y,W),propqui(W,Z).
gnm(X,Z) :- detm(X,Y),nm(Y,W),propque(W,Z).
gnm(X,Y) :- det(X,Z),nm(Z,Y).
gnm(X,Z) :- det(X,Y),nm(Y,W),propqui(W,Z).
gnm(X,Z) :- det(X,Y),nm(Y,W),propque(W,Z).

gv(X,Z) :- vt(X,Y),gn(Y,Z).
gv(X,Z) :- gn(X,Y),vt(Y,Z).
gv(X,Z) :- vi(X,Z).

propqui(X,Z) :- ntqui(X,Y),gv(Y,Z).
propque(X,Z) :- ntque(X,Y),gn(Y,W),vt(W,Z).
propque(X,Z) :- ntque(X,Y),vt(Y,W),gn(W,Z).

ntque(X,Y) :- entre(que,X,Y).
ntqui(X,Y) :- entre(qui,X,Y).

detm(X,Y) :- entre(un,X,Y).
detf(X,Y) :- entre(une,X,Y).
det(X,Y) :- entre(des,X,Y).


nf(X,Y) :- entre(hermine,X,Y).
nf(X,Y) :- entre(hermines,X,Y).
nm(X,Y) :- entre(herisson,X,Y).
nm(X,Y) :- entre(herissons,X,Y).
vi(X,Y) :- entre(hurle,X,Y).
vi(X,Y) :- entre(hurlent,X,Y).
vt(X,Y) :- entre(horripile,X,Y).
vt(X,Y) :- entre(horripilent,X,Y).

entre(Mot,[Mot|Reste],Reste). 