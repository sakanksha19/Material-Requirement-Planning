SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE DemandTable (
 
  Demanddate date,
  Product_id int NOT NULL,
  ProductName varchar(50) NOT NULL,
  ProductReq int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO DemandTable VALUES
('2022-01-01',101,'Shirt',10),
('2022-01-05',102,'Jeans',15),
('2022-01-18',101,'Shirt',5),
('2022-01-10',103,'T-Shirt',8),
('2022-01-21',102,'Jeans',12),
('2022-02-01',103,'T-Shirt',15);

CREATE TABLE Materialrequirements (
  Product_id INT NOT NULL PRIMARY KEY,
  ProductName varchar(20),
  Yarns INT NOT NULL,
  DYES int NOT NULL,
  Fabrics INT NOT NULL,
  Decoratives int NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO Materialrequirements VALUES
(101,"Shirt",10,15,20,20),
(102,"Jeans",20,5,10,10),
(103,"T-Shirt",10,15,25,30);

CREATE TABLE PriceTable(
    Material varchar(20) PRIMARY KEY,
    price INT
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO PriceTable VALUES
("Yarns",10),
("Dyes",5),
("Fabrics",15),
("Decoratives",20);

CREATE TABLE availableData(
    Material varchar(20) PRIMARY KEY,
    rem INT
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO availableData VALUES
("Yarns",100),
("Dyes",50),
("Fabrics",150),
("Decoratives",200);