<?php
    // CREATE TABLE roles (
    //     id_role SERIAL PRIMARY KEY,
    //     nom VARCHAR(50) NOT NULL UNIQUE
    // );

    class Role{
        public const ROLE_ADMIN = 'ADMIN';
        public const ROLE_BOUTIQUIER = 'BOUTIQUIER';
        public const ROLE_CLIENT = 'CLIENT';

        private ?int $idRole;
        private string $nom;

        public function __construct(string $nom = '',?int $idRole = null) {
            $this->idRole = $idRole;
            $this->setNom($nom);
        }

        public function getIdRole(): ?int {
            return $this->idRole;
        }

        public function getNom(): string {
            return $this->nom;
        }

        public function setIdRole(int $idRole): void {
            $this->idRole = $idRole;
        }

        public function setNom(string $nom): void {
            $formattedNom = strtoupper(trim($nom));
            if (empty($formattedNom)) {
                throw new Exception("Le nom du rôle ne peut pas être vide.");
            }
            $this->nom = $formattedNom;
        }
    }