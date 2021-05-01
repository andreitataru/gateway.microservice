CREATE DATABASE IF NOT EXISTS `users`;
USE users;
CREATE TABLE IF NOT EXISTS users (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    accountType VARCHAR(255),
    birthDate DATE,
    bankAccountNumber VARCHAR(255),
    rating DECIMAL(1,1) NOT NULL DEFAULT 0.0,
    timesRated INT(11) NOT NULL DEFAULT 0,
    cellphoneNumber VARCHAR(255),
    address VARCHAR(255),
    avatar VARCHAR(255) NOT NULL DEFAULT 'user.jpeg',
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE DATABASE IF NOT EXISTS `messages`;
USE messages;
CREATE TABLE IF NOT EXISTS messages (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idSender BIGINT(20) NOT NULL,
    idReceiver BIGINT(20) NOT NULL,
    message VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE DATABASE IF NOT EXISTS `houses`;
USE houses;
create TABLE IF NOT EXISTS houses (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    hostId INT(11) NOT NULL,
    address VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    coordinates VARCHAR(255) NOT NULL,
    rent DOUBLE(8,2) NOT NULL,
    maxPeopleNum INT(11) NOT NULL,
    roomsNum INT(11) NOT NULL,
    area INT(11) NOT NULL,
    houseType VARCHAR(255) NOT NULL,
    spaceType VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    closeServices VARCHAR(255) NOT NULL DEFAULT "",
    commodities VARCHAR(255) NOT NULL DEFAULT "",
    houseRules VARCHAR(255) NOT NULL DEFAULT "",
    installations VARCHAR(255) NOT NULL DEFAULT "",
    rating DECIMAL(1,1) NOT NULL DEFAULT 0.0,
    timesRated INT(11) NOT NULL DEFAULT 0,
    dateAvailable DATE NOT NULL,
    pictures VARCHAR(255) NOT NULL DEFAULT "",
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE DATABASE IF NOT EXISTS `services`;
USE services;
create TABLE IF NOT EXISTS services (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    providerId INT(11) NOT NULL,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    priceHour DOUBLE(8,2) NOT NULL,
    serviceType VARCHAR(255) NOT NULL,
    description VARCHAR(255) NOT NULL,
    rating DECIMAL(1,1) NOT NULL DEFAULT 0.0,
    minHourDay INT(11) NOT NULL,
    maxHourDay INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);