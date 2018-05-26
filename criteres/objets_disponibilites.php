<?php
/**
 * Critères par Disponibilites objets
 *
 * @plugin     Disponibilites objets
 * @copyright  2018
 * @author     Rainer Müller
 * @licence    GNU/GPL v3
 * @package    SPIP\Objets_disponibilites\Criteres
 */

/**
 * {dates_disponibles_en_cours}
 * {dates_disponibles_en_cours #ENV{date}}
 *
 * @param string $idb
 * @param object $boucles
 * @param object $crit
 */
function critere_dates_disponibles_en_cours_dist($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];
	$id_table = $boucle->id_table;

	$_dateref = dates_disponibles_calculer_date_reference($idb, $boucles, $crit);
	$_date_debut = "$id_table.date_debut";
	$_date_fin = "$id_table.date_fin";

	// si on ne sait pas si les heures comptent, on utilise toute la journee.
	// sinon, on s'appuie sur le champ 'horaire=oui'
	// pour savoir si les dates utilisent les heures ou pas.
	$where_jour_sans_heure =
	array("'AND'",
		array("'<='", "'$_date_debut'", "sql_quote(date('Y-m-d 23:59:59', strtotime($_dateref)))"),
		array("'>='", "'$_date_fin'", "sql_quote(date('Y-m-d 00:00:00', strtotime($_dateref)))")
	);

	if (array_key_exists('horaire', $boucle->show['field'])) {
		$where =
		array("'OR'",
			array("'AND'",
				array("'='", "'horaire'", "sql_quote('oui')"),
				array("'AND'",
					array("'<='", "'$_date_debut'", "sql_quote($_dateref)"),
					array("'>='", "'$_date_fin'", "sql_quote($_dateref)")
				)
			),
			array("'AND'",
				array("'!='", "'horaire'", "sql_quote('oui')"),
				$where_jour_sans_heure
			)
		);
	} else {
		$where = $where_jour_sans_heure;
	}

	if ($crit->not) {
		$where = array("'NOT'",$where);
	}
	$boucle->where[] = $where;
}


/**
 * {evenement_a_venir}
 * {evenement_a_venir #ENV{date}}
 *
 * @param string $idb
 * @param object $boucles
 * @param object $crit
 */
function critere_dates_disponibles_a_venir_dist($idb, &$boucles, $crit) {
	$boucle = &$boucles[$idb];
	$id_table = $boucle->id_table;

	$_dateref = dates_disponibles_calculer_date_reference($idb, $boucles, $crit);
	$_date = "$id_table.date_debut";
	$op = $crit->not ? '<=' : '>';

	// si on ne sait pas si les heures comptent, on utilise toute la journee.
	// sinon, on s'appuie sur le champ 'horaire=oui'
	// pour savoir si les dates utilisent les heures ou pas.
	$where_futur_sans_heure =
	array("'$op'", "'$_date'", "sql_quote(date('Y-m-d 23:59:59', strtotime($_dateref)))");

	if (array_key_exists('horaire', $boucle->show['field'])) {
		$where =
		array("'OR'",
			array("'AND'",
				array("'='", "'horaire'", "sql_quote('oui')"),
				array("'$op'","'$_date'","sql_quote($_dateref)")
			),
			array("'AND'",
				array("'!='", "'horaire'", "sql_quote('oui')"),
				$where_futur_sans_heure
			)
		);
	} else {
		$where = $where_futur_sans_heure;
	}

	$boucle->where[] = $where;
}

/**
 * Fonction privee pour mutualiser de code des criteres_evenement_*
 * Retourne le code php pour obtenir la date de reference de comparaison
 * des evenements a trouver
 *
 * @param string $idb
 * @param object $boucles
 * @param object $crit
 *
 * @return string code PHP concernant la date.
 **/
function dates_disponibles_calculer_date_reference($idb, &$boucles, $crit) {
	if (isset($crit->param[0])) {
		return calculer_liste($crit->param[0], array(), $boucles, $boucles[$idb]->id_parent);
	} else {
		return "date('Y-m-d H:i:00')";
	}
}
