s :- gn, gv.
gn :- det, n.
gn :- det, n, propqui.
gn :- det, n, propque.
gv :- vt, gn.
gv :- gn, vt.
gv :- vi.

propqui :- ntqui, gv. 
propque :- ntque, gn, vt. 
propque :- ntque, vt, gn. %(car le sujet peut se placer après le verbe dans une proposition relative introduite par que) 
ntque :- que.             %(que est un terminal) 
ntqui :- qui.             %(qui est un terminal) 

det :- un.
det :- une.
det :- des.
n :- hermine.    %(animal feminin)
n :- herisson.   %(animal masculin)
n :- hermines.    %(animal feminin)
n :- herissons.   %(animal masculin)
vi :- hurle.      %(verbe intransitif)
vt :- horripile.  %(verbe transitif)
vi :- hurlent.      %(verbe intransitif)
vt :- horripilent.  %(verbe transitif)