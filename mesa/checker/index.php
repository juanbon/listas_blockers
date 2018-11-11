
<?php
	/* Conexion con base de datos. */

// 	$conexion = new PDO('mysql:host=localhost;dbname=friend;charset=UTF8', 'root', '');

  $conexion = new PDO('mysql:host=sql101.eshost.com.ar;dbname=eshos_22364449_listas;charset=UTF8', 'eshos_22364449', 'cocom1ke');


	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$matriz = array(); // En esta matriz almacenaremos los resultados.


	$table="checker";



	if(!empty($_GET['not_blocked'])){


				$consulta = "update checker set not_blocked=1 where fb_id=".$_GET['fb_id'];

				$conexion->query($consulta, PDO::FETCH_ASSOC);

				?>
				<script>

					self.close();

				</script>
				<?php
				exit;

				// header('Location: https://m.facebook.com/profile.php?id='.$_GET['eject']);

	}



	if(!empty($_GET['eject'])){


		    

				$consulta = "update ".$table." set status=1 where fb_id=".$_GET['eject'];

				$conexion->query($consulta, PDO::FETCH_ASSOC);


				header('Location: https://m.facebook.com/profile.php?id='.$_GET['eject']);



	}


 
	/* Se defina la consulta SQL */
	$consulta = "SELECT * FROM ".$table." where status=0 order by id desc limit 6";
 
?>
<meta name="viewport" content="width=1024">
<body>
<?php
	
	/* Cada elemento que sea recuperado de la tabla, se almacena en la matriz. */
	foreach ($conexion->query($consulta, PDO::FETCH_ASSOC) as $item) $matriz[] = $item;

			$g = 0;

			echo "Quedan :".count($matriz)."   - isblocked? ";
			?><div class="enlocal"></div>   <?php
            foreach ($matriz as $key => $value) {
    
              echo '<br><br><a  target="_blank" href="?eject='.$value['fb_id'].'&table='.$table.'"><button class="tocame_'.$g.'" type="button" >Faceboook</button></a><br><br>';

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

