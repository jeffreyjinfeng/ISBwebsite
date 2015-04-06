
/*----------------------------------------------------------*/

		
#------- Code By  :Priyanka Kochhar
#------- Version  :1.0
#------- Database :MySql
#------- Interface:PHP


/*----------------------------------------------------------*/

# database changed to isb

USE isb;



/*----------------------------------------------------------*/

# Login access Function

/*----------------------------------------------------------*/

/*----------------------------------------------------------*/

#----Verifying the Userid and pwd for login-------------

/*----------------------------------------------------------*/


SELECT `UserId`, `UserAccessLevel`, `LoginPassword` FROM `userroleid` WHERE `UserId`='Useridinput' and `LoginPassword`='pwdinput';


/*----------------------------------------------------------*/

#------------- updating the login date------------------

/*----------------------------------------------------------*/

UPDATE `userroleid` SET `LastLoginDate`=NOW() WHERE `UserId`='Useridinput' ;



/*----------------------------------------------------------*/
#--------- Fetching data for welcome screen------------------

/*----------------------------------------------------------*/



#---- For customer


SELECT * FROM `customer` WHERE `UserId`='Userinput';


#---- For Employees


SELECT `EmployeeId`, `EmployeeFirstName`, `EmployeeMiddleName`, `EmployeeLastName`, `EmailId`, `UserId`, `LastDateModified` FROM `employee` WHERE `UserId`='Userinput' ;

/*----------------------------------------------------------*/
#--- Display all the accounts linked to the customer
/*----------------------------------------------------------*/


SELECT `AccountId`,`AccountType`, `CurrentBalance`, `LastModifiedDateTime` FROM `account` WHERE `CustomerId`='input';

/*----------------------------------------------------------*/
#-To check and display, if any of the customer's account is #closed ----Closed, if the ClosedDate is not null
/*----------------------------------------------------------*/


SELECT `ClosedDate` FROM `account` WHERE `AccountId` IN (SELECT `AccountId` FROM `account` WHERE `CustomerId`='input');

/*----------------------------------------------------------*/
#--Selected Account details and their last 10 transaction for #display
/*----------------------------------------------------------*/


SELECT `TransactionId`,`TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`, `TransactionStatus` FROM `transactions` WHERE `AccountId`='input';






















/*----------------------------------------------------------*/


-----------New Customer Registration Function-------------------

/*----------------------------------------------------------*/

/*----------------------------------------------------------*/
#------Create userid---------------------------------------
/*----------------------------------------------------------*/

#-----For Customer registration

INSERT INTO `userroleid`(`UserId`, `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) VALUES ([value-1],1,NOW(),NOW(),[value-5],'Customer');



#-----For  Employee -Clerk registration

INSERT INTO `userroleid`(`UserId`, `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) VALUES ([value-1],2,NOW(),NOW(),[value-5],'Clerk');



#-----For  Employee -Manager registration

INSERT INTO `userroleid`(`UserId`, `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) VALUES ([value-1],3,NOW(),NOW(),[value-5],'Manager');



#-----For  Employee -Admin registration

INSERT INTO `userroleid`(`UserId`, `UserAccessLevel`, `FirstLoginDate`, `LastLoginDate`, `LoginPassword`, `UserRoleDescription`) VALUES ([value-1],4,NOW(),NOW(),[value-5],'admin');




/*----------------------------------------------------------*/
#---Creating an employee record-user access level=(2,3,4)---
/*----------------------------------------------------------*/

INSERT INTO `employee`(`EmployeeId`, `EmployeeFirstName`, `EmployeeMiddleName`, `EmployeeLastName`, `EmailId`, `UserId`, `LastDateModified`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],NOW());


/*----------------------------------------------------------*/
#--Creating an customer record-user access level=1-------
/*----------------------------------------------------------*/

INSERT INTO `customer`(`CustomerId`, `CustomerFirstName`, `CustomerMiddleName`, `CustomerLastName`, `PhoneHome`, `PhoneMobile1`, `PhoneInternational`, `EmailId`, `LastDateModified`, `DOB`, `UserId`, `SSN`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],NOW(),[value-10],[value-11],[value-12]);


/*----------------------------------------------------------*/
#-----------Check if the address exists-------------------
/*----------------------------------------------------------*/


SELECT `AddressId` FROM `addresses` WHERE `AddressType`='input', `AddressLine1`='input', `AddressLine2`='input', `City`='input', `Zipcode`='input', `StateCode`='input', `Country`='input';


/*----------------------------------------------------------*/
#--Creating an address record if above select query returns null
/*----------------------------------------------------------*/

INSERT INTO `addresses`(`AddressId`, `AddressType`, `AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8]);



