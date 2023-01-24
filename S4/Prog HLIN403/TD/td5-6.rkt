#lang racket
;TD 5 
;ex9
(define (length l) (if (null? l) 0 (+ 1 (length (cdr l)))))

(define (length_acc l cpt) (if (null? l) cpt (length_acc (cdr l) (+ 1 cpt))))
(define (length2 l) (length_acc l 0))

;ex 10
(define (x2 x) (* 2 x))
(define (double l) (map x2 l))

(define (double2 l) (if (null? l) '() (cons (* 2 (car l)) (double2 (cdr l)))))

;td6
;(* 5 (fact 4))
;(* 5 (* 4 (fact 3)))
;...
;(* 5 (* 4 (* 3 (* 2 (* 1 1)))))
;

;ex 3
(define (inverse-acc l)
  (letrec ((aux (lambda (m acc) (if (null? m) acc (aux (cdr m) (cons (car m) acc))))))
    (aux l '())))

(define (sommeliste l)
  (letrec ((aux (lambda (m acc) (if (null? m) acc (aux (cdr m) (+ (car m) acc))))))
    (aux l 0)))

(define (sommerangimpair l)
  (letrec ((aux (lambda (m acc)
                  (if (null? m) acc
                      (if (null? (cdr m))
                          (+ (car m) acc)
                          (aux (cddr m) (+ (car m) acc)))))))
    (aux l 0)))

;ex 4
(define (appartient? e l) (if (null? l) #f (if (equal? (car l) e) #t (appartient? (cdr l) e))))
(define (appmap? e l) (ormap (lambda (x) (equal? x e)) l))



;td 7 abstractions et structures de données
;constructeurs et accésseurs
(define make_c list)
(define partie_r car)
(define partie_i cadr)

(define (reel? z) (= 0 (partie_i z)))
(define (imag? z) (= 0 (partie_r z)))
(define (som_c z1 z2) (make_c (+ (partie_r z1) (partie_r z2)) (+ (partie_i z1) (partie_i z2))))
(define (produit_c z1 z2) (make_c (- (* (partie_r z1) (partie_i z2)) (* (partie_r z2) (partie_i z1)))
                                  (+ (* (partie_r z1) (partie_i z2)) (* (partie_r z2) (partie_i z1)))))
(define (inverse_c z) (let ((a (+ (* (partie_r z) (partie_r z)) (* (partie_i z) (partie_i z)))))
                        (make_c (/ (partie_r z) a) (- (/ (partie_i z) a)))))
(define (divise_c z1 z2) (produit_c z1 (inverse_c z2)))
(define (puissance z n) (if (< n 0)
                            (puissance (inverse_c z) (- n))
                            (letrec ((aux (lambda (m acc) (if (= m 0) acc (aux (- m 1) (* acc z)))))) (aux n 1))))
  
                          


;ex 4
(define (monome d c) (if (= d 0) (list c) (cons '0 (monome (- d 1) c)))) 




;td 8 : récursivité sur les arbres





(define (rendreMonnaie somme nbSortesPieces valeurPiece)
  (define (rendre somme n)
    (cond ((= somme 0) 1)
          ((or (< somme 0) (= n 0)) 0)
          (else (+ (rendre somme (- n 1)) (rendre (- somme (valeurPiece n)) n)))))
  (rendre somme nbSortesPieces))

(define (valeurPiecesEuro piece)
  (cond ((= piece 1) 1)
        ((= piece 2) 2)
        ((= piece 3) 5)
        ((= piece 4) 10)
        ((= piece 5) 20)
        ((= piece 6 ) 50)
        ((= piece 7 ) 100)
        ((= piece 8 ) 200)))

(define (rendreEuro somme)
  (rendreMonnaie somme 8 valeurPiecesEuro))

;ex 1
(define (rendreMonnaieListe somme nbSortesPieces valeurPiece)
  (letrec ((rendre1 (lambda (somme n l)
    (cond ((= somme 0) (list l))
          ((or (< somme 0) (= n 0)) '())
          (else (append (rendre1 somme (- n 1) l)
                        (rendre1 (- somme (valeurPiece n)) n (cons (valeurPiece n) l))))))))
  (rendre1 somme nbSortesPieces '())))


(define (RE somme)
  (rendreMonnaieListe somme 8 valeurPiecesEuro))




;ex 2


(define make-noeud cons)
(define get-noeud-int car)
(define get-noeud-col cadr)
(define (noir? n) (= (get-noeud-col n) 1))
(define (pair? n) (= (remainder (get-noeud-int n) 2) 0))


;ex 4
#|(define (pairARN arn)
  (if (empty-arn? arn) void
  (let* ((rac (get-root-arn arn))
         (val (get-noeud-int rac))
         (newrac (make-noeud val (if (pair? rac) 1 2)))) 
    (make-arn newrac (pairARN (get-left-arn arn)) (pairARN (get-right-arn arn))))))




;ex5
(define (mono? a) (if (empty-arn? arb) #t
  (letrec ((aux (lambda (arb coul)
                  (cond ((empty-arn? arb) #t)
                        ((= (get-noeud-col arb) coul) (or (aux (get-left-arn arb) coul)
                                                           (aux (get-right-arn arb) coul)))
                        (else #f)))))
    (aux a (get-noeud-col a)))))





|#

































