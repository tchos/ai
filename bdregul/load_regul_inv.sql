LOAD DATA LOCAL INFILE 'regul_invalidite.csv'
INTO TABLE regul_invalidite
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(id,agent_saisie_id,matricul,nom_agent_invalide,a_affect,num_acte_inval,type_acte,date_signature,nom_inv_acte,date_invalidite,date_nais_der_orph,cloture_y_n,regulariser_y_n,date_regul,cc,resultat)
