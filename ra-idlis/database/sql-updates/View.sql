DROP VIEW IF EXISTS applist_details;
CREATE VIEW applist_details AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.status, trans_status.trns_desc, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, hfaci_serv_type.old_appcode, hfaci_serv_type.terms_condi, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, funcapf.funcdesc, appform.facmode, facmode.facmdesc,

/*Contact Details */
appform.owner, appform.mailingAddress, 
CASE WHEN appform.street_number !='N/A' THEN appform.street_number  ELSE '' END AS street_number, appform.street_name, appform.street_name as streetname, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag,

appform.ipaddress, appform.draft,  appform.savedRenewalOpt,appform.savingStat,  
appform.appid_payment, 

/*DOH Back Office */
appform.isPayEval, appform.payEvaldate, appform.payEvaltime, appform.payEvalip, appform.payEvalby, 
appform.CashierApproveIp,  appform.payProofFilen, appform.isPayProofFilen, appform.proofpaystat, 

appform.isReadyForInspec, appform.ispreassessed, appform.ispreassessedby, appform.ispreassessedtime, appform.ispreassesseddate, appform.ispreassessedip, 

appform.proposedWeek, appform.proposedTime, 
appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 
appform.proposedInspectiontime, CASE WHEN appform.proposedInspectiontime IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiontime, "%h:%i %p") ELSE NULL END AS formattedTimePropEval, 
CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedPropDate, 
CASE WHEN appform.proposedInspectiontime IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiontime, "%h:%i %p") ELSE NULL END AS formattedPropTime, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.inspectedipaddr,   appform.recommendedippaddr, appform.approvedIpAdd, appform.approvedRemark,
appform.isRecoForApproval, appform.RecoForApprovalby, appform.RecoForApprovalTime, appform.RecoForApprovalDate, appform.RecoForApprovalIpAdd, 

appform.conTeam, appform.ptcTeam, appform.assignedLO, appform.assignedLOTime, appform.assignedLoDate, appform.assignedLOIP, appform.assignedLOBy, 
appform.submittedReq, appform.appComment, appform.con_number, appform.requestReeval, appform.reevalcount, appform.corResubmit, appform.no_chklist, 
appform.concommittee_eval, appform.concommittee_evaltime, appform.concommittee_evaldate, appform.concommittee_evalby,
appform.isAcceptedFP, appform.fpcomment, appform.FPacceptedDate, appform.FPacceptedTime, appform.FPacceptedBy, 
ptc.propbedcap AS pbedcap, appform.HFERC_swork, appform.isNotified, appform.others_oanc, 
/* check if it has assessors */
CASE WHEN (SELECT COUNT(*) FROM app_team WHERE appid=appform.appid)>0 THEN 'T' ELSE 'F' END AS hasAssessors,

 /* FDA */ 
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, 
appform.FDAstatus,
appform.payProofFilenMach, appform.ispayProofFilenMach, appform.payProofFilenPhar, appform.ispayProofFilenPhar, appform.proofpaystatMach, appform.proofpaystatPhar, appform.FDAStatMach, appform.FDAStatPhar, 
appform.ispreassessedpharma, appform.ispreassessedbypharma, appform.ispreassessedtimepharma, appform.ispreassesseddatepharma, appform.ispreassessedippharma, 
appform.isReadyForInspecFDA, 
appform.isRecoDecisionPhar, appform.corResubmitPhar, appform.isRecoFDAPhar, appform.RecobyFDAPhar, appform.RecodateFDAPhar, appform.RecotimeFDAPhar, appform.RecoippaddrFDAPhar, appform.RecoRemarkFDAPhar, 
appform.machDocNeedRev, appform.machDocRevcount, appform.pharDocNeedRev, appform.pharDocRevcount, 
appform.preApproveTimeFDA, appform.preApproveDateFDA, appform.preApproveTimeFDAPharma, appform.preApproveDateFDAPharma,  appform.no_chklistFDA, 
appform.isrecommendedFDA, appform.recommendedbyFDA, appform.recommendedtimeFDA, appform.recommendeddateFDA, appform.recommendedippaddrFDA, appform.isrecommendedFDAPharma, appform.recommendedbyFDAPharma, appform.recommendedtimeFDAPharma, appform.recommendeddateFDAPharma, appform.recommendedippaddrFDAPharma, 
appform.isPayEvalFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA, appform.payEvalbyFDA, appform.isRecoFDA, appform.isRecoDecision, appform.RecobyFDA, appform.RecotimeFDA, appform.RecodateFDA, appform.RecoippaddrFDA, appform.RecoRemarkFDA, appform.RecoRemark, appform.isApproveFDA, appform.approvefdaverd, appform.approvedByFDA, appform.approvedDateFDA, appform.approvedTimeFDA, appform.approvedIpAddFDA, appform.approvedRemarkFDA, appform.isApproveFDAPharma, appform.approvefdaverdpharma, appform.approvedByFDAPharma, appform.approvedDateFDAPharma, appform.approvedTimeFDAPharma, appform.approvedIpAddFDAPharma, appform.approvedRemarkFDAPharma, appform.pharValidity, appform.xrayVal, 
appform.pharCOC, appform.pharUp, appform.xrayCOC, appform.xrayUp, 

/*Validity and License No. */
appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime, 
appform.licenseNo, appform.validDate, appform.validDateFrom, 

signatoryname, signatorypos, asrgn.rgn_desc AS assRgnDesc, asrgn.office, asrgn.address, asrgn.iso_desc, 
trans_status.allowedpayment, trans_status.canapply, appform.ocdesc as appformocdesc

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
LEFT JOIN funcapf ON appform.funcid=funcapf.funcid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN ptc ON ptc.appid=appform.appid

LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
ORDER BY appform.updated_at DESC, appform.t_date DESC, appform.appid DESC, appform.aptid ASC
);


