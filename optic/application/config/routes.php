<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

require(APPPATH.'config/database.php');
/** 
 * -------------------------------------------------------------------------
 * FOR REROUTING
 * -------------------------------------------------------------------------
 **/
function prepare_url($value){
	$search		= '-';
	$replace	= '-';
    $value      = strtolower($value);
	$trans = array(
        '&\#\d+?;'				=> '',
        '&\S+?;'				=> '',
        '\s+'					=> $replace,
        '[^a-z0-9\-\._]'		=> '',
        $replace.'+'			=> $replace,
        $replace.'$'			=> $replace,
        '^'.$replace			=> $replace,
        '\.+$'					=> ''
      );

    $value = strip_tags($value);
    
    foreach ($trans as $key => $val){
        $value = preg_replace("#".$key."#i", $val, $value);
    }

    $value = strip_tags($value);

    return trim(stripslashes($value));
}
// MY SQL CONNECTIONS
mysql_connect($db[$active_group]['hostname'], $db[$active_group]['username'], $db[$active_group]['password']);
mysql_select_db($db[$active_group]['database']);

// FOR CATEGORIES

$query  =   "SELECT fld_id, fld_name FROM tbl_categories";
$result = mysql_query($query);

while($regel = mysql_fetch_array($result))
{	
    list($id,$name) = $regel;
    for($x=9; $x<=45; $x=$x+9){
        $route[prepare_url($name) ."-" . $id.'/'.$x] = "site/categories/index/".$id."/".$x ;
        $route[prepare_url($name) ."-" . $id.'/'.$x.'/(:num)'] = "site/categories/index/".$id."/".$x.'/$1' ;
    }
}

// FOR PRODUCT

$query = "SELECT tbl_product.fld_id, tbl_product.fld_category, tbl_product.fld_subcategory, tbl_product.fld_name AS p_name, tbl_categories.fld_name AS cat_name, tbl_sub_categories.fld_name AS sub_cat_name FROM tbl_product LEFT JOIN tbl_categories ON tbl_product.fld_category = tbl_categories.fld_id LEFT JOIN tbl_sub_categories on tbl_product.fld_subcategory = tbl_sub_categories.fld_id";

$result = mysql_query($query);

while($regel = mysql_fetch_array($result))
{	
    list($id,$c_id,$sc_id,$p_name, $c_name, $sc_name) = $regel;
//    $route[prepare_url($c_name) ."-". $c_id.'/'.prepare_url($sc_name.'-'.$sc_id).'/'.prepare_url($p_name.'-'.$id)] = "site/cart_steps/index/".$id ;
    if($sc_name!=''){$address = prepare_url($c_name).'/'.prepare_url($sc_name);}
    else $address = prepare_url($c_name);
    $route[$address.'/'.prepare_url($p_name.'-'.$id)] = "site/cart_steps/index/".$id ;
}

// FOR SUB CATEGORIES

$query = "SELECT tbl_sub_categories.fld_id, tbl_sub_categories.fld_name, tbl_categories.fld_name as cat_name FROM tbl_sub_categories LEFT JOIN tbl_categories ON tbl_sub_categories.fld_category_id = tbl_categories.fld_id";

$result = mysql_query($query);

while($regel = mysql_fetch_array($result))
{	
    list($id,$sc_name, $c_name) = $regel;
    for($x=9; $x<=45; $x=$x+9){
        $route[prepare_url($c_name).'/'.prepare_url($sc_name.'-'.$id).'/'.$x] = "site/categories/sub_categories/".$id.'/'.$x ;
        $route[prepare_url($c_name).'/'.prepare_url($sc_name.'-'.$id).'/'.$x.'/(:num)'] = "site/categories/sub_categories/".$id.'/'.$x.'/$1' ;
    }
}

// FOR ACCESSORIES

$query = "SELECT fld_id,fld_name FROM tbl_accessories";
$result = mysql_query($query);
while($regel = mysql_fetch_array($result))
{
    $address = 'accessories';
    list($id,$acc_name) = $regel;
    $route[$address.'/'.prepare_url($acc_name).'-'.$id] = "site/accessories/selected_accessory/".$id;
}
mysql_close();
for($x=9; $x<=45; $x=$x+9){
    $route['accessories/'.$x] = "site/accessories/index/".$x;
    $route['accessories/'.$x.'/(:num)'] = "site/accessories/index/".$x.'/$1';
}
for($x=9; $x<=45; $x=$x+9){
    $route['contact_lens/'.$x] = "site/contact_lens/index/".$x;
    $route['contact_lens/'.$x.'/(:num)'] = "site/contact_lens/index/".$x.'/$1';
}
//echo '<pre>';
//print_r($route);
//echo '</pre>';
/** 
 * -------------------------------------------------------------------------
 * REROUTING ENDS
 * -------------------------------------------------------------------------
 **/

$route['help'] = "index/help";
$route['default_controller'] = "index";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */