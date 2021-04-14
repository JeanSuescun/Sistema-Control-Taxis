<?php
$this->load->view('header');
?>
<!--<iframe width="800" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-

71.1839,8.5797,-71.1156,8.6255&amp;layer=mapnik" style="border: 1px solid black"></iframe><br /><small>-->
<iframe width="800" height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=-71.2063,8.5619,-71.1379,8.6077&amp;layer=mapnik" style="border: 1px solid black"></iframe>

<!--
<a href="http://www.openstreetmap.org/?lat=8.6026&amp;lon=-71.14975&amp;zoom=100&amp;layers=M">Ver mapa m&#225;s grande</a></small>
-->
<!--<h1>Buscar</h1>
    <div class="search_container">
    <div id="search_field">
    <form action="/" id="search_form" method="get" onsubmit="setSearchViewbox(); new Ajax.Request('/geocoder/search', {asynchronous:true, evalScripts:true, onComplete:function(request){endSearch()}, onLoading:function(request){startSearch()}, parameters:Form.serialize(this)}); return false;">
      <input id="query" name="query" tabindex="1" type="text" value="" />
      <input name="commit" type="submit" value="Ir" />
    </form>

    </div>
    </div>
    <script type="text/javascript">
    function setSearchViewbox() {

    var extent = getMapExtent();

    var minlon = document.createElement("input");
    minlon.type = "hidden";
    minlon.id = "minlon";
    minlon.name = "minlon";
    minlon.value = extent.left;
    $("search_form").appendChild(minlon);

    var minlat = document.createElement("input");
    minlat.type = "hidden";
    minlat.id = "minlat";
    minlat.name = "minlat";
    minlat.value = extent.bottom;
    $("search_form").appendChild(minlat);

    var maxlon = document.createElement("input");
    maxlon.type = "hidden";
    maxlon.id = "maxlon";
    maxlon.name = "maxlon";
    maxlon.value = extent.left;
    $("search_form").appendChild(maxlon);

    var maxlat = document.createElement("input");
    maxlat.type = "hidden";
    maxlat.id = "maxlat";
    maxlat.name = "maxlat";
    maxlat.value = extent.bottom;
    $("search_form").appendChild(maxlat);

  }
   </script>
-->
<?php
$this->load->view('footer');
?>
