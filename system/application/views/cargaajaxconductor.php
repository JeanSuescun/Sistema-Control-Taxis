<option  value="0">-- SELECCIONE --</option>
<?php foreach($conductores as $item){
			echo "<option  value=".$item->cedula.">".$item->nombre."</option>";
			 //echo "<option  value=".$item->codigo_circuito.">".$item->codigo_circuito."</option>";
      }
?>
