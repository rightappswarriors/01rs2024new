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


/******** 2024-04-19 *****/

INSERT INTO x05 (mod_id, mod_desc, mod_lvl) VALUES ('F001', 'Facility Records', '1');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('FR001', 'User Accounts', '2', 'F001', 'manage/client_users');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('FR002', 'Registered Facilities', '2', 'F001', 'facilityrecords');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('FR003', 'Archive of Files', '2', 'F001', 'facilityrecords/archiveall');

INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'F001' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'FR001' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'FR002' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'FR003' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;



/******** 2024-04-21 *****/
ALTER TABLE hfaci_grp ADD COLUMN dialysisClinic_ptc tinyint DEFAULT 0;
ALTER TABLE hfaci_grp ADD COLUMN hasbedcapacity_ptc tinyint DEFAULT 0;
ALTER TABLE hfaci_grp ADD COLUMN hasbedcapacityadj_ptc tinyint DEFAULT 0;
ALTER TABLE hfaci_grp ADD COLUMN hassinglebedcapacity_ptc tinyint DEFAULT 0;
ALTER TABLE hfaci_grp ADD COLUMN hasdoublebedcapacity_ptc tinyint DEFAULT 0;


UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='1', ambuDetails='1', addOnServe='1', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='1', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='1'; /* Ambulatory Surgical Clinic */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0'  
WHERE hgpid='2'; /* Blood Center */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='3'; /* Blood Collection Unit/Blood Station */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='1', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='5'; /* Hemodialysis Clinic */
UPDATE hfaci_grp SET isHospital='1', otherClinicService='0', clinicLab='0', dialysisClinic='1', ambulSurgCli='0', ambuDetails='1', addOnServe='1', hasbedcapacity='1', pharmacy='1', dialysisClinic_ptc='0', hasbedcapacity_ptc='1', hasbedcapacityadj_ptc='1', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='6'; /* Hospital */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='1', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='8'; /* Drug Testing Laboratory */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='1', hassinglebedcapacity_ptc='1', hasdoublebedcapacity_ptc='1' 
WHERE hgpid='9'; /* Drug Abuse Treatment & Rehabilitation Center (DATRC) */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='10'; /* Kidney Transplant Facility */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='11'; /* Laboratory for Drinking Water Analysis (LDWA) */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='1', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='12';/* Medical Facility for Overseas Workers and Seafarers (MFOWS) */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='13';/* Newborn Screening Center (NSC) */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='14';/* Human Stem Cell and Cell-Based or Cellular Therapy Facility */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='20';/* Pharmacy */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='21';/* X-ray */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='23';/* Diagnostic X-ray Services */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='24';/* Specialized Diagnostic X-ray Services */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='25';/* Radiation Oncology */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='1', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0'
 WHERE hgpid='26';/* Land Ambulance and Ambulance Service Provider */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='29';/* Blood bank with Additional Function */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='30';/* BLood  Station */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='31';/* Blood Center */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='1', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='0', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='32';/* Blood Collection Unit */
UPDATE hfaci_grp SET isHospital='0', otherClinicService='0', clinicLab='0', dialysisClinic='0', ambulSurgCli='0', ambuDetails='1', addOnServe='0', hasbedcapacity='0', pharmacy='0', dialysisClinic_ptc='0', hasbedcapacity_ptc='0', hasbedcapacityadj_ptc='0', hassinglebedcapacity_ptc='0', hasdoublebedcapacity_ptc='0' 
WHERE hgpid='34';/* Ambulance Service Provider */


UPDATE X06 SET allow=1, ad_d=1, upd=1, cancel=1, print=1, view=1 WHERE grp_id='ADMIN';



INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('IDTOMIS', 'IDTOMIS', '1', null, 'idtomis');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('OHSRS', 'OHSRS', '1', null, 'dashboard');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl) VALUES ('NHFR', 'NHFR', '1');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('NHFR001', 'Current Import NHFR', '2', 'NHFR', 'nhfr');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('NHFR002', 'Registered Facility List', '2', 'NHFR', 'regfacility');

INSERT INTO x05 (mod_id, mod_desc, mod_lvl) VALUES ('NDHRHIS', 'NDHRHIS', '1');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('NDHRHIS001', 'List of Personnel By Application', '2', 'NDHRHIS', 'hhrdb/applist');
INSERT INTO x05 (mod_id, mod_desc, mod_lvl, mod_l1, links) VALUES ('NDHRHIS002', 'List of Personnel By Registered Facilities', '2', 'NDHRHIS', 'reports/ndhrhis/byregisteredfacilities');

INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'IDTOMIS' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'OHSRS' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'NHFR' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'NHFR001' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'NHFR002' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'NDHRHIS' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'NDHRHIS001' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;
INSERT INTO x06 (grp_id, mod_id, allow, ad_d, upd, cancel, print, view) SELECT grp_id, 'NDHRHIS002' AS mod_id, 0 AS allow, 0 AS ad_d, 0 AS upd, 0 AS cancel, 0 AS print, 0 AS view  FROM x07;

