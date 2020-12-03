LOAD DATA LOCAL INFILE 'inv.suspendre.M202011.csv'
INTO TABLE regul_inv_susp
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(Matricul,nom_agent_invalide,a_affect,num_acte_inval,type_acte,date_signature,nom_inv_acte,date_invalidite,date_regul,CC,resultat,regulariser_y_n)
