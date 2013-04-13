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
    if ($t->BannerURL=='') {$t->BannerURL = 'tools/noimg.png';}
    else if (file_exists('tools/' . $t->BannerURL)) {$t->BannerURL = 'tools/' . $t->BannerURL;}
  }
  else {$t->BannerURL = 'tools/noimg.png';}


  //compose the action menue
  $a = '';
  if ($t->HelpURL !== '') {$a=$a."      <li class='hlp'><a href='".$t->UseItURL."'>view help page</a></li>\n";}
  if ($t->ScreencastURL !== '') {$a=$a."      <li class='scr'><a href='".$t->UseItURL."'>view demonstration / screencast</a></li>\n";}
  if ($t->SourcesURL !== '') {$a=$a."      <li class='src'><a href='".$t->UseItURL."'>view sources</a></li>\n";}
  
  
  echo "
<div class='tool' style='background-image: url(" . $t->BannerURL . ");'>
  <h3>".$t->Name ."</h3>
  <p>". $t->ShortDescr ."</p>
</div>
<div class='toolinfo'>
  <div class='screenshot'><img src=".$t->ScreenshotURL." alt='Screenshot' width='380' /> </div>
  <div class='buttons'>
    <ul>
      <li class='use'><a href='".$t->UseItURL."'>use it</a></li>\n"
      . $a . "
    </ul>
  </div>
  <div class='description'>" . $t->LongDescr . "</div>
  <div class='end'></div>
</div>
";
}

?>


<!-- overlay for screenshot display -->
<div id="overlay">
  <div id="overlaycont">
    <img id="overlayimg" src="img/noscr.png" alt=""/>
  </div>
</div>



<!--




<div id="nr2" class="tool">
  <h3>LensToy</h3>
  <p>A gravitational lens simulator in Javascript/HTML5</p>
</div>
<div class="toolinfo">
  <div class='screenshot'>a screenshot</div>
  <div class='buttons'>
    <ul>
      <li class='use'>use it</li>
      <li class='demo'>view demo / help</li>
      <li class='src'>view source code</li>
    </ul>
  </div>
  <div class='description'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
  <div class="end"></div>
</div>

<div id="nr3" class="tool">
  <h3>MOWGLI</h3>
  <p>Manually Operated Widget for Gravitational Lens Identification</p>
</div>
<div class="toolinfo">
  <div class='screenshot'>a screenshot</div>
  <div class='buttons'>
    <ul>
      <li class='use'>use it</li>
      <li class='demo'>view demo / help</li>
      <li class='src'>view source code</li>
    </ul>
  </div>
  <div class='description'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
  <div class="end"></div>
</div>

<div id="nr4" class="tool">
  <h3>LensA</h3>
  <p>Some one line description</p>
</div>
<div class="toolinfo">
  <div class='screenshot'>a screenshot</div>
  <div class='buttons'>
    <ul>
      <li class='use'>use it</li>
      <li class='demo'>view demo / help</li>
      <li class='src'>view source code</li>
    </ul>
  </div>
  <div class='description'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
  <div class="end"></div>
</div>

<div id="nr1" class="tool">
  <h3>SpaghettiLens</h3>
  <p>Some one line description</p>
</div>
<div class="toolinfo">
  <div class='screenshot'>a screenshot</div>
  <div class='buttons'>
    <ul>
      <li class='use'>use it</li>
      <li class='demo'>view demo / help</li>
      <li class='src'>view source code</li>
    </ul>
  </div>
  <div class='description'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
  <div class="end"></div>
</div>

<div id="forum" class="tool forum">
  <h3>Forum</h3>
  <p>Discuss models</p>
</div>
<div class="toolinfo">
  <div class='screenshot'>a screenshot</div>
  <div class='buttons'>
    <ul>
      <li class='use'>use it</li>
      <li class='demo'>view demo / help</li>
      <li class='src'>view source code</li>
    </ul>
  </div>
  <div class='description'>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</div>
  <div class="end"></div>
</div>


-->