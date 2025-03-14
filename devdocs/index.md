# Le guide R&D

## L'application Zetia Planning

L'application est présentée par le cahier des charges : https://rdksolutions.sharepoint.com/:w:/r/sites/2023-M07DWWM/_layouts/15/doc2.aspx?sourcedoc=%7B094af34b-52d4-4993-866a-5a712d5671b0%7D&action=edit

## La Stack technique

## Étapes d'installation

- Installer Symfony
- Installer composer
- Installer PHP si nécessaire (composer install devrait le gérer)
- Pour travailler en local, installer MAMP pour avoir un MySQL + PhpMyAdmin
- Modifier `/.env` pour ajouter un utilisateur MySQL si besoin (voir https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html#connecting-using-a-url)
- Installer les dépendance et migrer vers la dernière version de la DB (voir "Les commandes utiles" plus bas)
- Lancer ces requêtes depuis PhpMyAdmin :
```SQL
INSERT INTO `statusproject_stp` (`stp_id`, `stp_title`) VALUES (NULL, 'en attente'), (NULL, 'en cours'), (NULL, 'livré');
INSERT INTO `statustask_stk` (`stk_id`, `stk_title`) VALUES (NULL, 'à faire'), (NULL, 'en cours'), (NULL, 'en pause'), (NULL, 'fait');
INSERT INTO `userjob_job` (`job_id`, `job_title`) VALUES (NULL, 'Développeuse fullstack');
``` 
- Démarrer le serveur avec `symfony server:start`

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

### Les commandes utiles

#### Installer les dépendances et packages

```bash
composer install
```
#### Lancer l'application

```bash
symfony server:start
```

#### Arrêter le serveur

```bash
symfony server:stop
```

#### Migrer vers la dernière version de la BDD

```bash
php bin/console d:m:m
```

### Un point sur la transpilation

TS et SCSS sont des langages transpilés : ils sont destinés à être "traduits" respectivement en JavaScript et en CSS. Pour ce faire, il faut que la transpilation soit en cours (en mode "watch").

Dans le fichier `.symfony.local.yaml`, il y a ce qu'on appelle des workers qui sont écrits. Ces tâches sont lancées en même temps que le serveur symfony. Parmi ces workers, il y a le build et TypeScript et de Sass. Autrement dit, les commandes de transpilation des fichiers concernés.

Par conséquent, pour lancer la transpilation des fichiers TS et SCSS il faut simplement lancer la commande `symfony server:start`

### SCSS

[En lire plus](scss.md)

### HTML et les templates

[En lire plus](html.md)

### Contribuer au projet (IMPORTANT)

[En lire plus](contribute.md)