DROP VIEW IF EXISTS applist_simple;
CREATE VIEW applist_details AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.status, trans_status.trns_desc, appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, hfaci_serv_type.old_appcode, hfaci_serv_type.terms_condi, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, funcapf.funcdesc, appform.facmode, facmode.facmdesc,

/*Contact Details */
appform.owner, appform.mailingAddress, 
CASE WHEN appform.street_number !='N/A' THEN appform.street_number  ELSE '' END AS street_number, appform.street_name, appform.street_name as streetname, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, x08.authorizedsignature, 

/* Other Details */
appform.noofbed, appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain, appform.conCode, appform.ptcCode, 
appform.cap_inv, appform.lot_area, appform.typeamb, appform.ambtyp, appform.plate_number, appform.ambOwner,  appform.noofamb, 
appform.addonDesc, appform.clab,  appform.documentSent,  appform.ishfep, appform.hfep_funded, appform.coaflag,

appform.ipaddress, appform.draft,  appform.savedRenewalOpt,appform.savingStat,  
appform.appid_payment, 

/*DOH Back Office */
appform.isPayEval, appform.payEvaldate, appform.payEvaltime, appform.payEvalip, appform.payEvalby, 
appform.CashierApproveIp,  appform.payProofFilen, appform.isPayProofFilen, appform.proofpaystat, 

appform.isReadyForInspec, appform.ispreassessed, appform.ispreassessedby, appform.ispreassessedtime, appform.ispreassesseddate, appform.ispreassessedip, 

appform.proposedWeek, appform.proposedTime, 
appform.proposedInspectiondate, CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedDatePropEval, 
appform.proposedInspectiontime, CASE WHEN appform.proposedInspectiontime IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiontime, "%h:%i %p") ELSE NULL END AS formattedTimePropEval, 
CASE WHEN appform.proposedInspectiondate IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiondate, "%M %d, %Y") ELSE NULL END AS formattedPropDate, 
CASE WHEN appform.proposedInspectiontime IS NOT NULL THEN DATE_FORMAT(appform.proposedInspectiontime, "%h:%i %p") ELSE NULL END AS formattedPropTime, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.inspectedipaddr,   appform.recommendedippaddr, appform.approvedIpAdd, appform.approvedRemark,
appform.isRecoForApproval, appform.RecoForApprovalby, appform.RecoForApprovalTime, appform.RecoForApprovalDate, appform.RecoForApprovalIpAdd, 

appform.conTeam, appform.ptcTeam, appform.assignedLO, appform.assignedLOTime, appform.assignedLoDate, appform.assignedLOIP, appform.assignedLOBy, 
appform.submittedReq, appform.appComment, appform.con_number, appform.requestReeval, appform.reevalcount, appform.corResubmit, appform.no_chklist, 
appform.concommittee_eval, appform.concommittee_evaltime, appform.concommittee_evaldate, appform.concommittee_evalby,
appform.isAcceptedFP, appform.fpcomment, appform.FPacceptedDate, appform.FPacceptedTime, appform.FPacceptedBy, 
ptc.propbedcap AS pbedcap, appform.HFERC_swork, appform.isNotified, appform.others_oanc, 
/* check if it has assessors */
CASE WHEN (SELECT COUNT(*) FROM app_team WHERE appid=appform.appid)>0 THEN 'T' ELSE 'F' END AS hasAssessors,

 /* FDA */ 
 appform.isPayEvalFDAPharma, appform.payEvalbyFDAPharma, appform.payEvaldateFDAPharma, appform.payEvaltimeFDAPharma, appform.payEvalipFDAPharma, appform.isCashierApproveFDA, appform.CashierApproveByFDA, appform.CashierApproveDateFDA, appform.CashierApproveTimeFDA, appform.CashierApproveIpFDA, appform.isCashierApprovePharma, appform.CashierApproveByPharma, appform.CashierApproveDatePharma, appform.CashierApproveTimePharma, appform.CashierApproveIpPharma, 
appform.FDAstatus,
appform.payProofFilenMach, appform.ispayProofFilenMach, appform.payProofFilenPhar, appform.ispayProofFilenPhar, appform.proofpaystatMach, appform.proofpaystatPhar, appform.FDAStatMach, appform.FDAStatPhar, 
appform.ispreassessedpharma, appform.ispreassessedbypharma, appform.ispreassessedtimepharma, appform.ispreassesseddatepharma, appform.ispreassessedippharma, 
appform.isReadyForInspecFDA, 
appform.isRecoDecisionPhar, appform.corResubmitPhar, appform.isRecoFDAPhar, appform.RecobyFDAPhar, appform.RecodateFDAPhar, appform.RecotimeFDAPhar, appform.RecoippaddrFDAPhar, appform.RecoRemarkFDAPhar, 
appform.machDocNeedRev, appform.machDocRevcount, appform.pharDocNeedRev, appform.pharDocRevcount, 
appform.preApproveTimeFDA, appform.preApproveDateFDA, appform.preApproveTimeFDAPharma, appform.preApproveDateFDAPharma,  appform.no_chklistFDA, 
appform.isrecommendedFDA, appform.recommendedbyFDA, appform.recommendedtimeFDA, appform.recommendeddateFDA, appform.recommendedippaddrFDA, appform.isrecommendedFDAPharma, appform.recommendedbyFDAPharma, appform.recommendedtimeFDAPharma, appform.recommendeddateFDAPharma, appform.recommendedippaddrFDAPharma, 
appform.isPayEvalFDA, appform.payEvaldateFDA, appform.payEvaltimeFDA, appform.payEvalipFDA, appform.payEvalbyFDA, appform.isRecoFDA, appform.isRecoDecision, appform.RecobyFDA, appform.RecotimeFDA, appform.RecodateFDA, appform.RecoippaddrFDA, appform.RecoRemarkFDA, appform.RecoRemark, appform.isApproveFDA, appform.approvefdaverd, appform.approvedByFDA, appform.approvedDateFDA, appform.approvedTimeFDA, appform.approvedIpAddFDA, appform.approvedRemarkFDA, appform.isApproveFDAPharma, appform.approvefdaverdpharma, appform.approvedByFDAPharma, appform.approvedDateFDAPharma, appform.approvedTimeFDAPharma, appform.approvedIpAddFDAPharma, appform.approvedRemarkFDAPharma, appform.pharValidity, appform.xrayVal, 
appform.pharCOC, appform.pharUp, appform.xrayCOC, appform.xrayUp, 

