<?php
    use App\StructsSlave;
    echo "<div id='jstreeSlave' style='width: 200px;''>";
    $roots = StructsSlave::roots()->mid($id)->get();
    $arr = array();
    if($id != null && StructsSlave::where('id', $sid)->first()){
        $obj = StructsSlave::where('id', $sid)->first()->ancestorsAndSelf()->get();

        foreach($obj as $o){
            array_push($arr, $o->id);;
        }

    }
    echo "<ul>";
    foreach($roots as $root):
        renderNodeSlave($root, $arr, $id, $sid);
    endforeach;
    function renderNodeSlave($node, $arr, $id, $sid)
    {
        $act="";
        $opn="";

        if(in_array($node->id, $arr)){$opn = " jstree-open";}
        if($node->id == $sid){$act = " active";}
        if($node->type == "file"){
            $dataJstree='{"type":"file"}';
            $href = url("/".$id."/".$node->id);
            $icn ="";
        }else{
            $dataJstree='{"type":"folder"}';
            $href = 'javascript:void(0)';
        }

        echo "<li id='{$node->id}' class='".$opn."' data-jstree= '".$dataJstree."' >";
        echo "<a href='".$href."' class='".$act."' title='{$node->text}' data-toggle='tooltipp' data-placement='top' >{$node->text}</a>";

        if ($node->children()->count() > 0) {
            echo "<ul>";
            foreach ($node->children as $child) renderNodeSlave($child, $arr, $id, $sid);
            echo "</ul>";
        }

    }
    echo "</div>";
?>