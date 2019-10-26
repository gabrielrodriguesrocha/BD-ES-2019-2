#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
	CREATE DATABASE exams;
	CREATE SCHEMA internal
    	AUTHORIZATION postgres;
	-- Table: internal.users

	-- DROP TABLE internal.users;
	
	CREATE TABLE internal.users
	(
	    username character varying(25) COLLATE pg_catalog."default" NOT NULL,
	    password character varying(255) COLLATE pg_catalog."default",
	    employee boolean,
	    CONSTRAINT users_pkey PRIMARY KEY (username)
	)
	WITH (
	    OIDS = FALSE
	)
	TABLESPACE pg_default;
	
	ALTER TABLE internal.users
	    OWNER to postgres;
EOSQL