/*Validity and License No. */
appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime, 
appform.licenseNo, appform.validDate, appform.validDateFrom, 

signatoryname, signatorypos, asrgn.rgn_desc AS assRgnDesc, asrgn.office, asrgn.address, asrgn.iso_desc, 
trans_status.allowedpayment, trans_status.canapply, appform.ocdesc as appformocdesc

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
LEFT JOIN funcapf ON appform.funcid=funcapf.funcid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN ptc ON ptc.appid=appform.appid

LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
ORDER BY appform.updated_at DESC, appform.t_date DESC, appform.appid DESC, appform.aptid ASC
);


/**********  View Application Status   **********/
DROP VIEW IF EXISTS view_app_status_summary;
CREATE VIEW view_app_status_summary AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
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

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

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

LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby

ORDER BY appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);

/**********  Documentary Evaluation List   **********/

DROP VIEW IF EXISTS app_documentary_evaluation_list;
CREATE VIEW app_documentary_evaluation_list AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 
appform.documentSent,  appform.recommendedippaddr,  

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/


appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*DOH Back Office */
ptc.propbedcap AS pbedcap, appform.noofbed, appform.appid_payment, appform.isPayEval, appform.isReadyForInspec

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
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
LEFT JOIN ptc ON ptc.appid=appform.appid
WHERE 
(appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND 
	(
		(
			(appform.hfser_id='CON' AND isrecommended = 2 AND  appform.status = 'REV' )
			OR (appform.hfser_id='PTC' AND isReadyForInspec = 0 AND  appform.status = 'REV' ) 
			OR (appform.hfser_id='PTC' AND submittedReq != 1 ) 
			OR (appform.hfser_id !='CON' AND appform.hfser_id!='PTC' AND appform.isCashierApprove!='1')
		) = false
		OR
		(appform.hfser_id='PTC' AND appform.status='REV')
	)  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC, appform.t_date DESC, appform.appid DESC, appform.aptid ASC
);


/**********  Technical Evaluation List   **********/
DROP VIEW IF EXISTS app_technical_evaluation_list;
CREATE VIEW app_technical_evaluation_list AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, appform.facmode, appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.zipcode, appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos,  x08.authorizedsignature, 
appform.documentSent, appform.recommendedippaddr, 

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec

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
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE 
(appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id!='PTC'  
AND (appform.isCashierApprove='1'  OR appform.aptid ='R' OR appform.isReadyForInspec = '1' OR appform.isrecommended ='2')  
AND  (
    (appform.hfser_id='CON' AND isrecommended = 2 AND  appform.status = 'REV' ) 
    OR (appform.hfser_id='PTC' AND isReadyForInspec = 0 AND  appform.status = 'REV' ) 
    OR (appform.hfser_id='PTC' AND submittedReq != 1 ) 
    OR (appform.hfser_id !='CON' AND appform.hfser_id!='PTC' AND appform.isCashierApprove!='1')
) = false 
 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC, appform.updated_at DESC, appform.t_date DESC, appform.appid DESC, appform.aptid ASC
);


/**********  HFERC Operation List   **********/
DROP VIEW IF EXISTS app_assignmentofhferc_max_rev;
DROP VIEW IF EXISTS app_assignmentofhferc;


CREATE VIEW app_assignmentofhferc AS
(
SELECT DISTINCT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc,  appform.rgnid, region.rgn_desc, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

CASE WHEN hferc_evaluation.HFERC_evalDate IS NOT NULL  THEN DATE_FORMAT(hferc_evaluation.HFERC_evalDate, "%M %d, %Y")  ELSE NULL END AS formattedHFERC_evalDate,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,
/*********** Important Dates ***************/

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
 appform.isPayEval, appform.isReadyForInspec,
 
 hferc_evaluation.revision AS revision,

ROW_NUMBER() OVER (PARTITION BY appform.appid ORDER BY hferc_evaluation.revision desc)  AS toplevel

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid
LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
LEFT JOIN hferc_evaluation ON hferc_evaluation.appid=appform.appid
WHERE 
(appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id='PTC' AND  appform.isCashierApprove='1' AND appform.isrecommended='1' AND appform.isPayEval='1' AND appform.isInspected IS NULL AND appform.iscancel='0' 

ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC, appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);




/* HFERC Operation List  Max Rev */
CREATE VIEW app_assignmentofhferc_max_rev AS
(
SELECT DISTINCT *
FROM app_assignmentofhferc
WHERE toplevel = 1

ORDER BY updated_at DESC, recommendeddate DESC, recommendedtime DESC, updated_at DESC, appid DESC, aptid ASC
);


/**********  END OF HFERC Operation List  **********/



/**********  Assignment Of Team   **********/
DROP VIEW IF EXISTS app_assignment_of_team;
CREATE VIEW app_assignment_of_team AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid, appform.facmode,

/*Contact Details */
appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, x08.authorizedsignature, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*********** Important Dates ***************/

/* check if it has assessors */
CASE WHEN (SELECT COUNT(*) FROM app_team WHERE appid=appform.appid)>0 THEN 'T' ELSE 'F' END AS hasAssessors,

/*DOH Back Office */
appform.appid_payment, appform.isPayEval,  appform.isReadyForInspec

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
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE 
(appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND  appform.isCashierApprove='1'
AND appform.hfser_id IN ('LTO','COA', 'ATO', 'COR') AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC, appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);




/**********  Inspection Schedule   **********/
DROP VIEW IF EXISTS app_inspection_schedule;
CREATE VIEW app_inspection_schedule AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */
appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, x08.authorizedsignature, 
appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain,

appform.proposedWeek, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*********** Important Dates ***************/


/* check if it has assessors */
CASE WHEN (SELECT COUNT(*) FROM app_team WHERE appid=appform.appid)>0 THEN 'T' ELSE 'F' END AS hasAssessors,

/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec,
appform.proofpaystatMach, appform.proofpaystatPhar, appform.FDAStatMach, appform.FDAStatPhar 

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
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE 
(appform.status!='A' AND appform.status!='NA') AND appform.aptid != 'R' AND appform.savingStat='final' AND  appform.isCashierApprove='1' AND appform.isReadyForInspec='1' AND appform.isPayEval='1'
AND appform.hfser_id IN ('LTO','COA', 'ATO', 'COR') AND appform.iscancel='0' 
ORDER BY  appform.updated_at DESC, appform.inspecteddate DESC, appform.inspectedtime DESC, appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);



