CREATE DATABASE deliverable;

CREATE TABLE account (
    id int NOT NULL AUTO_INCREMENT,
    company_id int NULL,
    gender enum('male','female','other') NOT NULL,
    firstName varchar(15) NOT NULL,
    surNamePrefix varchar(10) NULL,
    surName varchar(50) NOT NULL,
    phone varchar(11) NULL,
    mobile varchar(11) NULL,
    email varchar(100) NOT NULL,
    password varchar(64) NOT NULL,
    loginCookie varchar(64) NULL,
    createdAt timestamp NOT NULL,
    updatedAt timestamp NULL,
    deletedAt timestamp NULL,
    CONSTRAINT account_pk PRIMARY KEY (id)
);


CREATE TABLE account_role (
    account_id int NOT NULL,
    role_id int NOT NULL,
    CONSTRAINT account_role_pk PRIMARY KEY (account_id,role_id)
);


CREATE TABLE address (
    id int NOT NULL AUTO_INCREMENT,
    street varchar(50) NOT NULL,
    houseNumber int NOT NULL,
    houseNumberSuffix varchar(10) NULL,
    postcode varchar(12) NOT NULL,
    mailbox int NULL,
    city varchar(50) NOT NULL,
    country varchar(30) NOT NULL,
    additionalInfo varchar(255) NULL,
    CONSTRAINT address_pk PRIMARY KEY (id)
);


CREATE TABLE address_account (
    account_id int NOT NULL,
    address_id int NOT NULL,
    CONSTRAINT address_account_pk PRIMARY KEY (account_id,address_id)
);


CREATE TABLE attribute (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    value varchar(50) NOT NULL,
    CONSTRAINT attribute_pk PRIMARY KEY (id)
);


CREATE TABLE company (
    id int NOT NULL AUTO_INCREMENT,
    address_id int NOT NULL,
    name varchar(50) NOT NULL,
    cocNumber int NOT NULL,
    vatNumber varchar(14) NOT NULL,
    website varchar(50) NULL,
    email varchar(30) NOT NULL,
    createdAt timestamp NOT NULL,
    updatedAt timestamp NULL,
    deletedAt timestamp NULL,
    CONSTRAINT company_pk PRIMARY KEY (id)
);


CREATE TABLE company_product (
    company_id int NOT NULL,
    product_id varchar(13) NOT NULL,
    status varchar(50) NULL,
    price real(6,2) NOT NULL,
    instock int NULL,
    createdAt timestamp NOT NULL,
    deletedAt timestamp NULL,
    updatedAt timestamp NULL,
    CONSTRAINT company_product_pk PRIMARY KEY (company_id,product_id)
);


CREATE TABLE contact (
    id int NOT NULL AUTO_INCREMENT,
    company_id int NOT NULL,
    firstName varchar(15) NOT NULL,
    surNamePrefix varchar(10) NULL,
    surName varchar(50) NOT NULL,
    email varchar(50) NOT NULL,
    phone varchar(11) NULL,
    mobile varchar(11) NULL,
    type varchar(10) NOT NULL,
    CONSTRAINT contact_pk PRIMARY KEY (id)
);


CREATE TABLE product (
    ean varchar(13) NOT NULL,
    parent_id varchar(13) NULL,
    productCategory_id int NOT NULL,
    productImage_Id int NULL,
    name varchar(50) NOT NULL,
    description varchar(255) NULL,
    vat_type char(1) NOT NULL,
    CONSTRAINT product_pk PRIMARY KEY (ean)
);


CREATE TABLE productCategory (
    id int NOT NULL AUTO_INCREMENT,
    parent_id int NULL,
    name varchar(50) NOT NULL,
    description varchar(255) NULL,
    CONSTRAINT productCategory_pk PRIMARY KEY (id)
);


CREATE TABLE productImage (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NULL,
    description varchar(50) NULL,
    path varchar(255) NOT NULL,
    product_ean varchar(13) NOT NULL,
    CONSTRAINT productImage_pk PRIMARY KEY (id)
);


CREATE TABLE product_attribute (
    product_ean varchar(13) NOT NULL,
    attribute_id int NOT NULL,
    CONSTRAINT product_attribute_pk PRIMARY KEY (product_ean,attribute_id)
);

CREATE TABLE role (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(30) NOT NULL,
    CONSTRAINT role_pk PRIMARY KEY (id)
);


CREATE TABLE vat (
    type char(1) NOT NULL,
    CONSTRAINT vat_pk PRIMARY KEY (type)
);

CREATE TABLE log (
    id int NOT NULL AUTO_INCREMENT,
    string varchar(100) NOT NULL,
    results int NOT NULL,
    created_at timestamp NOT NULL,
    CONSTRAINT log_pk PRIMARY KEY (id)
)

ALTER TABLE productCategory ADD CONSTRAINT ProductCategory_ProductCategory FOREIGN KEY ProductCategory_ProductCategory (parent_id)
    REFERENCES productCategory (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE product ADD CONSTRAINT ProductCategory_product FOREIGN KEY ProductCategory_product (productCategory_id)
    REFERENCES productCategory (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE account ADD CONSTRAINT account_company FOREIGN KEY account_company (company_id)
    REFERENCES company (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE account_role ADD CONSTRAINT account_role_account FOREIGN KEY account_role_account (account_id)
    REFERENCES account (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;


ALTER TABLE account_role ADD CONSTRAINT account_role_role FOREIGN KEY account_role_role (role_id)
    REFERENCES role (id)
    ON UPDATE RESTRICT;


ALTER TABLE address_account ADD CONSTRAINT address_account_account FOREIGN KEY address_account_account (account_id)
    REFERENCES account (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;


ALTER TABLE address_account ADD CONSTRAINT address_account_address FOREIGN KEY address_account_address (address_id)
    REFERENCES address (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;

ALTER TABLE company_product ADD CONSTRAINT companyProduct_company FOREIGN KEY companyProduct_company (company_id)
    REFERENCES company (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;


ALTER TABLE company ADD CONSTRAINT company_address FOREIGN KEY company_address (address_id)
    REFERENCES address (id)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE contact ADD CONSTRAINT contact_company FOREIGN KEY contact_company (company_id)
    REFERENCES company (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;


ALTER TABLE productImage ADD CONSTRAINT productassets/images_product FOREIGN KEY productassets/images_product (product_ean)
    REFERENCES product (ean)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE product_attribute ADD CONSTRAINT product_attribute_attribute FOREIGN KEY product_attribute_attribute (attribute_id)
    REFERENCES attribute (id)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;


ALTER TABLE product_attribute ADD CONSTRAINT product_attribute_product FOREIGN KEY product_attribute_product (product_ean)
    REFERENCES product (ean)
    ON DELETE CASCADE
    ON UPDATE RESTRICT;


ALTER TABLE company_product ADD CONSTRAINT product_companyProduct FOREIGN KEY product_companyProduct (product_id)
    REFERENCES product (ean)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE product ADD CONSTRAINT product_product FOREIGN KEY product_product (parent_id)
    REFERENCES product (ean)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT;


ALTER TABLE product ADD CONSTRAINT product_vat FOREIGN KEY product_vat (vat_type)
    REFERENCES vat (type)
    ON DELETE RESTRICT
    ON UPDATE CASCADE;