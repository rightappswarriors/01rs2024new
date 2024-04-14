/* 2024-01-03 */
ALTER TABLE appform 
ADD COLUMN head_of_facility_name TEXT,
ADD COLUMN license_number TEXT,
ADD COLUMN license_validity DATE;

DROP TABLE reg_facility_archive;

/*******************/

ALTER TABLE reg_facility_archive
ADD COLUMN hfser_id varchar(11) DEFAULT NULL,
ADD COLUMN nhfcode  varchar(70)  DEFAULT NULL,
ADD COLUMN nhfcode_temp varchar(70)  DEFAULT NULL,
ADD COLUMN year int DEFAULT NULL,
ADD COLUMN rgnid varchar(5) DEFAULT NULL,
ADD COLUMN facilityname TEXT DEFAULT NULL,
ADD COLUMN dtrackno varchar(80) DEFAULT NULL,
ADD COLUMN conid text DEFAULT NULL,
ADD COLUMN ptcid text DEFAULT NULL,
ADD COLUMN ltoid text DEFAULT NULL,
ADD COLUMN coaid text DEFAULT NULL,
ADD COLUMN atoid text DEFAULT NULL,
ADD COLUMN corid text DEFAULT NULL,
ADD COLUMN hgpid int DEFAULT NULL;


/*******************/
ALTER TABLE reg_facility_archive
MODIFY COLUMN description text DEFAULT NULL,
MODIFY COLUMN filename varchar(300)  DEFAULT NULL,
MODIFY COLUMN regfac_id int DEFAULT NULL;


/******************/
DROP TABLE reg_facility_archive;

