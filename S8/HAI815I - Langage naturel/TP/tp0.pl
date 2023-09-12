s(a,b).
s(b,c).
s(c,d).
s(d,e).
mi(X,Y,Z) :- s(X,Y), s(Y,Z).
inf(X,Y) :- s(X,Y).
inf(X,Z) :- s(X,Y), inf(Y,Z).