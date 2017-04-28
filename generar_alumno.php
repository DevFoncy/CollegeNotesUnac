	<?php
	require 'conexion.php';
	require 'Database.php';
	require 'fpdf/fpdf.php';
	session_start();
	$codigo_alumno= $_POST['codigo_alumno'];
	$nombre= $_POST['nombre_completo'];
	$codigo_facultad = $_POST['codigo_facultad'];
	$nombre_facultad = $_POST['nombre_facultad'];

	class PDF extends FPDF
			{
			function Header()
			{

				$this->SetFont('Arial','B',20);
				    // Movernos a la derecha
				    // $this->Cell(80);
				    // Título
				    $this->Cell(0,5,'Universidad Nacional del Callao',0,2,'C');
					$this->SetFont('Arial','B',15);
					$this->Image('img/unac.png',10,10,-300);
					// Salto de línea
				    $this->Ln(10);
			}

			function Footer()
			{
			    // Posición a 1,5 cm del final
			    $this->SetY(-15);
			    // Arial itálica 8
			    $this->SetFont('Arial','I',8);
			    // Color del texto en gris
			    $this->SetTextColor(128);
			    // Número de página
			    $this->Cell(0,10,utf8_decode('Página').$this->PageNo(),0,0,'C');
			     $this->Cell(0,10,date('d/m/Y'),0,0,'R');
			}

			function ChapterTitle($tipo, $tittle)
			{
			    // Arial 12
			    $this->SetFont('Arial','',10);
			    // Color de fondo
			    $this->SetFillColor(200,220,255);
			    // Título
			    $this->Cell(0,5,"$tipo : $tittle",0,1,'L',false);
			    // Salto de línea
			    $this->Ln(4);
			}


			function PrintChapter($tipo, $title)
			{	
			    $this->ChapterTitle($tipo,$title);
			}
			}



			//$conex4= new Database(DB_HOST,DB_USER,DB_PASS,DB_NAME);

			$pdf = new PDF();
			$pdf->AddPage();
			$pdf->Cell(0,5,utf8_decode("FACULTAD DE ".$nombre_facultad),0,2,'C');
			$pdf->Cell(0,1,'________________________________________________________________',0,2,'C');
			$pdf->Ln(4);
			$pdf->PrintChapter("ALUMNO",$nombre,'20k_c1.txt');
			$pdf->PrintChapter("CODIGO",$codigo_alumno,'20k_c1.txt');
			$sql=mysql_connect(DB_HOST,DB_USER,DB_PASS);
			mysql_select_db("nota_fime", $sql);

		
			if($codigo_facultad==101){
					
				$sql= mysql_query("SELECT n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti, c.nombre_curso  from nota n, curso c  WHERE n.codigo_alumno='$codigo_alumno' and c.codigo_curso=n.codigo_curso");
				}
				if($codigo_facultad==102){
				$sql= mysql_query("SELECT n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti, c.nombre_curso  from nota_fca n, curso c, matricula_fca m  WHERE m.codigo_alumno='$codigo_alumno' and c.codigo_curso=m.codigo_curso and m.codigo_matricula=n.codigo_matricula ");					
				}

			$pdf->Cell(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(100,10,utf8_decode('Nombre del Curso'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('EP'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('EF'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('PC1'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('PC2'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('PC3'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('PC4'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('Lab'),0,0,'L');
			$pdf->Cell(10,10,utf8_decode('Susti'),0,1,'L');

			while($fila=mysql_fetch_array($sql)){
				    $nombre_curso=$fila['nombre_curso'];
					$exp=$fila['ex_parcial'];
					$pc1=$fila['pc1'];
					$pc2=$fila['pc2'];
					$pc3=$fila['pc3'];
					$pc4=$fila['pc4'];
					$labo=$fila['laboratorio'];
					$exf=$fila['ex_final'];
					$susti=$fila['susti'];
					$pdf->Cell(2);
					$pdf->SetFont('Arial','',8);
					
					$pdf->Cell(100,5,utf8_decode($nombre_curso),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($exp),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($exf),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($pc1),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($pc2),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($pc3),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($pc4),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($labo),0,0,'L');
					$pdf->Cell(10,5,utf8_decode($susti),0,1,'L');
			}
			

			$pdf->Output();



	?>