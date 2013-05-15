
<div class="article">
  <h2>Image / Lens ID: <?php echo $_GET['id']; ?></h2>
  <img src='http://www.spacewarps.org/subjects/standard/CFHTLS_082_0176_gri.png'/>
  <p>some infos about this image if availbable??</p>
  <p>start discussing this image on the forums or modelling it with one of these tools:</p>
</div>


<div class='tool small' style='background-image: url("tools/forum.png");'>
  <h2>Forum</h2>
  <p>Discuss this image on the forum</p>
  <p>there are X comments and Y posts.</p>
  <p>a click leads to http://talk.spacewarps.org/#/subjects/<?php echo $_GET['id']; ?></p>
</div>


<?php
/**
 * Clean comments of json content and decode it with json_decode().
 * Work like the original php json_decode() function with the same params
 *
 * http://php.net/manual/en/function.json-decode.php
 * 
 * @param   string  $json    The json string being decoded
 * @param   bool    $assoc   When TRUE, returned objects will be converted into associative arrays.
 * @param   integer $depth   User specified recursion depth. (>=5.3)
 * @param   integer $options Bitmask of JSON decode options. (>=5.4)
 * @return  string
 */
function json_clean_decode($json, $assoc = false, $depth = 512, $options = 0) {

  // search and remove comments like /* */ and //
  $json = preg_replace("#(/\*([^*]|[\r\n]|(\*+([^*/]|[\r\n])))*\*+/)|([\s\t](//).*)#", '', $json);

  // replace whitespace inside an argument with <br/>
  //$json = preg_replace('/(".*".*".*)(\v)/i', '$1<br>', $json);
  
  if(version_compare(phpversion(), '5.4.0', '>=')) {
    $json = json_decode($json, $assoc, $depth, $options);
  }
  elseif(version_compare(phpversion(), '5.3.0', '>=')) {
    $json = json_decode($json, $assoc, $depth);
  }
  else {
    $json = json_decode($json, $assoc);
  }


  return $json;
}


/**
 * reads the /tools/ folder and creates a tools entry for each *.json file
 */

$dir = "./tools/*.json"; // dir to the tools json files
$files = glob($dir);

//echo var_dump($files) . '<br/>';

foreach($files as $file)
{
  
  $t = json_clean_decode(file_get_contents($file));
  //echo var_dump($t) . '<br/>';
  if (property_exists($t, 'ScreenshotURL')) {
    if ($t->ScreenshotURL=='') {$t->ScreenshotURL = 'tools/noscr.png';}
    else if (file_exists('tools/' . $t->ScreenshotURL)) {$t->ScreenshotURL = 'tools/' . $t->ScreenshotURL;}
  }
  else {$t->ScreenshotURL = 'tools/noscr.png';}


  if (property_exists($t, 'BannerURL')) {
    if ($t->BannerURL=='') {$t->BannerURL = 'tools/nobnr.png';}
    else if (file_exists('tools/' . $t->BannerURL)) {$t->BannerURL = 'tools/' . $t->BannerURL;}
  }
  else {$t->BannerURL = 'tools/noimg.png';}
  
  if (property_exists($t, 'DirectUseURL')) {
    if ($t->DirectUseURL=='') {$t->DirectUseURL = 'http://www.google.com/';}
  }

  echo "
  <div class='tool small' style='background-image: url(" . $t->BannerURL . ");'>
    <h2>".$t->Name ."</h2>
    <p>". $t->ShortDescr ."</p>
  </div>
";
}

?>


