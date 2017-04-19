<?php
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);
$date = date("m-d");
$html = file_get_contents("http://www.imdb.com/search/name?birth_monthday=".$date."&refine=birth_monthday&ref_=nv_cel_brn_1",false, $context);

	$classname = "detailed";
    $domdocument = new DOMDocument();
    $domdocument->loadHTML($html);
    $a = new DOMXPath($domdocument);
    $spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
	$result = array();

   for ($i=0; $i <=$spans->length-1;   $i++) {
    // for ($i=0; $i <=5;   $i++) {
    
      //$result[] = $spans->item($i)->nodeValue;

				$number = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'number')]"); 
				$res['number']=$number->item($i)->nodeValue;								// return class="outline"  data
	

							
						$image =$spans->item($i)->getElementsByTagName('img');					// return class="outline"  data
								foreach ($image as $img) {

							$res['image']=$img->getAttribute('src'); 	// return span tag with itemprop=genre  data
							$res['name']=$img->getAttribute('title'); 	// return span tag with itemprop=genre  data
							
								}

				$description = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'description')]"); 
				$res['profession']=$description->item($i)->firstChild->nodeValue;								// return class="outline"  data

				$bio = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'bio')]"); 
				$res['bio']=$bio->item($i)->firstChild->nodeValue;		
									
$result[]=$res;

 }

    echo "<pre>";
  //  print_r($result);
 $connection = mysqli_connect("localhost","c6heer","ccKcJ0!4","c6heer"); 
//echo count($result);
//print_r($result);

    foreach ($result as $born){
	
		$name = $born['name'];
		$image = $born['image'];
		$profession = str_replace(", ","",$born['profession']);
		$bio = preg_replace('/[^A-Za-z0-9\-]/', ' ',$born['bio']);
		
		
		$filename = time()."-".str_replace(" ","-",$name);

			$filepath = "star_images/".$filename;
	 	  $sel = 'select name from  `imdb_stars` where name="'.$name.'"';
	// echo "<br>";
		$sel_query = mysqli_query($connection,$sel) or die(mysqli_error());
	  	$rows = mysqli_num_rows($sel_query);
	 	 echo "<br>";

		if($rows<1){
			 copy($image,$filepath);
echo 	 $insert = 	'INSERT INTO `imdb_stars`(`name`, `profession`, `bio`,`image`) VALUES ("'.$name.'","'.$profession.'","'.$bio.'","'.$filename.'")';
		$query= mysqli_query($connection,$insert)or die(mysqli_error());
	}
		 
	
		}
		
?>


