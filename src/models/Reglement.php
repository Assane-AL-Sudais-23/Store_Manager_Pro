<?php

    namespace Src\Models\Entity;

    use Exception;

    class Reglement {
        public const TYPE_CREDIT = 'Credit';
        public const TYPE_AVANCE = 'Avance';
        public const TYPE_COMPTANT = 'Comptant';

        public const TYPES_AUTORISES = [
            self::TYPE_CREDIT,
            self::TYPE_AVANCE,
            self::TYPE_COMPTANT
        ];

        private ?int $idReglement;
        private string $nom;

        public function __construct(string $nom = self::TYPE_COMPTANT,?int $idReglement = null){
            $this->idReglement = $idReglement;
            $this->setNom($nom);
        }

        public function getIdReglement(): ?int {
            return $this->idReglement;
        }

        public function getNom(): string {
            return $this->nom;
        }

        public function setIdReglement(int $idReglement): void {
            $this->idReglement = $idReglement;
        }

        public function setNom(string $nom): void {
            if (!in_array($nom, self::TYPES_AUTORISES, true)) {
                throw new Exception("Le type de règlement '$nom' est invalide. ");
            }
            $this->nom = $nom;
        }
    }