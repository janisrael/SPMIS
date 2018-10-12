sql command list:

-for retrieving data from tblequipment base from paricsID

select a.equipmentDesc, a.qty, a.unit, a.unitPrice, b.subCode, b.subDesc, a.life, c.officeAcronym, c.office, 
a.seq from tblequipment a, tblproperty b, refoffice c where a.propertyID=b.propertyID and a.officeID=c.officeID and a.paricsID = 6;



\\--------------------------------------------------

-show all data from tblparics with reference of personnel, reffund and tblsupplier

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID;

-show data from tblparics with doctype = 2 or PAR

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.docType=2;

-show data from tblparics with doctype = 1 or ICS

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.docType=1;

-show data from tblparics where status is posted =1

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier, a.isPosted, a.datePosted from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.isPosted=1;


-show data from tblparics where status is forwarded=1

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier, a.isPosted, a.datePosted, a.isForward, a.forwardDate from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.isForward = 1;

-show data from tblparics where status is cancelled=1

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier, a.isPosted, a.datePosted, a.isForward, a.forwardDate, a.isCancelled, a.cancelledDate from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.isCancelled = 1;

-show data from tblparics where dateGive is like [value]

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier, a.isPosted, a.datePosted, a.isForward, a.forwardDate, a.isCancelled, a.cancelledDate from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.dateGiven LIKE '2016%';

-show data from tblparics where dateGiven is like [value] and docType = [value]

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier, a.isPosted, a.datePosted, a.isForward, a.forwardDate, a.isCancelled, a.cancelledDate from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.dateGiven LIKE '2016%' and a.docType=2;

-show data from tblparics where dateGiven is like [value] and personID = [value]

select a.parics, a.docType, a.dateIssued, b.surName, b.firstName, b.middleName, a.poNumber, a.prNumber, a.obligation, a.orNumber, a.dateGiven, c.fundCode, c.fundDesc, d.supplier, a.isPosted, a.datePosted, a.isForward, a.forwardDate, a.isCancelled, a.cancelledDate from tblparics a, tblpersonnel b, reffund c, tblsupplier d where a.personID=b.personID and a.fundID=c.fundID and a.supplierID=d.supplierID and a.dateGiven LIKE '2016%' and a.personID=2;


-------------------------------------------------------------------------------------------
Summary Module

-generate report by office and doctype

select a.surName, a.firstName, a.middleName, b.docType, c.officeID from
tblpersonnel a, tblparics b, tblequipment c, tbldocequipment d where c.officeID = 2 and b.docType=1;

select b.paricsID, b.equipmentID, a.personID, c.officeID , a.docType, d.surName, d.firstName from tbldocequipment b, tblparics a, tblequipment c, tblpersonnel d where b.paricsID=a.paricsID and b.equipmentID=c.equipmentID and a.personID=d.personID and c.officeID=2 and a.docType=2 and c.paricsID > 0;

select b.paricsID, b.equipmentID, a.paricsID, a.personID, c.officeID, c.propertyID , a.docType, a.isPosted, d.surName, d.firstName, e.subCode from tbldocequipment b, tblparics a, tblequipment c, tblpersonnel d, tblproperty e where b.paricsID=a.paricsID and b.equipmentID=c.equipmentID and a.personID=d.personID and a.docType=2 and c.propertyID=42 and a.isPosted=0 and a.paricsID=3461;

select




SELECT tblpersonnel.IDNum, tblpersonnel.surName, tblpersonnel.firstName, refnametitle.nameTitle, refcivilstat.civilStatDesc, refoffice.officeAcronym, refposition.position, refshift.shiftDesc, refappoint.appointDesc 
FROM ((((((tblpersonnel INNER JOIN refnametitle ON tblpersonnel.nameTitleID=refnametitle.nameTitleID)
INNER JOIN refcivilstat ON tblpersonnel.civilStatID=refcivilstat.civilStatID)
INNER JOIN refoffice ON tblpersonnel.officeID=refoffice.officeID)
INNER JOIN refposition ON tblpersonnel.positionID=refposition.positionID)
INNER JOIN refshift ON tblpersonnel.shiftID=refshift.shiftID)
INNER JOIN refappoint ON tblpersonnel.appointID=refappoint.appointID);




importing database

mysql -u root -p databasename < databaselocation/name


summary report filter: by dateGiven

SELECT tblpersonnel.surName, tblpersonnel.firstName, tblparics.parics FROM (tblparics INNER JOIN tblpersonnel ON tblpersonnel.personID=tblparics.personID) WHERE tblparics.dateGiven LIKE '%2011%';


SELECT tblequipment.qty, tblequipment.unit, tblequipment.equipmentDesc, tblparics.dateGiven, tblequipment.unitPrice, tblequipment.unitPrice * tblequipment.qty AS amount FROM ((tbldocequipment INNER JOIN tblequipment ON tbldocequipment.equipmentID=tblequipment.equipmentID) INNER JOIN tblparics ON tbldocequipment.paricsID=tblparics.paricsID) WHERE tbldocequipment.paricsID="1720";



SELECT tblequipment.qty, tblequipment.unit, 
tblequipment.equipmentDesc, tblparics.dateGiven, 
tblequipment.unitPrice, tblequipment.unitPrice * tblequipment.qty 
AS amount FROM ((tbldocequipment INNER JOIN tblequipment ON 
	tbldocequipment.equipmentID=tblequipment.equipmentID) 
INNER JOIN tblparics ON tbldocequipment.paricsID=tblparics.paricsID) 
WHERE tbldocequipment.paricsID="1720";


SELECT tblpersonnel.IDNum, tblpersonnel.surName, tblpersonnel.firstName, refnametitle.nameTitle, refcivilstat.civilStatDesc, refoffice.officeAcronym, refposition.position, refshift.shiftDesc, refappoint.appointDesc 
FROM ((((((tblpersonnel INNER JOIN refnametitle ON tblpersonnel.nameTitleID=refnametitle.nameTitleID)
INNER JOIN refcivilstat ON tblpersonnel.civilStatID=refcivilstat.civilStatID)
INNER JOIN refoffice ON tblpersonnel.officeID=refoffice.officeID)
INNER JOIN refposition ON tblpersonnel.positionID=refposition.positionID)
INNER JOIN refshift ON tblpersonnel.shiftID=refshift.shiftID)
INNER JOIN refappoint ON tblpersonnel.appointID=refappoint.appointID);
