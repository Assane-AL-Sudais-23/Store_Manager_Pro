<?php
    require_once "Paiement.php";

    // CREATE TABLE modePaiements (
    //     id_modePaiement SERIAL PRIMARY KEY,
    //     nom VARCHAR(50) NOT NULL UNIQUE
    // );

    class ModePaiement {
        private ?int $idModePaiement;
        private string $nom;
        private array $paiements = [];

        public function __construct( string $nom = '', ?int $idModePaiement = null ) {
            $this->idModePaiement = $idModePaiement;
            $this->setNom($nom);
        }

        public function getIdModePaiement(): ?int {
            return $this->idModePaiement;
        }

        public function getNom(): string {
            return $this->nom;
        }

        public function getPaiements(): array {
            return $this->paiements;
        }

        public function setIdModePaiement(int $idModePaiement): void {
            $this->idModePaiement = $idModePaiement;
        }

        public function setNom(string $nom): void {
            if (empty($nom)) {
                throw new Exception("Le nom du mode de paiement ne peut pas être vide.");
            }
            $this->nom = trim($nom);
        }

        public function setAddPaiement(Paiement $paiement): void {
            $this->paiements[] = $paiement;
            $paiement->setModePaiement($this);
        }
    }