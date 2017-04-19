<form method="post">
<table>
<tr>
<td>
<select name="count">
<option value="25">Update First 25 Records</option>
<option value="50">Update  26-50 Records</option>
<option value="75">Update  50-75 Records</option>
<option value="99">Update  76-100 Records</option>
<option value="125">Update  101-125 Records</option>
<option value="150">Update  126-150 Records</option>
<option value="175">Update  151-175 Records</option>
<option value="199">Update  176-200 Records</option>
<option value="249">Update  201-250 Records</option>
</select>
</td><td>
<input type="submit" name="select" value="Update">
</td></tr>
</table>

</form>


<?php
if(isset($_POST['select'])){
	$end = $_POST['count'];
	$start=$_POST['count']-25;

$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);
$html = file_get_contents("http://www.imdb.com/chart/top?ref_=nv_mv_250_6",false, $context);

	$classname = "titleColumn";
    $domdocument = new DOMDocument();
    $domdocument->loadHTML($html);
    $a = new DOMXPath($domdocument);
    $spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
	$result = array();
  // for ($i=0; $i <=$spans->length-1;   $i++) {
  
  $insertcount=0;
     for ($i=$start; $i <=$end;   $i++) {
    

						
						 $anchor =$spans->item($i)->getElementsByTagName('a');					
								 foreach ($anchor as $anc) {
 
							 $link = $anc->getAttribute('href'); 	// return span tag with itemprop=genre  data
							 $res['title']=$anc->nodeValue; 	// return span tag with itemprop=genre  data
							 
$internal = file_get_contents("http://www.imdb.com/".$link,false, $context);
$internaldomdocument = new DOMDocument();
$internaldomdocument->loadHTML($internal);
$internalquery = new DOMXPath($internaldomdocument);


$subtext = $internalquery->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'subtext')]");

 $duration =$subtext->item(0)->getElementsByTagName('time');					
						foreach($duration as $time){
							 $res['duration']=trim($time->nodeValue);
							}
							
 $genres =$subtext->item(0)->getElementsByTagName('span');					
						foreach($genres as $genre){
							if($genre->getAttribute('itemprop')=="genre"){
							 $genre_array[]=trim($genre->nodeValue);
								}
							}
							$res['genre']=implode(",",$genre_array);
							$genre_array="";
$internaltags = $internalquery->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'summary_text')]");



		$res['description'] = trim($internaltags->item(0)->nodeValue);
		
$newstars = $internalquery->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'credit_summary_item')]");
 $directors =$newstars->item(0)->getElementsByTagName('span');
		foreach($directors as $director){
			if($director->getAttribute('itemprop')=="name"){
				$director_array[]=$director->nodeValue;
				}
			}
			$res['director'] =implode(",",$director_array);
			$director_array="";

 $writers =$newstars->item(1)->getElementsByTagName('span');
		foreach($writers as $writer){
			if($writer->getAttribute('itemprop')=="name"){
				$writer_array[]=$writer->nodeValue;
				}
			}
			$res['writer'] =implode(",",$writer_array);
			$writer_array="";
			
 $actors =$newstars->item(2)->getElementsByTagName('span');
		foreach($actors as $actor){
			if($actor->getAttribute('itemprop')=="name"){
				$actor_array[]=$actor->nodeValue;
				}
			}
			$res['actors'] =implode(",",$actor_array);
			$actor_array="";

		}
 $show_image = $internalquery->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'poster')]");
 $images =$show_image->item(0)->getElementsByTagName('img');
	foreach($images as $img){
		$res['image']=$img->getAttribute('src');
		}
				 $imdbRating = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'wlb_ribbon')]"); 
				 $res['imdbRating']=trim($imdbRating->item($i)->getAttribute('data-tconst'));								// return class="outline"  data

$result[]=$res;

 }

    echo "<pre>";

 $connection = mysqli_connect("localhost","c6heer","ccKcJ0!4","c6heer"); 
//echo count($result);
  //~ print_r($result);
//~ die;
    foreach ($result as $movie){
	
		$title = $movie['title'];
		$image = $movie['image'];
		$director = $movie['director'];
		$writer = $movie['writer'];
		$duration = $movie['duration'];
		$star = $movie['actors'];
		$genre = $movie['genre'];
		$imdbRating = $movie['imdbRating'];
		$description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$movie['description']);
		
		
		$filename = time()."-".str_replace(" ","-",$title);

			$filepath = "movie_images/".$filename;
	 	  $sel = 'select title from  `imdb_movies` where title="'.$title.'"';
	
		$sel_query = mysqli_query($connection,$sel) or die(mysqli_error());
	  	$rows = mysqli_num_rows($sel_query);
	 	

		if($rows<1){
			 copy($image,$filepath);
 	 $insert = 	'INSERT INTO `imdb_movies`(`title`, `genre`, `director`, `stars`, `description`, `image`, `duration`,`writer`, `top`) VALUES ("'.$title.'","'.$genre.'","'.$director.'","'.$star.'","'.$description.'","'.$filename.'","'.$duration.'","'.$writer.'","1")';
		$query= mysqli_query($connection,$insert)or die(mysqli_error());
		$insertcount++;	 	

	}
		 
	
		}
		
echo $insertcount." records inserted";		
}		
?>