/*----------------------------------------------------------*/
#--Creating bridge address for customer registeration----

#-use the above generated customerid and addess for above #queries
----------------------------------------------------------------



INSERT INTO `cust_addr`(`CustomerID`, `AddressID`) VALUES ([value-1],[value-2]);


/*----------------------------------------------------------*/
#--Creating bridge address for employee registeration----------

#-use the above generated Employeeid and addess for above #queries
/*----------------------------------------------------------*/


INSERT INTO `empl_addr`(`EmployeeID`, `AddressId`) VALUES ([value-1],[value-2]);



























/*----------------------------------------------------------*/

#-------Update Customer Information Function

/*----------------------------------------------------------*/



/*----------------------------------------------------------*/
#------------updating the login password------------------
/*----------------------------------------------------------*/

UPDATE `userroleid` SET`LoginPassword`='input' WHERE `UserId`='input' and `LoginPassword`='input';


/*----------------------------------------------------------*/
#---Fetching the current data for customer before update-------
/*----------------------------------------------------------*/


SELECT `CustomerFirstName`, `CustomerMiddleName`, `CustomerLastName`, `PhoneHome`, `PhoneMobile1`, `PhoneInternational`, `EmailId`, `LastDateModified`, `DOB`, `UserId`, `SSN` FROM `customer` WHERE `CustomerId`='global variable';


/*----------------------------------------------------------*/
#----------updating the Customer Address------------------
/*----------------------------------------------------------*/


SELECT `AddressId` FROM `addresses` WHERE `AddressType`='input', `AddressLine1`='input', `AddressLine2`='input', `City`='input', `Zipcode`='input', `StateCode`='input', `Country`='input';


/*----------------------------------------------------------*/

#--Creating an address record if above select query returns null
/*----------------------------------------------------------*/

INSERT INTO `addresses`(`AddressId`, `AddressType`, `AddressLine1`, `AddressLine2`, `City`, `Zipcode`, `StateCode`, `Country`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8]);


/*----------------------------------------------------------*/
#--Updating the primary address in the bridge table----------
/*----------------------------------------------------------*/


#----Employees

UPDATE `empl_addr` SET `AddressId`=[value-2] WHERE `EmployeeID`=[value-1];

#----Customer

UPDATE `cust_addr` SET `AddressID`=[value-2] WHERE `CustomerID`=[value-1];



/*----------------------------------------------------------*/
#---Updating the Customer Home Phone no----------
/*----------------------------------------------------------*/

UPDATE `customer` SET `PhoneHome`='newinput' WHERE `CustomerId`=[value-1];



/*----------------------------------------------------------*/
#---Updating the Customer Mobile Phone no----------
/*----------------------------------------------------------*/


UPDATE `customer` SET `PhoneMobile1`='newinput' WHERE `CustomerId`=[value-1];

/*----------------------------------------------------------*/

#---Updating the Customer International Phone no----------

/*----------------------------------------------------------*/

UPDATE `customer` SET `PhoneInternational`='newinput' WHERE `CustomerId`=[value-1];



/*----------------------------------------------------------*/
#---Updating the Customer email id----------
/*----------------------------------------------------------*/
UPDATE `customer` SET `EmailId`='newinput' WHERE `CustomerId`=[value-1];



/*----------------------------------------------------------*/
#----Update the last modified date after any of above updates--
/*----------------------------------------------------------*/



UPDATE `customer` SET `LastDateModified`=NOW() WHERE `CustomerId`=[value-1];
















/*----------------------------------------------------------*/


-----------New Account Creation Function-------------------

/*----------------------------------------------------------*/