/**********   Facility for Assessment  **********/
DROP VIEW IF EXISTS app_facility_for_assessment;
CREATE VIEW app_facility_for_assessment AS
(
SELECT DISTINCT
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc,appform.status AS status, trans_status.trns_desc,  aptm.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */
appform.owner, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

appform.proposedWeek, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 


appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*DOH Back Office */
appform.appid_payment, appform.isPayEval

FROM  app_team aptm  LEFT JOIN appform ON aptm.appid=appform.appid
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

WHERE 
(appform.status!='A' AND appform.status!='NA') AND appform.aptid != 'R' AND appform.savingStat='final' AND  appform.isCashierApprove='1' AND appform.isReadyForInspec='1' AND appform.isPayEval='1'
AND appform.hfser_id IN ('LTO','COA', 'ATO', 'COR') AND appform.proposedWeek IS NOT NULL AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.inspecteddate DESC, appform.inspectedtime DESC, appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);


/**********    Recommendation for Approval  **********/
DROP VIEW IF EXISTS app_recommendation_for_approval_old;
CREATE VIEW app_recommendation_for_approval_old AS
(
SELECT 
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, x08.authorizedsignature, 
appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain,

appform.proposedWeek, 

appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, CONCAT(evaluator.fname, ' ', evaluator.mname, ' ', evaluator.lname) AS recommendedbyName, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec, 
appform.requestReeval

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
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE 
(	appform.status!='A' AND appform.status!='NA'  AND appform.savingStat='final' AND  appform.isCashierApprove='1' 	) 
AND 
(
	(
		(
			(appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND  appform.isCashierApprove='1' AND appform.hfser_id = 'PTC' 
			AND (SELECT COUNT(*) FROM hferc_evaluation WHERE appid=appform.appid)=0
		) = TRUE OR
		(
			(appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND  appform.isCashierApprove='1' AND appform.isApprove IS NOT NULL 
			AND appform.requestReeval != '1' 
		) = TRUE
	) = FALSE OR
	appform.status='FC'
)
AND (appform.status='FA' OR  appform.status='RDA'  OR appform.status='FRDD' OR  appform.status='FC' OR appform.status='FR' OR appform.aptid='R'   OR appform.aptid='IC' OR appform.hfser_id='PTC') 
/*AND (appform.isRecoForApproval IS NULL OR appform.isRecoForApproval='') */
AND appform.payEvaldate IS NOT NULL
 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.inspecteddate DESC, appform.inspectedtime DESC,  appform.recommendeddate DESC, appform.recommendedtime DESC,  
	appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);



/**********    Recommendation for Approval  **********/
DROP VIEW IF EXISTS app_recommendation_for_approval;
CREATE VIEW app_recommendation_for_approval AS
(
SELECT 
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

appform.owner, appform.mailingAddress, 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, x08.authorizedsignature, 
appform.noofstation, appform.noofsatellite, appform.noofdialysis, appform.noofmain,

appform.proposedWeek, 

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

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


/*DOH Back Office */
appform.appid_payment, appform.isPayEval, appform.isReadyForInspec, 
appform.requestReeval

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
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
LEFT JOIN x08 evaluator ON evaluator.uid=appform.recommendedby
WHERE 
(
	appform.status!='A' AND appform.status!='NA'  AND appform.savingStat='final' AND  appform.isCashierApprove='1'  AND 
	(
		appform.status='FA' OR  appform.status='RDA'  OR appform.status='FRDD' OR  appform.status='FC' OR appform.status='FR' OR appform.aptid='R'   OR appform.aptid='IC' OR appform.hfser_id='PTC'
	) AND appform.payEvaldate IS NOT NULL AND appform.iscancel='0' 
)
OR 
(
	(appform.status!='A' AND appform.status!='NA'  AND appform.savingStat='final' AND  appform.isCashierApprove='1' ) OR appform.status='FC'  OR
	(
		((appform.isApprove IS NOT NULL AND  appform.isCashierApprove='1' AND appform.hfser_id = 'PTC' AND (SELECT COUNT(appid) FROM hferc_evaluation WHERE appid=appform.appid)=0) = TRUE 
		OR (appform.isApprove IS NOT NULL AND  appform.isCashierApprove='1' AND appform.requestReeval != '1' ) = TRUE) = FALSE 
	)
)
/*AND (appform.isRecoForApproval IS NULL OR appform.isRecoForApproval='') */

ORDER BY appform.updated_at DESC, appform.inspecteddate DESC, appform.inspectedtime DESC,  appform.recommendeddate DESC, appform.recommendedtime DESC,  
	appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);



/**********    Application for Approval  **********/
DROP VIEW IF EXISTS app_for_approval;
CREATE VIEW app_for_approval AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby,
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status='FA' OR appform.status='RDA' OR appform.status='DND' OR appform.status='FRDD') AND appform.savingStat='final' AND  appform.isCashierApprove='1'  AND  (appform.isApprove IS NULL OR appform.isApprove = '0') AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC,  appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);



