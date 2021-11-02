<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "webDB";

$connection = new mysqli($servername, $username, $password, $dbname);

if($connection->connect_error){
    die("Connection failed: " . $connection->connect_error);
}

$users = "INSERT INTO `users` (`uid`, `username`, `password`, `firstname`, `lastname`, `phone`)
VALUES ('fda786c58c3c4', 'user1@gmail.com', 'e64b78fc3bc91bcbc7dc232ba8ec59e0', 'Hoang', 'Tran', '0909999999'), #Admin123
('d2a095d4abd64','testuser@gmail.com','3e31b725acb8bfca0e49ccbddb25d3e7','Hung','Lam','0123456789')"; #User123456

$phars = "INSERT INTO `pharmacy`(`phid`, `name`, `latitude`, `longitude`)
VALUES ('a43ed8d9c1874','DR. H', 10.77376426982302, 106.66056565582056),
('21e1a6590ec74','BK pharmacy', 10.770890360902907, 106.65593515361698)";

$products = "INSERT INTO `products` (`pid`, `productname`, `condition`, `price`, `description`)
VALUES ('618005651c83c','Acenocoumarol','Cardiovascular and Blood Pressure',200000,'Indications for occurrence or risk of phlebitis, pulmonary embolism, atrial fibrillation, valvular malformation, prosthetic heart valve, patients with severe heart failure with EF < 30%'),
('6180055d946f8','Natrixam','Cardiovascular and Blood Pressure',250000,'Alternative in the treatment of hypertension for patients already receiving indapamide and amlodipine separately of the same strength.'),
('618004c088173','Aceronko','Cardiovascular and Blood Pressure',367000,'Aceronko 4 is a drug to treat heart disease that causes embolism, myocardial infarction.'),
('618004cebd99c','Maxlen','Osteoarthritis',90000,'Prevention and treatment of osteoporosis in postmenopausal women. Treatment of osteoporosis in men by increasing bone mass. Treatment of glucocorticoid-induced osteoporosis'),
('618004da4d32f','AtiGluco','Osteoarthritis',232000,'AtiGluco is used to relieve symptoms of mild and moderate knee osteoarthritis.'),
('618004e461875','Viartril-S','Osteoarthritis',315000,'Viartril-S is effective in reducing symptoms of mild and moderate osteoarthritis of the knee.'),
('618004ed4ff08','Fosamax','Osteoarthritis',161000,'Treatment of osteoporosis in men to prevent fractures and to help ensure adequate vitamin D.'),
('618004fa732dc','AcetylCystein','Cough',45000,'Acetylcysteine ​​200mg Uses: Treatment of bronchial secretion disorders (sputum)Usage: Adults and children from 2 years old Form: Oral powder Brand: Boston (Vietnam)'),
('618005075b2eb','AcezinDHG','Cough',9000,'Alimemazine tartrate 5mg Uses: Treatment of respiratory allergies, skin allergies, dry cough, substitute for benzodiazepines in the short-term treatment of insomnia. Subjects of use: Adults, children over 2 years of age Form: Coated tablets movieBrand: DHG Pharma (Vietnam)'),
('618005107f729','Becacold-S','Cough',100000,'Becacold-S (acetaminophen 500mg, chlorpheniramine maleate 2mg, phenylephrin HCl 10mg) is a medicine used to treat the symptoms of the common cold, allergic rhinitis, vasomotor rhinitis, flu secretory mucositis and other respiratory disorders. steam on.'),
('6180051cabbbf','Halixol','Cough',30000,'Halixol 30mg treats airway obstruction such as bronchial asthma and bronchitis, bronchiectasis caused by excessive production of mucus and phlegm, enhances the dissolution of mucus in nasopharyngitis.'),
('6180052502a07','Molitoux','Cough',36000,'Active ingredient: Eprazinon 50mg Uses: Treatment of bronchitisUsage: AdultsForm: Film-coated tablets Brand: Domesco (Vietnam) *The drug is only for prescription by a doctor.'),
('6180052b862ce','Strepsils','Cough',230000,'Active ingredient: Flurbiprofen 8.75mg Uses: Relieves pain in severe sore throat, anti-inflammatory Uses: Adults and children over 12 years old Form:Lozenges Brand: Reckitt Benckiser (Thailand)'),
('618005341c95c','Hexinvon','Cough',38000,'Hexinvon 8mg breaks down secretions in bronchopulmonary diseases associated with abnormal mucus secretion such as acute and chronic bronchitis, other chronic pulmonary embolism.'),
('618005393c8e1','Wonfixim','Antibiotic',346000,'Pharyngitis, tonsillitis caused by Streptococcus pyogenes.'),
('6180053e89973','Ofmantine','Antibiotic',433000,'OFMANTINE is used for the short-term treatment of infections caused by susceptible bacteria.'),
('61800543b470b','Cratsuca','Digestion',172000,'Sucralfate is indicated in adults and children over 14 years of age with duodenal ulcer, peptic ulcer, chronic gastritis, and for the prevention of gastrointestinal bleeding.'),
('6180054a474a9','Gelbra','Digestion',211000,'Gastric and duodenal ulcers, Gastroesophageal reflux disease (GORD).'),
('618005503a84e','HolistiCare-Ester','Vitamin',82000,'Provides the body need for Vitamin C, enhances resistance.'),
('618005560a07a','UPSA-C','Vitamin',35000,'Treatment of Vitamin C deficiency.')";