/*----------------------------------------------------------*/

#---Creating bridge address for employee registeration----------

/*----------------------------------------------------------*/


INSERT INTO `account`(`AccountId`, `CustomerId`, `AccountType`, `CurrentBalance`, `LastModifiedDateTime`, `OpenedDate`, `ClosedDate`) VALUES ([value-1],[value-2],[value-3],0,Now(),NOW(),[value-7]);




















/*----------------------------------------------------------*/


#-----Monthly Statememt Function-------------------
#-----Account Query Function-----------------------


/*----------------------------------------------------------*/



/*----------------------------------------------------------*/
#--Customer details for top of the statement-------
/*----------------------------------------------------------*/


SELECT `CustomerFirstName`, `CustomerMiddleName`, `CustomerLastName`, `PhoneHome` ,`EmailId` FROM `customer` WHERE `CustomerId`='global variable';


/*----------------------------------------------------------*/
#------Account details for top of the statement-------

/*----------------------------------------------------------*/

SELECT `AccountId`,`AccountType`, `CurrentBalance`FROM `account` WHERE `CustomerId`='input';

/*----------------------------------------------------------*/
#----Transaction details between two selected dates------

/*----------------------------------------------------------*/

SELECT `TransactionId`, `TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`, `TransactionStatus` FROM `transactions` WHERE `AccountId`='input' and `TransactionDate` between 'Startdate' and 'endate' ;





/*----------------------------------------------------------*/


#----Tracking and display the customer's enquiry request---

/*----------------------------------------------------------*/

/*----------------------------------------------------------*/
#---- Customer details------

/*----------------------------------------------------------*/



SELECT `RequestId`, , `EmployeeId`, `RequestTypeId`, `IsPriority`, `UserComment` FROM `generalrequests` WHERE `CustomerId`='input';





/*----------------------------------------------------------*/
#---- Request details for a customer ------

/*----------------------------------------------------------*/



SELECT `RequestId`, , `EmployeeId`, `RequestTypeId`, `IsPriority`, `UserComment` FROM `generalrequests` WHERE `CustomerId`='input';



/*----------------------------------------------------------*/
#---- Detail of employee handling the request ------

/*----------------------------------------------------------*/




SELECT `EmployeeFirstName`, `EmployeeMiddleName`, `EmployeeLastName`, `EmailId` FROM `employee` WHERE `EmployeeId` IN (SELECT `EmployeeId` FROM `generalrequests` WHERE `CustomerId`='input' and `RequestId`='input');




/* -----------------------------------------------------------*/
/* -----------------------------------------------------------*/
--	Code by: David York
--	Version: 1.0
--  Database: MySQL
--  Interface: PHP
--  Date: April 1, 2014
/* -----------------------------------------------------------*/


/*----------------------------------------------------------*/
# -- ----- get Account Balance ------------------------------

/*----------------------------------------------------------*/

/* -- Get the current account balance for a specified account number -- DY 2014-04-01 10:02pm */
/* Input is account number, output is variable &Balance in Call getBalance(AcctID, &Balance)*/
/* Balance amount can then be used as the variable &Balance */
delimiter //
DROP PROCEDURE IF EXISTS getBalance; //
CREATE PROCEDURE getBalance(IN AcctID_param INT(10), OUT Balance_param DECIMAL(9,2))
BEGIN
SET BALANCE_param = (SELECT `CurrentBalance` FROM `account` WHERE `AccountID` = `AcctID_param`);
END
//
delimiter ;


/*----------------------------------------------------------*/
# -- ----- Deposit and Withdrawl Transactions ---------------
# -- ----  with balance check -------------------------------

/*----------------------------------------------------------*/


-- ----------------------------------------------------------------------------------------------------------------------

/* -- Complete a specified Debit OR Credit transaction on a specified account --  DY 2014-04-01 10:02pm */
/*  calling procedure - - CALL transaction(AcctID_param, TransDetail_param, TransType_param, TransAmt_param)*/
delimiter //
DROP PROCEDURE IF EXISTS transaction; //
CREATE PROCEDURE transaction
(AcctID_param INT(10), TransDetail_param varchar(50), TransType_param varchar(6), TransAmt_param Decimal(9,2))

