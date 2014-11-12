<?php
/**
 * Created by PhpStorm.
 * User: IErshov
 * Date: 06.11.2014
 * Time: 17:26
 */
header('Content-Type: text/plain; charset=utf-8');

/* DEBUG
------------------------------------------------------------------- */
if(isset($_GET['test']))
{
    define(DEBUG, true);
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}
else  {define(DEBUG, false);}


/* CONFIG
------------------------------------------------------------------- */
require('../config/api.config.php');
require('../lib/post.php');

$key='mfpa';
$config=getConfig($key);
// extract($config, EXTR_OVERWRITE);

$username = $config['username'];
$password = $config['secret'];
$env = 'suite7';

/* Prepare
------------------------------------------------------------------- */
$uri = "contact/getdata";

/*$list= file('../config/list3.txt', FILE_IGNORE_NEW_LINES);
//print_r($list);
/**/

$list=array("a_s_w_4@mail.ru", "irishapo@gmail.com");
print_r($list);
/**/

$params = array("keyId" => "3", "keyValues" => $list, "fields"=>array("1","2","3","31"));
$data_string = json_encode($params);

/* Action
------------------------------------------------------------------- */
$resp=emarsys_post($username, $password, $env, $uri, $data_string);

if(!empty($resp->data->errors))
{
    print "Errors:\n";
    print_r($resp->data->errors);
}

print_r($resp->data->result);

/* Разбор по id;email
 * ------------------------------------------------- */
/*
$res=$resp->data->result;
$i=0;
foreach($res as $row)
{
    print $row->id;
    print ";";
    print $row->{'3'};
    print "\n";
    $i++;
//    if($i>10) break;
}


/**/
