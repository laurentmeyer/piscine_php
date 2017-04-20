SELECT UPPER(P.nom) AS 'NOM', P.prenom, A.prix
FROM membre AS M
INNER JOIN abonnement AS A
ON M.id_abo=A.id_abo
INNER JOIN fiche_personne AS P
ON M.id_fiche_perso=P.id_perso
WHERE A.prix > 42
ORDER BY P.nom ASC, P.prenom ASC
;
