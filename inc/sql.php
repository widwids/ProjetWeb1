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
        echo "<meta http-equiv='refresh' content='0'>";
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
        echo "<meta http-equiv='refresh' content='0'>";
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
        echo "<meta http-equiv='refresh' content='0'>";
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
        echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction listerCommandes,
 * Auteur   : Vincent,
 * Date     : 28-01-2020,
 * But      : Récupérer les commandes avec les données associées,
 * Input    : $conn = contexte de connexion,
 *            $recherche = chaîne de caractères pour la recherche de commande par nom de client (optionnel),
 * Output   : $liste = tableau des lignes de la commande SELECT.
 */
function listerCommandes($conn, $recherche = "")
{
/*     $req = "SELECT * FROM `commandes` ";
 */


$req = "SELECT
C.id as 'Numéro de commande', 
CL.clients_nom as 'Nom du client',
C.date as 'Date',
P.produits_nom as 'Produit',
PC.quantite_produit as 'Quantite',
P.produits_prix as 'Prix',
C.commandes_adresse as 'Adresse',
C.commandes_commentaire as 'Commentaire',
C.commandes_etat as 'État',
P.produits_id

FROM
    commandes as C
INNER JOIN
    commandes_produits as PC on PC.commande_id = C.id
INNER JOIN
    produits as P on P.produits_id = PC.produit_id
INNER JOIN
    clients as CL on CL.clients_id = C.fk_client_id";

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
 * Fonction enregistrerCommande
 * Auteur : Vincent
 * Date     : 28-01-2020,
 * But    : ajout de ligne dans les tables commande et comandes_produits
 * Arguments en entrée : $conn = contexte de connexion
 *                       $commande = tableau contenant les id et les quantités des produits commandés
 * Valeurs de retour   : aucune
 */
function enregistrerCommande($conn, $commande) {

/*     mysqli_begin_transaction($conn); // Début de la transaction
 */




    // Création de la commande
    $req = "INSERT INTO commandes
    (C.id as 'Numéro de commande', 
    CL.clients_nom as 'Nom du client',
    C.date as 'Date',
    P.produits_nom as 'Produit',
    PC.quantite_produit as 'Quantite',
    P.produits_prix as 'Prix',
    C.commandes_adresse as 'Adresse',
    C.commandes_commentaire as 'Commentaire',
    C.commandes_etat as 'État',
    P.produits_id)
    
    FROM
        commandes as C
    INNER JOIN
        commandes_produits as PC on PC.commande_id = C.id
    INNER JOIN
        produits as P on P.produits_id = PC.produit_id
    INNER JOIN
        clients as CL on CL.clients_id = C.fk_client_id
    VALUES (?,?,?,?,?)";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "ssssss", $commande["id"], $commande["date"], $commande["commandes_adresse"], $commande["commandes_etat"], $commande["commandes_commentaire"], $commande["fk_client_id"]);
    if (mysqli_stmt_execute($stmt)) {
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }





    
}


/**
 * Fonction errSQL,
 * Auteur   : Vincent,
 * Date     : 28-01-2020,
 * But      : afficher le message d'erreur de la dernière "query" SQL,
 * Input    : $conn = contexte de connexion,
 * Output   : aucun.
 */
function errSQL($conn)
{
    ?>
    <p>Erreur de requête : <?php echo mysqli_errno($conn) . " – " . mysqli_error($conn) ?></p>
<?php
}

/** 
 * Fonction modifierProduit
 * Auteur   : Vincent
 * Date     : 29-01-2020
 * But    : modifier une ligne dans la table produit  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $produit
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function modifierProduit($conn, $produit)
{
    $req = "UPDATE produits SET produits_nom = ?, produits_description = ?, produits_prix = ?, produits_quantite = ?, fk_categorie_id = ?
    WHERE produits_id = ?";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "ssdiss", $produit["produits_nom"], $produit["produits_description"], $produit["produits_prix"], $produit["produits_quantite"], $produit["fk_categorie_id"], $produit["produits_id"]);
    if (mysqli_stmt_execute($stmt)) {
    echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction supprimerProduit
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : supprimer une ligne dans la table produit  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $produit
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function supprimerProduit($conn, $produit)
{
    $req = "DELETE FROM produits WHERE produits_id = ?";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "s", $produit["produits_id"]);
    if (mysqli_stmt_execute($stmt)) {
    echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction modifierCategorie
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : modifier une ligne dans la table categorie  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $produit
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function modifierCategorie($conn, $categories)
{
    $req = "UPDATE categories SET categories_nom = ?
    WHERE categories_id = ?";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "ss", $categories["categories_nom"], $categories["categories_id"]);
    if (mysqli_stmt_execute($stmt)) {
    echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction supprimerCategorie
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : supprimer une ligne dans la table categorie  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $categorie
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function supprimerCategorie($conn, $categorie)
{
     $req2 = "DELETE FROM categories WHERE categories_id = ?";
    $stmt = mysqli_prepare($conn, $req2);
    mysqli_stmt_bind_param($stmt, "s", $categorie["categories_id"]);
    if (mysqli_stmt_execute($stmt)) {
        echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction modifierClient
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : modifier une ligne dans la table client  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $client
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function modifierClient($conn, $client)
{
    $req = "UPDATE clients SET clients_nom = ?, clients_telephone = ?, clients_adresse = ? 
    WHERE clients_id = ?";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "ssss", $client["clients_nom"], $client["clients_telephone"], $client["clients_adresse"], $client["clients_id"]);
    if (mysqli_stmt_execute($stmt)) {
    echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction supprimerClient
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : supprimer une ligne dans la table client  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $client
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function supprimerClient($conn, $client)
{
     $req2 = "DELETE FROM clients WHERE clients_id = ?";
    $stmt = mysqli_prepare($conn, $req2);
    mysqli_stmt_bind_param($stmt, "s", $client["clients_id"]);
    if (mysqli_stmt_execute($stmt)) {
        echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction modifierUtilisateur
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : modifier une ligne dans la table utilisateur  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $utilisateur
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function modifierUtilisateur($conn, $utilisateur)
{
    $req = "UPDATE utilisateurs SET utilisateurs_password = ?, utilisateurs_privilege = ? 
    WHERE utilisateurs_nom = ?";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "sss", $utilisateur["utilisateurs_password"], $utilisateur["utilisateurs_privilege"], $utilisateur["utilisateurs_nom"]);
    if (mysqli_stmt_execute($stmt)) {
    echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/** 
 * Fonction supprimerUtilisateur
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But    : supprimer une ligne dans la table client  
 * Arguments en entrée : $conn = contexte de connexion
 *                       $utilisateur
 * Valeurs de retour   : 1    si ajout effectuée
 *                       0    si aucun ajout
 */
function supprimerUtilisateur($conn, $utilisateur)
{
    $req2 = "DELETE FROM utilisateurs WHERE utilisateurs_nom = ?";
    $stmt = mysqli_prepare($conn, $req2);
    mysqli_stmt_bind_param($stmt, "s", $utilisateur["utilisateurs_nom"]);
    if (mysqli_stmt_execute($stmt)) {
        echo "<meta http-equiv='refresh' content='0'>";
        return mysqli_stmt_affected_rows($stmt);
    } else {
        errSQL($conn);
        exit;
    }
}

/**
 * Fonction controlerUtilisateur,
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But      : contrôler l'authentification de l'utilisateur dans la table utilisateur,
 * Input    : $conn = contexte de connexion,
 *                       $utilisateurs_nom,
 *                       $utilisateurs_password,
 * Output   : 1 si utilisateur avec $utilisateurs_nom et $utilisateurs_password trouvé sinon 0.
 */
function controlerUtilisateur($conn, $utilisateurs_nom, $utilisateurs_password)
{
    $req = "SELECT * FROM utilisateurs
            WHERE utilisateurs_nom=? AND utilisateurs_password =?";
    $stmt = mysqli_prepare($conn, $req);
    mysqli_stmt_bind_param($stmt, "ss", $utilisateurs_nom, $utilisateurs_password);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_num_rows($result);
    } else {
        errSQL($conn);
        exit;
    }
}

/**
 * Fonction lirePrivilegeUtilisateur
 * Auteur   : Vincent
 * Date     : 30-01-2020
 * But      : Récupérer le privilege d'un utilisateur à partir de son identifiant 
 * Input    : $conn = contexte de connexion
 *            $utilisateurs_nom = adresse email  du client
 * Output   : $row  = ligne correspondant au privilege de l'utilisateur  
 */
function lirePrivilegeUtilisateur($conn, $utilisateurs_nom)
{

    $req = "SELECT * FROM utilisateurs WHERE utilisateurs_nom ='$utilisateurs_nom'";

    if ($result = mysqli_query($conn, $req)) {
        $nbResult = mysqli_num_rows($result);
        $row = array();
        if ($nbResult) {
            mysqli_data_seek($result, 0);
            $row = mysqli_fetch_array($result);
        }
        mysqli_free_result($result);
        $id = $row['utilisateurs_privilege'];
        return $id;
    } else {
        errSQL($conn);
        exit;
    }
}
?>