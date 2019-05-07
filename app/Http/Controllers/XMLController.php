<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class XMLController extends Controller
{
    //
    public function neformat() {
        $url = "http://neformat.info/feed.php";
        $raw = file_get_contents($url);
        
        $raw = str_replace("<![CDATA[", "", $raw);
        $raw = str_replace("]]>", "", $raw);
        
        
        
        $raw = strip_tags($raw, "<author>,<link>,<category>,<content>,<title>,<published>,<updated>,<id>,<entry>,<xml>,<feed>");
        
      //dump($raw);
                
        $xml = simplexml_load_string($raw);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

       // dump($array);
              
        return view("widgets.neformat", ['xml' => $array['entry']]);
    }
    
}