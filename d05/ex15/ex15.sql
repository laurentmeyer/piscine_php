SELECT SUBSTRING(REVERSE(telephone), 1, CHAR_LENGTH(telephone) - 1) AS 'enohpelet'
	FROM distrib
	WHERE CONVERT(telephone, CHAR) LIKE '05%'
;
