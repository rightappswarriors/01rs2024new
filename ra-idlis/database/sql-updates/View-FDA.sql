/*********** View X-Ray Status ***************/

DROP VIEW IF EXISTS view_fda_status_summary;
CREATE VIEW view_fda_status_summary AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 
appform.proposedInspectiontime, CASE WHEN appform.proposedInspectiontime IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiontime, "%h:%i %p") ELSE NULL END AS formattedTimePropEval, 

appform.recommendedippaddr,  

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.xrayVal, CASE WHEN appform.xrayVal IS NOT NULL THEN DATE_FORMAT(appform.xrayVal, "%M %d, %Y") ELSE NULL END AS formattedXrayValidityDate, 
appform.pharValidity, CASE WHEN appform.pharValidity IS NOT NULL THEN DATE_FORMAT(appform.pharValidity, "%M %d, %Y") ELSE NULL END AS formattedPharmaValidityDate, 
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec, appform.proofpaystat, 

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvalipFDA,
 appform.payEvaldateFDA, CASE WHEN appform.payEvaldateFDA IS NOT NULL THEN DATE_FORMAT(appform.payEvaldateFDA, "%M %d, %Y") ELSE NULL END AS formattedPayEvaldateFDA, 
 appform.payEvaltimeFDA, CASE WHEN appform.payEvaltimeFDA IS NOT NULL THEN DATE_FORMAT(appform.payEvaltimeFDA, "%h:%i %p") ELSE NULL END AS formattedPayEvaltimeFDA,

 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvalipFDAPharma, 
 appform.payEvaldateFDAPharma, CASE WHEN appform.payEvaldateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.payEvaldateFDAPharma, "%M %d, %Y") ELSE NULL END AS formattedPayEvaldateFDAPharma, 
 appform.payEvaltimeFDAPharma, CASE WHEN appform.payEvaltimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.payEvaltimeFDAPharma, "%h:%i %p") ELSE NULL END AS formattedPayEvaltimeFDAPharma,
 
 appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveIpFDA,
 appform.CashierApproveDateFDA, CASE WHEN appform.CashierApproveDateFDA IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDateFDA, "%M %d, %Y") ELSE NULL END AS formattedCashierApproveDateFDA, 
 appform.CashierApproveTimeFDA, CASE WHEN appform.CashierApproveTimeFDA IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTimeFDA, "%h:%i %p") ELSE NULL END AS formattedCashierApproveTimeFDA, 
 
 appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveIpPharma,
 appform.CashierApproveDatePharma, CASE WHEN appform.CashierApproveDatePharma IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDatePharma, "%M %d, %Y") ELSE NULL END AS formattedCashierApproveDatePharma, 
 appform.CashierApproveTimePharma, CASE WHEN appform.CashierApproveTimePharma IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTimePharma, "%h:%i %p") ELSE NULL END AS formattedCashierApproveTimePharma,
 
 appform.ispreassessed, appform.ispreassessedby, appform.ispreassessedip, 
 appform.ispreassesseddate, CASE WHEN appform.ispreassesseddate IS NOT NULL THEN DATE_FORMAT(appform.ispreassesseddate, "%M %d, %Y") ELSE NULL END AS formattedIsPreassessedDate, 
 appform.ispreassessedtime, CASE WHEN appform.ispreassessedtime IS NOT NULL THEN DATE_FORMAT(appform.ispreassessedtime, "%h:%i %p") ELSE NULL END AS formattedIsPreassessedTime,
 
 appform.ispreassessedpharma, appform.ispreassessedbypharma, appform.ispreassessedippharma, 
 appform.ispreassesseddatepharma, CASE WHEN appform.ispreassesseddatepharma IS NOT NULL THEN DATE_FORMAT(appform.ispreassesseddatepharma, "%M %d, %Y") ELSE NULL END AS formattedIsPreassessedDatePharma, 
 appform.ispreassessedtimepharma, CASE WHEN appform.ispreassessedtimepharma IS NOT NULL THEN DATE_FORMAT(appform.ispreassessedtimepharma, "%h:%i %p") ELSE NULL END AS formattedIsPreassessedTimePharma, 
 
 appform.isrecommendedFDA, appform.recommendedbyFDA, appform.recommendedippaddrFDA, 
 appform.recommendeddateFDA, CASE WHEN appform.recommendeddateFDA IS NOT NULL THEN DATE_FORMAT(appform.recommendeddateFDA, "%M %d, %Y") ELSE NULL END AS formattedRecommendedDateFDA, 
 appform.recommendedtimeFDA, CASE WHEN appform.recommendedtimeFDA IS NOT NULL THEN DATE_FORMAT(appform.recommendedtimeFDA, "%h:%i %p") ELSE NULL END AS formattedRecommendedTimeFDA,
 
 appform.isrecommendedFDAPharma, appform.recommendedbyFDAPharma, appform.recommendedippaddrFDAPharma, 
 appform.recommendeddateFDAPharma, CASE WHEN appform.recommendeddateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.recommendeddateFDAPharma, "%M %d, %Y") ELSE NULL END AS formattedRecommendedDateFDAPharma, 
 appform.recommendedtimeFDAPharma, CASE WHEN appform.recommendedtimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.recommendedtimeFDAPharma, "%h:%i %p") ELSE NULL END AS formattedRecommendedTimeFDAPharma,
 
 appform.isRecoFDA, appform.RecobyFDA, appform.RecoippaddrFDA, appform.RecoRemarkFDA, 
 appform.RecodateFDA, CASE WHEN appform.RecodateFDA IS NOT NULL THEN DATE_FORMAT(appform.RecodateFDA, "%M %d, %Y") ELSE NULL END AS formattedRecoDateFDA, 
 appform.RecotimeFDA, CASE WHEN appform.RecotimeFDA IS NOT NULL THEN DATE_FORMAT(appform.RecotimeFDA, "%h:%i %p") ELSE NULL END AS formattedRecoTimeFDA,
 
 appform.isRecoFDAPhar, appform.RecobyFDAPhar, appform.RecoippaddrFDAPhar, appform.RecoRemarkFDAPhar, 
 appform.RecodateFDAPhar, CASE WHEN appform.RecodateFDAPhar IS NOT NULL THEN DATE_FORMAT(appform.RecodateFDAPhar, "%M %d, %Y") ELSE NULL END AS formattedRecoDateFDAPhar, 
 appform.RecotimeFDAPhar, CASE WHEN appform.RecotimeFDAPhar IS NOT NULL THEN DATE_FORMAT(appform.RecotimeFDAPhar, "%h:%i %p") ELSE NULL END AS formattedRecoTimeFDAPhar,
 
 appform.isApproveFDA, appform.approvefdaverd, appform.approvedByFDA, appform.approvedIpAddFDA,  appform.approvedRemarkFDA, 
 appform.approvedDateFDA, CASE WHEN appform.approvedDateFDA IS NOT NULL THEN DATE_FORMAT(appform.approvedDateFDA, "%M %d, %Y") ELSE NULL END AS formattedApprovedDateFDA, 
 appform.approvedTimeFDA, CASE WHEN appform.approvedTimeFDA IS NOT NULL THEN DATE_FORMAT(appform.approvedTimeFDA, "%h:%i %p") ELSE NULL END AS formattedApprovedTimeFDA,
 
 appform.isApproveFDAPharma, appform.approvefdaverdpharma, appform.approvedByFDAPharma, appform.approvedIpAddFDAPharma, appform.approvedRemarkFDAPharma, 
 appform.approvedDateFDAPharma, CASE WHEN appform.approvedDateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.approvedDateFDAPharma, "%M %d, %Y") ELSE NULL END AS formattedApprovedDateFDAPharma, 
 appform.approvedTimeFDAPharma, CASE WHEN appform.approvedTimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.approvedTimeFDAPharma, "%h:%i %p") ELSE NULL END AS formattedApprovedTimeFDAPharma, 
 
 appform.pharCOC, appform.pharUp, appform.xrayCOC, appform.xrayUp, 
 appform.isReadyForInspecFDA, appform.isRecoDecision, appform.isRecoDecisionPhar, 
 appform.preApproveDateFDA, appform.preApproveTimeFDA, appform.preApproveDateFDAPharma, appform.preApproveTimeFDAPharma,
 appform.FDAStatMach, appform.FDAStatPhar, appform.proofpaystatMach, appform.proofpaystatPhar, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE appform.appid IN (SELECT appid FROM cdrrhrxraylist)  AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')  AND appform.iscancel='0' 

