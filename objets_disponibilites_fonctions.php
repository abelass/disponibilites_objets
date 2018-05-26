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

include_spip('criteres/objets_disponibilites');

/**
 * Donne les dates d'un intervalle. Par défaut exclus la date fin
 *
 * @param mixed $date_debut
 * @param mixed $date_fin
 * @param integer $diff
 *   nombre
 * @return string[]
 */
function dates_intervalle($date_debut, $date_fin, $debut = 0, $fin =0, $horaire= false) {
	$format = 'Y-m-d';

	if($horaire) {
		$format = 'Y-m-d H:i:s';
	}

	if (!is_integer($date_debut)) {
		$date_debut = strtotime($date_debut);
	}
	if (!is_integer($date_fin)) {
		$date_fin = strtotime($date_fin);
	}

	$dates = array();
	if ($date_fin >= $date_debut) {
		$difference = $date_fin - $date_debut;
		$nombre_jours = round($difference / (60 * 60 *24)) + $fin;
		$i = $debut;

		while ($i <= $nombre_jours) {
			$muliplie = $i * 60 * 60 *24;
			$dates[] = date($format, $date_debut + $muliplie);
			$i++;
		}
	}

	return $dates;
}

function date_relative_brut($date, $decalage, $format = 'Y-m-d') {
	return date($format, strtotime($decalage, strtotime($date)) );
}