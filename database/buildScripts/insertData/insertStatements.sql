INSERT INTO driver VALUES ('111222333', 'George',null, 'Washington');
INSERT INTO driver VALUES ('222333444', 'John',null, 'Adams');
INSERT INTO driver VALUES ('333444555', 'Thomas',null, 'Jefferson');
INSERT INTO driver VALUES ('444555666', 'James',null, 'Madison');
INSERT INTO driver VALUES ('555666777', 'James',null, 'Monroe');
INSERT INTO driver VALUES ('666777888', 'John','Q.', 'Adams');
INSERT INTO driver VALUES ('777888999', 'Andrew',null, 'Jackson');
INSERT INTO driver VALUES ('888999101', 'Martin',null, 'Van Buren');
INSERT INTO driver VALUES ('999101111', 'William','H.', 'Harrison');
INSERT INTO driver VALUES ('101111121', 'John',null, 'Tyler');
INSERT INTO driver VALUES ('111121131', 'James',null, 'Polk');

INSERT INTO license VALUES ('111222333', '42839282', 'George', null, 'Washington', '2023-12-24');
INSERT INTO license VALUES ('222333444', '93829392', 'John', null, 'Adams', '2018-02-14');
INSERT INTO license VALUES ('333444555', '83284783','Thomas', null, 'Jefferson', '2024-04-19');
INSERT INTO license VALUES ('444555666', '87237481','James', null, 'Madison', '2025-11-01');
INSERT INTO license VALUES ('555666777', '10284783','James', null, 'Monroe', '2005-06-16');
INSERT INTO license VALUES ('666777888', '94787921','John', 'Q.', 'Adams', '2009-04-27');
INSERT INTO license VALUES ('777888999', '84289742', 'Andrew',null, 'Jackson', '2009-04-19');
INSERT INTO license VALUES ('888999101', '96593892', 'Martin',null, 'Van Buren', '2005-03-30');
INSERT INTO license VALUES ('999101111', '84568123','William','H.', 'Harrison', '2006-07-22');
INSERT INTO license VALUES ('101111121', '98546587','John',null, 'Tyler', '2005-08-16');
INSERT INTO license VALUES ('111121131', '25412698','James',null, 'Polk', '2003-01-14');


INSERT INTO insurance VALUES ('111222333', 'Omaha');
INSERT INTO insurance VALUES ('222333444', 'Liberty');
INSERT INTO insurance VALUES ('333444555', 'American Life');
INSERT INTO insurance VALUES ('444555666', 'Liberty');
INSERT INTO insurance VALUES ('555666777', 'American Life');
INSERT INTO insurance VALUES ('666777888', 'Amica');
INSERT INTO insurance VALUES ('111121131', 'Omaha');
INSERT INTO insurance VALUES ('101111121', 'Liberty');
INSERT INTO insurance VALUES ('999101111', 'American Life');
INSERT INTO insurance VALUES ('777888999', 'Amica');
INSERT INTO insurance VALUES ('888999101', 'Amica');

INSERT INTO vehicleowned VALUES ('111222333','19345832912394394','2010-12-08', null);
INSERT INTO vehicleowned VALUES ('222333444','29137489321467127','2011-08-02', null);
INSERT INTO vehicleowned VALUES ('333444555','89732891237894381','2012-03-23', null);
INSERT INTO vehicleowned VALUES ('444555666','91373891237491271','2008-09-12', null);
INSERT INTO vehicleowned VALUES ('555666777','89432178912375978','2009-10-11', null);
INSERT INTO vehicleowned VALUES ('666777888','84736842785810038','2013-01-29', null);
INSERT INTO vehicleowned VALUES ('777888999','87381328903748219','2012-03-10', null);
INSERT INTO vehicleowned VALUES ('888999101','87893921823718294','2003-11-18', null);
INSERT INTO vehicleowned VALUES ('999101111','90527281228497919','2005-10-12', null);
INSERT INTO vehicleowned VALUES ('101111121','93018462819393728','2014-02-19', null);
INSERT INTO vehicleowned VALUES ('111121131','83229348892017322','2016-09-30', null);

INSERT INTO repairshop VALUES ('Farmington Auto',121,'farmington falls road','farmington','maine');
INSERT INTO repairshop VALUES ('Paris Auto',14,'north street','paris','maine');