/**********    Evaluation Tool  **********/
DROP VIEW IF EXISTS app_evaluation_tool;
CREATE VIEW app_evaluation_tool AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id='PTC' 
	AND appform.isCashierApprove='1' AND appform.isPayEval='1' AND  appform.isrecommended='1' AND appform.isInspected IS NULL  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC,  appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);

/**********    Evaluation Tool Admin  **********/
DROP VIEW IF EXISTS app_evaluation_tool_admin;
CREATE VIEW app_evaluation_tool_admin AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id='PTC' AND appform.isCashierApprove='1'  AND  appform.isrecommended='1' AND appform.isInspected IS NULL  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC, appform.updated_at DESC, appform.appid DESC, appform.aptid ASC
);


/**********    DOH Cashier with Total Payment **********/
DROP VIEW IF EXISTS app_doh_cashier;
CREATE VIEW app_doh_cashier AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, 
appform.owner, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 

appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 

/*DOH Back Office */
appform.ishfep, appform.hfep_funded, 
appform.appid_payment,  appform.isrecommended, appform.isCashierApprove, appform.CashierApproveBy, appform.CashierApproveIp,
appform.CashierApproveTime, 
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,


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
WHERE appform.savingStat='final' AND appform.isPayEval='1' AND 
(appform.hfser_id='PTC' AND appform.isAcceptedFP!='1') =  FALSE  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.CashierApproveDate DESC, appform.CashierApproveTime DESC, appform.updated_at DESC, appform.appid DESC, appform.isCashierApprove ASC, appform.aptid ASC
);

/**********    DOH Cashier Applist Only  **********/
DROP VIEW IF EXISTS app_doh_cashier_listonly;
CREATE VIEW app_doh_cashier_listonly AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ 
appform.street_number, appform.street_name, appform.brgyid, barangay.brgyname, appform.cmid, city_muni.cmname, appform.provid, province.provname, appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, appform.areacode, 
appform.owner, appform.email, appform.contact, appform.landline, appform.faxnumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.approvingauthority, appform.approvingauthoritypos, 

appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 

/*DOH Back Office */
appform.ishfep, appform.hfep_funded, 
appform.appid_payment,  appform.isrecommended, appform.isCashierApprove, appform.CashierApproveBy, appform.CashierApproveIp,
appform.CashierApproveTime, 
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

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
WHERE appform.savingStat='final' AND appform.isPayEval='1' AND 
(appform.hfser_id='PTC' AND appform.isAcceptedFP!='1') =  FALSE  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.CashierApproveDate DESC, appform.CashierApproveTime DESC, appform.updated_at DESC, appform.appid DESC, appform.isCashierApprove ASC, appform.aptid ASC
);


/**********    Committee Assignment  **********/
DROP VIEW IF EXISTS app_committee_assignment;
CREATE VIEW app_committee_assignment AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby,
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,
/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id='CON' AND appform.isPayEval='1' AND appform.isCashierApprove = '1'
AND (SELECT COUNT(*) FROM committee_team WHERE appid=appform.appid AND uid=appform.uid) AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.CashierApproveDate DESC, appform.CashierApproveTime DESC, appform.updated_at DESC, appform.appid DESC, appform.isCashierApprove ASC, appform.aptid ASC
);


/**********    Committee Assignment Admin  **********/
DROP VIEW IF EXISTS app_committee_assignment_admin;
CREATE VIEW app_committee_assignment_admin AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,
/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' 
AND appform.hfser_id='CON' AND appform.isPayEval='1' AND appform.isCashierApprove = '1' AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.CashierApproveDate DESC, appform.CashierApproveTime DESC, appform.updated_at DESC, appform.appid DESC, appform.isCashierApprove ASC, appform.aptid ASC
);


/**********    CON Evaluation  **********/
DROP VIEW IF EXISTS app_con_evaluation;
CREATE VIEW app_con_evaluation AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,
/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id='CON' AND appform.isPayEval='1' AND appform.isrecommended='1' AND appform.isCashierApprove = '1' AND appform.isInspected IS NULL 
AND (SELECT COUNT(*) FROM committee_team WHERE appid=appform.appid AND uid=appform.uid)
 AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.CashierApproveDate DESC, appform.CashierApproveTime DESC, appform.updated_at DESC, appform.isCashierApprove ASC, appform.aptid ASC, appform.appid DESC
);

/**********    CON Evaluation Admin  **********/
DROP VIEW IF EXISTS app_con_evaluation_admin;
CREATE VIEW app_con_evaluation_admin AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,
/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status!='A' AND appform.status!='NA') AND appform.savingStat='final' AND appform.hfser_id='CON' AND appform.isPayEval='1' AND appform.isrecommended='1' AND appform.isCashierApprove = '1' AND appform.isInspected IS NULL  AND appform.iscancel='0' 
ORDER BY  appform.updated_at DESC, appform.CashierApproveDate DESC, appform.CashierApproveTime DESC, appform.updated_at DESC, appform.appid DESC, appform.isCashierApprove ASC, appform.aptid ASC
);



