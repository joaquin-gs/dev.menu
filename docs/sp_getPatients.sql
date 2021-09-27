CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_getPatients`(
  pageSize smallint,
  pageNum int,
  filterCondition varchar(500),
  out numRows int
)
BEGIN
   DECLARE cmd, sql1 varchar(5000);
   DECLARE nr int;
   SET nr = 0;

   SET @cmd = "SELECT p.patientID,
	p.familyNameEn, 
	p.firstNameEn, 
	p.familyNameKh, 
	p.firstNameKh, 
	p.gender, 
	p.dob, 
	p.nationality, 
	p.caretakerNameKh, 
	p.relationship, 
	p.distance, 
	p.provinceID, 
	prov.provinceNameEn, 
	p.districtID, 
	d.districtNameEn, 
	p.communeID, 
	c.communeNameEn, 
	p.villageID, 
	v.villageNameEn, 
	p.address, 
	p.phone1, 
	p.phone2, 
	p.bloodGroup, 
	p.estimatedDoB, 
	p.overAge, 
	p.deceased 
	FROM patient p
	  JOIN province prov ON (prov.provinceID = p.provinceID)
	  JOIN district d ON (d.districtID = p.districtID)
	  JOIN commune c ON (c.communeId = p.communeID)
	  JOIN village v ON (v.villageID = p.villageID) 
	WHERE p.deleted <> 'Y'";

   SET pageNum = pageNum * (pageSize - 1);
   IF filterCondition IS NULL OR filterCondition = '' THEN
      SELECT COUNT(*) INTO @nr FROM patient;
      SET numRows = @nr;
      SET @cmd = concat(@cmd, "ORDER BY p.patientID DESC LIMIT ", CONVERT(pageNum, CHAR(6)), ",", CONVERT(pageSize, CHAR(6)));
   ELSE
	  SET @sql1 = CONCAT("SELECT COUNT(1) INTO @nr FROM (", @cmd, filterCondition, ") as temp");
      SET @cmd = concat(@cmd, filterCondition, " ORDER BY p.patientID DESC LIMIT ", CONVERT(pageNum, CHAR(6)), ",", CONVERT(pageSize, CHAR(6)));
   END IF;
   
   PREPARE stmt FROM @cmd;
   EXECUTE stmt;
   
   IF filterCondition <> '' THEN
      PREPARE stmt2 FROM @sql1;
      EXECUTE stmt2;
      SET numRows = @nr;
      DEALLOCATE PREPARE stmt2;
   END IF;
   
   DEALLOCATE PREPARE stmt;
END