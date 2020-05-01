
CREATE DATABASE IF NOT EXISTS `urlshortener_test`;

CREATE USER 'test'@'%' IDENTIFIED BY 'test';
GRANT ALL ON urlshortener_test.* to 'test'@'%';
