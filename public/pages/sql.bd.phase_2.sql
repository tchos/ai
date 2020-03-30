 load data local infile 'precont.ad.csv' into table reversion
 FIELDS TERMINATED BY ';'
 LINES TERMINATED BY '\n'
 IGNORE 1 ROWS
 (matricul,noms_ayant_droit,sexe,date_nais,qualite_ayant_droit,date_nais_der_orph,ccay,cc,date_affectat,a_affect,noms_auteur,matricule_auteur,ministere,date_deces,noms_ad_acte,num_acte_revers,type_acte,date_signature_rev,conforme_y_n,date_saisie,resultat,precontentieux);
 
 load data local infile 'precont.inv.csv' into table invalidite
 FIELDS TERMINATED BY ';'
 LINES TERMINATED BY '\n'
 IGNORE 1 ROWS
 (matricul_inv,nom_agent_invalide,sexe,date_nais,num_acte_inval,type_acte_inv,date_signature_inv,noms_inv_acte,date_invalidite,cc_inv,cc,resultat,precontentieux,a_affect);
