-- select 1
-- Surandama uzsakumu paslaugus kiekiai nurodytam laikotarpiui
SELECT SQL_NO_CACHE s.name, COUNT(*)
FROM JobsRegister AS jr
JOIN JobsRegister_Services AS jrs ON jr.jobsRegisterId = jrs.jobsRegisterId
JOIN Services AS s ON jrs.serviceId = s.serviceId
WHERE arrivalDate < '2007-06-30' AND arrivalDate > '2007-06-01' 
GROUP BY s.serviceId ASC;
-- be index						su index
-- Duration  / Fetch			Duration  / Fetch
-- 0,817 sec / 0,00092 sec		0,0018 sec / 0,000022 sec

-- select 2
-- Nurodyto laikotraptio medziagu sanaudu ataskaita
SELECT SQL_NO_CACHE m.name, SUM(jrm.count), m.price, m.cost, m.unit
FROM JobsRegister AS jr
JOIN JobsRegister_Materials AS jrm ON jr.jobsRegisterId = jrm.jobsRegisterId
JOIN Materials AS m ON jrm.materialId = m.materialId
WHERE arrivalDate < '2007-06-30' AND arrivalDate > '2007-06-01' 
GROUP BY jrm.materialId;
-- be index						su index
-- Duration  / Fetch			Duration  / Fetch
-- 0,943 sec / 0,000013 sec		0,0021 sec / 0,000029 sec

-- select 3
-- Techniko nurodyto laikotarpio atliktu darbu ataskaita
SELECT SQL_NO_CACHE jr.kkTechnicianId, jr.contractId, s.name, jr.arrivalDate
FROM JobsRegister AS jr
JOIN JobsRegister_Services AS jrs ON jr.jobsRegisterId = jrs.jobsRegisterId
JOIN Services AS s ON jrs.serviceId = s.serviceId
WHERE jr.kkTechnicianId = 66 AND jr.arrivalDate < '2008-06-30' AND arrivalDate > '2007-06-01' 
ORDER BY arrivalDate;
-- be index						su index
-- Duration  / Fetch			Duration  / Fetch
-- 0,778 sec / 0,00090 sec		0,0030 sec / 0,063 sec

-- update 1

-- update 2

-- delete 1
DELETE FROM JobsRegister
WHERE JobsRegister.kkTechnicianId = 66;
-- be index						su index
-- Duration  / Fetch			Duration  / Fetch
-- 0,253 sec    				0,022 sec			        		

-- delete 2
DELETE FROM JobsRegister_Services
WHERE JobsRegister_Services.serviceId = 2;
-- be index						su index
-- Duration  / Fetch			Duration  / Fetch
-- 0,537 sec					2,417 sec		 

-- insert 1

-- insert 2

-- insert 3
	