ORDER BY appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);


/*********** View Pharmacy Status ***************/

DROP VIEW IF EXISTS view_fda_status_summary_pharma;
CREATE VIEW view_fda_status_summary_pharma AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 
appform.proposedInspectiontime, CASE WHEN appform.proposedInspectiontime IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiontime, "%h:%i %p") ELSE NULL END AS formattedTimePropEval, 

appform.recommendedippaddr,  

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.xrayVal, CASE WHEN appform.xrayVal IS NOT NULL THEN DATE_FORMAT(appform.xrayVal, "%M %d, %Y") ELSE NULL END AS formattedXrayValidityDate, 
appform.pharValidity, CASE WHEN appform.pharValidity IS NOT NULL THEN DATE_FORMAT(appform.pharValidity, "%M %d, %Y") ELSE NULL END AS formattedPharmaValidityDate, 
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec, appform.proofpaystat, 

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvalipFDA,
 appform.payEvaldateFDA, CASE WHEN appform.payEvaldateFDA IS NOT NULL THEN DATE_FORMAT(appform.payEvaldateFDA, "%M %d, %Y") ELSE NULL END AS formattedPayEvaldateFDA, 
 appform.payEvaltimeFDA, CASE WHEN appform.payEvaltimeFDA IS NOT NULL THEN DATE_FORMAT(appform.payEvaltimeFDA, "%h:%i %p") ELSE NULL END AS formattedPayEvaltimeFDA,

 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvalipFDAPharma, 
 appform.payEvaldateFDAPharma, CASE WHEN appform.payEvaldateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.payEvaldateFDAPharma, "%M %d, %Y") ELSE NULL END AS formattedPayEvaldateFDAPharma, 
 appform.payEvaltimeFDAPharma, CASE WHEN appform.payEvaltimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.payEvaltimeFDAPharma, "%h:%i %p") ELSE NULL END AS formattedPayEvaltimeFDAPharma,
 
 appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveIpFDA,
 appform.CashierApproveDateFDA, CASE WHEN appform.CashierApproveDateFDA IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDateFDA, "%M %d, %Y") ELSE NULL END AS formattedCashierApproveDateFDA, 
 appform.CashierApproveTimeFDA, CASE WHEN appform.CashierApproveTimeFDA IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTimeFDA, "%h:%i %p") ELSE NULL END AS formattedCashierApproveTimeFDA, 
 
 appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveIpPharma,
 appform.CashierApproveDatePharma, CASE WHEN appform.CashierApproveDatePharma IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDatePharma, "%M %d, %Y") ELSE NULL END AS formattedCashierApproveDatePharma, 
 appform.CashierApproveTimePharma, CASE WHEN appform.CashierApproveTimePharma IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTimePharma, "%h:%i %p") ELSE NULL END AS formattedCashierApproveTimePharma,
 
 appform.ispreassessed, appform.ispreassessedby, appform.ispreassessedip, 
 appform.ispreassesseddate, CASE WHEN appform.ispreassesseddate IS NOT NULL THEN DATE_FORMAT(appform.ispreassesseddate, "%M %d, %Y") ELSE NULL END AS formattedIsPreassessedDate, 
 appform.ispreassessedtime, CASE WHEN appform.ispreassessedtime IS NOT NULL THEN DATE_FORMAT(appform.ispreassessedtime, "%h:%i %p") ELSE NULL END AS formattedIsPreassessedTime,
 
 appform.ispreassessedpharma, appform.ispreassessedbypharma, appform.ispreassessedippharma, 
 appform.ispreassesseddatepharma, CASE WHEN appform.ispreassesseddatepharma IS NOT NULL THEN DATE_FORMAT(appform.ispreassesseddatepharma, "%M %d, %Y") ELSE NULL END AS formattedIsPreassessedDatePharma, 
 appform.ispreassessedtimepharma, CASE WHEN appform.ispreassessedtimepharma IS NOT NULL THEN DATE_FORMAT(appform.ispreassessedtimepharma, "%h:%i %p") ELSE NULL END AS formattedIsPreassessedTimePharma, 
 
 appform.isrecommendedFDA, appform.recommendedbyFDA, appform.recommendedippaddrFDA, 
 appform.recommendeddateFDA, CASE WHEN appform.recommendeddateFDA IS NOT NULL THEN DATE_FORMAT(appform.recommendeddateFDA, "%M %d, %Y") ELSE NULL END AS formattedRecommendedDateFDA, 
 appform.recommendedtimeFDA, CASE WHEN appform.recommendedtimeFDA IS NOT NULL THEN DATE_FORMAT(appform.recommendedtimeFDA, "%h:%i %p") ELSE NULL END AS formattedRecommendedTimeFDA,
 
 appform.isrecommendedFDAPharma, appform.recommendedbyFDAPharma, appform.recommendedippaddrFDAPharma, 
 appform.recommendeddateFDAPharma, CASE WHEN appform.recommendeddateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.recommendeddateFDAPharma, "%M %d, %Y") ELSE NULL END AS formattedRecommendedDateFDAPharma, 
 appform.recommendedtimeFDAPharma, CASE WHEN appform.recommendedtimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.recommendedtimeFDAPharma, "%h:%i %p") ELSE NULL END AS formattedRecommendedTimeFDAPharma,
 
 appform.isRecoFDA, appform.RecobyFDA, appform.RecoippaddrFDA, appform.RecoRemarkFDA, 
 appform.RecodateFDA, CASE WHEN appform.RecodateFDA IS NOT NULL THEN DATE_FORMAT(appform.RecodateFDA, "%M %d, %Y") ELSE NULL END AS formattedRecoDateFDA, 
 appform.RecotimeFDA, CASE WHEN appform.RecotimeFDA IS NOT NULL THEN DATE_FORMAT(appform.RecotimeFDA, "%h:%i %p") ELSE NULL END AS formattedRecoTimeFDA,
 
 appform.isRecoFDAPhar, appform.RecobyFDAPhar, appform.RecoippaddrFDAPhar, appform.RecoRemarkFDAPhar, 
 appform.RecodateFDAPhar, CASE WHEN appform.RecodateFDAPhar IS NOT NULL THEN DATE_FORMAT(appform.RecodateFDAPhar, "%M %d, %Y") ELSE NULL END AS formattedRecoDateFDAPhar, 
 appform.RecotimeFDAPhar, CASE WHEN appform.RecotimeFDAPhar IS NOT NULL THEN DATE_FORMAT(appform.RecotimeFDAPhar, "%h:%i %p") ELSE NULL END AS formattedRecoTimeFDAPhar,
 
 appform.isApproveFDA, appform.approvefdaverd, appform.approvedByFDA, appform.approvedIpAddFDA,  appform.approvedRemarkFDA, 
 appform.approvedDateFDA, CASE WHEN appform.approvedDateFDA IS NOT NULL THEN DATE_FORMAT(appform.approvedDateFDA, "%M %d, %Y") ELSE NULL END AS formattedApprovedDateFDA, 
 appform.approvedTimeFDA, CASE WHEN appform.approvedTimeFDA IS NOT NULL THEN DATE_FORMAT(appform.approvedTimeFDA, "%h:%i %p") ELSE NULL END AS formattedApprovedTimeFDA,
 
 appform.isApproveFDAPharma, appform.approvefdaverdpharma, appform.approvedByFDAPharma, appform.approvedIpAddFDAPharma, appform.approvedRemarkFDAPharma, 
 appform.approvedDateFDAPharma, CASE WHEN appform.approvedDateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.approvedDateFDAPharma, "%M %d, %Y") ELSE NULL END AS formattedApprovedDateFDAPharma, 
 appform.approvedTimeFDAPharma, CASE WHEN appform.approvedTimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.approvedTimeFDAPharma, "%h:%i %p") ELSE NULL END AS formattedApprovedTimeFDAPharma, 
 
 appform.pharCOC, appform.pharUp, appform.xrayCOC, appform.xrayUp, 
 appform.isReadyForInspecFDA, appform.isRecoDecision, appform.isRecoDecisionPhar, 
 appform.preApproveDateFDA, appform.preApproveTimeFDA, appform.preApproveDateFDAPharma, appform.preApproveTimeFDAPharma,
 appform.FDAStatMach, appform.FDAStatPhar, appform.proofpaystatMach, appform.proofpaystatPhar, FDAstatus   

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE (( appform.noofstation IS NOT NULL AND appform.noofstation > 0) OR ( appform.noofmain IS NOT NULL   AND appform.noofmain > 0))  AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')  AND appform.iscancel='0' 

