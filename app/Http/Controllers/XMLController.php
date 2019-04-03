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
        
        $raw = strip_tags($raw, "<author>,<link>");
        
       dump($raw);
                
       // $xml = simplexml_load_string($raw);
              
        dump($xml);
    }
    
}
