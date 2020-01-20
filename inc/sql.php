<?php

/**
 * Fonction listerMarques,
 * Auteur   : Vincent
 * Date     : 20-01-2020,
* But      : Récupérer les produits,
 * Input    : $conn = contexte de connexion,
 *            $recherche = chaîne de caractères pour la recherche de produits (optionnel),
 *            $tri  = champ critère de tri (optionnel),
 *            $sens = sens du tri, ASC ou DESC (optionnel),
 * Output   : $liste = tableau des lignes de la commande SELECT.
 */
function listerProduits($conn, $recherche = "")
{
    $req = "SELECT * FROM `produits` ";

    $stmt = mysqli_prepare($conn, $req);
    $recherche = "%" . $recherche . "%";

/*     mysqli_stmt_bind_param($stmt, "s", $recherche);
 */
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $nbResult = mysqli_num_rows($result);
        $liste = array();
        if ($nbResult) {
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $liste[] = $row;
            }
        }
        mysqli_free_result($result);
        return $liste;
    } else {
        errSQL($conn);
        exit;
    }
}





?>