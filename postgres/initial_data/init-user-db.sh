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

	INSERT INTO internal.users VALUES ('drauzio', 'a48b43e3b209810ac497cf7488e70c9ebf4fbdfc959c493b08eb3ce5132fadfc', false);
	INSERT INTO internal.users VALUES ('leozin', '1f2e7c091036e2d459e69137f8b2ed78b6a0ae9b5bcc9c62e384a9e99f293cca', false);
	INSERT INTO internal.users VALUES ('hortencia', 'b1d4c27cd07adfccd0eaba2cb07a3ffeca29d7776f50cadc99aff2c5fb1471b9', false);
	INSERT INTO internal.users VALUES ('choko', '7ac643e9f7bb7360478fe2126d72ff4d3e6164159ca3fe70a5cccffa1e7890eb', false);
	INSERT INTO internal.users VALUES ('eleven', '1036ba144eaee0a0434df75c46999077bdaec45c5bb4fe0492af7d9f635e0ad9', false);
	INSERT INTO internal.users VALUES ('ryze', '3b0eb7adcebee13eb3d7ca4aeb9e890647c6caa893cad164db8258ebd655cc6c', false);
	INSERT INTO internal.users VALUES ('mormaco', '5e4d8dbb1f041bc25ecabbec8522f516b2e4b00639d55df5957e2ae3fc71dc3d', false);
	INSERT INTO internal.users VALUES ('hskodama', '4964c335001f1aa87b6a98664c069b5cc8643a39bac997879689b909d075c257', false);
	INSERT INTO internal.users VALUES ('highelo', 'd70086c04a209172d4fba6311de8fa38aa1ba3dea5868635f1ca3df999dcc7a2', false);
	INSERT INTO internal.users VALUES ('toyquedo', '8a24b49c2648230aa108d91c3a79c6b20eba41f450351db0ceff8002b25278f2', false);
	INSERT INTO internal.users VALUES ('cosi', '9b658fd802df8a132ec8d4c50526c3dc5583234db5f166f72eb9791ddf7c1f60', false);
	INSERT INTO internal.users VALUES ('bell', '931ee1c9e9be0e73500037b43961cc9a6b09ec79f7fd9871e3d162fa273a452f', false);

	INSERT INTO internal.users VALUES ('rocha', 'e6da9a41d0345e3d8eaf6971e20438d4bb5760cfe72bc28da3a4c1ef77ef29fe', true);
	INSERT INTO internal.users VALUES ('gabriel', 'd482c10b3d4d2a198042e6c042e7a6d292dd4d4abd4bf7820813fcc316135063', true);
	INSERT INTO internal.users VALUES ('shiko', 'b171bce4a5f07d2c31f063b9a076f0d8eb775e94040d7b76aaab87b1b2a75ce3', true);
	INSERT INTO internal.users VALUES ('verinha', 'e1b0c451044f9e219ed4e7470f6ba9b025fe4a1ec8a761a7d4c1f0a46dda96a4', true);
	INSERT INTO internal.users VALUES ('pablooo', 'ca243c3d76725a0e343c720e9a9058f11d9d274fc471e29d6c027cbb89a15aa0', true);
	INSERT INTO internal.users VALUES ('sujeira', 'ba3204def1e6e966e0888ee50dd045efeae2f95c0052c291f02eb48b80b677fb', true);
EOSQL