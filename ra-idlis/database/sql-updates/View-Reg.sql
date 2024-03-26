DROP VIEW IF EXISTS view_registered_facility_for_change;
CREATE VIEW view_registered_facility_for_change AS
(
	SELECT rf.regfac_id, rf.old_pk, rf.facid AS hgpid, rf.nhfcode, rf.nhfcode_short, rf.facilityname, rf.facilitytype, 
	rf.ocid, ownership.ocdesc,  rf.classid,  class.classname, subclass.classname AS subclassname, rf.subClassid, 
	rf.facmode, facmode.facmdesc, rf.funcid, funcapf.funcdesc,

	rf.owner, rf.mailingAddress,
	rf.street_number, rf.street_name, rf.brgyid, barangay.brgyname, rf.cmid, city_muni.cmname, rf.provid, province.provname, rf.rgnid, region.rgn_desc, rf.zipcode, rf.assignedRgn, asrgn.rgn_desc AS asrgn_desc,

	rf.contact, rf.areacode, rf.landline, rf.faxnumber, rf.email, rf.ownerMobile, rf.ownerLandline, rf.ownerEmail, 
	rf.approvingauthoritypos, rf.approvingauthority, rf.hfep_funded, 

	CASE
		WHEN cor_id IS NOT NULL OR cor_id !='' THEN 'COR'
		WHEN coa_id IS NOT NULL OR coa_id !='' THEN 'COA' 
		WHEN ato_id IS NOT NULL OR ato_id !='' THEN 'ATO' 
		WHEN lto_id IS NOT NULL OR lto_id !='' THEN 'LTO' 
		WHEN ptc_id IS NOT NULL OR ptc_id !='' THEN 'PTC'
		WHEN con_id IS NOT NULL OR con_id !='' THEN 'CON' 
		ELSE NULL 
	END AS hfser_id,
		
	CASE
		WHEN cor_id IS NOT NULL OR cor_id !='' THEN 'Certificate Of Registration'
		WHEN coa_id IS NOT NULL OR coa_id !='' THEN 'Certificate Of Accreditation' 
		WHEN ato_id IS NOT NULL OR ato_id !='' THEN 'Authority To Operate' 
		WHEN lto_id IS NOT NULL OR lto_id !='' THEN 'License To Operate' 
		WHEN ptc_id IS NOT NULL OR ptc_id !='' THEN 'Permit To Constructg'
		WHEN con_id IS NOT NULL OR con_id !='' THEN 'Certificate Of Need' 
		ELSE NULL 
	END AS hfser_desc,

	rf.con_id, rf.ptc_id, rf.lto_id, rf.ato_id, rf.coa_id, rf.cor_id, 
	rf.con_approveddate, rf.ptc_approveddate, rf.lto_approveddate, rf.ato_approveddate, rf.coa_approveddate, rf.cor_approveddate, 
	rf.con_validityfrom, rf.lto_validityfrom, rf.ato_validityfrom, rf.coa_validityfrom, rf.cor_validityfrom, rf.con_validityto, rf.lto_validityto, rf.ato_validityto, rf.coa_validityto, rf.cor_validityto, 

	rf.uid, rf.noofbed, rf.noofstation, rf.noofsatellite, rf.noofdialysis, rf.noofmain, rf.cap_inv, rf.lot_area, rf.typeamb, rf.ambtyp, rf.plate_number, rf.ambOwner, rf.HFERC_swork, rf.noofamb, rf.pharCOC, rf.xrayCOC,
	hfaci_grp.isHospital, hfaci_grp.otherClinicService, hfaci_grp.clinicLab, hfaci_grp.dialysisClinic, hfaci_grp.ambulSurgCli, hfaci_grp.ambuDetails, hfaci_grp.addOnServe 

	FROM registered_facility rf 
	LEFT JOIN hfaci_grp ON rf.facid=hfaci_grp.hgpid
	LEFT JOIN x08 ON rf.uid=x08.uid
	LEFT JOIN barangay ON rf.brgyid=barangay.brgyid
	LEFT JOIN city_muni ON rf.cmid=city_muni.cmid
	LEFT JOIN province ON rf.provid=province.provid
	LEFT JOIN region ON rf.rgnid=region.rgnid
	LEFT JOIN ownership ON rf.ocid=ownership.ocid
	LEFT JOIN class ON rf.classid=class.classid
	LEFT JOIN class subclass ON rf.subclassid=subclass.classid
	LEFT JOIN funcapf ON rf.funcid=funcapf.funcid
	LEFT JOIN facmode ON rf.facmode=facmode.facmid
	LEFT JOIN reg_ptc ON reg_ptc.regfac_id=rf.regfac_id
	LEFT JOIN region AS asrgn ON rf.assignedRgn=asrgn.rgnid
);


