<?php

$hashalgo = "sha512";
$docpath = dirname(__FILE__) .'/docs/';
date_default_timezone_set("Europe/Paris");

function get_table($tablename)
{
	global $docpath;
	$serial = $docpath . $tablename . '.serial';
	return (unserialize(file_get_contents($serial)));
}

function put_table($tablename, $data)
{
	global $docpath;
	file_put_contents($docpath . $tablename . '.serial', serialize($data));
	return ;
}


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//                     USERS
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

function create_user($login, $passwd, $admin)
{
	global $hashalgo;
	$passwd = hash($hashalgo, $passwd);
	$users = get_table('users');
	foreach ($users as $entry)
		if ($entry['login'] == $login)
				return (FALSE);
	$new = array();
	$new['login'] = $login;
	$new['passwd'] = $passwd;
	$new['admin'] = (bool)$admin;
	$users[] = $new;
	put_table('users', $users);
	return (TRUE);
}

function modif_user($login, $oldpw, $newpw, $switchadmin)
{
	global $hashalgo;
	
	$users = get_table('users');
	foreach ($users as &$value)
	{
		if ($value['login'] == $login)
		{
			if (!$oldpw && $switchadmin)
			{
				$value['admin'] = !$value['admin'];
				put_table('users', $users);
				return (TRUE);
			}
			$oldpw = hash($hashalgo , $oldpw);
			$newpw = hash($hashalgo, $newpw);
			if ($value['passwd'] != $oldpw)
				return (FALSE);
			$value['passwd'] = $newpw;
			if ($switchadmin)
				$value['admin'] = !$value['admin'];
			put_table('users', $users);
			return (TRUE);
		}
	}
	return (FALSE);
}

function delete_user ($login)
{
	$users = get_table('users');
	foreach ($users as &$user)
		if ($user['login'] == $login)
		{
			$user['login'] = '';
			$user['passwd'] = '';
			$user['admin'] = '';
			put_table('users', $users);
			return (TRUE);
		}
	return (FALSE);
}

function get_all_users()
{
	$ret = array();
	$users = get_table('users');
	foreach ($users as $user)
		if ($user['login'] != "")
			$ret[] = $user;
	return ($ret);
}

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//                     PRODUCTS
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

function create_product($name, $img_path, $description, $price)
{
	$products = get_table('products');
	$temp = array();
	$temp['name'] = $name;
	$temp['img_path'] = $img_path;
	$temp['description'] = $description;
	$temp['price'] = $price;
	$products[] = $temp;
	put_table('products', $products);
}

function modif_product($oldname, $newname, $newdescription, $newimg_path, $newprice)
{
	if (!$oldname)	
		return ;
	$products = get_table('products');
	foreach ($products as &$prod)
	{
		if ($prod['name'] == $oldname)
		{
			if ($newname)
				$prod['name'] = $newname;
			if ($newimg_path)
				$prod['img_path'] = $newimg_path;
			if ($newdescription)
				$prod['description'] = $newdescription;
			if ($newprice)
				$prod['price'] = $newprice;
			put_table('products', $products);
			return (TRUE);
		}
	}
	return (FALSE);
}

function delete_product($productname)
{
	$products = get_table('products');
	foreach ($products as &$prod)
		if ($prod['name'] == $productname)
		{
			$prod['name'] = '';
			$prod['img_path'] = '';
			$prod['description'] = '';
			$prod['price'] = '';
			put_table('products', $products);
			return (TRUE);
		}
	return (FALSE);
}

function get_product_details($productname)
{
	if (!$productname)
		return (NULL);
	$products = get_table('products');
	foreach($products as $item)
		if ($item['name'] == $productname)
			return ($item);
	return (NULL);
}

function get_product_price($productname)
{
	if (($item = get_product_details($productname)) != NULL)
		return ($item['price']);
	return 0;
}

function get_product_id($product)
{
	$products = get_table('products');
	return (array_search($product, array_column($products, 'name')));
}

function get_all_products()
{
	$ret = array();
	$products = get_table('products');
	foreach ($products as $prod)
		if ($prod['name'] != "")
			$ret[] = $prod;
	return ($ret);
}


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//                     CART
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

function add_to_cart($serialcart, $productname)
{
	if ($serialcart)
		$cart = unserialize($serialcart);
	else
		$cart = array();
	if (!array_key_exists($productname, $cart))
		$cart[$productname] = 0;
	$cart[$productname] += 1;
	//var_dump($cart);
	return (serialize($cart));
}

function remove_from_cart($serialcart, $productname)
{
	if (!$serialcart)
	{
		$cart = array();
		return (serialize($cart));
	}
	$cart = unserialize($serialcart);
	if (!array_key_exists($productname, $cart))
		return (serialize($cart));
		
	if ($cart[$productname] <= 1)
		unset ($cart[$productname]);
	else
		$cart[$productname] -= 1;
	return (serialize($cart));
}

