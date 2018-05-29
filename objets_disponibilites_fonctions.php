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

function dates_disponibles($options, $contexte) {

	$contexte = array_merge(unserialize($contexte), $options);

	$contexte['disponible'] = '';
	$dates_indisponibles = unserialize(recuperer_fond('inclure/dates_disponibles_tableau', $contexte));

	$contexte['disponible'] = 1;

	$dates_disponibles = unserialize(recuperer_fond('inclure/dates_disponibles_tableau', $contexte));

	$dates = array_diff($dates_disponibles, $dates_indisponibles);

	return $dates;
}
