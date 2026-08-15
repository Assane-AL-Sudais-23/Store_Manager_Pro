PRAGMA foreign_keys = ON;

CREATE TABLE roles (
    id_role INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);

CREATE TABLE clients (
    id_client INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    adresse TEXT NOT NULL,
    email TEXT UNIQUE,
    limiteCredit NUMERIC NOT NULL DEFAULT 0 CHECK (limiteCredit >= 0)
);

CREATE TABLE articles (
    id_article INTEGER PRIMARY KEY AUTOINCREMENT,
    libelle TEXT NOT NULL UNIQUE,
    qteStock INTEGER NOT NULL DEFAULT 0 CHECK (qteStock >= 0),
    montant NUMERIC NOT NULL CHECK (montant >= 0)
);

CREATE TABLE modePaiements (
    id_modePaiement INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);

CREATE TABLE reglements (
    id_reglement INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE
);

CREATE TABLE fournisseurs (
    id_fournisseur INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    telephone TEXT NOT NULL UNIQUE,
    adresse TEXT,
    email TEXT UNIQUE
);

CREATE TABLE utilisateurs (
    id_user INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role_id INTEGER NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id_role)
);

CREATE TABLE commandes (
    id_commande INTEGER PRIMARY KEY AUTOINCREMENT,
    montant NUMERIC NOT NULL DEFAULT 0,
    montantVerse NUMERIC NOT NULL DEFAULT 0,
    client_id INTEGER NOT NULL,
    reglement_id INTEGER NOT NULL,
    user_id INTEGER,
    dateCommande TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_montant_positif CHECK (montant >= 0 AND montantVerse >= 0),
    FOREIGN KEY (client_id) REFERENCES clients(id_client),
    FOREIGN KEY (reglement_id) REFERENCES reglements(id_reglement),
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id_user)
);

CREATE TABLE ligneCommandes (
    id_ligneCommande INTEGER PRIMARY KEY AUTOINCREMENT,
    qte INTEGER NOT NULL CHECK (qte > 0),
    montant NUMERIC NOT NULL CHECK (montant >= 0),
    article_id INTEGER NOT NULL,
    commande_id INTEGER NOT NULL,
    FOREIGN KEY (article_id) REFERENCES articles(id_article),
    FOREIGN KEY (commande_id) REFERENCES commandes(id_commande) ON DELETE CASCADE
);

CREATE TABLE dettes (
    id_dette INTEGER PRIMARY KEY AUTOINCREMENT,
    dateCreation TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    montantInitial NUMERIC NOT NULL CHECK (montantInitial >= 0),
    commande_id INTEGER NOT NULL,
    user_id INTEGER,
    FOREIGN KEY (commande_id) REFERENCES commandes(id_commande) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id_user)
);

CREATE TABLE paiements (
    id_paiement INTEGER PRIMARY KEY AUTOINCREMENT,
    montant NUMERIC NOT NULL CHECK (montant > 0),
    datePaiement TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dette_id INTEGER,
    modePaiement_id INTEGER NOT NULL,
    FOREIGN KEY (dette_id) REFERENCES dettes(id_dette) ON DELETE CASCADE,
    FOREIGN KEY (modePaiement_id) REFERENCES modePaiements(id_modePaiement)
);

CREATE TABLE approvisionnements (
    id_approvisionnement INTEGER PRIMARY KEY AUTOINCREMENT,
    refBL TEXT NOT NULL UNIQUE,
    qteAchat INTEGER NOT NULL CHECK (qteAchat >= 0),
    qteRecu INTEGER NOT NULL CHECK (qteRecu >= 0),
    montant NUMERIC NOT NULL CHECK (montant >= 0),
    fournisseur_id INTEGER NOT NULL,
    user_id INTEGER,
    dateApprovisionnement TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fournisseur_id) REFERENCES fournisseurs(id_fournisseur),
    FOREIGN KEY (user_id) REFERENCES utilisateurs(id_user)
);

CREATE TABLE ligneApprovisionnements (
    id_ligneApprovisionnement INTEGER PRIMARY KEY AUTOINCREMENT,
    qteRecu INTEGER NOT NULL CHECK (qteRecu >= 0),
    montant NUMERIC NOT NULL CHECK (montant >= 0),
    approvisionnement_id INTEGER NOT NULL,
    article_id INTEGER NOT NULL,
    FOREIGN KEY (approvisionnement_id) REFERENCES approvisionnements(id_approvisionnement) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(id_article)
);