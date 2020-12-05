
** BD SUSPENDUS qui va servir à la BD pour les régularisations.

** Pensions de réversions.
GET FILE = 'E:\spss\ayantsdroit\phase_4\rev.inv.suspendre.M202011.SAV'.
FREQUENCIES pensRevInv.
SELECT IF ( pensRevInv = 1 ).
EXECUTE.
FREQUENCIES pensRevInv.

MATCH FILES /FILE=* 
  /TABLE='E:\spss\ayantsdroit\phase_4\BDreversion.phaseIII.resultat.SAV' 
  /RENAME (suspendre = d0) 
  /BY matricul 
  /DROP= d0. 
EXECUTE.

SAVE OUTFILE = "E:\spss\ayantsdroit\phase_4\bdregul\rev.suspendre.M202011.SAV" /KEEP Matricul nomsAyantDroit qualiteAyantDroit  dateNaisDerOrph matriculeAuteur dateDeces 
noms_ad_acte numActeRevers typeActe dateSignatureRev dateSaisieRevers a_affect  cc resultat  
/RENAME  nomsAyantDroit =  noms_ayant_droit qualiteAyantDroit =  qualite_ayant_droit dateNaisDerOrph = date_nais_der_orph matriculeAuteur = matricule_auteur dateDeces = date_deces
numActeRevers = num_acte_revers typeActe = type_acte dateSignatureRev = date_signature_rev  dateSaisieRevers = date_regul .

GET FILE = "E:\spss\ayantsdroit\phase_4\bdregul\rev.suspendre.M202011.SAV".
SAVE TRANSLATE OUTFILE='E:\spss\ayantsdroit\phase_4\bdregul\rev.suspendre.M202011.csv' 
  /TYPE=CSV 
  /MAP 
  /REPLACE 
  /FIELDNAMES 
  /CELLS=VALUES.

** Pensions d'invalidité.
GET FILE = 'E:\spss\ayantsdroit\phase_4\rev.inv.suspendre.M202011.SAV'.
FREQUENCIES pensRevInv.
SELECT IF ( pensRevInv = 2 ).
EXECUTE.
FREQUENCIES pensRevInv.

MATCH FILES /FILE=* 
  /TABLE='E:\spss\ayantsdroit\phase_4\BDinvalidite.phaseIII.resultat.SAV' 
  /RENAME (suspendre = d0) 
  /BY matricul 
  /DROP= d0. 
EXECUTE.

SAVE OUTFILE = "E:\spss\ayantsdroit\phase_4\bdregul\inv.suspendre.M202011.SAV" /KEEP Matricul Nom a_affect numActeInval typeActeInv dateSignatureInv nomAgentInvalide
dateInvalidite why_is_not_authentic date_saisie cc resultat 
/RENAME Nom = nom_agent_invalide numActeInval = num_acte_inval typeActeInv = type_acte dateSignatureInv = date_signature nomAgentInvalide = nom_inv_acte
dateInvalidite = date_invalidite why_is_not_authentic = cloture_y_n date_saisie = date_regul .

GET FILE = "E:\spss\ayantsdroit\phase_4\bdregul\inv.suspendre.M202011.SAV".
SAVE TRANSLATE OUTFILE='E:\spss\ayantsdroit\phase_4\bdregul\inv.suspendre.M202011.csv' 
  /TYPE=CSV 
  /MAP 
  /REPLACE 
  /FIELDNAMES 
  /CELLS=VALUES.


** BD CLOTURE qui va servir à la BD pour les régularisations.

** Pensions de réversions.
GET FILE = "E:\spss\ayantsdroit\phase_4\rev.inv.cloture.M202011.SAV" /DROP precontentieux.
FREQUENCIES pensRevInv.
SELECT IF ( pensRevInv = 1 ).
EXECUTE.
FREQUENCIES pensRevInv.

MATCH FILES /FILE=* 
  /TABLE='E:\spss\ayantsdroit\phase_4\BDreversion.phaseIII.resultat.SAV' 
  /RENAME (suspendre = d0) 
  /BY matricul 
  /DROP= d0. 
EXECUTE.

SAVE OUTFILE = "E:\spss\ayantsdroit\phase_4\bdregul\rev.cloture.M202011.SAV" /KEEP Matricul nomsAyantDroit qualiteAyantDroit  dateNaisDerOrph matriculeAuteur dateDeces 
noms_ad_acte numActeRevers typeActe dateSignatureRev dateSaisieRevers a_affect  cc resultat  
/RENAME  nomsAyantDroit =  noms_ayant_droit qualiteAyantDroit =  qualite_ayant_droit dateNaisDerOrph = date_nais_der_orph matriculeAuteur = matricule_auteur dateDeces = date_deces
numActeRevers = num_acte_revers typeActe = type_acte dateSignatureRev = date_signature_rev  dateSaisieRevers = date_regul .

GET FILE = "E:\spss\ayantsdroit\phase_4\bdregul\rev.cloture.M202011.SAV".
SAVE TRANSLATE OUTFILE='E:\spss\ayantsdroit\phase_4\bdregul\rev.cloture.M202011.csv' 
  /TYPE=CSV 
  /MAP 
  /REPLACE 
  /FIELDNAMES 
  /CELLS=VALUES. 


** Pensions d'invalidité.
GET FILE = "E:\spss\ayantsdroit\phase_4\rev.inv.cloture.M202011.SAV" /DROP precontentieux.
FREQUENCIES pensRevInv.
SELECT IF ( pensRevInv = 2 ).
EXECUTE.
FREQUENCIES pensRevInv.

MATCH FILES /FILE=* 
  /RENAME (a_affect CC nom = d0 d1 d2) 
  /TABLE='E:\spss\ayantsdroit\phase_4\BDinvalidite.phaseIII.resultat.SAV' 
  /RENAME (An_emb chef_equipe DER equipe_id homo curieux id idUser libelleEquipe login mission precont resultat suspendre Sexe test = d3 d4 d5 d6 d7 d8 d9 d10 d11 d12 
	d13 d14 d15 d16 d17 d18) 
  /BY matricul 
  /DROP= d0 d1 d2 d3 d4 d5 d6 d7 d8 d9 d10 d11 d12 d13 d14 d15 d16 d17 d18. 
EXECUTE.

SAVE OUTFILE = "E:\spss\ayantsdroit\phase_4\bdregul\inv.cloture.M202011.SAV" /KEEP Matricul Nom a_affect numActeInval typeActeInv dateSignatureInv nomAgentInvalide
dateInvalidite date_saisie cc resultat why_is_not_authentic 
/RENAME Nom = nom_agent_invalide numActeInval = num_acte_inval typeActeInv = type_acte dateSignatureInv = date_signature nomAgentInvalide = nom_inv_acte
dateInvalidite = date_invalidite date_saisie = date_regul why_is_not_authentic = regulariser_y_n .

GET FILE = "E:\spss\ayantsdroit\phase_4\bdregul\inv.cloture.M202011.SAV".
SAVE TRANSLATE OUTFILE='E:\spss\ayantsdroit\phase_4\bdregul\inv.cloture.M202011.csv' 
  /TYPE=CSV 
  /MAP 
  /REPLACE 
  /FIELDNAMES 
  /CELLS=VALUES.