CREATE TABLE `reg_facility_archive` (
  `rfa_id` int NOT NULL AUTO_INCREMENT,
  `regfac_id` int DEFAULT NULL,
  `hfser_id` varchar(11) DEFAULT NULL,
  `nhfcode` varchar(70) DEFAULT NULL,
  `nhfcode_temp` varchar(70) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `rgnid` varchar(5) DEFAULT NULL,
  `facilityname` text,
  `hgpid` int DEFAULT NULL,
  `dtrackno` varchar(80) DEFAULT NULL,
  `conid` text,
  `ptcid` text,
  `ltoid` text,
  `coaid` text,
  `atoid` text,
  `corid` text,
  `rectype_id` int DEFAULT NULL,
  `description` text,
  `filename` varchar(300) DEFAULT NULL,
  `savelocation` text NOT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `localip` varchar(20) DEFAULT NULL,
  `computername` varchar(100) DEFAULT NULL,
  `browser` varchar(35) DEFAULT NULL,
  `created_at` date NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `updated_at` date DEFAULT NULL,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`rfa_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;



/*************************/
ALTER TABLE registered_facility
ADD COLUMN noofbed_dateapproved date null,
ADD COLUMN noofdialysis_dateapproved date null,
ADD COLUMN personnel_dateapproved date null,
ADD COLUMN equipment_dateapproved date null,
ADD COLUMN hospital_lvl_dateapproved date null,
ADD COLUMN addonservice_dateapproved date null,
ADD COLUMN changeonservice_dateapproved date null,
ADD COLUMN ambulance_dateapproved date null,
ADD COLUMN classification_dateapproved date null,
ADD COLUMN rename_dateapproved date null;


/**************2024-03-26***********/
ALTER TABLE appform
ADD COLUMN noofbed_dateapproved date null,
ADD COLUMN noofdialysis_dateapproved date null,
ADD COLUMN personnel_dateapproved date null,
ADD COLUMN equipment_dateapproved date null,
ADD COLUMN hospital_lvl_dateapproved date null,
ADD COLUMN addonservice_dateapproved date null,
ADD COLUMN changeonservice_dateapproved date null,
ADD COLUMN ambulance_dateapproved date null,
ADD COLUMN classification_dateapproved date null,
ADD COLUMN rename_dateapproved date null;


/***************/SELECT appform.regfac_id, appform.nhfcode,  appform.autoTimeDate, appform.appid, appform.uid, appform.facilityname, serv_capabilities, 
appform.owner, appform.email, appform.contact, appform.hfser_id, hfaci_serv_type.hfser_desc, appform.facid, appform.ocid, appform.ocdesc as appformocdesc, 
appform.aptid, appform.ptcCode, appform.classid, classdesc, appform.subClassid, subClassdesc, appform.funcid, appform.facmode, appform.noofbed, draft, 
appid_payment, t_date, t_time, region.rgnid, region.rgn_desc, assRgn.office, assRgn.address, assRgn.iso_desc,

barangay.brgyid, barangay.brgyname, city_muni.cmid, city_muni.cmname, province.provid, province.provname, assRgn.rgn_desc AS assRgnDesc, appform.zipcode, 
CASE WHEN appform.street_name!='N/A' THEN appform.street_name ELSE '' END AS street_name,
CASE WHEN appform.street_number !='N/A' THEN appform.street_number  ELSE '' END AS street_number, 

appform.landline, appform.faxNumber, appform.ownerMobile, appform.ownerLandline, appform.ownerEmail, appform.mailingAddress, appform.areacode,

appform.status, trans_status.trns_desc, trans_status.allowedpayment, trans_status.canapply, facmode.facmdesc, funcapf.funcdesc, 
ownership.ocdesc, class.classname, apptype.aptdesc, appform.rgnid, appform.noofmain, appform.noofsatellite, appform.noofstation, appform.noofdialysis, 
clab, appform.cap_inv, appform.lot_area, appform.con_number, 

appform.typeamb, appform.ambtyp, appform.noofamb, appform.plate_number, appform.ambOwner, 

appform.validDate, appform.documentSent, appform.isApproveFDA, isNotified, appform.isPayEval, appform.isCashierApprove, appform.isrecommended, appform.isReadyForInspec, 
appform.isReadyForInspecFDA, appform.isrecommendedFDA, appform.FDAstatus, appform.pharCOC, appform.xrayCOC, 
appform.validDateFrom, appform.licenseNo, appform.HFERC_swork, appform.payEvalbyFDA, 
/*HFERC_comments,*/  appform.ishfep, 
appform.isAcceptedFP, appform.FPacceptedDate, appform.FPacceptedTime, appform.fpcomment, others_oanc, appform.hfep_funded, appform.proposedWeek, appform.appComment,
appform.addonDesc, appform.approvingauthority, appform.approvingauthoritypos, 
appform.savingStat, appform.hgpid, hfaci_grp.hgpdesc, appform.assignedRgn, 
appform.approvedDate, appform.savedRenewalOpt, signatoryname, signatorypos, appform.license_number, appform.license_validity, appform.head_of_facility_name,
registered_facility.noofbed_dateapproved, registered_facility.noofdialysis_dateapproved, registered_facility.personnel_dateapproved, registered_facility.equipment_dateapproved, registered_facility.hospital_lvl_dateapproved, 
registered_facility.addonservice_dateapproved, registered_facility.changeonservice_dateapproved, registered_facility.ambulance_dateapproved, registered_facility.classification_dateapproved, registered_facility.rename_dateapproved 
	
    FROM appform             
	LEFT JOIN registered_facility ON appform.regfac_id=registered_facility.regfac_id 
	LEFT JOIN region ON region.rgnid = appform.rgnid 
	LEFT JOIN class ON class.classid = appform.classid 
	LEFT JOIN province ON province.provid = appform.provid 
	LEFT JOIN ownership ON ownership.ocid = appform.ocid 
	LEFT JOIN funcapf ON funcapf.funcid = appform.funcid 
	LEFT JOIN apptype ON apptype.aptid = appform.aptid 
	LEFT JOIN city_muni ON city_muni.cmid = appform.cmid 
	LEFT JOIN barangay ON barangay.brgyid = appform.brgyid 
	LEFT JOIN hfaci_serv_type ON hfaci_serv_type.hfser_id = appform.hfser_id 
	LEFT JOIN trans_status ON trans_status.trns_id = appform.status 
	LEFT JOIN facmode ON facmode.facmid = appform.facmode 
	LEFT JOIN hfaci_grp ON appform.hgpid=hfaci_grp.hgpid 
	LEFT JOIN region AS assRgn ON assRgn.rgnid = appform.assignedRgn 
WHERE appform.appid = '8056' ;


/******** 2024-04- *****/
ALTER TABLE hfaci_grp 
ADD COLUMN hasbedcapacity TINYINT(1) DEFAULT 0,
ADD COLUMN pharmacy TINYINT(1) DEFAULT 0;

