<?php 
    require_once dirname(__DIR__)."/Core/Database.php";
    require_once dirname(__DIR__)."/models/Article.php";

    class ArticleRepository {

        public function saveArticle(Article $newArticle): int {
            $requeteSQL = "INSERT INTO articles(libelle, qteStock, prixUnitaire)
                            VALUES (:libelle, :qteStock, :prixUnitaire)";
            return Database::executeUpdate($requeteSQL, [
                'libelle' => $newArticle->getLibelle(),
                'qteStock' => $newArticle->getQteStock(),
                'prixUnitaire' =>$newArticle->getPrixUnitaire()
            ]);
            
        }

        public function getAllArticles(): array {
            $requeteSQL = "SELECT * FROM articles";
            $allLignes =  Database::query($requeteSQL, false);

            $articles = [];

            if (!$allLignes) {
                return [];
            }

            foreach($allLignes as $ligne){
                $articles[] = $this->arrayToObjet($ligne);
            }
            return $articles;
        }

        public function filterAllArticleByName(string $nameArticle): array {
            $requeteSQL = "SELECT * FROM articles WHERE libelle ILIKE :nameArticle";

            $allArticlesFiltrer = Database::executeQuery($requeteSQL, [
                'nameArticle' => trim($nameArticle) . '%'
            ], false);

            if (!$allArticlesFiltrer) {
                return [];
            }

            $articlesFiltre = [];
            foreach ($allArticlesFiltrer as $article) {
                $articlesFiltre[] = $this->arrayToObjet($article);
            }

            return $articlesFiltre;
        }

        public function arrayToObjet(array $ligne): Article{
            return new Article(
                (int)$ligne['id_article'],
                $ligne['libelle'],
                (int)$ligne['qteStock'],
                (float)$ligne['prixUnitaire']
            );
        }
    }