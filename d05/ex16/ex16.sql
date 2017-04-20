SELECT COUNT(*) AS 'films'
FROM historique_membre
WHERE (date>=STR_TO_DATE('30,10,2006','%d,%m,%Y') AND date<=STR_TO_DATE('27,07,2007','%d,%m,%Y'))
OR (MONTH(date)=12 AND DAY(date)=24)
;
