
CREATE TABLE inscricao (
    inscricaoId integer PRIMARY KEY AUTOINCREMENT,
    militarId text,
    planoId integer,
    status integer,
    criadoEm text
);
-- POSTGREE
CREATE TABLE inscricao (
    inscricaoId SERIAL,
    militarId varchar,
    planoId integer,
    status integer,
    criadoEm varchar
);


