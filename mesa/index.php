
<?php

	/* Conexion con base de datos. */
 $conexion = new PDO('mysql:host=sql101.eshost.com.ar;dbname=eshos_22364449_listas;charset=UTF8', 'eshos_22364449', 'cocom1ke');
//  $conexion = new PDO('mysql:host=localhost;dbname=listas;charset=UTF8', 'root', '');

	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 

/*


		$cuentas2 = "SELECT * FROM friends";

		foreach ($conexion->query($cuentas2, PDO::FETCH_ASSOC) as $item5) $resultados5[] = $item5;

		foreach ($resultados5 as $key => $value) {

		$posicion_coincidencia = strpos($value['fb_id'], "profile.php?id");
		if ($posicion_coincidencia === false) {
		//  echo "NO se ha encontrado la palabra deseada!!!!";
		} else {

		$r =explode("/profile.php?id=", $value['fb_id']);


		echo "update friends set fb_id='".$r[1]."' where id=".$value['id'].";</br>"; 
		//            exit;
		}

		}

		exit;

*/


	$matriz = array(); // En esta matriz almacenaremos los resultados.

?>
<style>
td:nth-child(5) {
 text-align: center;
}

td:first-child { width: 50px;
    text-align: left;
    margin-right: 54px; }; 

    td:last-child { 
    text-align: center; }; 
    a{text-decoration: none;
}
.lastrain{text-align: center}

.item_row{
	height:30px !important;}
</style>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

<script>

$(document).ready(function(){

$(".migo").change(function() {

	if($(".migo").val()!=""){

		window.location.href = "?type=ver_migos&myFb="+$(".migo").val();

	}

});


$(".ver_ref").change(function() {

	if($(".ver_ref").val()!=""){

		window.location.href = "?type=ver_migos&myFb="+$(".migo").val()+"&refe="+$(".ver_ref").val();

	}else{



		window.location.href = "?type=ver_migos&myFb="+$(".migo").val();
	}

});


});
</script>	

<?php


if(!empty($_GET)){



if(!empty($_GET['type'])  && ($_GET['type']=="setearcuenta") ){

		$consulta = "update account set last_view='".date("Y-m-d H:i:s")."' where id='".$_GET['cuenta']."'";

		$conexion->query($consulta, PDO::FETCH_ASSOC);


			header("Location: ?type=control");


exit;
}	

// 


if(!empty($_GET['type'])  && ($_GET['type']=="setearcuentaahuevo") ){

		$consulta = "update account set last_view=NULL where id='".$_GET['cuenta']."'";

		$conexion->query($consulta, PDO::FETCH_ASSOC);


			header("Location: ?type=control");


exit;
}






if(!empty($_GET['type'])  && ($_GET['type']=="control") ){

	?>
	<meta content='width=device-width, initial-scale=1' name='viewport'/>
	<?php


		$consulta = "select * from account";

	    foreach ($conexion->query($consulta, PDO::FETCH_ASSOC) as $item88) $ffri88[] = $item88;


goto a;
/*

for ($i=0; $i < 5 ; $i++) {  ?>
	<div class="viaje1" >juann <?php echo $i?></div>
	<div class="viaje2" style="clear:both"><button value="Setear" /></div>
	<div class="viaje3" style="margin-bottom: 20px"></div>
	<?php

*/


}




/*
echo "<pre>";
var_dump($ffri88);
echo "</pre>";
*/
//		exit;


}



if(!empty($_GET['favorito'])){



		$consulta = "update friends set favorito='1' where fb_id='".$_GET['favorito']."' OR fb_id='".$_GET['favorito2']."'";

		$conexion->query($consulta, PDO::FETCH_ASSOC);

		exit;


}




if( (!empty($_GET['visit_user']))AND(!empty($_GET['user_id'])) ){

	$consulta2 = " update friends set visto=visto+1 where id=".$_GET['user_id'];

	$conexion->query($consulta2, PDO::FETCH_ASSOC);

	header("Location: https://m.facebook.com".$_GET['visit_user']);

	die();



}