ORDER BY appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);

/***********  Preassess FDA  ***************/

DROP VIEW IF EXISTS view_fda_preassessed;
CREATE VIEW view_fda_preassessed AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE  (appform.ispreassessed IS NULL  OR appform.ispreassessed=2)  AND appform.savingStat='final' AND appform.isPayEvalFDA=1 AND appform.appid IN (SELECT appid FROM cdrrhrxraylist)  AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')  AND appform.iscancel='0' 

ORDER BY appform.updated_at DESC, appform.appid DESC
);
 


/***********  Preassess FDA Pharma ***************/

DROP VIEW IF EXISTS view_fda_preassessed_pharma;
CREATE VIEW view_fda_preassessed_pharma AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE  (appform.ispreassessedpharma IS NULL  OR appform.ispreassessedpharma=2)  AND appform.savingStat='final' AND appform.isPayEvalFDAPharma=1 
AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR') AND  
(( appform.noofstation IS NOT NULL AND appform.noofstation > 0) OR ( appform.noofmain IS NOT NULL   AND appform.noofmain > 0))   AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);



/***********  FDA EVALUATE Machine ***************/

DROP VIEW IF EXISTS view_fda_evaluate;
CREATE VIEW view_fda_evaluate AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE  appform.ispreassessed=1  AND appform.savingStat='final'  AND  appform.isReadyForInspecFDA=1 
AND ((appform.isCashierApproveFDA=1 AND (appform.proofpaystatMach!='posting' OR appform.proofpaystatMach!='insufficient') ) AND appform.FDAStatMach != 'COC Still Valid') 
AND (appform.isrecommendedFDA IS NULL OR appform.isrecommendedFDA=2 OR appform.isRecoDecision = 'Return for Correction')  
AND appform.appid IN (SELECT appid FROM cdrrhrxraylist)   AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);


