<?php
require('fpdf.php');

$_POST = array_merge($_POST, (array) json_decode(file_get_contents('php://input')));

class PDF extends FPDF
{
// Cabecera de página
function Header()
{

	require('../../common/include.php');
	$conn=getConnection();

	$sql = "select mm.fecha, mm.id ,mm.horaInicio ,mm.horaTermino ,mm.tiempoMuerto ,mm.comentarios ,mm.nomenclatura ,mm.folio
			, maq.numMaquina, maq.descripcion, maq.modelo
			from mttomaestro mm
			JOIN mttodetalle md ON mm.id=md.idMttoMaestro
			JOIN maquinas maq ON maq.idMaquina=mm.idMaquina
			
			where mm.id = '".$_POST["Id"]."' order by mm.id Limit 1";

	$result = mysqli_query($conn,$sql);

    // Logo
     $this->Image('../../vistas/img/empresa/logoEmpresa.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(50);
    // Título
    $this->Cell(70,10,'Troubleshooting',0,0,'R');
    // Salto de línea
    $this->Ln(20);
    //
    $this->SetFont('Arial','B',12);
    while($row = $result->fetch_assoc()) {
	    $this->Cell(40,8,'No.Maquina',1,0,'L',0);
	    $this->Cell(230,8,$row['numMaquina'],1,1,'L',0);	    
	    $this->Cell(40,8,'Tipo de Maquina',1,0,'L',0);
	    $this->Cell(140,8,$row['descripcion'],1,0,'L',0);
	    $this->Cell(40,8,'Modelo',1,0,'L',0);
	    $this->Cell(50,8,$row['modelo'],1,1,'L',0);
	    $this->Cell(40,8,'Area',1,0,'L',0);
	    $this->Cell(230,8,'',1,0,'L',0);
	    $this->Ln(20);
	}

    
}

// Pie de página
	function Footer()
	{
		require('../../common/include.php');
		$nameSU='';
		$nameOP='';
		$nameTE='';
		$nameEHS='';
		$fechaSU='';
		$fechaOP='';
		$fechaTE='';
		$fechaEHS='';

		$conn=getConnection();

		$sql = "SELECT id, nombre, firma, fecha from mttofirmas where idMttoMaestro ='".$_POST["Id"]."' and tipoUsuario='OP' order by id desc Limit 1";

		$result = mysqli_query($conn,$sql);

		while($row = $result->fetch_assoc()) {

			
			$data = $row['firma'];
			$file = fopen("firmaOP.png", "w+");

			fwrite($file, base64_decode($data));
			fclose($file);
			$nameOP = $row["nombre"];
			$fechaOP= $row["fecha"];
		}
		$conn=getConnection();

		$saql = "SELECT id, nombre, firma, fecha from mttofirmas where idMttoMaestro ='".$_POST["Id"]."' and tipoUsuario='SU' order by id desc Limit 1";

		$result = mysqli_query($conn,$saql);

		while($row = $result->fetch_assoc()) {

			
			$data = $row['firma'];
			$file = fopen("firmaSU.png", "w+");

			fwrite($file, base64_decode($data));
			fclose($file);
			$nameSU = $row["nombre"];
			 $fechaSU= $row["fecha"];
			
			// $this->Cell(62,8, $this->Image('logomaintenance.png', 110, 185,25),1);
		}

		$sql = "SELECT id, nombre, firma, fecha from mttofirmas where idMttoMaestro ='".$_POST["Id"]."' and tipoUsuario='TE' order by id desc Limit 1";

		$result = mysqli_query($conn,$sql);

		while($row = $result->fetch_assoc()) {

			
			$data = $row['firma'];
			$file = fopen("firmaTE.png", "w+");

			fwrite($file, base64_decode($data));
			fclose($file);
			$nameTE = $row["nombre"];
			$fechaTE= $row["fecha"];
		}

		$sql = "SELECT id, nombre, firma, fecha from mttofirmas where idMttoMaestro ='".$_POST["Id"]."' and tipoUsuario='EHS' order by id desc Limit 1";

		$result = mysqli_query($conn,$sql);

		while($row = $result->fetch_assoc()) {

			
			$data = $row['firma'];
			$file = fopen("firmaEHS.png", "w+");

			fwrite($file, base64_decode($data));
			fclose($file);
			$nameEHS = $row["nombre"];
			$fechaEHS= $row["fecha"];
		}

		$this->SetY(-40);
		$this->Cell(20,8,'',0,0,'L',0);
		$this->Cell(62,8,'Operador',1,0,'C',0);
		$this->Cell(62,8,'Supervisor de Turno',1,0,'C',0);
		$this->Cell(62,8,'Tecnico de Mantenimiento',1,0,'C',0);
		$this->Cell(62,8,'EHS',1,1,'C',0);	
		$this->Cell(20,8,'Nombre',1,0,'L',0);
		$this->Cell(62,8,$nameOP,1,0,'C',0);
		$this->Cell(62,8,$nameSU,1,0,'C',0);
		
		

		$this->Cell(62,8,$nameTE,1,0,'C',0);
		$this->Cell(62,8,$nameEHS,1,1,'C',0);
		$this->Cell(20,8,'Firma',1,0,'L',0);
		$this->Cell(62,8,'',1,0,'C',0);
		$this->Cell(62,8,'',1,0,'C',0);
		
		if($nameOP!=null){
			$this->Cell(62,8, $this->Image('firmaOP.png', 45, 185,25),1);	
		}
		if($nameSU!=null){
			$this->Cell(62,8, $this->Image('firmaSU.png', 110, 185,25),1);
		}
		
		if($nameTE!=null){
			$this->Cell(62,8,$this->Image('firmaTE.png', 175, 185,25),1);
		}	
		
		if($nameEHS!=null){
			$this->Cell(62,8,$this->Image('firmaEHS.png', 235, 185,25),1);	
		}
		
		$this->Ln(6);	
		$this->Cell(92,8,$fechaOP,0,0,'C',0);
		$this->Cell(52,8,$fechaSU,0,0,'C',0);
		$this->Cell(62,8,$fechaTE,0,0,'C',0);
		$this->Cell(52,8,$fechaEHS,0,0,'C',0);	
		
		//$this->Cell(62,8,'',1,1,'C',0);
	    // Posición: a 1,5 cm del final
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Número de página
	    $this->Cell(0,10,utf8_decode('Page ').$this->PageNo().'/{nb}',0,0,'C');

	}
}

require('../../common/include.php');

$pdf=new PDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);


$conn=getConnection();

$sql = "SELECT id, problema, solucion from mttodetalle where idMttoMaestro ='".$_POST["Id"]."'";

$result = mysqli_query($conn,$sql);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(40,8,'Problema',1,0,'C',0);

if($row = $result->fetch_assoc()){
    $pdf->Cell(230,8,$row['problema'],1,1,'L',0);
}
    	
		
		//Body



$sql = "SELECT id, problema, solucion from mttodetalle where idMttoMaestro ='".$_POST["Id"]."' Limit 5";

$result = mysqli_query($conn,$sql);


$pdf->Cell(40,50,'Solucion',1,0,'C',0);
//$pdf->Cell(40,10,'',1,0,'C',0);
$cont=0;
while($row = $result->fetch_assoc()){
    
    if($cont!=0){
        $pdf->Cell(40,10,'',0,0,'C',0);    
    }
    
	$pdf->MultiCell(230,10,utf8_decode($row['solucion']),1,'C');
	//$pdf->Cell(40,10,'',0,1,'C',0);
	$cont = $cont +1;
}

    
$pdf->Output();


?>