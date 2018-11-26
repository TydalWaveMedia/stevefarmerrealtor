ALTER USER 'tydal_wp'@'%' IDENTIFIED BY 'OneMoreSale69';
CREATE USER 'tydal_wp'@'%.%.%.%' IDENTIFIED BY 'OneMoreSale69';
GRANT ALL PRIVILEGES ON *.* TO 'tydal_wp'@'%';
GRANT ALL PRIVILEGES ON *.* TO 'tydal_wp'@'%.%.%.%';
FLUSH PRIVILEGES;
