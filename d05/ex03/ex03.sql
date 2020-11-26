INSERT  INTO `ft_table` (
    `login`, 
    `group`, 
    `creation_date` 
    )
SELECT  
`last_name`, 
"other",
`birthdate`
from 
`user_card` 
WHERE 
length(`last_name`) < 9 AND `last_name` LIKE '%a%' 
ORDER BY `birthdate`  LIMIT 10;