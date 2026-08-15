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

    modification apporte : 
        suppression des classes : UserVente, Admin , UserStock, UserInventaire. Detachement de la relation paiement et approvisionnement, suppresion de l'attribut reglement dans commande, ajout de l'attribut montantInitial sur Dette, relier Dette et paient et commande avec Dette enfin definir la classe user pour generaliser les acteurs et faire les relations avec les autres classes

**Difficultés / Obstacles** : 
1 - Diagramme de Uses Cases:
        Problematique de reperer les uses principale en fonction des ecran notamment au niveau de l'acteur Admin Boutique, Blocage au niveau des classes acteur lors de la realisation des diagramme de classe, des ennuies avec les relations des acteurs envers les autres classes

2 - Diagramme de Classe :
        Un problematique de comprendre et definir la relation de l'utilisateur avec las autres classes, probleme de separer Dette et commande chacun avec sa propre classe, l'erreur de relier approvisionnement et paiement qui signifie dans paiement on doit avoir Dette ou Commande et Approvisionnement ce qui crée un ambiguité 

3 - Singleton Database et Automatique Fallback 
        probleme d'implementer le code pour le Fallback Automatique et connaitre le role du fichier erp.db