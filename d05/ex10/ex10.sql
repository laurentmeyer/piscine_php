SELECT F.titre AS 'Titre', F.resum AS 'Resume', F.annee_prod
FROM film as F
INNER JOIN genre as G ON F.id_genre=G.id_genre
WHERE G.nom='erotic';
