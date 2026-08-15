CREATE TABLE roles (
    id_role SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE clients (
    id_client SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    adresse VARCHAR(150) NOT NULL,
    email VARCHAR(100) UNIQUE,
    limiteCredit NUMERIC(10,2) NOT NULL CHECK (limiteCredit >= 0)
);

CREATE TABLE articles (
    id_article SERIAL PRIMARY KEY,
    libelle VARCHAR(100) NOT NULL UNIQUE,
    qteStock INTEGER NOT NULL DEFAULT 0 CHECK (qteStock >= 0),
    montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0)
);

CREATE TABLE modePaiements (
    id_modePaiement SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE reglements (
    id_reglement SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE fournisseurs (
    id_fournisseur SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    telephone VARCHAR(30) NOT NULL UNIQUE,
    adresse VARCHAR(150),
    email VARCHAR(100) UNIQUE
);

CREATE TABLE utilisateurs (
    id_user SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL REFERENCES roles(id_role)
);

CREATE TABLE commandes (
    id_commande SERIAL PRIMARY KEY,
    montant NUMERIC(10,2) NOT NULL DEFAULT 0,
    montantVerse NUMERIC(10,2) NOT NULL DEFAULT 0,
    client_id INT NOT NULL REFERENCES clients(id_client),
    reglement_id INT NOT NULL REFERENCES reglements(id_reglement),
    dateCommande TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT chk_montant_positif CHECK (montant >= 0 AND montantVerse >= 0)
);

CREATE TABLE ligneCommandes (
    id_ligneCommande SERIAL PRIMARY KEY,
    qte INTEGER NOT NULL CHECK (qte > 0),
    montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0),
    article_id INT NOT NULL REFERENCES articles(id_article),
    commande_id INT NOT NULL REFERENCES commandes(id_commande) ON DELETE CASCADE
);

CREATE TABLE dettes (
    id_dette SERIAL PRIMARY KEY,
    dateCreation TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montantInitial NUMERIC(10,2) NOT NULL CHECK (montantInitial >= 0),
    commande_id INT NOT NULL REFERENCES commandes(id_commande) ON DELETE CASCADE
);