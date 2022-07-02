create database if not exists coderschat;


create table if not exists coderschat.messages
(
    msg_id          INTEGER AUTO_INCREMENT,
    outgoing_msg_id INTEGER,
    incoming_msg_id INTEGER,
    msg             TEXT,
    PRIMARY KEY (msg_id)
);

CREATE TABLE IF NOT EXISTS coderschat.users
(
    user_id   INTEGER AUTO_INCREMENT,
    unique_id INTEGER,
    username  VARCHAR(60),
    email     varchar(255),
    password  varchar(255),
    img       varchar(255),
    status    varchar(255),
    PRIMARY KEY (user_id),
    INDEX (email, unique_id, username)
);