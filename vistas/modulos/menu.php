<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '

			<li>

				<a href="usuarios">

					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>

			</li>';

		}

		

		// if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

		// 	echo '<li>

		// 		<a href="categorias">

		// 			<i class="fa fa-th"></i>
		// 			<span>Tipo de Documentos</span>

		// 		</a>

		// 	</li>

		// 	';

		// }

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Tecnico"){

			echo '<li>

				<a href="maquinas">

					<i class="fa fa-cogs"></i>
					<span>Maquinas</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Tecnico"){

			echo '<li>

				<a href="grupos">

					<i class="fa fa-object-group"></i>
					<span>Grupos</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Tecnico"){

			echo '<li>

				<a href="generarCodigoQR">

					<i class="fa fa-barcode"></i>
					<span>Generar Codigo QR</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Tecnico" ){

			echo '<li>

				<a href="mantenimiento">

					<i class="fa fa-list-ul"></i>
					<span>Informacion de Mttos</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Tecnico" || $_SESSION["perfil"] == "Operador"){

			echo '<li>

				<a href="doctos">

					<i class="fa fa-archive"></i>
					<span>Visualizacion Documentos</span>

				</a>

			</li>

			';

		}
		
		if($_SESSION["perfil"] == "Administrador" ){

			echo '<li>

				<a href="settings">

					<i class="fa fa-wrench"></i>
					<span>Settings</span>

				</a>

			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Tecnico"){

			echo '<li>

				<a href="descargar-archivo">

					<i class="fa fa-android"></i>
					<span>Descargar APK</span>

				</a>

			</li>';

		}
		

		?>

		</ul>

	 </section>

</aside>