/**********    Failed Application  **********/
DROP VIEW IF EXISTS app_failed;
CREATE VIEW app_failed AS
(
SELECT 
/* Application Details */
appform.appid, appform.regfac_id, appform.nhfcode, appform.aptid, apptype.aptdesc, appform.savingStat, appform.status AS status, trans_status.trns_desc,  appform.uid, appform.facilityname, 
seq_num, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.hgpid, hfaci_grp.hgpdesc, appform.ocid, ownership.ocdesc, appform.classid, class.classname, appform.subClassid, appform.funcid,  appform.facmode, facmode.facmdesc,

/*Contact Details */ appform.rgnid, region.rgn_desc, appform.zipcode, appform.assignedRgn, asrgn.rgn_desc AS asrgn_desc, 

/*********** Important Dates ***************/
appform.t_date, CASE WHEN appform.t_date IS NOT NULL THEN DATE_FORMAT(appform.t_date, "%M %d, %Y") ELSE 'Not officially applied yet.' END AS formattedDate, 
appform.t_time, CASE WHEN appform.t_time IS NOT NULL THEN DATE_FORMAT(appform.t_time, "%h:%i %p") ELSE NULL END AS formattedTime, 

appform.isCashierApprove, appform.CashierApproveBy,
appform.CashierApproveDate, CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS CashierApproveformattedDate, 
appform.CashierApproveTime, CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%M %d, %Y") ELSE NULL END AS formattedCashierTime,

appform.isInspected, appform.inspectedby,
appform.inspecteddate, CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formattedInspectedDate,
appform.inspectedtime, CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%M %d, %Y") ELSE NULL END AS formattedInspectedTime,

appform.isrecommended, appform.recommendedby, 
appform.recommendeddate, CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formattedDateEval, 
appform.recommendedtime, CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formattedTimeEval,

appform.isApprove, appform.approvedBy, 
appform.approvedDate, CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS formattedApprovedDate, 
appform.approvedTime, CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS formattedApprovedTime,

appform.autoTimeDate, appform.created_at, appform.updated_at,
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%M %d, %Y") ELSE NULL END AS formattedUpdatedDate, 
CASE WHEN appform.updated_at IS NOT NULL THEN DATE_FORMAT(appform.updated_at, "%h:%i %p") ELSE NULL END AS formattedUpatedTime,

/*********** Important Dates ***************/

/*DOH Back Office */
appform.appid_payment

FROM appform
LEFT JOIN hfaci_serv_type ON appform.hfser_id = hfaci_serv_type.hfser_id
LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid

LEFT JOIN region ON appform.rgnid=region.rgnid
LEFT JOIN ownership ON appform.ocid=ownership.ocid
LEFT JOIN apptype ON appform.aptid=apptype.aptid
LEFT JOIN class ON appform.classid=class.classid
LEFT JOIN facmode ON appform.facmode=facmode.facmid
LEFT JOIN trans_status ON appform.status=trans_status.trns_id
LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
WHERE (appform.status='NA' OR appform.status='RA' OR appform.status='RE' OR appform.status='RI') AND appform.savingStat='final'  AND appform.iscancel='0' 
ORDER BY appform.updated_at DESC, appform.recommendeddate DESC, appform.recommendedtime DESC, appform.inspecteddate DESC, appform.inspectedtime DESC,  
	appform.updated_at DESC, appform.appid DESC, appform.isCashierApprove ASC, appform.aptid ASC
);



/**********    View Application that has Staffs who touched the applications  **********/
DROP VIEW IF EXISTS viewAppStaffRecommender;
CREATE VIEW viewAppStaffRecommender AS
(
SELECT appform.*, appform.street_name AS streetname, x08.pwd, x08.authorizedsignature, x08.assign, x08.nameofcompany, x08.lastChangePassDate, x08.lastChangePassTime, x08.isActive, x08.isTempBanned, x08.isBanned, x08.tries, x08.is_fda, 
x07.grp_desc, barangay.brgyname, city_muni.cmname, province.provname, trans_status.trns_desc,
comeval.fname AS com_fname, comeval.pre AS com_pre, comeval.suf AS com_suf, comeval.mname AS com_mname, comeval.lname AS com_lname, 
cashval.fname AS cash_fname, cashval.pre AS cash_pre, cashval.suf AS cash_suf, cashval.mname AS cash_mname, cashval.lname AS cash_lname, 
FDApreassesedby.pre AS preassesedbyFDA_pre, FDApreassesedby.fname AS preassesedbyFDA_fname, FDApreassesedby.mname AS preassesedbyFDA_mname, FDApreassesedby.lname AS preassesedbyFDA_lname, FDApreassesedby.suf AS preassesedbyFDA_suf, 
FDAPharmapreassesedby.pre AS preassesedbyFDAPharma_pre, FDAPharmapreassesedby.fname AS preassesedbyFDAPharma_fname, FDAPharmapreassesedby.mname AS preassesedbyFDAPharma_mname, FDAPharmapreassesedby.lname AS preassesedbyFDAPharma_lname, FDAPharmapreassesedby.suf AS preassesedbyFDAPharma_suf, 
recfdaval.fname AS recfdaval_fname, recfdaval.pre AS recfdaval_pre, recfdaval.suf AS recfdaval_suf, recfdaval.mname AS recfdaval_mname, recfdaval.lname AS recfdaval_lname, 
evalby.fname AS evalby_fname, evalby.pre AS evalby_pre, evalby.suf AS evalby_suf, evalby.mname AS evalby_mname, evalby.lname AS evalby_lname, 
recbyfda.fname AS recbyfda_fname, recbyfda.pre AS recbyfdal_pre, recbyfda.suf AS recbyfda_suf, recbyfda.mname AS recbyfda_mname, recbyfda.lname AS recbyfda_lname, 
recbyfdaphar.fname AS recbyfdaphar_fname, recbyfdaphar.pre AS recbyfdalphar_pre, recbyfdaphar.suf AS recbyfdaphar_suf, recbyfdaphar.mname AS recbyfdaphar_mname, recbyfdaphar.lname AS recbyfdaphar_lname, 
recbyfdaph.fname AS recbyfdaph_fname, recbyfdaph.pre AS recbyfdaph_pre, recbyfdaph.suf AS recbyfdaph_suf, recbyfdaph.mname AS recbyfdaph_mname, recbyfdaph.lname AS recbyfdaph_lname,

CASE WHEN appform.CashierApproveTime IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveTime, "%h:%i %p") ELSE NULL END AS FCashierApproveTime,
CASE WHEN appform.CashierApproveDate IS NOT NULL THEN DATE_FORMAT(appform.CashierApproveDate, "%M %d, %Y") ELSE NULL END AS FCashierApproveDate,
CASE WHEN cashierEvaluator1.uid IS NOT NULL THEN 
	CONCAT('(', IFNULL(cashierEvaluator1.uid,''), ') ',  IFNULL(cashierEvaluator1.pre,''), ' ', IFNULL(cashierEvaluator1.fname,''), ' ', IFNULL(cashierEvaluator1.mname,''), ' ', IFNULL(cashierEvaluator1.lname,''), ' ', IFNULL(cashierEvaluator1.suf,''))
	ELSE 'Not Available'