/***********  FDA EVALUATE Pharmacy ***************/

DROP VIEW IF EXISTS view_fda_evaluate_pharma;
CREATE VIEW view_fda_evaluate_pharma AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.FDAstatus=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE  
	(
		(	
			appform.isReadyForInspecFDA=1	
			AND (
					(appform.isCashierApprovePharma=1 AND (appform.proofpaystatPhar!='posting' OR appform.proofpaystatPhar!='insufficient') ) 
					AND appform.FDAStatPhar != 'COC Still Valid'
				) 
			AND (appform.isrecommendedFDAPharma IS NULL OR appform.isrecommendedFDAPharma=2 OR appform.isRecoDecision = 'Return for Correction')
		)	
		OR	
		(	appform.FDAStatPhar = "For Notice of Deficiency"	)
	)	
	AND appform.savingStat='final' AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')  
	AND (	( appform.noofstation IS NOT NULL AND appform.noofstation > 0) OR ( appform.noofmain IS NOT NULL   AND appform.noofmain > 0)	) 
	AND appform.iscancel='0' 
	
ORDER BY appform.updated_at DESC, appform.appid DESC
);



/***********  FDA Cashier ***************/
DROP VIEW IF EXISTS view_fda_cashier;
CREATE VIEW view_fda_cashier AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE  appform.ispreassessed=1 AND appform.isPayEvalFDA=1   AND appform.FDAStatMach != 'COC Still Valid' AND appform.appid IN (SELECT appid FROM cdrrhrxraylist)  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);


