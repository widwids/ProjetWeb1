<?php

/**
 * Fonction listerProduits,
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
/**
 * Fonction listerCategories,
 * Auteur   : Vincent
 * Date     : 20-01-2020
 * But      : Récupérer les marques des categories,
 * Input    : $conn = contexte de connexion,
 *           
 * Output   : $marque = tableau des lignes de la commande SELECT.
 */
function listerCategories($conn)
{
    $req = "SELECT * FROM categories";
    if ($result = mysqli_query($conn, $req)) {
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
/** 
 * Fonction ajouterProduit
 * Auteur   : Vincent
 * Date     : 20-01-2020
 * But    : ajouter une ligne dans la table produit  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $produit
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function ajouterProduit($conn, $produit)
{
    $req = "INSERT INTO categories (
        categories_id,
        categories_nom)
    VALUES (?,?);

INSERT INTO produits (
        categorie_id,
        produits_description,
        produits_id,
        produits_nom,
        produits_prix,
        produits_quantite)
    VALUES (?,?,?,?,?,?);
    ";

    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "sssisii", $produit["nom"], $produit["description"], $produit["prix"], $produit["quantite"], $produit["categorie"], $produit["marque"]);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}



?>