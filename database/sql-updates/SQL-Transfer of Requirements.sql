UPDATE cdrrattachment SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrhrotherattachment SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrhrpersonnel SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrhrreceipt SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrhrxraylist SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrhrxrayservcat SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrpersonnel SET appid='NEWID' WHERE appid='PASTID';
UPDATE cdrrreceipt SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexa SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexb SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexc SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexd SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexf SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexh SET appid='NEWID' WHERE appid='PASTID';
UPDATE hfsrbannexi SET appid='NEWID' WHERE appid='PASTID';


---------------------------

SELECT assignedRgn, appid, licenseNo, rgnid, facilityname, hfser_id, hgpid, approvedDate FROM `appform` WHERE appform.status='A' AND hfser_id='PTC' ORDER BY assignedRgn, licenseNo;