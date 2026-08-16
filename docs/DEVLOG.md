-- SIDY Assane
-- Projet : StoreManager Pro (ERP PHP/POO) 

### 🌃 [Vendredi - Phase 1] : Conception & BDD Fallback

**Heure de réalisation** : 
--(19h-23h)

**Ce qui a été fait** : 
1 - Diagramme de Uses Cases :
        Realisation des diagrammes de uses pour les acteurs(Admin Boutrique, Vente, Stock et Inventaire) ainsi que le diagramme de classe du projet 


2 - Diagramme de Classe :
        Realisation des diagrammes de classe avec la gestion des cles etrangeres et la mise en place des contraintes

    1 - modification apporte : 
        suppression des classes : UserVente, Admin , UserStock, UserInventaire. Detachement de la relation paiement et approvisionnement, suppresion de l'attribut reglement dans commande, ajout de l'attribut montantInitial sur Dette, relier Dette et paient et commande avec Dette enfin definir la classe user pour generaliser les acteurs et faire les relations avec les autres classes

        2 - modification apportee: 
                ajout des tables approviosionnement, ligneapprovisionnement et paiement, modification sur les tables ayant des clees etrangeres avec l'ajout des mode de suppresion cascade, ajout de la relation fournisseur et article

**Difficultés / Obstacles** : 
1 - Diagramme de Uses Cases:
        Problematique de reperer les uses principale en fonction des ecran notamment au niveau de l'acteur Admin Boutique, Blocage au niveau des classes acteur lors de la realisation des diagramme de classe, des ennuies avec les relations des acteurs envers les autres classes

2 - Diagramme de Classe :
        Un problematique de comprendre et definir la relation de l'utilisateur avec las autres classes, probleme de separer Dette et commande chacun avec sa propre classe, l'erreur de relier approvisionnement et paiement qui signifie dans paiement on doit avoir Dette ou Commande et Approvisionnement ce qui crée un ambiguité 

3 - Singleton Database et Automatique Fallback 
        probleme d'implementer le code pour le Fallback Automatique et connaitre le role du fichier erp.db



### ☀️ [Samedi - Phase 2] : POO, Repositories & Ventes POS

- **Heure de réalisation** : 
 Step 2.1 (09h00 - 11h00) : Entités POO Pure
        1 - Realisation des classe Entity et methodes metiers


- **Ce qui a été fait** : 
        Creation des classes de descriptions avec leurs attributs et leurs methodes metiers avec la gestion des relations des classes entre eux



- **Difficultés / Obstacles** : 
        Probleme d'encapsulation au niveau des attributs, problematiques distinguer les methodes specifiques aux classe de description par rapport aux methodes des classe repositories