<?php
    require_once "Approvisionnement.php";
    require_once "Article.php";

    class LigneApprovisionnement {
        private ?int $idLigneApprovisionnement;
        private int $qte;
        private float $montant;
        private ?Approvisionnement $approvisionnement = null;
        private ?Article $article = null;

        public function __construct( int $qte = 0, float $montant = 0.0, ?Article $article = null, ?Approvisionnement $approvisionnement = null, ?int $idLigneApprovisionnement = null) {
            $this->idLigneApprovisionnement = $idLigneApprovisionnement;
            $this->setQte($qte);
            $this->setMontant($montant);
            $this->article = $article;
            $this->approvisionnement = $approvisionnement;
        }

        public function getIdLigneApprovisionnement(): ?int {
            return $this->idLigneApprovisionnement;
        }

        public function getQte(): int {
            return $this->qte;
        }

        public function getMontant(): float {
            return $this->montant;
        }

        public function getApprovisionnement(): ?Approvisionnement {
            return $this->approvisionnement;
        }

        public function getArticle(): ?Article {
            return $this->article;
        }

        public function setIdLigneApprovisionnement(int $idLigneApprovisionnement): void {
            $this->idLigneApprovisionnement = $idLigneApprovisionnement;
        }

        public function setQte(int $qte): void {
            if ($qte < 0) {
                $this->exception("La quantité ne peut pas être négative.");
            }
            $this->qte = $qte;
        }

        public function setMontant(float $montant): void {
            if ($montant < 0) {
                $this->exception("Le montant ne peut pas être négatif.");
            }
            $this->montant = $montant;
        }

        public function setApprovisionnement(Approvisionnement $approvisionnement): void {
            $this->approvisionnement = $approvisionnement;
        }

        public function setArticle(Article $article): void {
            $this->article = $article;
        }

        public function calculerMontant(): void {
            if ($this->article !== null) {
                $this->montant = $this->qte * $this->article->getPrixUnitaire();
            }
        }

        private function exception(string $message): void {
            throw new Exception($message);
        }
    }