if(!empty($_GET['action'])){



		$consulta = "update friends set status='1' where id='".$_GET['id']."'";

		$conexion->query($consulta, PDO::FETCH_ASSOC);

		header('Location: ?type=ver_migos&myFb='.$_GET['myfb']);
		exit;


}



if(!empty($_GET['type_action'])){

	if($_GET['type_action']=='guardar_paja'){

	$consulta2 = " select fb_id from friends where my_user=".$_GET['my_fbid'];

	foreach ($conexion->query($consulta2, PDO::FETCH_ASSOC) as $item2) $ffri[] = $item2['fb_id'];


 	$ral = json_decode($_GET['data_json']);


	foreach ($ral as $key => $value) {


			if (!in_array((string)$value[2], $ffri)) {

			$consulta = "insert into friends (fb_id,friends,my_user,status,name,referencia) values ('".$value[2]."','".trim($value[0])."','".$_GET['my_fbid']."',0,'".$value[1]."','".trim($_GET['referencia'])."')";


			$conexion->query($consulta, PDO::FETCH_ASSOC);

		}

}

	echo json_encode(array("status"=>"ok"));

	exit;

 // header("Location: ?type=ver_listas");

}

}










if(!empty($_POST)){


if($_POST['type_action']=='register_lugar'){


	$consulta = "insert into lugar (name) values ('".$_POST['createlugar']."')";
	$conexion->query($consulta, PDO::FETCH_ASSOC);

 header("Location: ?type=ver_listas");

}


$f = explode(" ",$_POST['listas']);


//   hacer trim


foreach ($f as $key => $value) {

	$parts = parse_url(trim($value));
	parse_str($parts['query'], $query);


	if($query['ft_ent_identifier']!='events'){

		$consulta = "insert into lista (name,id_account,status,id_lugar) values ('".trim($value)."','".$_POST['account']."','0','".$_POST['lugar']."')";

		$conexion->query($consulta, PDO::FETCH_ASSOC);

	}

}


//  redirect  exit; 



}





	if(!empty($_GET['eject'])){


		    

				$consulta = "update blocked set status=1 where fb_id=".$_GET['eject'];

				$conexion->query($consulta, PDO::FETCH_ASSOC);




				header('Location: https://m.facebook.com/privacy/touch/block/confirm/?bid='.$_GET['eject'].'&ret_cancel&source=profile&refid=17');



	}

a:

?>

<a href="?type=listado"><button> Cargar Listas</button></a>
<a  href="?type=create_lugar"><button> Crear Lugar</button></a>
<a href="?type=ver_listas"><button> Ver listado</button></a>
</br>
<a href="?type=ver_migos"><button style="margin-top:  7px;"> Ver Amigos</button></a>
<a href="?type=control"><button style="margin-top:  7px;"> Control</button></a>
</br>
</br>
</br>

<style>
.viaje1 {
    font-size: 32px;
    text-align: center;
}

.viaje5 {
    font-size: 24px;
    width: 100%;
    height: 6%;
    text-align: center;
}
.viaje3 {
    padding-bottom: 50px;
     text-align: center;
}

</style>

<?php