/***********  FDA Cashier Pharma ***************/
DROP VIEW IF EXISTS view_fda_cashier_pharma;
CREATE VIEW view_fda_cashier_pharma AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE  appform.ispreassessedpharma=1 AND appform.isPayEvalFDAPharma=1   AND appform.FDAStatPhar != 'COC Still Valid' AND  appform.isReadyForInspecFDA=1 AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')  AND  
(( appform.noofstation IS NOT NULL AND appform.noofstation > 0) OR ( appform.noofmain IS NOT NULL   AND appform.noofmain > 0))  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);



/***********  FDA Recommendation ***************/
DROP VIEW IF EXISTS view_fda_reco;
CREATE VIEW view_fda_reco AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus        

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE 
(
	appform.isRecoDecision = 'Return for Correction'  OR 
   (
		appform.isPayEvalFDA=1 AND appform.isrecommendedFDA=1  AND
		((appform.isCashierApproveFDA=1 AND (appform.proofpaystatMach!='posting' OR appform.proofpaystatMach!='insufficient') ) AND appform.FDAStatMach != 'COC Still Valid')  AND
	   appform.isRecoFDA IS NULL  AND appform.isApproveFDA IS NULL
   )  
) 
AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')   
AND appform.appid IN (SELECT DISTINCT appid FROM cdrrhrxraylist)
AND appform.appid NOT IN (SELECT DISTINCT appid FROM fdaevaluation WHERE requestFrom='cdrrhr' AND decision='RFC')
 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);


