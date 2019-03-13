<?php
require dirname(dirname(__DIR__)) . "/include/" . "config.php";
require dirname(dirname(__DIR__)) . "/include/" . "imageutils.php";



function get() {
    
  global $json_encode_props;
  header('Content-Type: application/json');
  handle_version(basename(dirname(__DIR__)));

  $requesturi = $_SERVER['REQUEST_URI'];
  $requesturi = $requesturi ? $requesturi : '/';
  $requesturi = substr($requesturi, -1) == '/' ? $requesturi : $requesturi.'/' ;

  $proto = "http".((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'    )?'s':'' );
  $baselink = $proto.'://'.$_SERVER['HTTP_HOST'].$requesturi;
  $basepath = $requesturi;


  $result = array();
  $calendars = array();
  $calendars['self'] = array(
     'link' => $baselink,
     'path' => $basepath,
     'name' => 'Supported Calendars',
     'description' => 'Get information for supported calendars.'
  );

  $calendars['bulgarian'] = array(
     'link' => $baselink.'bulgarian',
     'path' => $basepath.'bulgarian',
     'name' => 'Ancient Bulgarian Calendar',
     'description' => 'Dates and Model of the Ancient Bulgarian Calendar.'
  );

  $calendars['gregorian'] = array(
     'link' => $baselink.'gregorian',
     'path' => $basepath.'gregorian',
     'name' => 'Gregorian Calendar',
     'description' => ''
  );
  
  $calendars['julian'] = array(
     'link' => $baselink.'julian',
     'path' => $basepath.'julian',
     'name' => 'Julian Calendar',
     'description' => ''
  );
   
  $result['links'] = $calendars; 
       
  echo json_encode($result, $json_encode_props)."\n";

}

function post() {

   global $json_encode_props;
   global $datadir;

   echo json_encode($obj, $json_encode_props)."\n";
      
} 

function put() {
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
}

function delete() {
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET' and 'POST'.");
}

$method = isset($_SERVER["REQUEST_METHOD"]) ? $_SERVER["REQUEST_METHOD"] : "";
if ($method == "GET") {
  get();
} else if ($method == "POST") {
  post();
} else if ($method == "PUT") {
  put();
} else if ($method == "DELETE") {
  delete();
} else {
  $method = $method.replace("\\", "\\\\");
  $method = $method.replace("'", "\\'");
  http_exit(405, "Method '" . $method . "' not allowed. Allowed methods are 'GET', 'POST', 'PUT' and 'DELETE'.");
}   
?>
