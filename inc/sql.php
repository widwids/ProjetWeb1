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
    $req = "INSERT INTO produits (produits_nom, produits_description, produits_prix, produits_quantite, fk_categorie_id)
    VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "ssdis", $produit["nom"], $produit["description"], $produit["prix"], $produit["quantite"], $produit["categorie"]);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}
/** 
 * Fonction ajouterCategorie
 * Auteur : Vincent
 * Date   : 22-01-2020
 * But    : ajouter une ligne dans la table categories  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $marque = marque à ajouter à la table
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function ajouterCategorie($conn, $categorie)
{
    $req = "INSERT INTO categories (categories_nom)
    VALUES (?)";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "s", $categorie["nom"]);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}



/**
 * Fonction listerClients,
 * Auteur   : Vincent
 * Date     : 24-01-2020
 * But      : Récupérer les clients,
 * Input    : $conn = contexte de connexion,
 *           
 * Output   : 
 */
function listerClients($conn)
{
    $req = "SELECT * FROM clients";
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
 * Fonction ajouterClient
 * Auteur : Vincent
 * Date   : 24-01-2020
 * But    : ajouter une ligne dans la table client 
 * Arguments en entrée : $conn = contexte de connexion
 *                       $marque = marque à ajouter à la table
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function ajouterClient($conn, $clients)
{
    $req = "INSERT INTO clients (clients_adresse, clients_telephone, clients_nom)
    VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "sss", $clients["adresse"], $clients["telephone"], $clients["nom"]);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/**
 * Fonction listerUtilisateurs,
 * Auteur   : Vincent
 * Date     : 24-01-2020
 * But      : Récupérer les utilisateurs,
 * Input    : $conn = contexte de connexion,
 *           
 * Output   : 
 */
function listerUtilisateurs($conn)
{
    $req = "SELECT * FROM utilisateurs";
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
 * Fonction ajouterClient
 * Auteur : Vincent
 * Date   : 24-01-2020
 * But    : ajouter une ligne dans la table client 
 * Arguments en entrée : $conn = contexte de connexion
 *                       $marque = marque à ajouter à la table
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function ajouterUtilisateur($conn, $utilisateurs)
{
    $req = "INSERT INTO utilisateurs (utilisateurs_nom, utilisateurs_password, utilisateurs_privilege)
    VALUES (?,?,?)";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "sss", $utilisateurs["nom"], $utilisateurs["mdp"], $utilisateurs["privilege"]);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

?>