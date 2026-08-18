<?php 
    require_once "Client.php";
    require_once "Reglement.php";
    require_once "LigneCommande.php";
    require_once "Dette.php";

    // CREATE TABLE commandes (
    //     id_commande SERIAL PRIMARY KEY,
    //     montant NUMERIC(10,2) NOT NULL DEFAULT 0,
    //     montantVerse NUMERIC(10,2) NOT NULL DEFAULT 0,
    //     client_id INT NOT NULL REFERENCES clients(id_client),
    //     reglement_id INT NOT NULL REFERENCES reglements(id_reglement),
    //     dateCommande TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    //     CONSTRAINT chk_montant_positif CHECK (montant >= 0 AND montantVerse >= 0)
    // );

    class Commande {
        private ?int $idCommande;
        private float $montant;
        private float $montantVerse;
        private string $dateCommande;
        private array $ligneCommandes = [];

        private ?Client $client = null;
        private ?Reglement $reglement = null;
        private ?Dette $dette = null;

        public function __construct(?int $idCommande = null, float $montant = 0.0, float $montantVerse = 0.0, string $dateCommande = ''){
            $this->idCommande = $idCommande;
            $this->setMontantCommande($montant);
            $this->setMontantVerse($montantVerse);
            $this->dateCommande = $dateCommande;
        }

        public function getIdCommande(): ?int{
            return $this->idCommande;
        }

        public function getMontantCommande(): float {
            return $this->montant;
        }

        public function getMontantVerse(): float {
            return $this->montantVerse;
        }

        public function getClient(): ?Client {
            return $this->client;
        }

        public function getReglment(): ?Reglement {
            return $this->reglement;
        }

        public function getDateCommande(): string {
            return $this->dateCommande;
        }

        public function getLigneCommandes(): array {
            return $this->ligneCommandes;
        }

        public function getDette(): ?Dette {
            return $this->dette !== null ? $this->dette : null;
        }

        public function setIdCommande(int $idCommande): void {
            $this->idCommande = $idCommande;
        }

        private function setMontantCommande(int $montant): void {
            if($montant < 0){
                $this->exception("le montant doit etre positif");
            }
            $this->montant = $montant;
        }

        private function setMontantVerse(int $montantVerse): void {
            if($montantVerse < 0){
                $this->exception("Le montant ne doit pas etre negatif");
            }
            $this->montantVerse = $montantVerse;
        }

        public function setClient(Client $client): void {
            $this->client = $client;
        }

        public function setReglement(Reglement $reglement): void {
            $this->reglement = $reglement;
        }

        public function setAddLigneCommande(LigneCommande $ligneCommande): void {
            $this->ligneCommandes[] = $ligneCommande;
            $ligneCommande->setCommande($this);
        }

        public function setDette(Dette $dette): void {
            $this->dette = $dette;
        }

        private function exception(string $message): void {
            throw new Exception($message);
        }
    }