DROP VIEW IF EXISTS view_registered_facility;
CREATE VIEW view_registered_facility AS
(
	SELECT rf.regfac_id, rf.old_pk, rf.facid AS hgpid, rf.nhfcode, rf.nhfcode_short, rf.facilityname, rf.facilitytype, 
	rf.ocid, ownership.ocdesc,  rf.classid,  class.classname,  subclass.classname AS subclassname, rf.subClassid, 
	rf.facmode, facmode.facmdesc, rf.funcid, funcapf.funcdesc,

	rf.owner, rf.mailingAddress,
	rf.street_number, rf.street_name, rf.brgyid, barangay.brgyname, rf.cmid, city_muni.cmname, rf.provid, province.provname, rf.rgnid, region.rgn_desc, rf.zipcode, rf.assignedRgn, asrgn.rgn_desc AS asrgn_desc,

	rf.contact, rf.areacode, rf.landline, rf.faxnumber, rf.email, rf.ownerMobile, rf.ownerLandline, rf.ownerEmail, 
	rf.approvingauthoritypos, rf.approvingauthority, rf.hfep_funded, 
	
	rf.con_id, rf.ptc_id, rf.lto_id, rf.ato_id, rf.coa_id, rf.cor_id, 
	rf.con_approveddate, rf.ptc_approveddate, rf.lto_approveddate, rf.ato_approveddate, rf.coa_approveddate, rf.cor_approveddate, 
	rf.con_validityfrom, rf.lto_validityfrom, rf.ato_validityfrom, rf.coa_validityfrom, rf.cor_validityfrom, rf.con_validityto, rf.lto_validityto, rf.ato_validityto, rf.coa_validityto, rf.cor_validityto, 

	rf.uid, rf.noofbed, rf.noofstation, rf.noofsatellite, rf.noofdialysis, rf.noofmain, rf.cap_inv, rf.lot_area, rf.typeamb, rf.ambtyp, rf.plate_number, rf.ambOwner, rf.HFERC_swork, rf.noofamb, rf.pharCOC, rf.xrayCOC 

	FROM registered_facility rf 
	LEFT JOIN hfaci_grp ON rf.facid=hfaci_grp.hgpid
	LEFT JOIN x08 ON rf.uid=x08.uid
	LEFT JOIN barangay ON rf.brgyid=barangay.brgyid
	LEFT JOIN city_muni ON rf.cmid=city_muni.cmid
	LEFT JOIN province ON rf.provid=province.provid
	LEFT JOIN region ON rf.rgnid=region.rgnid
	LEFT JOIN ownership ON rf.ocid=ownership.ocid
	LEFT JOIN class ON rf.classid=class.classid
	LEFT JOIN class subclass ON rf.subclassid=subclass.classid
	LEFT JOIN funcapf ON rf.funcid=funcapf.funcid
	LEFT JOIN facmode ON rf.facmode=facmode.facmid
	LEFT JOIN reg_ptc ON reg_ptc.regfac_id=rf.regfac_id
	LEFT JOIN region AS asrgn ON rf.assignedRgn=asrgn.rgnid
);



DROP VIEW IF EXISTS view_reg_annexa_personnel;
CREATE VIEW   view_reg_annexa_personnel AS
(
	SELECT raxa.id, raxa.prefix, raxa.surname, raxa.firstname, raxa.middlename, raxa.suffix, raxa.prof, pos.posname AS profession_official, raxa.prcno, raxa.validityPeriodTo, raxa.speciality, raxa.dob, raxa.sex, raxa.employement, raxa.pos, raxa.designation, raxa.area, raxa.qual, raxa.email, raxa.tin, raxa.prc, raxa.bc, raxa.coe, raxa.isMainRadio, raxa.ismainpo, raxa.isMainRadioPharma, raxa.isChiefRadTech, raxa.isXrayTech, raxa.status, raxa.cert, raxa.evaluation, raxa.remarks, raxa.regfac_id, raxa.profession 
	FROM reg_hfsrbannexa raxa LEFT JOIN position pos ON raxa.prof=pos.posid
);