$belongto = "INSERT INTO `belongto` (`pharmacyid`, `productid`)
VALUES ('a43ed8d9c1874','618005651c83c'),
('a43ed8d9c1874','6180055d946f8'),
('a43ed8d9c1874','618004c088173'),
('a43ed8d9c1874','618004cebd99c'),
('a43ed8d9c1874','618004da4d32f'),
('a43ed8d9c1874','618004e461875'),
('a43ed8d9c1874','618004ed4ff08'),
('a43ed8d9c1874','618004fa732dc'),
('a43ed8d9c1874','618005075b2eb'),
('a43ed8d9c1874','618005107f729'),
('a43ed8d9c1874','6180051cabbbf'),
('a43ed8d9c1874','6180052502a07'),
('a43ed8d9c1874','6180052b862ce'),
('a43ed8d9c1874','618005341c95c'),
('21e1a6590ec74','618005393c8e1'),
('21e1a6590ec74','6180053e89973'),
('21e1a6590ec74','61800543b470b'),
('21e1a6590ec74','6180054a474a9'),
('21e1a6590ec74','618005503a84e'),
('21e1a6590ec74','618005560a07a'),
('21e1a6590ec74','618005651c83c'),
('21e1a6590ec74','6180055d946f8'),
('21e1a6590ec74','618004c088173'),
('21e1a6590ec74','618004cebd99c'),
('21e1a6590ec74','618004da4d32f'),
('21e1a6590ec74','618004e461875'),
('21e1a6590ec74','618004ed4ff08'),
('21e1a6590ec74','618004fa732dc'),
('21e1a6590ec74','6180052b862ce')";

$transactions = "INSERT INTO `transactions` (`tid`, `userid`, `pid`, `quantity`, `overallprice`, `boughtdate`)
VALUES ('618006b64fc06','fda786c58c3c4','618005651c83c',2,400000,'2021-11-1 22:30:13')";

if ($connection->multi_query($users) === TRUE) {
    echo "successfully ";
} else {
    echo "Error: " . $connection->error;
}

if ($connection->multi_query($phars) === TRUE) {
    echo "successfully ";
} else {
    echo "Error: ". $connection->error;
}
if ($connection->multi_query($products) === TRUE) {
    echo "successfully ";
} else {
    echo "Error: "  . $connection->error;
}
if ($connection->multi_query($belongto) === TRUE) {
    echo "successfully ";
} else {
    echo "Error: " . $connection->error;
}
if ($connection->multi_query($transactions) === TRUE) {
    echo "successfully ";
} else {
    echo "Error: " . $connection->error;
}

$connection->close();
?>