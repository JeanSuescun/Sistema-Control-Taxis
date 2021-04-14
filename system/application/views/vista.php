<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es" dir="ltr">
  <head>
  <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0"/>
  <script type='text/javascript'>
i18n_strings = new Array();
i18n_strings['javascripts.site.edit_tooltip'] = 'Edita el mapa';
i18n_strings['javascripts.site.history_tooltip'] = 'Ver ediciones para esta área';
i18n_strings['javascripts.site.edit_zoom_alert'] = 'Debe hacer más zoom para editar el mapa';
i18n_strings['javascripts.site.history_zoom_alert'] = 'Debe hacer más zoom para ver el histórico de ediciones';
i18n_strings['javascripts.site.edit_disabled_tooltip'] = 'Haga zoom para editar el mapa';
i18n_strings['javascripts.site.history_disabled_tooltip'] = 'Haga zoom para ver las ediciones de esta área';
i18n_strings['javascripts.map.overlays.maplint'] = 'Maplint';
i18n_strings['javascripts.map.base.mapnik'] = 'Mapnik';
i18n_strings['javascripts.map.base.noname'] = 'Sin nombres';
i18n_strings['javascripts.map.base.osmarender'] = 'Osmarender';
i18n_strings['javascripts.map.base.cycle_map'] = 'Mapa ciclista';
</script>

  <script src="/javascripts/prototype.js?1313181320" type="text/javascript"></script>
  <script src="/javascripts/site.js?1313181320" type="text/javascript"></script>
  <script src="/javascripts/menu.js?1313181320" type="text/javascript"></script>

  <!--[if lt IE 7]><script src="/javascripts/pngfix.js?1313181320" type="text/javascript"></script><![endif]--> <!-- thanks, microsoft! -->
  <link href="/stylesheets/common.css?1313181320" media="screen" rel="stylesheet" type="text/css" />
  <link href="/stylesheets/ltr.css?1313181320" media="screen" rel="stylesheet" type="text/css" />
  <!--[if IE]><link href="/stylesheets/large.css?1313181320" media="screen" rel="stylesheet" type="text/css" /><![endif]--> <!-- IE is totally broken with CSS media queries -->
  <link href="/stylesheets/small.css?1313181320" media="only screen and (max-width:641px)" rel="stylesheet" type="text/css" />
  <link href="/stylesheets/large.css?1313181320" media="screen and (min-width: 642px)" rel="stylesheet" type="text/css" />
  <link href="/stylesheets/print.css?1313181320" media="print" rel="stylesheet" type="text/css" />
  <link href="/opensearch/osm.xml" rel="search" title="OpenStreetMap Search" type="application/opensearchdescription+xml" />

  <meta content="OpenStreetMap is the free wiki world map." name="description" />
  <style type="text/css">.hidden { display: none }.hide_unless_logged_in { display: none }.hide_unless_administrator { display: none }</style>

  <title>OpenStreetMap</title>
</head>

  <body>
    <div id="small-title">
      <a href="/"><img alt="Logo de OpenStreetMap" border="0" height="16" src="/images/osm_logo.png?1313181320" width="16" /></a>
      <h1>OpenStreetMap</h1>

    </div>
    <div id="content" class="site_index">









<div id="sidebar">
  <table class="sidebar_title" width="100%">
    <tr>
      <td id="sidebar_title"></td>
      <td id="sidebar_close"><a href="javascript:closeSidebar()">Cerrar</a></td>
    </tr>

  </table>
  <div id="sidebar_content">
  </div>
</div>

<script type="text/javascript">
<!--
  var onclose;

  function openSidebar(options) {
    options = options || {};

    if (onclose) {
       onclose();
       onclose = null;
    }

    if (options.title) { $("sidebar_title").innerHTML = options.title; }

    if (options.width) { $("sidebar").style.width = options.width; }
    else { $("sidebar").style.width = "30%"; }

    $("sidebar").style.display = "block";

    resizeMap();

    onclose = options.onclose;
  }

  function closeSidebar() {
    $("sidebar").style.display = "none";

    resizeMap();

    if (onclose) {
       onclose();
       onclose = null;
    }
  }

  function updateSidebar(title, content) {
    $("sidebar_title").innerHTML = title;
    $("sidebar_content").innerHTML = content;
  }
