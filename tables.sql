CREATE TABLE `users` (
    `uid` VARCHAR(40) NOT NULL,
    `username` VARCHAR(256) NOT NULL UNIQUE,
    `password` VARCHAR(256) NOT NULL,
    `firstname` VARCHAR(50),
    `lastname` VARCHAR(50),
    `phone` VARCHAR(15),
    PRIMARY KEY (`uid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pharmacy`(
    `phid` VARCHAR(40) NOT NULL,
    `name` VARCHAR(100) NOT NULL UNIQUE,
    `latitude` FLOAT NOT NULL UNIQUE,
    `longitude` FLOAT NOT NULL UNIQUE,
    PRIMARY KEY (`phid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `products`(
    `pid` VARCHAR(40) NOT NULL,
    `productname` VARCHAR(100) NOT NULL UNIQUE,
    `condition` VARCHAR(256) NOT NULL, 
    `price` FLOAT NOT NULL,
    `description` VARCHAR(300) NOT NULL,
    PRIMARY KEY (`pid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `belongto`(
    `pharmacyid` VARCHAR(40) NOT NULL,
    `productid` VARCHAR(40) NOT NULL,
    FOREIGN KEY (`productid`) REFERENCES `products` (`pid`),
    FOREIGN KEY (`pharmacyid`) REFERENCES `pharmacy` (`phid`),
    PRIMARY KEY (`productid`, `pharmacyid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `transactions`(
    `tid` VARCHAR(40) NOT NULL,
    `userid` VARCHAR(40) NOT NULL,
    `pid` VARCHAR(40) NOT NULL,
    `quantity` INT UNSIGNED NOT NULL,
    `overallprice` FLOAT NOT NULL,
    `boughtdate` datetime NOT NULL,
    PRIMARY KEY (`tid`, `userid`),
    FOREIGN KEY (`pid`) REFERENCES `products` (`pid`),
    CONSTRAINT `FK_UserTransactions` FOREIGN KEY (`userid`) REFERENCES `users`(`uid`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;