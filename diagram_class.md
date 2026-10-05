classDiagram
    class Historique {
        -conversations
        +trierDuPlusRecentAuPlusAncien()
    }

    class Conversation {
        -titre
        -date
        -categorie
        +attribuerCategorie(categorie)
        +marquerMemorable()
    }

    class ConversationMemorable {
        +titre
    }

    class De {
        -faces
        +lancer()
    }

    class Parcours {
        -position
        +demarrer()
        +examiner(x)
        +ignorer(x)
        +estTerminee()
    }

    class Categorie {
        +nom
        +occurrences
        +ajouterOccurrence()
    }

    class Fiche {
        -categories
        -memorables
        +afficherResultats()
    }

    Historique "1" *-- "*" Conversation : contient
    Conversation <|-- ConversationMemorable : herite
    Conversation "*" --> "1" Categorie : appartient a
    Fiche "1" o-- "*" Categorie : regroupe
    Fiche "1" o-- "0..8" ConversationMemorable : garde
    Parcours ..> De : utilise
    Parcours --> Historique : parcourt