END	AS CashierEvaluator,

CASE WHEN appform.payEvaltime IS NOT NULL THEN DATE_FORMAT(appform.payEvaltime, "%h:%i %p") ELSE NULL END AS formmatedPayEvalTime,
CASE WHEN appform.payEvaldate IS NOT NULL THEN DATE_FORMAT(appform.payEvaldate, "%M %d, %Y") ELSE NULL END AS formmatedPayEvalDate,
CASE WHEN payEvaluator1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(payEvaluator1.uid,''), ') ', IFNULL(payEvaluator1.pre,''), ' ', IFNULL(payEvaluator1.fname,''), ' ', IFNULL(payEvaluator1.mname,''), ' ', IFNULL(payEvaluator1.lname,''), ' ', IFNULL(payEvaluator1.suf,'') )
	ELSE 'Not Available'
END	AS PayEvaluator,

CASE WHEN appform.inspectedtime IS NOT NULL THEN DATE_FORMAT(appform.inspectedtime, "%h:%i %p") ELSE NULL END AS formmatedAssessTime,
CASE WHEN appform.inspecteddate IS NOT NULL THEN DATE_FORMAT(appform.inspecteddate, "%M %d, %Y") ELSE NULL END AS formmatedAssessDate,
CASE WHEN assessor1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(assessor1.uid,''), ') ', IFNULL(assessor1.pre,''), ' ', IFNULL(assessor1.fname,''), ' ', IFNULL(assessor1.mname,''), ' ', IFNULL(assessor1.lname,''), ' ', IFNULL(assessor1.suf,''))
	ELSE 'Not Available'
END	AS Assessor,

CASE WHEN appform.recommendedtime IS NOT NULL THEN DATE_FORMAT(appform.recommendedtime, "%h:%i %p") ELSE NULL END AS formmatedEvalTime,
CASE WHEN appform.recommendeddate IS NOT NULL THEN DATE_FORMAT(appform.recommendeddate, "%M %d, %Y") ELSE NULL END AS formmatedEvalDate,
CASE WHEN evaluator1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(evaluator1.uid,''), ') ', IFNULL(evaluator1.pre,''), ' ', IFNULL(evaluator1.fname,''), ' ', IFNULL(evaluator1.mname,''), ' ', IFNULL(evaluator1.lname,''), ' ', IFNULL(evaluator1.suf,''))
	ELSE 'Not Available'
END	AS Evaluator,

CASE WHEN appform.RecoForApprovalTime IS NOT NULL THEN DATE_FORMAT(appform.RecoForApprovalTime, "%h:%i %p") ELSE NULL END AS fRecoForApprovalTime,
CASE WHEN appform.RecoForApprovalDate IS NOT NULL THEN DATE_FORMAT(appform.RecoForApprovalDate, "%M %d, %Y") ELSE NULL END AS fRecoForApprovalDate,
CASE WHEN recoEvaluator1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(recoEvaluator1.uid,''), ') ', IFNULL(recoEvaluator1.pre,''), ' ', IFNULL(recoEvaluator1.fname,''), ' ', IFNULL(recoEvaluator1.mname,''), ' ', IFNULL(recoEvaluator1.lname,''), ' ', IFNULL(recoEvaluator1.suf,''))
	ELSE 'Not Available'
END	AS RecommedationEvaluator,

CASE WHEN appform.approvedTime IS NOT NULL THEN DATE_FORMAT(appform.approvedTime, "%h:%i %p") ELSE NULL END AS FapprovedTime,
CASE WHEN appform.approvedDate IS NOT NULL THEN DATE_FORMAT(appform.approvedDate, "%M %d, %Y") ELSE NULL END AS FapprovedDate,
CASE WHEN aprovalApprover1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(aprovalApprover1.uid,''), ') ', IFNULL(aprovalApprover1.pre,''), ' ', IFNULL(aprovalApprover1.fname,''), ' ', IFNULL(aprovalApprover1.mname,''), ' ', IFNULL(aprovalApprover1.lname,''), ' ', IFNULL(aprovalApprover1.suf,''))  
	ELSE 'Not Available'
END	AS AprovalApprover,

CASE WHEN appform.approvedTimeFDA IS NOT NULL THEN DATE_FORMAT(appform.approvedTimeFDA, "%h:%i %p") ELSE NULL END AS FDAapprovedTime,
CASE WHEN appform.approvedDateFDA IS NOT NULL THEN DATE_FORMAT(appform.approvedDateFDA, "%M %d, %Y") ELSE NULL END AS FDAapprovedDate,
CASE WHEN FDAAprovalApprover1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(FDAAprovalApprover1.uid,''), ') ', IFNULL(FDAAprovalApprover1.pre,''), ' ', IFNULL(FDAAprovalApprover1.fname,''), ' ', IFNULL(FDAAprovalApprover1.mname,''), ' ', IFNULL(FDAAprovalApprover1.lname,''), ' ', IFNULL(FDAAprovalApprover1.suf,''))
	ELSE 'Not Available'