BEGIN
START TRANSACTION;
CALL getBalance(AcctID_param, @Balance_param);

IF TransAmt_param < @Balance_param AND TransType_param = 'Debit' THEN	
	INSERT INTO transactions 
	(`AccountId`,`TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`) VALUES
	(AcctID_param, NOW(), TransDetail_param, TransType_param, TransAmt_param);
	UPDATE account SET CurrentBalance = CurrentBalance - TransAmt_param WHERE AccountID = AcctID_param;
	COMMIT;
ELSEIF TransType_param = 'Credit' THEN
	INSERT INTO transactions 
	(`AccountId`,`TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`) VALUES 
	(AcctID_param, NOW(), TransDetail_param, TransType_param, TransAmt_param);  
	UPDATE account SET CurrentBalance = CurrentBalance + TransAmt_param WHERE AccountID = AcctID_param;
	COMMIT;
ELSE 
        SIGNAL SQLSTATE '01000'
        SET MESSAGE_TEXT = 'This Transaction Information is wrong or incomplete', MYSQL_ERRNO = 1000;

	ROLLBACK;
        
END IF;
END //

delimiter ;

/*----------------------------------------------------------*/
# -- ----- Transfer Funds between Accounts -------------------

/*----------------------------------------------------------*/

delimiter //
DROP PROCEDURE IF EXISTS transactionTRF; //
CREATE PROCEDURE transactionTRF
(ToAcctID_param INT(10), FromAcctID_param INT(10), TransDetail_param varchar(50), TransAmt_param Decimal(9,2))

BEGIN
START TRANSACTION;
CALL getBalance(FromAcctID_param, @Balance_param);

IF TransAmt_param < @Balance_param THEN	
	INSERT INTO transactions 
	(`AccountId`,`TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`) VALUES
	(FromAcctID_param, NOW(), TransDetail_param, 'Debit', TransAmt_param);
	UPDATE account SET CurrentBalance = CurrentBalance - TransAmt_param WHERE AccountID = FromAcctID_param;

	INSERT INTO transactions 
	(`AccountId`,`TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`) VALUES 
	(ToAcctID_param, NOW(), TransDetail_param, 'Credit', TransAmt_param);  
	UPDATE account SET CurrentBalance = CurrentBalance + TransAmt_param WHERE AccountID = ToAcctID_param;
	COMMIT;
ELSE 
        SIGNAL SQLSTATE '01000'
        SET MESSAGE_TEXT = 'This Transaction Information is wrong or incomplete', MYSQL_ERRNO = 1000;

	ROLLBACK;
        
END IF;
END //

delimiter ;


/*----------------------------------------------------------------------------*/
# -- ----- Post Daily Transactions to Banks General Journal -------------------

/*----------------------------------------------------------------------------*/

delimiter //
DROP PROCEDURE IF EXISTS posting;//
CREATE PROCEDURE posting()

BEGIN
DECLARE done INT;
DECLARE pSTATUS INT(1);
DECLARE pJournalDate DATE;
DECLARE pTransactionId INT(20);
DECLARE pAccountId INT(20);
DECLARE pTransactionDate DATETIME;
DECLARE pTransactionDetail varchar(50);
DECLARE pTransactionType varchar(6);
DECLARE pAmount DECIMAL(9,2);
DECLARE pTransactionStatus INT(1);
DECLARE Counts VARCHAR(255);
DECLARE pCursor CURSOR FOR SELECT 
    `TransactionId`, `AccountId`, `TransactionDate`, `TransactionDetail`, `TransactionType`, `Amount`, `TransactionStatus` FROM transactions;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;
SET done = 0;
SET pJournalDate = NOW();
SET pTransactionStatus = 1;
START TRANSACTION;
OPEN pCursor;

posting: LOOP
FETCH pCursor INTO 
    `pTransactionId`, `pAccountId`, `pTransactionDate`, `pTransactionDetail`, `pTransactionType`, `pAmount`, `pStatus`;