// a:
if(!empty($_GET['type'])  && ($_GET['type']=="control") ){


foreach ($ffri88 as $key44 => $value44) { ?>
	<div class="viaje1" > <?php echo $value44['account']; ?></div>
	<div class="viaje1" >

	<?php

	$dias = "Inactivo";

	if(!empty($value44['last_view'])){

		$now 		= time(); 
		$your_date 	= strtotime($value44['last_view']);
		$datediff 	= $now - $your_date;
		$dias 		= round($datediff / (60 * 60 * 24));
		
		$dias= $dias." dias";

	}

	echo $dias;
	?> </div>
	<div class="viaje2" style="clear:both"><button onclick="mandar(<?php echo $value44['id']; ?>)" class="viaje5"  />Setear (to 1000)</button></div>
	<div class="viaje2" style="clear:both;margin-top: 7px"><button onclick="ahuevo(<?php echo $value44['id']; ?>)" class="viaje5"  />Inicializar</button></div>
	<div class="viaje3" style="margin-bottom: 20px"></div>
	<?php

}

?>
<script>

	function mandar(w){

		var txt;

		var r = confirm("Confirma Setear?");

		if (r == true) {
		window.location.href = "?type=setearcuenta&cuenta="+w;

		}

	}


	function ahuevo(w){

		var txt;

		var r = confirm("Confirma Setear?");

		if (r == true) {
		window.location.href = "?type=setearcuentaahuevo&cuenta="+w;

		}

	}

</script>

<?php




exit;

	}


if(!empty($_GET)){


if((!empty($_GET['type']))AND($_GET['type']="ver_migos")){ 




//Limito la busqueda
$TAMANO_PAGINA = 30;

//examino la página a mostrar y el inicio del registro a mostrar
$pagina = (!empty($_GET["pagina"]))?$_GET["pagina"]:null;
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}else {
   $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}
//calculo el total de páginas


	$mfb = (!empty($_GET['myFb']))?$_GET['myFb']:3;

	$cuentas99 = "SELECT referencia FROM friends  where my_user=".$mfb." and referencia IS NOT NULL GROUP BY referencia";

	foreach ($conexion->query($cuentas99, PDO::FETCH_ASSOC) as $item99) $resultados99[] = $item99;


	//  var_dump($resultados99); exit; 



	$mat = array("1"=>"Juann Manuel","2"=>"Juan Manuell","3"=>"Juan Bouni","5"=>"Ian Manuel","6"=>"Juan Bon");

	echo "Seleccionar : <br>";

//	$myFb = (!empty($_GET['myFb']))?$_GET['myFb']:3;




	echo "<div style='float: left;'><select class='migo' style='position: relative;top: -19px;left: 92px;' name='migo'>";
        foreach ($mat as $key77 => $value77) {

        	$sele = ($mfb==$key77)?'selected':'';

          echo '<option '.$sele.' value="'.$key77.'">'.$value77.'</option>';
        }
	echo "</select></div><div style='top: -20px;float: left;position: relative;left: 150px;' class='tengas'> Referencia";





	echo "<div style='top: -20px;position: relative;left: 81px;'><select class='ver_ref'  name='ver_ref'><option value=''> Seleccionar </div>";

        foreach ($resultados99 as $key99 => $value99) {

        	$sele = "";

        	if(!empty($_GET['refe'])){

        		$sele = ($value99['referencia']==$_GET['refe'])?'selected':'';
        	
        	}

          echo '<option '.$sele.' value="'.$value99['referencia'].'">'.$value99['referencia'].'</option>';
        }

	echo "</select></div>";

echo "</div>";


echo "<br><br>";





	// cast(registration_no as unsigned)  convert(`proc`, decimal)

	if(!empty($_GET['refe'])){

		$vw= " AND referencia LIKE '%".$_GET['refe']."%' ";

	}

	$tijuana = (!empty($_GET['refe']))?$vw:"";





	$cuentas = "SELECT * FROM friends f where f.my_user=".$mfb." AND f.status=0 ".$tijuana." order by convert(f.friends,decimal) DESC  LIMIT ".$inicio."," .$TAMANO_PAGINA;






	foreach ($conexion->query($cuentas, PDO::FETCH_ASSOC) as $item) $resultados[] = $item;


	// paginado	

	$cuentas2 = "SELECT * FROM friends f where f.my_user=".$mfb." AND f.status=0  ".$tijuana." order by convert(f.friends,decimal) DESC";

	foreach ($conexion->query($cuentas2, PDO::FETCH_ASSOC) as $item5) $resultados5[] = $item5;



$total_paginas = ceil(count($resultados5) / $TAMANO_PAGINA);








// var_dump($resultados,$cuentas);  exit; 


if(!empty($resultados)){

	
echo "Cantidad : ".count($resultados5)."</br></br>";

?>


<table><thead align="left" style="display: table-header-group"><tr>
				<th>Id</th>
                <th>Nombre</th>
                <th>Comun</th>
                <th style="width: 200px;text-align:  center;">Refer</th>
                <th style="width: 60px;text-align: center;">Visto</th>
                <th style="width: 60px;text-align: center;">Favorito</th>
                <th>Eliminar</th>
</tr>
<tbody>
<?php foreach ($resultados as $rows){?>
    <tr class="item_row" style="height:30px">
   
            <td><?php echo $rows['id']; ?></td>

<?php

$vv =  (is_numeric($rows['fb_id']))?"/profile.php?id=".$rows['fb_id']:$rows['fb_id']; 

?>


		<td><a target="_blank" href="?visit_user=<?php echo $vv; ?>&user_id=<?php echo $rows['id'];?>"><?php echo $rows['name']; ?></a></td>
         <td><?php echo $rows['friends']; ?></td>
         <td><?php echo $rows['referencia']; ?></td>
         <td><?php echo $rows['visto']; ?></td>
         <td><?php echo ($rows['favorito']=="1")?"<img width='18' heigth='18' style='margin-left: 23px;' src='/img/ok.png'>":""; ?></td>
         <td class="lastrain"><a href="?action=eliminar&id=<?php echo $rows['id']; ?>&myfb=<?php echo $_GET['myFb']?>" style="text-decoration: none;" class="sefue" data-seva="<?php echo $rows['id']; ?>"><span style="font-weight: bold;color:red;text-align: right;"> X </span></td>
         

         
    </tr>
<?php } ?>
</tbody>
</table>
<div style="height:40px"></div>
<div style="clear:both;width:150px"></div><div style="margin-left: 80px;margin-bottom: 60px;float:left">
<?php


//  (!empty($_GET['refe']))?$vw:"";

$mikol = (!empty($_GET['refe']))?"&refe=".$_GET['refe']:"";


if ($total_paginas > 1) {
   if ($pagina != 1)
      echo '<a style="margin-right: 20px;" href="?type=ver_migos&myFb='.$_GET['myFb'].'&pagina='.($pagina-1).$mikol.'"> <- </a>';
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            //si muestro el índice de la página actual, no coloco enlace
            echo $pagina;
         else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '  <a     style="margin-right: 5px;margin-left:5px" href="?type=ver_migos&myFb='.$_GET['myFb'].'&pagina='.$i.$mikol.'">'.$i.'</a>  ';
      }
      if ($pagina != $total_paginas)
         echo '<a style="margin-left: 20px;" href="?type=ver_migos&myFb='.$_GET['myFb'].'&pagina='.($pagina+1).$mikol.'"> -> </a>';
}

?>

</div>

<?php



}

