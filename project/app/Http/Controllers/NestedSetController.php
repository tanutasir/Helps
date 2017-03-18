<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;
use Auth;

use App\libs\nestedSet;
use App\libs\nestedSetSlave;
use App\libs\at\ext;
use App\Structs;
use App\StructsSlave;
use App\Data;
use Session;


class NestedSetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function data(){
        if(isset($_GET['op'])) {
            $fs = new nestedSet();
            try {
                $rslt = null;
                switch($_GET['op']) {
                    case 'get_node':
                        $id = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $rslt = $fs->get_children($id);
                        break;
                    case 'create_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $temp = $fs->mk($node, isset($_GET['position']) ? (int)$_GET['position'] : 0, $_GET['type']);
                        $rslt = $temp['id'];//array('id' => $temp);
                        break;
                    case 'rename_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $rslt = $fs->rn($node, isset($_GET['text']) ? $_GET['text'] : 'Renamed node');
                        break;
                    case 'delete_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $rslt = $fs->rm($node);
                        break;
                    case 'move_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $parn = isset($_GET['parent']) && $_GET['parent'] !== '#' ? (int)$_GET['parent'] : 0;
                        $rslt = $fs->mv($node, $parn, isset($_GET['position']) ? (int)$_GET['position'] : 0);
                        break;
                    default:
                        throw new Exception('Unsupported operation: ' . $_GET['op']);
                        break;
                }
                //header('Content-Type: application/json; charset=utf-8');
                echo json_encode($rslt);
                
            } catch (Exception $ex) {
                header($_SERVER["SERVER_PROTOCOL"] . ' 500 Server Error');
                header('Status:  500 Server Error');
                echo $ex->getMessage();
            }
        }
    }

    public function dataSlave(){
        if(isset($_GET['op'])) {
            $fs = new nestedSetSlave();
            try {
                $rslt = null;
                switch($_GET['op']) {
                    case 'get_node':
                        $id = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $rslt = $fs->get_children($id);
                        break;
                    case 'create_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $temp = $fs->mk($node, isset($_GET['position']) ? (int)$_GET['position'] : 0, $_GET['type']);
                        $rslt = $temp['id'];//array('id' => $temp);
                        break;
                    case 'rename_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $rslt = $fs->rn($node, isset($_GET['text']) ? $_GET['text'] : 'Renamed node');
                        break;
                    case 'delete_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $rslt = $fs->rm($node);
                        break;
                    case 'move_node':
                        $node = isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
                        $parn = isset($_GET['parent']) && $_GET['parent'] !== '#' ? (int)$_GET['parent'] : 0;
                        $rslt = $fs->mv($node, $parn, isset($_GET['position']) ? (int)$_GET['position'] : 0);
                        break;
                    default:
                        throw new Exception('Unsupported operation: ' . $_GET['op']);
                        break;
                }
                //header('Content-Type: application/json; charset=utf-8');
                echo json_encode($rslt);

            } catch (Exception $ex) {
                header($_SERVER["SERVER_PROTOCOL"] . ' 500 Server Error');
                header('Status:  500 Server Error');
                echo $ex->getMessage();
            }
        }
    }

    public function modal(){

        $rows = Structs::roots()->get();
        $arr=array();
        $i=0;
        echo "[";

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

        foreach($rows as $row):
            if ($i != 0){echo ", ";}
            $i++;
            renderNode($row, $arr);
        endforeach;
        echo "]";
    }

    public function slave(){

        $rows = StructsSlave::roots()->mid(Session::get("id"))->get();
        $arr=array();
        $i=0;
        echo "[";

        function renderNode($row, $arr){
            if($row->type == "file"){
                $href = url("/".Session("id")."/".$row->id);
            }else{
                $href = "javascript:void(0)";
            }

            echo '{"id":"'.$row->id.'", "text":"'.$row->text.'", "a_attr":{"title":"'.$row->text.'", "href":"'.$href.'"}, "type":"'.$row->type.'", "children":[';

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

        foreach($rows as $row):
            if ($i != 0){echo ", ";}
            $i++;
            renderNode($row, $arr);
        endforeach;



        echo "]";

    }
}
