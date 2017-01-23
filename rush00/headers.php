<?php

function db_destroy_db(); //dans l'init, inutile pour toi
function db_init(); //dans l'init, inutile pour toi
function db_create_tables(); //dans l'init, inutile pour toi
function insert_category($name); //cree nouvelle categorie
function link_product_category($prodname, $catname); //relie produit a cotegorie
function insert_user($login, $passwd) ; //cree un nouvel utilisateur
function insert_product($name, $img_path, $price, $description); // cree nouveau produit
function select_product($name); //retourne les details d'un produit
function select_all_categories(); //retourne les infos de toutes les categories
function select_all_category_products($c_id); //retourne les infos de tous les produits d'une cat
function select_all_product_categories($p_id); // retourne les infos de toutes les cats d'un produit
function select_no_product_categories($p_id); // retourne les infos de toutes les categories auxquelle le prod n'appartient pas
function select_all_products(); // rtourne les infos de tous les produits

include ("db_describes.php");
function table_fields($name); // retourne le nom des champs d'une table

include ("db_updates.php");
function update_user($id, $login, $password, $admin)
