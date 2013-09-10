/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function check_all(tab_id,cat_id)
{
    var cat = "#cat_"+cat_id;
    if($('#tab'+tab_id).find(cat).attr('class')=="cath true")
    {
        $('#tab'+tab_id).find(cat+'>div >ul >li > :checkbox').attr("disabled","disabled");
        $('#tab'+tab_id).find(cat+'>div >ul >li > :checkbox').removeAttr("checked");
        $('#tab'+tab_id).find(cat).removeClass("true");
    }
    else
    {
        $('#tab'+tab_id).find(cat+'>div >ul >li > :checkbox').removeAttr("disabled");
        $('#tab'+tab_id).find(cat).addClass("true");
    }
    
}
function prevent(tab,cat)
{
    var cat = "#cat_"+cat;
    $('#tab'+tab).find(cat).addClass("true");
    $('#tab'+tab).find(cat+'>div >ul >li > :checkbox').removeAttr("disabled");
}


