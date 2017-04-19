<form method="post">
<input type="submit" name="update" value="UPDATE">
</form>
<?php
if(isset($_POST['update'])){
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);

$context = stream_context_create($opts);



//$html = file_get_contents("http://www.imdb.com/movies-coming-soon/?ref_=nv_mv_cs_4");
$html = file_get_contents("http://www.imdb.com/movies-coming-soon", false, $context);

	$classname = "overview-top";
    $domdocument = new DOMDocument();
    $domdocument->loadHTML($html);
    $a = new DOMXPath($domdocument);
    $spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
 	$movies = array();
$insertcount=0;

     for ($i=0; $i <=$spans->length-1;   $i++) {
     
         //   $mov[] = $spans->item($i)->nodeValue;

				$image = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'poster')]"); 
		
				$mov['image'] = $image->item($i)->getAttribute('src');
				
				
			  $title = $spans->item($i)->getElementsByTagName('h4'); 
			
				foreach ($title as $p) {
			
					
						$mov['title']=trim($p->nodeValue); 					// return <h4> tag data
						
					} 
			
			  $duration = $spans->item($i)->getElementsByTagName('time'); 
			 
				foreach ($duration as $time) {
			
		
				$mov['Duration']=$time->nodeValue;  					// return <time> tag data
						
					}
					
			  $classp = $spans->item($i)->getElementsByTagName('p'); 
			 
				foreach ($classp as $pp) {
					
						$genre = $pp->getElementsByTagName('span'); 
			 
						foreach ($genre as $gen) {
								if($gen->getAttribute('itemprop')=="genre"){
							$gen_array[]	=	$gen->firstChild->nodeValue; 		// return span tag with itemprop=genre  data
						}
							
						
							}		
							
							
											
					}
					
					
					$mov['genre'] = implode(",",$gen_array);
					$gen_array="";
			  $starcast = $spans->item($i)->getElementsByTagName('span'); 
			 
				foreach ($starcast as $cast) {
								if($cast->getAttribute('itemprop')=="director"){
					$dir_array[] = trim($cast->nodeValue); 						// return span tag with itemprop=director  data
							}
								if($cast->getAttribute('itemprop')=="actors"){
					$act_array[] = trim($cast->nodeValue); 						// return span tag with itemprop=actors  data
							}
							
					}
					$mov['Director'] =implode(",",$dir_array);
					$mov['stars'] = implode(",",$act_array);
					$dir_array = "";
					$act_array = "";
				$desc = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'outline')]"); 
						$mov['Description']=trim($desc->item($i)->nodeValue);			// return class="outline"  data
				
				 $imdb_rating = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'wlb_watchlist_lite')]"); 
				 $mov['imdb_rating']=trim($imdb_rating->item($i)->getAttribute('data-tconst'));			// return class="outline"  data
				 
							


$movies[]=$mov;	
    }
    echo "<pre>";
  //  print_r($movies);
    
$connection = mysqli_connect("localhost","c6heer","ccKcJ0!4","c6heer"); 

   foreach ($movies as $movie){
	   
	   $title = $movie['title'];
	   $Duration = $movie['Duration'];
	   $genre = $movie['genre'];
	   $Director = $movie['Director'];
	   $imdb_rating = $movie['imdb_rating'];
	   $stars = $movie['stars'];
	   $Description = preg_replace('/[^A-Za-z0-9\-]/', ' ',$movie['Description']);
	   $fromimage = $movie['image'];
	   $imagename = time()."-".str_replace(" ","-",$title);
	   $imagepath = "movie_images/".$imagename;
	   $sel ="select `title` from imdb_movies where title='$title'";
	   $sel_query  = mysqli_query($connection,$sel)or die(mysqli_error());
	   $num_rows = mysqli_num_rows($sel_query);
	   if($num_rows<1){
		   
		   copy($fromimage,$imagepath);
		  $insert = "INSERT INTO `imdb_movies`( `title`, `genre`, `director`, `stars`, `description`, `image`, `duration`,`imdb_rating`,`coming`) VALUES('$title','$genre','$Director','$stars','$Description','$imagename','$Duration','$imdb_rating','1')";
		  $ins_query = mysqli_query($connection,$insert)or die(mysqli_error());
		$insertcount++;
		   }
	   
	   
	   }
    
   echo  $insertcount." records inserted";

}

?>