// -->
</script>

<script type="text/javascript">
  function openMapKey() {
    updateMapKey();

    openSidebar({
      title: "Leyenda del mapa",
      onclose: closeMapKey
    });

    map.events.register("zoomend", map, updateMapKey);
    map.events.register("changelayer", map, updateMapKey);
  }

  function closeMapKey() {
    map.events.unregister("zoomend", map, updateMapKey);
    map.events.unregister("changelayer", map, updateMapKey);
  }

  function updateMapKey() {
    var layer = map.baseLayer.keyid;
    var zoom = map.getZoom();

    new Ajax.Updater('sidebar_content', '/key', {asynchronous:true, evalScripts:true, method:'get', parameters:'layer=' + layer + '&zoom=' + zoom})
  }
</script>



<script type="text/javascript">
<!--
  function describeLocation() {
    var args = getArgs($("viewanchor").href);

    new Ajax.Request('/geocoder/description', {asynchronous:true, evalScripts:true, onLoading:function(request){startSearch()}, parameters:'lat=' + args['lat'] + '&lon=' + args['lon'] + '&zoom=' + args['zoom']})
  }

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

  function startSearch() {
    updateSidebar("Resultados de la búsqueda", "");
  }

  function endSearch() {

    $("minlon").remove();
    $("minlat").remove();
    $("maxlon").remove();
    $("maxlat").remove();

  }


// -->

</script>




<noscript>
  <div id="noscript">
    <p>Está usando un navegador que no soporta o tiene desactivado JavaScript</p>
    <p>OpenStreetMap utiliza JavaScript para mostrar su mapa</p>
    <p>Podría intentar el <a href="http://tah.openstreetmap.org/Browse/">navegador de teselas estáticas de Tiles@Home</a> si no es capaz de activar JavaScript.</p>
  </div>
</noscript>

<div id="map">
  <div id="permalink">
    <a href="/" id="permalinkanchor" class="geolink llz layers object">Enlace permanente</a><br/>
    <a href="/" id="shortlinkanchor">Atajo</a>

  </div>
</div>

<iframe id="linkloader" style="display: none">
</iframe>

<div id="attribution">
  <table width="100%">
    <tr>
      <td class="attribution_license">http://creativecommons.org/licenses/by-sa/2.0/</td>
      <td class="attribution_project">http://openstreetmap.org</td>

    </tr>
    <tr>
      <td colspan="2" class="attribution_notice">Bajo la licencia Creative Commons Reconocimiento- Compartir bajo la misma licencia 2.0 a nombre de Proyecto OpenStreetMap y sus colaboradores.</td>
    </tr>
  </table>
</div>



<script src="/openlayers/OpenLayers.js?1313181320" type="text/javascript"></script>

<script src="/openlayers/OpenStreetMap.js?1313181320" type="text/javascript"></script>
<script src="/javascripts/map.js?1313181320" type="text/javascript"></script>

<script type="text/javascript">
  var brokenContentSize = $("content").offsetWidth == 0;

  function resizeContent() {
    var content = $("content");
    var leftMargin = parseInt(getStyle(content, "left"));
    var rightMargin = parseInt(getStyle(content, "right"));
    var bottomMargin = parseInt(getStyle(content, "bottom"));

        content.style.width = document.documentElement.clientWidth - content.offsetLeft - rightMargin;
        content.style.height = document.documentElement.clientHeight - content.offsetTop - bottomMargin;
  }

  function resizeMap() {
    var sidebar_width = $("sidebar").offsetWidth;

    if (sidebar_width > 0) {
      sidebar_width = sidebar_width + 5
    }

        $("map").style.left = (sidebar_width) + "px";
        $("map").style.width = ($("content").offsetWidth - sidebar_width) + "px";
    $("map").style.height = ($("content").offsetHeight - 2) + "px";
  }

  function handleResize() {
    if (brokenContentSize) {
      resizeContent();
    }

    resizeMap();
  }
</script>


