<?php
/**
 * Fonctions utiles au plugin Disponibilites objets
 *
 * @plugin     Disponibilites objets
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Objets_disponibilites\Fonctions
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

// Les fonctions de dates_outils.
include_spip('filtres/dates_outils');
include_spip('filtres/inc_agenda_filtres');


// Les critères de dates_outils.
include_spip('criteres/inc_agenda_filtres');
include_spip('criteres/public_agenda');
