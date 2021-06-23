<html>
<div class="content-wrapper">
	<body class="">
		<div class="container" style="min-height:500px;">
            <div class="container">     
                <div class="row">
                    <h2>Descargar Archivos</h2>
                </div>
                
                <div class="col-md-3">
                    <?php
					// Esto devolverá todos los archivos de esa carpeta
					$archivos = scandir("vistas/subidas");
					$num=0;
					for ($i=2; $i<count($archivos); $i++)
					{$num++;
					?>
					<!-- Visualización del nombre del archivo !-->
					         
					    <tr>
					      <th scope="row"><?php echo $num;?></th>
					      <td><?php echo $archivos[$i]; ?></td>
					      <td><a title="Descargar Archivo" href="vistas/subidas/<?php echo $archivos[$i]; ?>" download="<?php echo $archivos[$i]; ?>" style="color: blue; font-size:18px;"><br> <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> <br></a></td>
					     
					    </tr>
					 <?php }?>
                </div>
                
                <div class="col-md-6">
                    <div class="showQRCode"></div>
                </div>
            </div>
        </div>
        </div>  
        <div class="insert-post-ads1" style="margin-top:20px;">

        </div>
        </div>
	</body>
</div>
</html>

