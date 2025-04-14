# 🎬 CinéHall - API de Réservation de Billets de Cinéma

## 📝 Contexte du Projet

Avec l’essor de la digitalisation, **CinéHall** souhaite moderniser l’expérience de réservation en ligne. Cette API backend permet aux utilisateurs de :

- Réserver facilement leurs sièges
- Payer en ligne
- Obtenir un billet électronique

Développée en **Laravel** avec une base de données **PostgreSQL**, cette API est conçue pour être sécurisée, performante et facile à intégrer avec un frontend (mobile ou web).

---

## 🚀 Fonctionnalités de l'API

### 1. 👤 Gestion des Utilisateurs

- Création de compte utilisateur
- Authentification avec **JWT**
- Gestion du profil :
  - Mise à jour des informations
  - Suppression du compte

---

### 2. 🎥 Gestion des Films et Séances

- **Films** : titre, description, image, durée, âge minimum, bande-annonce, genre, *(option : acteurs, etc.)*
- **Séances** : date/heure de début (`start-time`), type (`Normale` ou `VIP`), langue, etc.
- Création, modification et suppression de films (admin)
- Association d’un film à une salle et une date/heure
- Consultation et filtrage des séances

---

### 3. 🛋️ Gestion des Salles et Sièges

- Création de salles avec types de séances (`Normale`, `VIP`)
- Sièges de couple disponibles pour les séances VIP (réservation de 2 sièges obligatoire)
- Suivi en temps réel des sièges disponibles/réservés

---

### 4. 🎟️ Gestion des Réservations

- Réservation de sièges
- Modification et annulation de réservations

---

## 🛠️ Stack Technique

- **Framework** : Laravel 10
- **Base de données** : PostgreSQL
- **Authentification** : JWT (via Laravel Sanctum)
- **Langage** : PHP 8

---