function get_total_cart($serialcart)
{
	if (!$serialcart)
		return 0;
	$cart = unserialize($serialcart);
	$res = 0;
	foreach ($cart as $name => $quantity)
		$res += $quantity * get_product_price($name);
	return ($res);
}

function get_products_number_cart($serialcart)
{
	if (!$serialcart)
		return 0;
	$cart = unserialize($serialcart);
	$res = 0;
	foreach ($cart as $name => $quantity)
		$res += $quantity;
	return ($res);
}

function get_products_in_cart($serialcart)
{
	$res = array();
	if (!$serialcart || !($cart = unserialize($serialcart)))
		return (FALSE);
	foreach ($cart as $name => $quantity)
	{
		$temp = get_product_details($name);
		if ($temp)
		{
			$temp['quantity'] = $quantity;
			$res[] = $temp;
		}
		
	}
	return ($res);
}

function validate_cart($serialcart, $login)
{
	if (!$login || !$serialcart)
		return (FALSE);
	$orders = get_table('orders');
	//var_dump($orders);
	$temp = array();
	$temp['login'] = $login;
	$temp['date'] = time();
	$temp['total'] = get_total_cart($serialcart);
	$temp['cart'] = $serialcart;
	$orders[] = $temp;
	put_table('orders', $orders);
	return (TRUE);
}

function get_order($id)
{
	$orders = get_table('orders');
	return ($orders[$id]);
	
}

function get_all_orders()
{
	return (get_table('orders'));
}


/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//                     CATEGORIES
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

function create_category($name)
{
	$categories = get_table('categories');
	$temp = array();
	$temp['name'] = $name;
	$categories[] = $temp;
	put_table('categories', $categories);
}

function modif_category($oldname, $newname)
{
	if (!$oldname || !$newname)	
		return ;
	$categories = get_table('categories');
	foreach ($categories as &$category)
		if ($category['name'] == $oldname)
		{
			$category['name'] = $newname;
			put_table('categories', $categories);
			return (TRUE);
		}
	return (FALSE);
}

function delete_category($categoryname)
{
	$categories = get_table('categories');
	foreach ($categories as &$category)
		if ($category['name'] == $categoryname)
		{
			$category['name'] = '';
			put_table('categories', $categories);
			return (TRUE);
		}
	return (FALSE);
}

function get_category_id($category)
{
	$categories = get_table('categories');
	return (array_search($category, array_column($categories, 'name')));
}

function get_all_categories()
{
	$ret = array();
	$categories = get_table('categories');
	foreach ($categories as $cat)
		if ($cat['name'] != "")
			$ret[] = $cat;
	return ($ret);
}

/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
//                CATEGORIES-PRODUCTS
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////

function create_link($cat_name, $prod_name)
{
	$categories_products = get_table('categories_products');
	$c_id = get_category_id($cat_name);
	$p_id = get_product_id($prod_name);
	$temp = array();
	$temp['c_id'] = $c_id;
	$temp['p_id'] = $p_id;
	$categories_products[] = $temp;
	put_table('categories_products', $categories_products);
}

function delete_link($cat_name, $prod_name)
{
	$categories_products = get_table('categories_products');
	$c_id = get_category_id($cat_name);
	$p_id = get_product_id($prod_name);
	foreach ($categories_products as $key => $cp)
		if ($cp['p_id'] == $p_id && $cp['c_id'] == $c_id)
		{
			unset($categories_products[$key]);
			put_table('categories_products', $categories_products);
			return (TRUE);
		}
	return (FALSE);
}

function category_has_product($cat_name, $prod_name)
{
	$categories_products = get_table('categories_products');
	$c_id = get_category_id($cat_name);
	$p_id = get_product_id($prod_name);
	foreach ($categories_products as $cp)
		if ($cp['p_id'] == $p_id && $cp['c_id'] == $c_id)
			return (TRUE);
	return (FALSE);
}

function categories_of_product($name)
{
	if ($name === NULL)
		return (NULL);
	$products = get_table('products');
	$categories = get_table('categories');
	$categories_products = get_table('categories_products');
	$p_id = get_product_id($name);
	$ret = array();
	foreach($categories_products as $cp)
		if ($cp['p_id'] == $p_id)
			$ret[] = $categories[$cp['p_id']];
	return ($ret);
}


function products_of_category($name)
{
	if ($name === NULL)
		return (get_all_products());
		
	$products = get_table('products');
	$categories = get_table('categories');
	$categories_products = get_table('categories_products');

	$cat_index = array_search($name, array_column($categories, 'name'));
	$ret = array();
	foreach($categories_products as $cp)
		if ($cp['c_id'] == $cat_index)
			$ret[] = $products[$cp['p_id']];
	return ($ret);
}

?>
