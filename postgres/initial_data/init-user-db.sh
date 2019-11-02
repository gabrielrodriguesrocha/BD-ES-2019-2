#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
	CREATE SCHEMA internal;
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

	INSERT INTO internal.users VALUES ('admin@site.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', true);
	INSERT INTO internal.users VALUES ('user@site.com', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', false);
EOSQL