<?php

include('data.php');

if ($_POST['action'] == 'create_category')
{
    create_category($_POST['name']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

if ($_POST['action'] == 'delete_category')
{
    delete_category($_POST['name']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

if ($_POST['action'] == 'remove_from_category')
{
    delete_link($_POST['category'], $_POST['product']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

if ($_POST['action'] == 'add_to_category')
{
    create_link($_POST['category'], $_POST['product']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

if ($_POST['action'] == 'delete_product')
{
    delete_product($_POST['name']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

if ($_POST['action'] == 'edit_product')
{
    modif_product($_POST['oldname'], $_POST['name'], $_POST['description'], $_POST['img_path'], $_POST['price']);
    header('Location: admin/product.php?name=' . $_POST['name']);
    return ;
}

if ($_POST['action'] == 'remove_admin' || $_POST['action'] == 'make_admin')
{
    modif_user($_POST['login'], 0, 0, 1);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

if ($_POST['action'] == 'delete_user')
{
    delete_user($_POST['login']);
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    return ;
}

?>
