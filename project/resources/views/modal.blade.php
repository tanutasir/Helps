<?php

    use Illuminate\Support\Facades\Request;
    use App\Structs;
    use Illuminate\Support\Facades\DB;

   // header('Content-Type: application/json');
    $roots = Structs::roots()->get();
    $arr=array();
    $i=0;
    echo "[";
    foreach($roots as $root):
        if ($i != 0){echo ", ";}
        $i++;
        renderNode($root, $arr);
    endforeach;

    function renderNode($row, $arr){

        echo '{"id":"'.$row->id.'", "text":"'.$row->text.'", "type":"'.$row->type.'", "children":[';

        if ($row->children()->count() > 0) {
            $i=0;
            foreach ($row->children as $child):
                if ($i != 0){echo ", ";}
                $i++;
                renderNode($child, $arr);
            endforeach;
        }

        echo "]}";

    }

    echo "]";




//    $id = Request::input('id');
//    $rslt = array();
//
//    //echo '<div id="modal-tree">';
//
//    $roots = Structs::roots()->get();
//    $arr = array();
//    if($id != null && Structs::where('id', $id)->first()){
//        $obj = Structs::where('id', $id)->first()->ancestorsAndSelf()->get();
//        foreach($obj as $o){
//            array_push($arr, $o->id);;
//        }
//    }
//
//    $i=0;
//    $q = "[";
//    foreach($roots as $root):
//        if ($i != 0){$q .= ",";}
//        renderNode($root, $arr, $q);
//    endforeach;
//    function renderNode($node, $arr, &$q)
//    {
//
//        $act="";
//        if(in_array($node->id, $arr)){$act = " active";}
//        if($node->type == "file"){
//            $href = '/page/'.$node->id;
//        }else{
//            $href = 'javascript:void(0)';
//        }
//        echo "<li id='{$node->id}'  class='submenu".$act."' >";
//        echo "<a href='".$href."' class='".$act."' >{$node->text}</a>";
//        $q .= "{'id' : '{$node->id}', 'text' : '{$node->text}', 'type' : '{$node->type}', 'children' : [";
//
//
//
//        if ($node->children()->count() > 0) {
//
//            foreach ($node->children as $child) renderNode($child, $arr, $q);
//
//        }
//        $q .= "]}";
//    }
//    $q .= "]";
//    //echo "</div>";
//
//
//    echo json_encode($q);
//echo "<br/><br/>";
//$tree = Structs::get()->toHierarchy();
//
////print_r($tree);
////var_dump($tree)
//echo "<br/><br/>";
//$tree = DB::select('select * from structs');
//echo json_encode($tree);



//    $rows = DB::select('SELECT node.id, node.text, node.depth, node.type, node.lft, node.rgt
//                          FROM tree_struct AS node, tree_struct AS parent
//                          WHERE node.lft BETWEEN parent.lft AND parent.rgt
//                          ORDER BY node.lft');
//
//
//
//
//
//$depth = 0;
//$rslt = array();
//echo "[";
//$i = 0;
//foreach ($rows as $row):
//    if($i>1){echo ",";}
//    $i++;
////    if($row->depth == $depth){
////        echo "{ 'id':".$row->id.", 'text':".$row->text."}";
////        echo "<br/>";
////    }
////    if($row->depth > $depth){
////        //$depth = $row->depth;
////    }
////    if($row->depth < $depth){
////        //$depth = $row->depth;
////    }
//////
//    renderNode($row, $depth);
//endforeach;
//
//    function renderNode($row, $depth) {
//        if($row->rgt - $row->lft > 1){
//            echo "{'id':'$row->id','text':'$row->text','children':[]}";
//        }else{
//            echo "{'id':'$row->id','text':'$row->text','children':[";
//            if ($row->depth > $depth) {
//                //renderNode($row, $depth);
//                //foreach ($node->children as $child) renderNode($child, $rslt);
//
//            }
//            echo "]}";
//        }
//    }
//echo "]";
//    function renderchild($node, &$rslt) {
//
////        if ($node->children()->count() > 0) {
////
////            //foreach ($node->children as $child) renderNode($child, $rslt);
////
////        }
//
//    }
////    print_r($roots);
//echo "<br/><br/>";
//    echo json_encode($rslt);
?>