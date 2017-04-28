	<?php
	require 'conexion.php';
	require 'Database.php';
	require 'fpdf/fpdf.php';
	session_start();
	$codigo_teacher=$_SESSION['codigo'];
	
	$nombre_curso = $_POST['nombre_curso'];
	$nombre_facultad = $_POST['nombre_facu'];
	$apellido_profe = $_POST['apellido'];
	$nombre_profe = $_POST['nombre'];	
	$turno = $_POST['turno'];	
	$codigo_cur=$_POST['codigo_curso1'];
	$codigo_facultad=$_POST['codigo_facu'];
	$nombre_completo= $apellido_profe." ".$nombre_profe; 

	class PDF extends FPDF
			{
			function Header()
			{

				    $this->SetFont('Arial','B',20);
				    // Movernos a la derecha
				    // $this->Cell(80);
				    // Título
				    $this->Cell(0,8,'Universidad Nacional del Callao',0,2,'C');
					$this->SetFont('Arial','B',15);
					// Salto de línea
				    $this->Ln(5);
			}

			function Footer()
			{
			    // Posición a 1,5 cm del final
			    $this->SetY(-15);
			    // Arial itálica 8
			    $this->SetFont('Arial','B',10);
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
			    $this->Cell(0,3,"$tipo : $tittle",0,1,'L',false);
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
			//pdf->PrintChapter("FACULTAD",$nombre_facultad,'20k_c1.txt');
			$pdf->Ln(4);
			$pdf->PrintChapter("PROFESOR",$nombre_completo,'20k_c1.txt');
			$pdf->PrintChapter("CURSO",$nombre_curso,'20k_c1.txt');
			$pdf->PrintChapter("TURNO",$turno,'20k_c1.txt');

			$sql=mysql_connect(DB_HOST,DB_USER,DB_PASS);
			mysql_select_db("nota_fime", $sql);
			$n=0;

			if($codigo_facultad==101){
					$sql= mysql_query("SELECT a.codigo_alumno ,CONCAT(a.apellido_paterno,' ', a.apellido_materno) as APELLIDO, a.nombre_alumno, n.ex_parcial, n.ex_final,n. pc1, n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti FROM alumno a, nota n  WHERE n.codigo_alumno =a.codigo_alumno and n.codigo_curso='$codigo_cur' and n.codigo_turno='$turno' ORDER BY a.apellido_paterno");

			}
			if($codigo_facultad==102){
					$sql= mysql_query("SELECT a.codigo_alumno ,CONCAT(a.apellido_paterno,' ', a.apellido_materno) as APELLIDO, a.nombre_alumno, n.ex_parcial, n.ex_final,n.pc1,n.pc2,n.pc3,n.pc4,n.laboratorio,n.susti FROM alumno_fca a, nota_fca n , matricula_fca m WHERE n.codigo_matricula=m.codigo_matricula and m.codigo_curso='$codigo_cur' and m.codigo_turno='$turno' and m.codigo_alumno = a.codigo_alumno ORDER BY a.apellido_paterno");

			}
			

			$pdf->Cell(2);
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(6,5,'Nro',0,0,'L');
			$pdf->Cell(18,5,utf8_decode('Código'),0,0,'L');
			$pdf->Cell(90,5,utf8_decode('Apellidos y Nombres'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('EP'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('EF'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('PC1'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('PC2'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('PC3'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('PC4'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('Lab'),0,0,'L');
			$pdf->Cell(10,5,utf8_decode('Susti'),0,1,'L');

			while($fila=mysql_fetch_array($sql)){
					$n=$n+1;
					$codigo=$fila['codigo_alumno'];
					$nombre= $fila['APELLIDO'].", ".$fila['nombre_alumno'];
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
					if($n<10)
						{$pdf->Cell(6,5,'0'.$n,0,0,'L');}
					else
						{$pdf->Cell(6,5,$n,0,0,'L');}
					$pdf->Cell(18,5,utf8_decode($codigo),0,0,'L');
					$pdf->Cell(90,5,utf8_decode($nombre),0,0,'L');
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