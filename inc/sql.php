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
function enregistrerCommande($conn, $commande, $client) {
    mysqli_begin_transaction($conn); // Début de la transaction

    // Création de la commande
    $req = "INSERT INTO commandes (fk_client_id, date, commandes_adresse, commandes_etat, commandes_commentaire) VALUES ($_POST[nomClient], $_POST[date], $_POST[adresse], $_POST[etat], $_POST[commentaire]);";
        
    if ($result = mysqli_query($conn, $req)) {
        $row = mysqli_affected_rows($conn);
    } else {
        errSQL($conn);
        mysqli_rollback($conn);
        exit;
    }

    $commande_id = mysqli_insert_id($conn);


    
    // Insert les produits commandés dans la table commandes_produits
    $req = "INSERT INTO commandes_produits (produit_id, commande_id, quantite_produit) VALUES (" . $_POST["produit"] . ", $commande_id," . $_POST["quantite"] . ");";
        
    if ($result = mysqli_query($conn, $req)) {
        $row = mysqli_affected_rows($conn);
    } else {
        errSQL($conn);
        mysqli_rollback($conn);
        exit;
    }

    // mise à jours à jours de la quantité des produits commandés
        $req = "UPDATE produits SET produits_quantite = produits_quantite -". $_POST["quantite"] . ");";

        if ($result = mysqli_query($conn, $req)) {
            $row = mysqli_affected_rows($conn);
        } else {
            errSQL($conn);
            mysqli_rollback($conn);
            exit;
        }
    
    

    /* foreach ($commande as $c { // Pour chaque produit commandé
        // Récupération de la quantité actuelle des produits commandés
        $req = "SELECT produits_quantite FROM produits WHERE produits_id=" . $c["produit"];
        die($req);
        if ($result = mysqli_query($conn, $req)) {
            $row = mysqli_fetch_row($result);
            $quantite = $row[0]; 
        } else {
            errSQL($conn);
            mysqli_rollback($conn);
            exit;
        }

        $nouvelleQuantite = $quantite - $c["quantité"];

        // Insert les produits commandés dans la table commandes_produits
        $req = "INSERT INTO commandes_produits (produit_id, commande_id, quantite_produit) VALUES (" . $c["produit"] . ", $commande_id," . $c["quantite"] . ");";
        
        if ($result = mysqli_query($conn, $req)) {
            $row = mysqli_affected_rows($conn);
        } else {
            errSQL($conn);
            mysqli_rollback($conn);
            exit;
        }

        // Si il y a suffisament de stock, mise à jours à jours de la quantité des produits commandés
        if ($c["quantité"] <= $quantite) {
            $req = "UPDATE produits SET produits_quantite = $nouvelleQuantite WHERE produits_id = " . $c["produit"];
    
            if ($result = mysqli_query($conn, $req)) {
                $row = mysqli_affected_rows($conn);
            } else {
                errSQL($conn);
                mysqli_rollback($conn);
                exit;
            }
        }
        else {
            mysqli_rollback($conn); ?>
                <p class="erreur">Erreure : Plus assez de stock pour le produit numéro <?= $c["produit"] ?>.</p>
        <?php  exit;
        }
    } */


    mysqli_commit($conn);
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





?>