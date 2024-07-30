# zetia-planning
Projet de soutenance de formation : gestionnaire de projets et de tâches, budget et planning

## Cahier des Charges

https://rdksolutions.sharepoint.com/:w:/r/sites/2023-M07DWWM/_layouts/15/Doc.aspx?sourcedoc=%7B094af34b-52d4-4993-866a-5a712d5671b0%7D&action=edit

## Maquette

https://www.figma.com/design/cpyrF6WN7GIhCyP0iiZ3ez/Untitled

## Développement

Pour lancer Sass et TypeScript en mode build, lancer simplement la commande
`symfony server:start`

Merci de se référer à [la documentation](./devdocs/index.md) du projet pour contribuer à son développement et avoir des indications sur les stacks techniques employées. 

### Requêtes SQL utiles

Lancez ces requêtes dans phpMYAdmin pour compléter quelques valeurs nécessaires à la cré"ation de nouvelles tâches / projets / etc.

```SQL
INSERT INTO `statusproject_stp` (`stp_id`, `stp_title`) VALUES (NULL, 'en attente'), (NULL, 'en cours'), (NULL, 'livré');
INSERT INTO `statusproject_stp` (`stp_id`, `stp_title`) VALUES (NULL, 'à faire'), (NULL, 'en cours'), (NULL, 'en pause'), (NULL, 'fait');
INSERT INTO `userjob_job` (`job_id`, `job_title`) VALUES (NULL, 'Développeuse fullstack');
```