<script type="text/javascript">
  var marker;
  var map;

  OpenLayers.Lang.setCode("es");

  function mapInit(){
    map = createMap("map");


      map.dataLayer = new OpenLayers.Layer("Datos", { "visibility": false });
      map.dataLayer.events.register("visibilitychanged", map.dataLayer, toggleData);
      map.addLayer(map.dataLayer);




        var centre = new OpenLayers.LonLat(-71.2389030457, 8.5468222022373);
        var zoom = 15;



        setMapCenter(centre, zoom);


      updateLocation();



      setMapLayers("M");






    map.events.register("moveend", map, updateLocation);
    map.events.register("changelayer", map, updateLocation);

    handleResize();
  }

  function toggleData() {
    if (map.dataLayer.visibility) {
      new Ajax.Request('/browse/start', {asynchronous:true, evalScripts:true})
    } else if (map.dataLayer.active) {
      closeSidebar();
    }
  }

  function getPosition() {
    return getMapCenter();
  }

  function getZoom() {
    return getMapZoom();
  }

  function setPosition(lat, lon, zoom, min_lon, min_lat, max_lon, max_lat) {
    var centre = new OpenLayers.LonLat(lon, lat);

    if (min_lon && min_lat && max_lon && max_lat) {
      var bbox = new OpenLayers.Bounds(min_lon, min_lat, max_lon, max_lat);

      setMapExtent(bbox);
    } else {
      setMapCenter(centre, zoom);
    }

    if (marker)
      removeMarkerFromMap(marker);

    marker = addMarkerToMap(centre, getArrowIcon());
  }

  function updateLocation() {
    var lonlat = getMapCenter();
    var zoom = map.getZoom();
    var layers = getMapLayers();
    var extents = getMapExtent();
    var expiry = new Date();
    var objtype;
    var objid;



    updatelinks(lonlat.lon, lonlat.lat, zoom, layers, extents.left, extents.bottom, extents.right, extents.top, objtype, objid);

    expiry.setYear(expiry.getFullYear() + 10);
    document.cookie = "_osm_location=" + lonlat.lon + "|" + lonlat.lat + "|" + zoom + "|" + layers + "; expires=" + expiry.toGMTString();
  }

  function remoteEditHandler(event) {
    var extent = getMapExtent();
    var loaded = false;

    $("linkloader").observe("load", function () { loaded = true; });
    $("linkloader").src = "http://127.0.0.1:8111/load_and_zoom?left=" + extent.left + "&top=" + extent.top + "&right=" + extent.right + "&bottom=" + extent.bottom;

    setTimeout(function () {
      if (!loaded) alert("Error de edición - asegúrese de que JOSM o Merkaartor están cargados y con la opción de control remoto activada");
    }, 1000);

    event.stop();
  }

  function installEditHandler() {
    $("remoteanchor").observe("click", remoteEditHandler);


  }

  document.observe("dom:loaded", mapInit);
  document.observe("dom:loaded", installEditHandler);
  document.observe("dom:loaded", handleResize);

  Event.observe(window, "resize", function() {
    var centre = map.getCenter();
    var zoom = map.getZoom();

    handleResize();

    map.setCenter(centre, zoom);
  });


