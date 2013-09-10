<?php if( ! defined('BASEPATH')) exit('NO direct script access allowed');
function product_types() 
{
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_product_type');
    $query = $CI->db->get();
    return $query;
}
function attributes($ptype_id)
{
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_attributes');
    $CI->db->where('fld_product_type_id',$ptype_id);
    $query = $CI->db->get();
    return $query;
}
function categories($product_type)
{
    $CI = & get_instance();
    $sql = 'select tbl_categories.fld_id,tbl_categories.fld_name from tbl_categories inner join tbl_product on tbl_categories.fld_id = tbl_product.fld_category where fld_product_type ='.$product_type.' group by tbl_categories.fld_id';
    $query = $CI->db->query($sql);
    return $query;
}
function subcategories($category)
{
    $CI = & get_instance();
    $CI->db->select('*');
    $CI->db->from('tbl_sub_categories');
    $CI->db->where('fld_category_id',$category);
    $query = $CI->db->get();
    return $query;
}

function cats_subcats()
{
    $CI = & get_instance();
    $CI->db->select('c.*,s.fld_id as subcat_id,s.fld_name as subcat_name,s.fld_location as subcat_location,s.fld_image as subcat_image,s.fld_description as subcat_description, MIN(p.fld_sp) as min_price,MAX(p.fld_sp) as max_price');
    $CI->db->from('tbl_categories as c');
    $CI->db->join('tbl_sub_categories as s','s.fld_category_id = c.fld_id','inner');
    $CI->db->join('tbl_product as p','p.fld_category = c.fld_id','inner');
    $query = $CI->db->get()->result();
    foreach($query as $key=>$value)
    {
        $cats[$value->fld_id]['fld_id']=$value->fld_id;
        $cats[$value->fld_id]['fld_name']=$value->fld_name;
        $cats[$value->fld_id]['fld_description']=$value->fld_description;
        $cats[$value->fld_id]['fld_location']=$value->fld_location;
        $cats[$value->fld_id]['fld_image']=$value->fld_image;
        $cats[$value->fld_id]['min_price']=$value->min_price;
        $cats[$value->fld_id]['max_price']=$value->max_price;
        $cats[$value->fld_id]['subcat'][$value->subcat_id]=array(
                                                                'subcat_id'=>$value->subcat_id,
                                                                'subcat_name'=>$value->subcat_name,
                                                                'subcat_description'=>$value->subcat_description,
                                                                'subcat_location'=>$value->subcat_location,
                                                                'subcat_image'=>$value->subcat_image
                                                            );
    }
    return $cats;
}
function get_attributes()
{
    $CI = & get_instance();
    $CI->db->select('a.*,v.fld_id as attr_id,v.fld_value as attr_name,v.fld_parent_id as parent_id,v.fld_attribute_id');
    $CI->db->from('tbl_attributes as a');
    $CI->db->join('tbl_attribute_values as v','a.fld_id = fld_attribute_id','inner');
    $query = $CI->db->get()->result();
    
    return $query;
}

function displayArrayRecursively($attr_id, $arr, $indent='', $new=false)
{
    if ($arr)
    {
        //echo '<pre>';print_r($arr);echo '</pre>';
        if(!$new)echo '<ul>';
        foreach ($arr as $value)
        {
            if (is_array($value))
            {
                echo '<li>';
                displayArrayRecursively($attr_id, $value, $indent . '&nbsp;&nbsp;&nbsp;',false);
                echo " </li><br />";
            }
            else
            {
                if($new)
                {
                    echo '<li><ul>';
                    $new=false;
                }else{ 
                    if($attr_id == 3 &&count($arr)>1)
                    {
                        echo "<li style='display:none;'>"; 
                    }else
                    echo "<li>"; 
                    echo $indent .'<input type="checkbox" name="attr[]" value="'.$attr_id.'_'.$value->attr_id.'"> '. $value->attr_name." &nbsp;&nbsp;&nbsp;&nbsp;";
                    echo " </li>";
                }
            }
        }
        echo '</ul>';
    }
}