exit;

}









if(!empty($_GET['visitpage'])){



/*

		$consulta = "update lista set status=1 where id=".$_GET['visitpage'];

		$conexion->query($consulta, PDO::FETCH_ASSOC);

*/




		$cuentas = "SELECT * FROM lista where id=".$_GET['visitpage'];

	    foreach ($conexion->query($cuentas, PDO::FETCH_ASSOC) as $item) $matriz[] = $item;


		header('Location: '.$matriz[0]['name']);

}




if($_GET['type']=="create_lugar"){

?>
<form action="?type=create_lugar" name="registro_lugar" method="POST">

</br>
Lugar: 
<input type="text" name="createlugar" value="" >
<input type="hidden" name="type_action" value="register_lugar" >
</br>
</br>
<input type="submit" name="Enviar" value="Registrar">
</form>


<?php
exit;

 	}


if($_GET['type']=="ver_listas"){



?>



<form action="" method="POST">

</br>
Usuario: 
	<?php

	$cuentas = "SELECT * FROM account";

	foreach ($conexion->query($cuentas, PDO::FETCH_ASSOC) as $item) $matriz[] = $item;

// echo "<pre>"; var_dump($matriz); echo "</pre>";exit; 

	echo "<select class='cuenta'  name='account'>";
        foreach ($matriz as $key => $value) {

        	$sele = ($_GET['cuenta']==$value['id'])?'selected':'';


          echo '<option '.$sele.' value="'.$value['id'].'">'.$value['account'].'</option>';
        }
	echo "</select>";

?>
</br>
</br>
Lugar: 
	<?php

	$cuentas2 = "SELECT * FROM lugar";

	foreach ($conexion->query($cuentas2, PDO::FETCH_ASSOC) as $item) $matriz2[] = $item;

// echo "<pre>"; var_dump($matriz); echo "</pre>";exit; 

	echo "<select class='lugar' name='lugar'>";
	echo  "<option value='' selected >Seleccionar</option>";
        foreach ($matriz2 as $key2 => $value2) {




        	$sele = ($_GET['lugar']==$value2['id'])?'selected':'';


          echo '<option '.$sele.' value="'.$value2['id'].'">'.$value2['name'].'</option>';
        }
	echo "</select>";

?>
</br>
</br>
</form>


<?php














if((!empty($_GET['cuenta']))AND($_GET['lugar'])){ 


	$cuentas = "SELECT * FROM lista where id_account=".$_GET['cuenta']." AND id_lugar=".$_GET['lugar']." AND status=0";

	foreach ($conexion->query($cuentas, PDO::FETCH_ASSOC) as $item) $resultados[] = $item;


}



if(!empty($resultados)){

	
echo "cantidad : ".count($resultados)."</br>";

?>


<table><thead align="left" style="display: table-header-group"><tr><th>
    <table><tr> <td>id</td>
                <td>Evento</td>
    </tr></table>
</th></tr></thead>
<tbody>
<?php foreach ($resultados as $rows){?>
    <tr class="item_row">
   
            <td><?php echo $rows['id']; ?></td>
            <td><a target="_blank" href="?visitpage=<?php echo $rows['id']; ?>">Evento <?php echo $rows['id']; ?></td>
         
    </tr>
<?php } ?>
</tbody>
</table>

<?php






}


	exit;

}





}



 
	/* Se defina la consulta SQL */
	// $consulta = "SELECT * FROM blocked where status=0 limit 10";


	echo "Ingresar Listas de eventos: </br></br>";

	?>
