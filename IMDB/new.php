www.m4s.com'; 
$header[] = 'Referer: http://www.m4s.com/mobile/';
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl,CURLOPT_USERAGENT,$browser);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_REFERER, 'http://www.m4s.com/mobile');
curl_setopt($curl, CURLOPT_POST, 1); 
curl_setopt($curl, CURLOPT_POSTFIELDS, $_POST); 
curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
curl_setopt($curl, CURLOPT_TIMEOUT, 10);
$cnt = curl_exec($curl);
curl_close($curl);
return $cnt;
}

?>

$content=str_replace("www.m4s.com",$_SERVER['HTTP_HOST'],$content);

preg_match('#(.*?)#si',$content,$title);
if(!empty($title[1]))
echo ''.$title[1].' ';

 $content=curl_get($url);