END	AS FDAAprovalApprover,

CASE WHEN appform.approvedTimeFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.approvedTimeFDAPharma, "%h:%i %p") ELSE NULL END AS FDAapprovedTimePharma,
CASE WHEN appform.approvedDateFDAPharma IS NOT NULL THEN DATE_FORMAT(appform.approvedDateFDAPharma, "%M %d, %Y") ELSE NULL END AS FDAapprovedDatePharma,
CASE WHEN FDAAprovalApproverPharma1.uid IS NOT NULL THEN 
	CONCAT('(',  IFNULL(FDAAprovalApproverPharma1.uid,''), ') ', IFNULL(FDAAprovalApproverPharma1.pre,''), ' ', IFNULL(FDAAprovalApproverPharma1.fname,''), ' ', IFNULL(FDAAprovalApproverPharma1.mname,''), ' ', IFNULL(FDAAprovalApproverPharma1.lname,''), ' ', IFNULL(FDAAprovalApproverPharma1.suf,''))
	ELSE 'Not Available'
END	AS FDAAprovalApproverPharma

FROM appform 
LEFT JOIN x08 ON appform.uid = x08.uid 
LEFT JOIN x08 AS comeval ON appform.concommittee_evalby = comeval.uid 
LEFT JOIN x08 AS cashval ON appform.CashierApproveByFDA = cashval.uid 
LEFT JOIN x08 AS recfdaval ON appform.recommendedbyFDA = recfdaval.uid 
LEFT JOIN x08 AS recbyfda ON appform.RecobyFDA = recbyfda.uid 
LEFT JOIN x08 AS recbyfdaphar ON appform.RecobyFDAPhar = recbyfdaphar.uid 
LEFT JOIN x08 AS recbyfdaph ON appform.CashierApproveByPharma = recbyfdaph.uid 
LEFT JOIN x08 AS evalby ON appform.recommendedby = evalby.uid 
LEFT JOIN x08 AS FDApreassesedby ON appform.ispreassessedby = FDApreassesedby.uid 
LEFT JOIN x08 AS FDAPharmapreassesedby ON appform.ispreassessedbypharma = FDAPharmapreassesedby.uid 

LEFT JOIN x08 AS cashierEvaluator1 ON appform.CashierApproveBy = cashierEvaluator1.uid
LEFT JOIN x08 AS payEvaluator1 ON appform.payEvalby = payEvaluator1.uid 
LEFT JOIN x08 AS assessor1 ON appform.inspectedby = assessor1.uid 
LEFT JOIN x08 AS evaluator1 ON appform.recommendedby = evaluator1.uid 
LEFT JOIN x08 AS recoEvaluator1 ON appform.RecoForApprovalby = recoEvaluator1.uid
LEFT JOIN x08 AS aprovalApprover1 ON appform.approvedBy = aprovalApprover1.uid
LEFT JOIN x08 AS FDAAprovalApprover1 ON appform.approvedByFDA = FDAAprovalApprover1.uid
LEFT JOIN x08 AS FDAAprovalApproverPharma1 ON appform.approvedByFDAPharma = FDAAprovalApproverPharma1.uid

LEFT JOIN x07 ON comeval.grpid = x07.grp_id 
LEFT JOIN barangay ON appform.brgyid = barangay.brgyid 
LEFT JOIN city_muni ON appform.cmid = city_muni.cmid 
LEFT JOIN province ON appform.provid = province.provid 
LEFT JOIN trans_status ON appform.status = trans_status.trns_id 
ORDER BY  appform.updated_at DESC
);




/**********    View Application   **********/
DROP VIEW IF EXISTS viewAppFormForUpdate;
CREATE VIEW viewAppFormForUpdate AS
(
	SELECT appform.*, x08.nameofcompany, barangay.brgyname, city_muni.cmname, province.provname, region.rgn_desc, asrgn.rgn_desc AS asrgn_rgndesc,
	ownership.ocdesc AS ownership_desc, class.classname,  subclass.classname AS subclassname, funcapf.funcdesc,  facmode.facmdesc, 
	hfaci_grp.hgpdesc, hfaci_grp.hgpdesc AS facilitytype,  apptype.aptdesc, hfaci_serv_type.hfser_desc,
	registered_facility.con_id, registered_facility.lto_id, registered_facility.ato_id, registered_facility.coa_id, registered_facility.cor_id,
	registered_facility.ptc_id,
	registered_facility.ptc_approveddate, registered_facility.lto_validityto, registered_facility.coa_validityto, registered_facility.ato_validityto,
	registered_facility.lto_approveddate, registered_facility.coa_approveddate, registered_facility.ato_approveddate,
	hfaci_grp.isHospital, hfaci_grp.otherClinicService, hfaci_grp.clinicLab, hfaci_grp.dialysisClinic, hfaci_grp.ambulSurgCli, hfaci_grp.ambuDetails, hfaci_grp.addOnServe 
	
	FROM appform 
	LEFT JOIN registered_facility ON appform.regfac_id=registered_facility.regfac_id 
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
	LEFT JOIN funcapf ON appform.funcid=funcapf.funcid
	LEFT JOIN facmode ON appform.facmode=facmode.facmid
	LEFT JOIN trans_status ON appform.status=trans_status.trns_id

	LEFT JOIN region AS asrgn ON appform.assignedRgn=asrgn.rgnid
 
	ORDER BY  appform.updated_at DESC
);