# Objets disponibles
Permet de définir des disponibilités pour les objets

## Utilisation
### Configuration
Dans la configuration du plugin déclarez les objets pour lesquels vous voulez gérer
des diponibilités.

### Édition
Vous pouvez alors définir pour ces objets des periodes de disponibilité ou de non
disponibilités.

### Squelettes
Dans l'état actuel, la manière principal d'affichage des dates disponibles est via
les saisies `dates_disponibles` ou `dates_disponibles_select` (regardez dans le dossiers `saisies`), vous y trouverez des examples ainsi que toutes les variables utilisées.

Ces saisies utilisent le filtre `dates_disponibles($options, $contexte)` qui prend
les mêmes variables que les saisies et retourne un tableau avec les dates disponibles.

## Filtre
Le filtre `dates_disponibles($options, $contexte = array())` qui calcules les dates disponibles pour un objet y déduit les non disponibles ainsi que les dates utilisées (par example dans le cadre d'une location avec le plugin
[Objets Location](https://github.com/abelass/location_objets).

Les calculs des dates disponibles et non disponibles se font dans des squelettes (voir dossier disponibilites), donc facilement modifiable. Pour les dates utilisées, s'il existe une fonction poersonnalisé pour l'objet `disponibilites_objetEnQuestion_utilise_dist()` celle-ci sera utilisé, sinon on recourt à la fonction par défaut `disponibilites_objet_utilise_dist()` qui se trouve dans le fichier `disponibilites/objet_utilise.php`.


## to do
A l'instar de api prix. Faire une balise disponibilité qui calcule la disponiblite d'un objet .
