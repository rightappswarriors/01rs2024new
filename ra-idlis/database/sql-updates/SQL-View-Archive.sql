DROP VIEW IF EXISTS view_archive_files;
CREATE VIEW view_archive_files AS
SELECT hfaci_grp.hgpdesc, reg_facility_archive.*
FROM reg_facility_archive
LEFT JOIN hfaci_grp ON hfaci_grp.hgpid=reg_facility_archive.hgpid