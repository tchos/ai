LOAD DATA LOCAL INFILE 'regul_reversion.csv'
INTO TABLE regul_reversion
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(matricul,noms_ayant_droit,qualite_ayant_droit,date_nais_der_orph,matricule_auteur,date_deces,noms_ad_acte,num_acte_revers,type_acte,date_signature_rev,date_regul,cloture_y_n,a_affect,regulariser_y_n,cc,resultat)
