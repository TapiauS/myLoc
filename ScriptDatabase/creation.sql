DROP TABLE borrow ;
DROP TABLE item;
DROP TABLE users;
DROP TABLE roles;
DROP TABLE category_item;


CREATE TABLE _role(
    id SERIAL PRIMARY KEY,
    role_name VARCHAR UNIQUE NOT NULL
);


CREATE TABLE category_item(
    id SERIAL PRIMARY KEY,
    category_name VARCHAR UNIQUE NOT NULL
);

CREATE TABLE _user(
    id SERIAL  PRIMARY KEY,
    pseudo VARCHAR  UNIQUE NOT NULL,
    points INT NOT NULL DEFAULT 0,
    password VARCHAR UNIQUE NOT NULL,
    town VARCHAR,
    adress TEXT,
    id_role INT,
    FOREIGN KEY(id_role) REFERENCES _role(id)
);

CREATE TABLE item(
    id SERIAL PRIMARY KEY,
    name VARCHAR NOT NULL,
    desription VARCHAR,
    picture_path VARCHAR ,
    id_category_item INT NOT NULL,
    id_user INT NOT NULL,
    FOREIGN KEY(id_category_item) REFERENCES category_item(id),
    FOREIGN KEY(id_user) REFERENCES _user(id) ON DELETE CASCADE
);

CREATE TABLE borrow(
    id SERIAL PRIMARY KEY,
    id_item INT NOT NULL,
    id_user INT NOT NULL,
    startdate DATE,
    enddate DATE,
    FOREIGN KEY(id_item) REFERENCES item(id) ,
    FOREIGN KEY(id_user) REFERENCES _user(id) 
);