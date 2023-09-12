s(X,Z):-gns(X,Y),gvs(Y,Z).
s(X,Z):-gnp(X,Y),gvp(Y,Z).

gns(X,Y) :- gnf(X,Y).
gns(X,Y) :- gnm(X,Y).

gnf(X,Y) :- detf(X,Z),nfs(Z,Y).
gnf(X,Z) :- detf(X,Y),nfs(Y,W),propquis(W,Z).
gnf(X,Z) :- detf(X,Y),nfs(Y,W),propques(W,Z).

gnm(X,Y) :- detm(X,Z),nms(Z,Y).
gnm(X,Z) :- detm(X,Y),nms(Y,W),propquis(W,Z).
gnm(X,Z) :- detm(X,Y),nms(Y,W),propques(W,Z).

gnp(X,Y) :- detp(X,Z),nmp(Z,Y).
gnp(X,Z) :- detp(X,Y),nmp(Y,W),propquip(W,Z).
gnp(X,Z) :- detp(X,Y),nmp(Y,W),propquep(W,Z).
gnp(X,Y) :- detp(X,Z),nfp(Z,Y).
gnp(X,Z) :- detp(X,Y),nfp(Y,W),propquip(W,Z).
gnp(X,Z) :- detp(X,Y),nfp(Y,W),propquep(W,Z).

gvs(X,Z) :- vts(X,Y),gns(Y,Z).
gvs(X,Z) :- gns(X,Y),vts(Y,Z).
gvs(X,Z) :- vis(X,Z).

gvp(X,Z) :- vtp(X,Y),gnp(Y,Z).
gvp(X,Z) :- vtp(X,Y),gns(Y,Z).
gvp(X,Z) :- gnp(X,Y),vtp(Y,Z).
gvp(X,Z) :- gns(X,Y),vtp(Y,Z).
gvp(X,Z) :- vip(X,Z).

propquis(X,Z) :- ntqui(X,Y),gvs(Y,Z).
propquip(X,Z) :- ntqui(X,Y),gvp(Y,Z).

propque(X,Y) :- propques(X,Y).
propque(X,Y) :- propquep(X,Y).

propques(X,Z) :- ntque(X,Y),gns(Y,W),vts(W,Z).
propques(X,Z) :- ntque(X,Y),vts(Y,W),gns(W,Z).
propquep(X,Z) :- ntque(X,Y),gnp(Y,W),vtp(W,Z).
propquep(X,Z) :- ntque(X,Y),vtp(Y,W),gnp(W,Z).

ntque(X,Y) :- entre(que,X,Y).
ntqui(X,Y) :- entre(qui,X,Y).

% Vocabulaire
detm(X,Y) :- entre(un,X,Y).
detf(X,Y) :- entre(une,X,Y).
detp(X,Y) :- entre(des,X,Y).

nfs(X,Y) :- entre(hermine,X,Y).
nfp(X,Y) :- entre(hermines,X,Y).
nms(X,Y) :- entre(herisson,X,Y).
nmp(X,Y) :- entre(herissons,X,Y).
vis(X,Y) :- entre(hurle,X,Y).
vip(X,Y) :- entre(hurlent,X,Y).
vts(X,Y) :- entre(horripile,X,Y).
vtp(X,Y) :- entre(horripilent,X,Y).

entre(Mot,[Mot|Reste],Reste). 