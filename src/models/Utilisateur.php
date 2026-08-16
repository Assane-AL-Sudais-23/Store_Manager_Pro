<?php 
    // CREATE TABLE utilisateurs (
    //     id_user SERIAL PRIMARY KEY,
    //     nom VARCHAR(50) NOT NULL,
    //     prenom VARCHAR(50) NOT NULL,
    //     email VARCHAR(100) NOT NULL UNIQUE,
    //     password VARCHAR(255) NOT NULL,
    //     role_id INT NOT NULL REFERENCES roles(id_role) ON DELETE RESTRICT
    // );

    namespace Src\Models\Entity;

    use Exception;

    class Utilisateur {
        private ?int $idUser;
        private string $nom;
        private string $prenom;
        private string $email;
        private string $password;
        private ?Role $role = null;

        public function __construct(string $nom = '',string $prenom = '',string $email = '',string $password = '',?Role $role = null,?int $idUser = null) {
            $this->idUser = $idUser;
            $this->setNom($nom);
            $this->setPrenom($prenom);
            $this->setEmail($email);
            $this->setPassword($password);
            $this->role = $role;
        }

        public function getIdUser(): ?int {
            return $this->idUser;
        }

        public function getNom(): string {
            return $this->nom;
        }

        public function getPrenom(): string {
            return $this->prenom;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getPassword(): string {
            return $this->password;
        }

        public function getRole(): ?Role {
            return $this->role;
        }

        public function setIdUser(int $idUser): void {
            $this->idUser = $idUser;
        }

        public function setNom(string $nom): void {
            if (empty(trim($nom))) {
                throw new Exception("Le nom de l'utilisateur ne peut pas être vide.");
            }
            $this->nom = trim($nom);
        }

        public function setPrenom(string $prenom): void {
            if (empty(trim($prenom))) {
                throw new Exception("Le prénom de l'utilisateur ne peut pas être vide.");
            }
            $this->prenom = trim($prenom);
        }

        public function setEmail(string $email): void {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("L'adresse email '$email' n'est pas valide.");
            }
            $this->email = $email;
        }

        public function setPassword(string $password): void {
            if (empty($password)) {
                throw new Exception("Le mot de passe ne peut pas être vide.");
            }
            $this->password = $password;
        }

        public function setRole(Role $role): void {
            $this->role = $role;
        }
    }