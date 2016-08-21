<?PHP
	
	
	// Create new PHPExcel object
	$objPHPExcel = new PHPExcel();
	
	

	
	function ci_import($inputFileName){
		
			//echo "calling....";exit;
			
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
		} catch (Exception $e) {
			die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) 
			. '": ' . $e->getMessage());
		}
		
		$sheets = count($objPHPExcel->getAllSheets());
		//echo $sheets;
		//echo "<pre>";
		$arr=array();
		foreach($objPHPExcel->getAllSheets() as $sheet){
			$title = $sheet->getTitle();
			$arr[$title]=array();
			$rows= array();
			// fetch the data
			foreach ($sheet->getRowIterator() as $row) 
			{
				$cols= array();
				$cellIterator = $row->getCellIterator();
				$cellIterator->setIterateOnlyExistingCells(false); // This loops all cells,
				foreach ($cellIterator as $cell)
				{
					$cols[]=$cell->getValue();
				}
				$rows[] = $cols;
			}
			$arr[$title]=$rows;
			
			
					}
		
		return $arr;
		//print_r( $arr);
		
	}
	