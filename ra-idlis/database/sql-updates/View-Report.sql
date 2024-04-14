/*********************   PTC EVALUATION RESULT (Checklist) **************************/
DROP VIEW IF EXISTS rpt_evaluation_ptc_checklist;
CREATE VIEW rpt_evaluation_ptc_checklist AS
(
SELECT DISTINCT
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname,  appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, barangay.brgyname, city_muni.cmname, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 


appform.documentSent, appform.isrecommended, appform.recommendedippaddr,  CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 

appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 

appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE '' END AS formattedDateApprove, 

/*DOH Back Office */
appform.isCashierApprove, appform.isReadyForInspec, appform.isInspected,  appform.isApprove,

ptc.type, CASE WHEN ptc.type='0' THEN 'New Construction' ELSE 'Expansion/Renovation/Substantial Alteration' END AS ptctype_desc, ptc.propbedcap,  ptc.construction_description, 
CASE WHEN hferc_evaluation.revision=1 THEN '1st Review' WHEN hferc_evaluation.revision=2 THEN '2nd Review' WHEN hferc_evaluation.revision=3 THEN '3rd Review' ELSE 'Not reviewed yet.' END AS revision

FROM hferc_evaluation 
LEFT JOIN appform ON appform.appid = hferc_evaluation.appid 
LEFT JOIN assessmentcombinedduplicateptc ON appform.appid = assessmentcombinedduplicateptc.appid 
LEFT JOIN assessmentrecommendation ON appform.appid = assessmentrecommendation.appid
LEFT JOIN ptc ON appform.appid = ptc.appid
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid	
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE appform.savingStat='final' AND appform.hfser_id='PTC' AND appform.isCashierApprove='1' AND appform.isReadyForInspec='1'
ORDER BY appform.appid ASC
);



/*********************   PTC EVALUATION **************************/
DROP VIEW IF EXISTS rpt_evaluation_ptc_logsheet;
CREATE VIEW rpt_evaluation_ptc_logsheet AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname,  appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, barangay.brgyname, city_muni.cmname, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 


appform.documentSent, appform.isrecommended, appform.recommendedippaddr,  CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 

appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 

appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE '' END AS formattedDateApprove, 

/*DOH Back Office */
appform.isCashierApprove, appform.isReadyForInspec, appform.isInspected,  appform.isApprove,

ptc.type, CASE WHEN ptc.type='0' THEN 'New Construction' ELSE 'Expansion/Renovation/Substantial Alteration' END AS ptctype_desc, ptc.propbedcap, ptc.conCode, ptc.ltoCode, ptc.construction_description, (SELECT COALESCE(SUM(amount),'0.00') AS payment FROM  chgfil WHERE appform_id=appform.appid AND paymentMode IS NOT NULL) AS payment,
'' AS ptc_id

FROM appform 
LEFT JOIN ptc ON appform.appid = ptc.appid
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid	
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE appform.savingStat='final' AND appform.hfser_id='PTC' AND appform.isCashierApprove='1' AND appform.isReadyForInspec='1'
ORDER BY appform.t_date DESC, appform.aptid ASC, appform.appid DESC
);


/*********************   INSPECTION LOGS **************************/
DROP VIEW IF EXISTS rpt_inspection_logsheet;
CREATE VIEW rpt_inspection_logsheet 	 AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname,  appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, appform.facmode, facmode.facmdesc, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, barangay.brgyname, city_muni.cmname, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate,

appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedDateInspect, 
appform.isInspected, appform.inspectedby, inspector.fname||' ' || inspector.mname ||' ' || inspector.lname AS inspectorName, 
'' AS inspectorRemarks,

appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 

appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE '' END AS formattedDateApprove, 

/*DOH Back Office */
appform.documentSent, appform.isCashierApprove, appform.isReadyForInspec,  appform.isApprove,
appform.noofbed, appform.noofmain, appform.noofstation,  appform.noofdialysis,

(SELECT COALESCE(SUM(amount),'0.00') AS payment FROM  chgfil WHERE appform_id=appform.appid AND paymentMode IS NOT NULL) AS payment,
'' AS license_id

