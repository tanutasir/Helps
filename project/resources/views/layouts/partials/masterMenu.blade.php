<?php

use Illuminate\Support\Facades\Request;
use App\Structs;
if(Request::isMethod('post')){
//    $id = Request::input('id');
}
/*echo '<h1>';
echo $id;
echo '<br/>';
echo $sid;
echo '</h1>';*/
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

echo '<div style="height: 30px;"></div>';
echo '
<div style="position: absolute;z-index: -1;height: 35px; background-color: #0fc1d1;position: relative;">
    <div style="background-color: orange;height: 31px;">
        <div style="background-color: #3E78A6;height: 29px;"></div>
    </div>
</div>';

