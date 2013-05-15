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


  //compose the action menue
  $a = '';
  if (property_exists($t, 'UseItURL') && $t->UseItURL !== '') {$a=$a."      <li class='use'><a href='".$t->UseItURL."'>use it</a></li>\n";}
  if (property_exists($t, 'HomeURL') && $t->HomeURL !== '') {$a=$a."      <li class='home'><a href='".$t->HomeURL."'>visit homepage</a></li>\n";}
  if (property_exists($t, 'HelpURL') && $t->HelpURL !== '') {$a=$a."      <li class='hlp'><a href='".$t->UseItURL."'>view help page</a></li>\n";}
  if (property_exists($t, 'ScreencastURL') && $t->ScreencastURL !== '') {$a=$a."      <li class='scr'><a href='".$t->ScreencastURL."'>view demonstration / screencast</a></li>\n";}
  if (property_exists($t, 'SourcesURL') && $t->SourcesURL !== '') {$a=$a."      <li class='src'><a href='".$t->SourcesURL."'>view sources</a></li>\n";}
  if (property_exists($t, 'PaperURL') && $t->PaperURL !== '') {$a=$a."      <li class='ppr'><a href='".$t->PaperURL."'>view paper</a></li>\n";}

  
  echo "
<div class='tool big article' style='background-image: url(" . $t->BannerURL . ");'>
  <h2>".$t->Name ."</h2>
  <p>". $t->ShortDescr ."</p>
</div>
<div class='toolinfo'>
  <div class='screenshot'>
    <a href='".$t->ScreenshotURL."' rel='lightbox'
      title='click to enlarge'
      data-name='".$t->Name ."'
      data-descr='". $t->ShortDescr ."'>
      <img src='".$t->ScreenshotURL."' alt='". $t->ShortDescr ."' width='380' />
    </a>
  </div>
  <div class='buttons'>
    <ul>\n"
      . $a . "
    </ul>
  </div>
  <div class='description'>" . $t->LongDescr . "</div>
  <div class='end'></div>
</div>
";
}

?>