FROM appform 
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
LEFT JOIN x08 inspector ON inspector.uid=appform.inspectedby
WHERE appform.savingStat='final' AND appform.isInspected='1'
ORDER BY appform.t_date DESC, appform.aptid ASC, appform.appid DESC
);



/*********************   LICENSE REPORT **************************/
DROP VIEW IF EXISTS rpt_license_facilities;
CREATE VIEW rpt_license_facilities 	 AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname,  appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, subclass.classname AS subclassname, appform.funcid, appform.facmode, facmode.facmdesc, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, barangay.brgyname, city_muni.cmname, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate,

appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedDateInspect, 
appform.isInspected, appform.inspectedby, 
CONCAT( IFNULL(inspector.fname,''), ' ', IFNULL(inspector.mname,''), ' ', IFNULL(inspector.lname,'')) AS inspectorName,  
'' AS inspectorRemarks,

appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 

appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE '' END AS formattedDateApprove, 

/*DOH Back Office */
appform.documentSent, appform.isCashierApprove, appform.isReadyForInspec,  appform.isApprove,
appform.noofbed, appform.noofmain, appform.noofstation,  appform.noofdialysis,

'' AS doh_retained, '' AS license_id,  '' AS issued_date, appform.approvedRemark AS approvedRemark,
appform.licenseNo, appform.signatoryname, appform.signatorypos

FROM appform 
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
LEFT JOIN x08 inspector ON inspector.uid=appform.inspectedby
WHERE appform.isApprove='1'
ORDER BY appform.t_date DESC, appform.aptid ASC, appform.appid DESC
);


/*********************   LICENSE REPORT **************************/
DROP VIEW IF EXISTS rpt_nonissuance_facilities;
CREATE VIEW rpt_nonissuance_facilities 	 AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname,  appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, subclass.classname AS subclassname, appform.funcid, appform.facmode, facmode.facmdesc, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, barangay.brgyname, city_muni.cmname, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate,

appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedDateInspect, 
appform.isInspected, appform.inspectedby, inspector.fname||' ' || inspector.mname ||' ' || inspector.lname AS inspectorName, 
'' AS inspectorRemarks,

appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 

appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE '' END AS formattedDateApprove, 

/*DOH Back Office */
appform.documentSent, appform.isCashierApprove, appform.isReadyForInspec,  appform.isApprove,
appform.noofbed, appform.noofmain, appform.noofstation,  appform.noofdialysis,

'' AS doh_retained, '' AS license_id,  '' AS issued_date, appform.approvedRemark AS approvedRemark

FROM appform 
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
LEFT JOIN x08 inspector ON inspector.uid=appform.inspectedby
WHERE (appform.status='NA' OR appform.status='RA' OR appform.status='RE' OR appform.status='RI')
ORDER BY appform.t_date DESC, appform.aptid ASC, appform.appid DESC
);



/**********    DOH Cashier  **********/
DROP VIEW IF EXISTS rpt_cashier_summary;
CREATE VIEW rpt_cashier_summary AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, 
appform.owner, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 

appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 

/*DOH Back Office */
appform.ishfep, appform.hfep_funded, 
appform.appid_payment,  appform.isrecommended, appform.isCashierApprove, appform.CashierApproveBy, cashier.fname ||' '|| cashier.mname ||' '|| cashier.lname AS CashierFullNameApproveBy, appform.CashierApproveTime, appform.CashierApproveIp,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") END AS CashierApproveformattedDate, 

(SELECT SUM(COALESCE(amount, 0.00)) AS amount FROM chgfil cf WHERE cf.appform_id=appform.appid AND cf.amount IS NOT NULL AND cf.paymentMode IS NOT NULL) AS totalpayment,
CASE WHEN appform.isCashierApprove='1' THEN 'Paid' ELSE 'For Payment' END AS paymentstatus

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid 
LEFT JOIN x08 AS cashier ON appform.CashierApproveBy=cashier.uid
WHERE appform.savingStat='final' AND appform.isPayEval='1' AND 
(appform.hfser_id='PTC' AND appform.isAcceptedFP!='1') =  FALSE 
AND appform.isCashierApprove='1' 
ORDER BY appform.isCashierApprove ASC, appform.aptid ASC, appform.appid ASC
);
