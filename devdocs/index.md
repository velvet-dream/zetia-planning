# Le guide R&D

## L'application Zetia Planning

L'application est présentée par le cahier des charges : https://rdksolutions.sharepoint.com/:w:/r/sites/2023-M07DWWM/_layouts/15/doc2.aspx?sourcedoc=%7B094af34b-52d4-4993-866a-5a712d5671b0%7D&action=edit

## La Stack technique

### Liens utiles sur de la documentation

SQL :
- https://sql.sh/ (n'y allez pas sans adblock svp)

Symfony : 
- https://symfony.com/doc/current/index.html

PHP : 
- https://www.php.net/docs.php (doc plus technique)
- https://www.w3schools.com/php/php_ref_overview.asp (doc plus simple)

TypeScript (TS) : 
- https://www.typescriptlang.org/docs/
- https://www.typescriptlang.org/cheatsheets/ (Les anti-sèches)

JavaScript (JS) :
- https://developer.mozilla.org/fr/docs/Learn/JavaScript (en français, doc très complète)
- https://www.w3schools.com/jsref/default.asp (doc plus simpliste et concise)

SCSS :
- https://sass-lang.com/documentation/syntax/ (doc officielle)
- https://www.w3schools.com/sass/ (doc plus simple et concise)

CSS :
- https://www.w3schools.com/cssref/index.php (ref concise)
- https://developer.mozilla.org/fr/docs/Web/CSS (doc en FR, détaillée)
- https://caniuse.com/ (pour connaître le compatibilité d'une règle CSS avec les navigateurs)

HTML :
- https://developer.mozilla.org/fr/docs/Web/HTML

TWIG :
- https://twig.symfony.com/doc/3.x/

### Un point sur la transpilation

TS et SCSS sont des langages transpilés : ils sont destinés à être "traduits" respectivement en JavaScript et en CSS. Pour ce faire, il faut que la transpilation soit en cours (en mode "watch").

Dans le fichier `.symfony.local.yaml`, il y a ce qu'on appelle des workers qui sont écrits. Ces tâches sont lancées en même temps que le serveur symfony. Parmi ces workers, il y a le build et TypeScript et de Sass. Autrement dit, les commandes de transpilation des fichiers concernés.

Par conséquent, pour lancer la transpilation des fichiers TS et SCSS il faut simplement lancer la commande `symfony server:start`


### SCSS

[En lire plus](scss.md)

### HTML et les templates

[En lire plus](html.md)