</script>

    </div>

    <span id="greeting">


        <a href="/login?referer=%2F" id="loginanchor" title="Identificarse con una cuenta existente">identificarse</a> |
        <a href="/user/new" id="registeranchor" title="Cree una cuenta para editar">registrarse</a>

    </span>

    <div>
      <ul id="tabnav">

        <li><a href="/" class="geolink llz layers active" id="viewanchor" title="Ver el mapa">Ver</a></li>
        <li><a href="/edit" class="geolink llz object minzoom13 disabled" id="editanchor" title="Edita el mapa">Editar&nbsp;&#x25be;</a></li>

        <li><a href="/browse/changesets" class="geolink bbox minzoom11" id="historyanchor" title="Ver ediciones para esta área">Historial</a></li>

        <li><a class="geolink llz layers" href="/export" id="exportanchor" onclick="new Ajax.Request('/export/start', {asynchronous:true, evalScripts:true}); return false;" title="Exportar datos del mapa">Exportar</a></li>

        <li><a href="/traces" class="" id="traceanchor" title="Gestiona las trazas GPS">Trazas GPS</a></li>
        <li><a href="/diary" class="" id="diaryanchor" title="Ver diarios de usuario">Diarios de usuario</a></li>
      </ul>
    </div>

    <div id="editmenu" class="menu">
      <ul>

          <li><a href="/edit?editor=potlatch" class="geolink llz object" id="potlatchanchor">Editar con Potlatch 1 (editor en el navegador)</a></li>

          <li><a href="/edit?editor=potlatch2" class="geolink llz object" id="potlatch2anchor">Editar con Potlatch 2 (editor en el navegador)</a></li>

          <li><a href="/edit?editor=remote" class="geolink llz object" id="remoteanchor">Editar con Control remoto (JOSM o Merkaartor)</a></li>

      </ul>
    </div>

    <script type="text/javascript">
      createMenu("editanchor", "editmenu", 1000, "left");
    </script>

    <div id="left">

      <div id="logo">
        <center>
          <h1>OpenStreetMap</h1>
          <a href="/"><img alt="Logo de OpenStreetMap" border="0" height="120" src="/images/osm_logo.png?1313181320" width="120" /></a><br/>

          <h2 class="nowrap">El WikiMapaMundi libre</h2>
        </center>
      </div>


  <div class="optionalbox">
    <span class="whereami"><a href="javascript:describeLocation()" title="Describe la ubicación actual por medio del motor de búsqueda">¿Dónde estoy?</a></span>
    <h1>Buscar</h1>
    <div class="search_container">

    <div id="search_field">
    <form action="/" id="search_form" method="get" onsubmit="setSearchViewbox(); new Ajax.Request('/geocoder/search', {asynchronous:true, evalScripts:true, onComplete:function(request){endSearch()}, onLoading:function(request){startSearch()}, parameters:Form.serialize(this)}); return false;">
      <input id="query" name="query" tabindex="1" type="text" value="" />
      <input name="commit" type="submit" value="Ir" />
    </form>
    </div>
    </div>
    <p class="search_help">
      ejemplos: 'Soria', 'Calle Mayor, Lugo',  'CB2 5AQ', o 'post offices near Lünen' <a href='http://wiki.openstreetmap.org/wiki/Search'>más ejemplos...</a>

    </p>
  </div>



      <div id="intro">
        <p>
          OpenStreetMap es un mapa libremente editable de todo el mundo. Está hecho por personas como usted.
        </p>
        <p>
          OpenStreetMap te permite ver, editar y usar información geográfica de manera colaborativa desde cualquier lugar del mundo.
        </p>

        <p>
        El alojamiento de OpenStreetMap es amablemente proporcionado por <a href="http://www.vr.ucl.ac.uk">the UCL VR Centre</a>, <a href="http://www.imperial.ac.uk/">Imperial College London</a> y <a href="http://www.bytemark.co.uk">Bytemark Hosting</a>. Otros patrocinadores del proyecto se encuentran listados en el <a href="http://wiki.openstreetmap.org/wiki/Partners">wiki</a>.
        </p>
      </div>






      <div id="left_menu" class="left_menu">

        <ul>
          <li><a href="http://help.openstreetmap.org/" title="Sitio de ayuda para el proyecto">Centro de ayuda</a></li>
          <li><a href="http://wiki.openstreetmap.org/" title="Documentación del proyecto">Documentación</a></li>
          <li><a href="/copyright">Copyright y licencia</a></li>
          <li><a href="http://blogs.openstreetmap.org/" title="Blogs de miembros de la comunidad de OpenStreetMap">Blogs de la comunidad</a></li>
          <li><a href="http://www.osmfoundation.org" title="La Fundación OpenStreetMap">Fundación</a></li>


  <li><a href="#" onclick="openMapKey(); return false;" title="Leyenda del mapa">Leyenda del mapa</a></li>

        </ul>
      </div>

      <div id="sotm">
        <a href="http://stateofthemap.org/register-now/"><img alt="¡Ven a la Conferencia de OpenStreetMap 2011, El Estado del Mapa, del 09 al 11 de septiembre en Denver!" border="0" src="/images/sotm.png?1313181320" title="¡Ven a la Conferencia de OpenStreetMap 2011, El Estado del Mapa, del 09 al 11 de septiembre en Denver!" /></a>
      </div>

      <center>

        <div class="donate">
          <a href="http://donate.openstreetmap.org/" title="Apoye a OpenStreetMap con una donación monetaria">Hacer una donación</a>
        </div>
      </center>
    </div>
  </body>
</html>