/***********  FDA Recomnedation Pharma ***************/
DROP VIEW IF EXISTS view_fda_reco_pharma;
CREATE VIEW view_fda_reco_pharma AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE 
(
	appform.isRecoDecisionPhar = 'Return for Correction'  OR 
   (
		appform.isPayEvalFDAPharma=1 AND appform.isrecommendedFDAPharma=1  AND
		((appform.isCashierApprovePharma=1 AND (appform.proofpaystatPhar!='posting' OR appform.proofpaystatPhar!='insufficient') ) AND appform.FDAStatPhar != 'COC Still Valid')  AND
	   appform.isRecoFDAPhar IS NULL  AND appform.isApproveFDAPharma IS NULL
   )  
) 
AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')   
AND ( ( appform.noofstation IS NOT NULL AND appform.noofstation > 0) OR ( appform.noofmain IS NOT NULL   AND appform.noofmain > 0)  )  	
AND appform.appid IN (SELECT DISTINCT appid FROM cdrrpersonnel WHERE isTag!='1')
AND appform.appid NOT IN (SELECT DISTINCT appid FROM fdaevaluation WHERE requestFrom='cdrr' AND decision='RFC')
	 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);




/***********  FDA Approval ***************/
DROP VIEW IF EXISTS view_fda_approval;
CREATE VIEW view_fda_approval AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus        

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE 

appform.isPayEvalFDA=1 AND appform.isrecommendedFDA=1  AND
((appform.isCashierApproveFDA=1 AND (appform.proofpaystatMach!='posting' OR appform.proofpaystatMach!='insufficient') ) AND appform.FDAStatMach != 'COC Still Valid')  AND appform.isRecoFDA=1  AND appform.isApproveFDA IS NULL

AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')   
AND appform.appid IN (SELECT DISTINCT appid FROM cdrrhrxraylist)
AND appform.appid NOT IN (SELECT DISTINCT appid FROM fdaevaluation WHERE requestFrom='cdrrhr' AND decision='RFC')
 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);


/***********  FDA Approval Pharma ***************/
DROP VIEW IF EXISTS view_fda_approval_pharma;
CREATE VIEW view_fda_approval_pharma AS
(
SELECT 
/* Application Details */
appform.appid, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc, appform.nhfcode, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, subclass.classname AS subclassname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag, appform.submittedReq,

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 


appform.isInspected, appform.isrecommended,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,

/*FDA Back Office */
 appform.isPayEvalFDA, appform.payEvalbyFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA,
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, appform.FDAStatMach , appform.FDAStatPhar, appform.proofpaystatMach, appform.isReadyForInspecFDA, appform.proofpaystatPhar,
appform.isrecommendedFDAPharma, appform.isrecommendedFDA, appform.isRecoFDA, appform.isRecoFDAPhar, isRecoDecisionPhar, appform.isRecoDecision, appform.isApproveFDAPharma, appform.isApproveFDA, FDAstatus    

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN x08 ON appform.uid=x08.uid
LEFT JOIN barangay ON appform.brgyid=barangay.brgyid
LEFT JOIN city_muni ON appform.cmid=city_muni.cmid
LEFT JOIN province ON appform.provid=province.provid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN class subclass ON appform.subClassid=subclass.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid

WHERE 

appform.isPayEvalFDAPharma=1 AND appform.isrecommendedFDAPharma=1  AND
((appform.isCashierApprovePharma=1 AND (appform.proofpaystatPhar!='posting' OR appform.proofpaystatPhar!='insufficient') ) AND appform.FDAStatPhar != 'COC Still Valid')  
AND appform.isRecoFDAPhar=1  AND appform.isApproveFDAPharma IS NULL

AND appform.hfser_id IN ('COA', 'LTO', 'ATO', 'COR')   
AND ( ( appform.noofstation IS NOT NULL AND appform.noofstation > 0) OR ( appform.noofmain IS NOT NULL   AND appform.noofmain > 0)  )  	
AND appform.appid IN (SELECT DISTINCT appid FROM cdrrpersonnel WHERE isTag!='1')
AND appform.appid NOT IN (SELECT DISTINCT appid FROM fdaevaluation WHERE requestFrom='cdrr' AND decision='RFC')
	 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.appid DESC
);