<form action="" method="POST">
 <textarea rows="8" cols="35" name="listas">

</textarea> 
</br>
Usuario: 
	<?php

	$cuentas = "SELECT * FROM account";

	foreach ($conexion->query($cuentas, PDO::FETCH_ASSOC) as $item) $matriz[] = $item;

// echo "<pre>"; var_dump($matriz); echo "</pre>";exit; 

	echo "<select name='account'>";
        foreach ($matriz as $key => $value) {
          echo '<option value="'.$value['id'].'">'.$value['account'].'</option>';
        }
	echo "</select>";

?>
</br>
</br>
Lugar: 
	<?php

	$cuentas2 = "SELECT * FROM lugar";

	foreach ($conexion->query($cuentas2, PDO::FETCH_ASSOC) as $item) $matriz2[] = $item;

// echo "<pre>"; var_dump($matriz); echo "</pre>";exit; 

	echo "<select name='lugar'>";
        foreach ($matriz2 as $key2 => $value2) {
          echo '<option value="'.$value2['id'].'">'.$value2['name'].'</option>';
        }
	echo "</select>";

?>
<input type="hidden" name="type_action" value="register_lista" name="action">
</br>
</br>
<input type="submit" name="Enviar" value="Registrar">
</form>

<script>
$(document).ready(function(){

$(".lugar").change(function() {

	if($(".lugar").val()!=""){

		window.location.href = "?type=ver_listas&cuenta="+$(".cuenta").val()+"&lugar="+$(".lugar").val();

	}

});





});
</script>	