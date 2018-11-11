
<?php
	/* Conexion con base de datos. */
	$conexion = new PDO('mysql:host=localhost;dbname=cinea;charset=UTF8', 'root', '');
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
	$matriz = array(); // En esta matriz almacenaremos los resultados.



	if(!empty($_GET['eject'])){


		    

				$consulta = "update blocked set status=1 where fb_id=".$_GET['eject'];

				$conexion->query($consulta, PDO::FETCH_ASSOC);


				header('Location: https://m.facebook.com/privacy/touch/block/confirm/?bid='.$_GET['eject'].'&ret_cancel&source=profile&refid=17');



	}


 
	/* Se defina la consulta SQL */
	$consulta = "SELECT * FROM blocked where status=0 order by id desc limit 6";
 
?>
<body>
<?php
	
	/* Cada elemento que sea recuperado de la tabla, se almacena en la matriz. */
	foreach ($conexion->query($consulta, PDO::FETCH_ASSOC) as $item) $matriz[] = $item;

			$g = 0;

			echo "Quedan :".count($matriz);
			?><div class="enlocal"></div>   <?php
            foreach ($matriz as $key => $value) {
    
              echo '<br><br><a  target="_blank" href="?eject='.$value['fb_id'].'"><button class="tocame_'.$g.'" type="button" >Faceboook</button></a><br><br>';

              $g++;

            }



?>

</body>

<script>




function espana(){

	console.log("a ver que pasas");


setTimeout(function(){ 


console.log("verificandoooo");



	if(!window.jQuery)
{
console.log("no hay jquery");

setTimeout(function(){ location.reload(true); }, 5000);

}else{

console.log("jquery esta cargado");

}



}, 6000);

}


espana();

</script>