INSERT INTO vehicle VALUES ('19345832912394394','Honda','Civic','red',18740,'Farmington Auto');
INSERT INTO vehicle VALUES ('29137489321467127','Lexus','RX 350','green',32000,'Farmington Auto');
INSERT INTO vehicle VALUES ('89732891237894381','Ford','Mustang','black',21000,'Farmington Auto');
INSERT INTO vehicle VALUES ('91373891237491271','Honda','Fit','red',57000,'Paris Auto');
INSERT INTO vehicle VALUES ('89432178912375978','Chevrolet','Corvette','orange',45000,'Paris Auto');
INSERT INTO vehicle VALUES ('84736842785810038','Honda','Accord','red',22455,'Farmington Auto');
INSERT INTO vehicle VALUES ('87381328903748219','Toyota','Tacoma','silver',24320,'Farmington Auto');
INSERT INTO vehicle VALUES ('87893921823718294','Jeep','Grand Cherokee','grey',30395,'Farmington Auto');
INSERT INTO vehicle VALUES ('90527281228497919','Land Rover','Range Rover','green',85650,'Paris Auto');
INSERT INTO vehicle VALUES ('93018462819393728','Acura','MDX','red',44050,'Paris Auto');
INSERT INTO vehicle VALUES ('83229348892017322','Toyota','Sienna','red',29750,'Farmington Auto');


INSERT INTO mechanics VALUES ('john','stander','Paris Auto');
INSERT INTO mechanics VALUES ('anthony','trist','Paris Auto');
INSERT INTO mechanics VALUES ('leroy','herra','Farmington Auto');


INSERT INTO engine VALUES ('19345832912394394', 150, 2.2, 4);
INSERT INTO engine VALUES ('29137489321467127', 110, 1.9, 4);
INSERT INTO engine VALUES ('89732891237894381', 240, 3.0, 6);
INSERT INTO engine VALUES ('91373891237491271', 500, 4.0, 6);
INSERT INTO engine VALUES ('89432178912375978', 312, 3.0, 6);
INSERT INTO engine VALUES ('84736842785810038', 228, 2.0, 4);
INSERT INTO engine VALUES ('87381328903748219', 300, 2.2, 4);
INSERT INTO engine VALUES ('87893921823718294', 220, 2.1, 4);
INSERT INTO engine VALUES ('90527281228497919', 456, 4.5, 6);
INSERT INTO engine VALUES ('93018462819393728', 510, 4.6, 8);
INSERT INTO engine VALUES ('83229348892017322', 319, 3.1, 6);

INSERT INTO employment VALUES ('Glover Corp','22','grover','cleveland','ohio','111222333');
INSERT INTO employment VALUES ('Holistic Healing Inc','34','stearns','malden','massachusetts','222333444');
INSERT INTO employment VALUES ('Trident Plastics','576','franklin','miami','florida','333444555');
INSERT INTO employment VALUES ('Glover Corp','224','roosevelt','trennen','oklahoma','444555666');
INSERT INTO employment VALUES ('Hannaford','19','ellen','denver','colorado','555666777');
INSERT INTO employment VALUES ('Wal-Mart','67','torooksaw pkwy','chester city','utah','666777888');
INSERT INTO employment VALUES ('University of New Hampshire','42','el monte', 'lakewood', 'new hampshire', '777888999');
INSERT INTO employment VALUES ('Skynet','91', 'throne', 'chapasta', 'florida', '888999101');
INSERT INTO employment VALUES ('Sony','101', 'queen', 'yorkshire', 'delaware', '999101111');
INSERT INTO employment VALUES ('HP','280', 'fellsway', 'medfield', 'maryland', '101111121');
INSERT INTO employment VALUES ('Hannaford','162', 'bond', 'jamestown', 'rhode island', '111121131');


INSERT INTO residence VALUES ('43','ashmont','cleveland','ohio','111222333');
INSERT INTO residence VALUES ('57','davis','malden','massachusetts','222333444');
INSERT INTO residence VALUES ('123','porter','miami','florida','333444555');
INSERT INTO residence VALUES ('45','chelsea','trennen','oklahoma','444555666');
INSERT INTO residence VALUES ('73','harvard','denver','colorado','555666777');
INSERT INTO residence VALUES ('41','kendall','chester city','utah','666777888');
INSERT INTO residence VALUES ('467','hillsborrow','el monte','new hampshire','777888999');
INSERT INTO residence VALUES ('291', 'hilton', 'chapasta', 'florida', '888999101');
INSERT INTO residence VALUES ('913', 'linwood', 'yorkshire', 'delaware', '999101111');
INSERT INTO residence VALUES ('27', 'hather', 'medfield', 'maryland', '101111121');
INSERT INTO residence VALUES ('14', 'trinus', 'jamestown', 'rhode island', '111121131');
