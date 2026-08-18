<?php
    require_once "Commande.php";
    require_once "Article.php";

    // CREATE TABLE ligne_commandes (
    //     id_ligne_commande SERIAL PRIMARY KEY,
    //     qte INTEGER NOT NULL CHECK (qte > 0),
    //     montant NUMERIC(10,2) NOT NULL CHECK (montant >= 0),
    //     article_id INT NOT NULL REFERENCES articles(id_article) ON DELETE RESTRICT,
    //     commande_id INT NOT NULL REFERENCES commandes(id_commande) ON DELETE CASCADE,

    //     CONSTRAINT uq_commande_article UNIQUE (commande_id, article_id)
    // );

    class LigneCommande {
        private ?int $idLigneCommande;
        private int $qte;
        private float $montant;
        private ?Article $article = null;
        private ?Commande $commande = null;

        public function __construct(int $qte = 1,float $montant = 0.0,?Article $article = null,?Commande $commande = null,?int $idLigneCommande = null) {
            $this->idLigneCommande = $idLigneCommande;
            $this->setQte($qte);
            $this->setMontant($montant);
            $this->article = $article;
            $this->commande = $commande;
        }

        public function getIdLigneCommande(): ?int {
            return $this->idLigneCommande;
        }

        public function getQte(): int {
            return $this->qte;
        }

        public function getMontant(): float {
            return $this->montant;
        }

        public function getArticle(): ?Article {
            return $this->article;
        }

        public function getCommande(): ?Commande {
            return $this->commande;
        }

        public function setIdLigneCommande(int $idLigneCommande): void {
            $this->idLigneCommande = $idLigneCommande;
        }

        public function setQte(int $qte): void {
            if ($qte <= 0) {
                $this->exception("La quantité doit être strictement supérieure à 0.");
            }
            $this->qte = $qte;
        }

        public function setMontant(float $montant): void {
            if ($montant < 0) {
                $this->exception("Le montant ne peut pas être négatif.");
            }
            $this->montant = $montant;
        }

        public function setArticle(Article $article): void {
            $this->article = $article;
        }

        public function setCommande(Commande $commande): void {
            $this->commande = $commande;
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