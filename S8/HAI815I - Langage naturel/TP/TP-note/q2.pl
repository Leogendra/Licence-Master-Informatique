s(X,Z):-gn(X,Y),gv(Y,Z).

gn(X,Y):-det(X,Z),n(Z,Y).
gn(X,Z):-det(X,Y),n(Y,W),propqui(W,Z).
gn(X,Z):-det(X,Y),n(Y,W),propque(W,Z).
gv(X,Z):-vt(X,Y),gn(Y,Z).
gv(X,Z):-gn(X,Y),vt(Y,Z).
gv(X,Z):-vi(X,Z).

propqui(X,Z):-ntqui(X,Y),gv(Y,Z).
propque(X,Z):-ntque(X,Y),gn(Y,W),vt(W,Z).
propque(X,Z):-ntque(X,Y),vt(Y,W),gn(W,Z).

ntque(X,Y) :- entre(que,X,Y).
ntqui(X,Y) :- entre(qui,X,Y).

det(X,Y) :- entre(un,X,Y).
det(X,Y) :- entre(une,X,Y).
det(X,Y) :- entre(des,X,Y).

n(X,Y) :- entre(hermine,X,Y).
n(X,Y) :- entre(herisson,X,Y).
n(X,Y) :- entre(hermines,X,Y).
n(X,Y) :- entre(herissons,X,Y).
vi(X,Y) :- entre(hurle,X,Y).
vt(X,Y) :- entre(horripile,X,Y).
vi(X,Y) :- entre(hurlent,X,Y).
vt(X,Y) :- entre(horripilent,X,Y).

% entre(des,0,1).
% entre(herissons,1,2).
% entre(qui,2,3).
% entre(horripilent,3,4).
% entre(une,4,5).
% entre(hermine,5,6).