LOAD DATA LOCAL INFILE 'rev.suspendre.M202011.csv'
INTO TABLE regul_rev_susp
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(Matricul,noms_ayant_droit,qualite_ayant_droit,date_nais_der_orph,matricule_auteur,date_deces,noms_ad_acte,num_acte_revers,type_acte,date_signature_rev,date_regul,a_affect,CC,resultat);

LOAD DATA LOCAL INFILE 'rev.cloture.M202011.csv'
INTO TABLE regul_rev_clo
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(Matricul,noms_ayant_droit,qualite_ayant_droit,date_nais_der_orph,matricule_auteur,date_deces,noms_ad_acte,num_acte_revers,type_acte,date_signature_rev,date_regul,a_affect,CC,resultat);

LOAD DATA LOCAL INFILE 'inv.suspendre.M202011.csv'
INTO TABLE regul_inv_susp
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(Matricul,nom_agent_invalide,a_affect,num_acte_inval,type_acte,date_signature,nom_inv_acte,date_invalidite,date_regul,CC,resultat,regulariser_y_n);

LOAD DATA LOCAL INFILE 'inv.cloture.M202011.csv'
INTO TABLE regul_inv_clo
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(Matricul,nom_agent_invalide,a_affect,num_acte_inval,type_acte,date_signature,nom_inv_acte,date_invalidite,date_regul,CC,resultat,regulariser_y_n);