if done = 0 THEN
INSERT transactionsjournal(`TransactionId`, `AccountId`, `TransactionDate`, `JournalDate`, `TransactionDetail`, `TransactionType`, `Amount`, `TransactionStatus`)
    VALUE (`pTransactionId`, `pAccountId`, `pTransactionDate`, `pJournalDate`, `pTransactionDetail`, `pTransactionType`, `pAmount`, `pTransactionStatus`);
ELSE 
    TRUNCATE TABLE transactions;
    COMMIT;
    CLOSE pCursor;
    LEAVE posting;
end if;
END LOOP posting;
IF done = 0 THEN
    ROLLBACK;
    SIGNAL SQLSTATE '01000'
    SET MESSAGE_TEXT = 'posting Did Not Complete Properly', MYSQL_ERRNO = 1000;
END IF;
END;
//

delimiter ;













/* -----------------------------------------------------------*/
/* -----------------------------------------------------------*/
--	Code by: David Hardister
--	Version: 1.0
--  Database: MySQL
--  Interface: PHP
--  Date: April 3, 2014
/* -----------------------------------------------------------*/


/*----------------------------------------------------------*/
# -- ----- Customer Makes a Request ------------------------------
/*----------------------------------------------------------*/
/* RequestId must auto-increment */
/* Initial inquiry does not have EmployeeId */
/* GeneralRequests table needs Date and Time added as attribute */
/* GeneralRequests table needs Binary attribute (0=customer,1=employee) */

INSERT INTO generalrequests
('RequestId', 'CustomerId', 'RequestTypeId', 'IsPriority', 'UserComment') VALUES
(RequestId, CustomerId, RequestTypeId_param, IsPriority_param, UserComment_param);


/*----------------------------------------------------------*/
# -- ----- Customer Responds to Employee's Response ------------------------------
/*----------------------------------------------------------*/
/* RequestId must remain the same */

INSERT INTO generalrequests
('RequestId', 'CustomerId', 'EmployeeId', 'RequestTypeId', 'IsPriority', 'UserComment') VALUES
(RequestId, CustomerId, EmployeeId, RequestTypeId_param, IsPriority_param, UserComment_param);


/*----------------------------------------------------------*/
# -- ----- Customer Views List of Inquiries ------------------------------
/*----------------------------------------------------------*/

SELECT DISTINCT RequestId, RequestTypeId, IsPriority
FROM generalrequests WHERE CustomerId = global variable;


/*----------------------------------------------------------*/
# -- ----- Customer Selects Individual Request Conversation ------------------------------
/*----------------------------------------------------------*/

SELECT RequestId, CustomerId, EmployeeId, RequestTypeId, IsPriority, UserComment
FROM generalrequests WHERE RequestId = RequestId_param;


/*----------------------------------------------------------*/
# -- ----- Customer Queries Current Account ------------------------------
/*----------------------------------------------------------*/
/* Debits must be added and credits subtracted to work backwards */

SELECT TransactionDate AS PostDate, JournalDate AS EffectiveDate, TransactionDetail, TransactionType, 
	(CASE
		WHEN TransactionType = 'Credit' THEN CurrentBalance - Amount
		ELSE CurrentBalance + Amount
	 END
	) AS BeginningBalance, Amount, 
	(CASE
		WHEN TransactionType = 'Credit' THEN BeginningBalance + Amount
		ELSE BeginningBalance - Amount
	 END
	) AS RunningBalance
FROM account, transactions, transactionsjournal
WHERE CustomerId = global variable AND AccountId = AccountId_param AND TransactionDate BETWEEN NOW() AND DATEADD(MONTH, -1,NOW());


/*----------------------------------------------------------*/
# -- ----- Customer Queries Account History ------------------------------
/*----------------------------------------------------------*/

SELECT TransactionDate AS PostDate, JournalDate AS EffectiveDate, TransactionDetail, TransactionType, Amount, CurrentBalance AS RunningBalance
FROM account, transactionsjournal 
WHERE CustomerId = global variable AND AccountId = AccountId_param AND AccountType = AccountType_param AND JournalDate >= FromDate_param AND JournalDate <= ToDate_param AND IF TransactionType = Debit THEN CurrentBalance = CurrentBalance - Amount ELSE CurrentBalance = CurrentBalance + Amount;
