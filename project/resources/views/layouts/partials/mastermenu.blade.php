<?php

use Illuminate\Support\Facades\Request;
use App\Structs;
if(Request::isMethod('post')){
//    $id = Request::input('id');
}
echo '<h1>';
echo $id;
echo '<br/>';
echo $sid;
echo '</h1>';
//echo '<div id="smoothmenu1" class="ddsmoothmenu">';
echo '<nav id="nav">';
$roots = Structs::roots()->get();
$arr = array();
if($id != null && Structs::where('id', $id)->first()){
    $obj = Structs::where('id', $id)->first()->ancestorsAndSelf()->get();


    foreach($obj as $o){
        array_push($arr, $o->id);;
    }

}
echo "<ul>";
foreach($roots as $root):
    renderNode($root, $arr);
endforeach;
function renderNode($node, $arr)
{
    $act="";
    if(in_array($node->id, $arr)){$act = " active";}
    if($node->type == "file"){
        $href = '/'.$node->id;
    }else{
      //  $href = 'javascript:void(0)';
        $href = '/'.$node->id;
    }
    echo "<li id='{$node->id}'  class='submenu".$act."' >";
    echo "<a href='".$href."' class='".$act."' >{$node->text}</a>";

    if ($node->children()->count() > 0) {
        echo "<ul>";
        foreach ($node->children as $child) renderNode($child, $arr);
        echo "</ul>";
    }

}
echo "</ul>";
echo "</nav>";
/*
echo '<div style="clear:both;text-align: left;float: left;">';
if($id != null && Structs::where('id', $id)->first()){
    $obj = Structs::where('id', $id)->first()->ancestors()->get();
    foreach($obj as $o){
        echo $o->text;
        echo " > ";
    }
    echo Structs::where('id', $id)->first()->text;
}
echo"</div>";
*/