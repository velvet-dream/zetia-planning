# SCSS

SCSS (Sassy CSS) est à peu près à CSS ce qu'est TypeScript à JavaScript. C'est une surcouche à CSS, qui ajoute des possbilités que du CSS vanilla ne permet pas, comme par exemple :
- L'usage de mixins (du style réutilisable)
- L'emboîtement des règles (dans un grand bloc, on peut déclarer plusieurs sous-blocs et ainsi de suite, rendant le code plus lisible et plus simple)
- L'usage de fonctions
- Des variables plus poussées
- etc.

Tout comme TypeScript, SCSS a besoin d'un préprocesseur pour fonctionner. Voir "[transpilation](./index.md#un-point-sur-la-transpilation)" dans la doc.

## Architecture

L'architecture choisie est particulière. Elle s'appuie sur le "7-1 pattern" : https://dev.to/dostonnabotov/a-modern-sass-folder-structure-330f

Basiquement, on a plusieurs sous-dossiers dans "assets/styles" qui ont chacun des fichiers regroupés par un fichier `_index.scss`, puis tous ces sous-dossiers sont importés dans un fichier Sass principal pour être compilé en un gros fichier CSS.

On emploie les mots-clés [`@use`](https://sass-lang.com/documentation/at-rules/use/) et [`@forward`](https://sass-lang.com/documentation/at-rules/forward/). 

Chaque fichier `_index.scss` d'un sous-dossier se doit d'exporter tous les fichiers de son répertoire avec `@forward`.

Exemple : 
```scss
// Exporte les fichiers "_globals.scss" et "_media-queries.scss".
// Notez qu'on peut omettre les underscores et les extensions
@forward "globals";
@forward "media-queries";
```

C'est ensuite `app.scss` qui se charger de tout importer.
```scss
@use "abstracts";
@use "utilities";
@use "components";
@use "layout";
// etc.
```

### Description des dossiers 

Chaque feuille de style doit être rangée dans un sous-dossier adapté. Chaque sous-dossier a un rôle.

```
assets/
└── styles/
    ├── abstracts/  (concepts abstraits : variables, mixins et functions)
    │   └── _index.scss
    ├── base/       (style de base destiné à être au plus bas niveau, comme un reset.scss par ex)
    │   └── _index.scss
    ├── components/ (style à appliquer à des composants particuliers, comme un bouton ou un encadré)
    │   └── _index.scss
    ├── layout/     (les grosses parties comme la sidebar, le footer, le header...)
    │   └── _index.scss
    ├── pages/      (style à appliquer à des pages entières de l'app)
    │   └── _index.scss
    ├── utilities/  (style utilitaire, similaire à des classes bootstrap)
    │   └── _index.scss
    └── app.scss
```

> Note : TOUS les fichiers scss, à l'exceptions d'app.scss, doivent être nommés avec un underscore en début de nom. Ça concerne la transpilation. lire https://sass-lang.com/guide/#topic-4 pour plus de détails 

L'avantage, c'est qu'on n'a pas besoin de s'embêter à importer 10 feuilles de styles différentes par template. Toutefois, il faut être rigoureuse sur les css rules pour éviter qu'un style n'en écrase un autre par inadvertance. Voir la section "[Notion de spécificité sur les règles CSS](#notion-de-spécificité-en-css)"

## Design Responsif

Dans le fichier `_media-queries.scss` sont déclarées des [mixins](https://sass-lang.com/documentation/values/mixins/) qui permettent d'écrire facilement des règles responsives qui s'appliqueront toujours sur les mêmes largeurs d'écran. Exemple d'usage :

```scss
// fichier : components/_responsive-table.scss

// Il faut importer les media-queries
@import "../abstracts/media-queries";

table.responsive-table {
    // Avec le mot-clé @include, on emploie le mixin
    @include media-screen-xs {
        margin: auto;

        th {
            display: none;
        }
    }

    /** équivaut à :

    @media screen and (max-width: 640px) {
        margin: auto;

        th {
            display: none;
        }
    }
    */
}
```

## Notion de spécificité en CSS

En CSS, il y a une notion de spécificité sur chaque règle. Si un élément HTML doit recevoir du style de plusieurs endroits différents, alors CSS établit un ordre de spécificité pour savoir quelles règles appliquer par dessus les autres.

Par exemple : Si je déclare `h1 { font-size : 18px; }` et `.title {font-size : 25px;}`, alors CSS décidera que ma balise h1 avec pour nom de classe "title" aura une taille de police de 25px.

Comment ça se fait ? Ça dépend du sélecteur CSS. Pour ne pas rentrer dans les détails, sachez que plus un sélecteur CSS est précis, plus il aura de spécificité par rapport aux autres.

Un sélecteur qui emploie un nom de classe a plus de spécificité qu'un sélecteur qui emploie un nom de tag. Un sélecteur qui emploie un id (genre #my-id) a plus de spécificité qu'un sélecteur qui emploie un nom de classe.

Du style écrit dans l'attribut "style" d'une balise HTML a plus de spécificité que le reste.

Et, enfin, le mot-clé `!important` en css octroie une spécificité supérieure à une règle sur toutes les autres.

> Attention : IL EST STRICTEMENT INTERDIT D'UTILISER LE MOT-CLÉ "!important" DANS LE CODE. DANS 99% DES CAS, C'EST UNE SOLUTION DE FACILITÉ QUI REND LE CODE MOINS MAINTENABLE

Pour en savoir plus sur cette notion de spécificité : https://developer.mozilla.org/fr/docs/Web/CSS/Specificity