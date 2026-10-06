# Rolling the Dice – Exercice 3.b

**Artificial Inquiries · Qualifying **

## Fiche de l'exercice (Task Categories)
<img width="553" height="775" alt="image" src="https://github.com/user-attachments/assets/c2aca22d-012e-4a1b-b12a-6c646512a4be" />


## Description

Cartographie de mes usages d'un LLM à partir de mon historique de conversations, analysé par échantillonnage aléatoire : un dé détermine
combien de conversations examiner, puis combien ignorer.


## Objectifs

- Explorer son historique de conversations avec un LLM.
- Identifier les différents types de tâches effectuées.
- Classer les conversations par catégories.
- Observer les catégories les plus fréquentes.
- Identifier les conversations particulièrement marquantes.
- Réfléchir à ses propres usages des LLM.

## Méthode

1. Ouvrir l'historique de conversations du LLM utilisé.
2. Commencer par les conversations les plus récentes.
3. Lancer un dé.
4. Le nombre obtenu indique le nombre de conversations à analyser.
5. Analyser ces conversations et attribuer une catégorie à chacune.
6. Ignorer ensuite le même nombre de conversations.
7. Relancer le dé et répéter le processus.
8. Continuer jusqu'à avoir parcouru l'ensemble de l'historique.
9. Noter les catégories identifiées et leurs occurrences.
10. Conserver au maximum huit conversations particulièrement mémorables.

## Outils techniques

| Outil | Rôle |
|---|---|
| **JavaScript** | Exécution du script |
| **Module `random`** | Simulation du lancer de dé |
| **Module `json`** | Lecture de l'export des conversations et fichier de suivi |
| **Export de l'historique du LLM** | Récupération des conversations (`conversations.json`) |
| **Git / GitHub** | Versionnement et rendu du projet |
| **Markdown** | Rédaction du README |

## Solution technique

- Export de l'historique des conversations.
- Script JavaScript simulant le lancer de dé.
- Fichier de suivi (JSON ou CSV) pour les catégories, les occurrences et les
  conversations mémorables.

## Résultats

| Catégorie | Occurrences |
|-----------|:-----------:|
|           |             |

**Conversations mémorables** : *à compléter*

