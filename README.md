# TP 3 - Formulaires Symfony avec SOLID

## Description
Ce projet implémente un formulaire Symfony pour un site e-commerce selon les principes SOLID.

## Structure
- **CartItem (Entity)** : Représente un item du panier avec validation
- **CartItemType (Form)** : Définit le formulaire avec types Symfony
- **ProductController (Controller)** : Gère la logique métier et validation
- **Twig Templates** : Vue avec Bootstrap 5.3 et validation client

## Principes SOLID appliqués

### 1. Single Responsibility
- CartItem : Représentation des données
- CartItemType : Construction du formulaire
- ProductController : Gestion des requêtes

### 2. Open/Closed
- Les champs du formulaire peuvent être étendus sans modifier le code existant
- Validation séparée dans l'entité

### 3. Liskov Substitution
- AbstractType comme base pour tous les formulaires
- Interface commune pour tous les types de champs

### 4. Interface Segregation
- FormBuilderInterface pour construire
- OptionsResolver pour configurer
- Chaque interface a un rôle spécifique

### 5. Dependency Inversion
- Injection de dépendances (Request, Validator)
- Abstraction via les interfaces Symfony

## Fonctionnalités
- Validation côté serveur avec Constraints
- Validation côté client Bootstrap 5.3
- Messages d'erreur personnalisés
- Bonnes pratiques

## Installation
- Créer l'image dans `public/images/Appareil.jpg`

## Routes
- `/appareil` : Page produit avec formulaire
