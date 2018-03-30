<?php

	require 'back/conexion.php';
	
	$sTabla = "usuarios";
	
	$aColumnas = array('id', 'usuario', 'nombre', 'correo');
	
	$sIndexColumn = "id";
	
	$sLimit = "";

	if (isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1'){

		$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ".$_GET['iDisplayLength'];
	}
	
	if (isset( $_GET['iSortCol_0'])){

		$sOrder = "ORDER BY  ";

		for ( $i=0 ; $i<intval( $_GET['iSortingCols']); $i++){

			if ( $_GET['bSortable_'.intval($_GET['iSortCol_'.$i])] == "true"){

				$sOrder .= $aColumnas[ intval( $_GET['iSortCol_'.$i] ) ]."
				".$_GET['sSortDir_'.$i] .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );

		if($sOrder == "ORDER BY"){

			$sOrder = "";
		}
	}
	
	$sWhere = "";

	if ($_GET['sSearch'] != ""){

		$sWhere = "WHERE (";

		for ($i=0 ; $i<count($aColumnas) ; $i++){

			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
		}

		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
	}
	
	for ($i=0 ; $i<count($aColumnas); $i++){

		if ($_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '')
		{
			if ($sWhere == ""){

				$sWhere = "WHERE ";

			}else{

				$sWhere .= " AND ";
			}

			$sWhere .= $aColumnas[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
		}
	}
	
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", ", $aColumnas))."
		FROM   $sTabla
		$sWhere
		$sOrder
		$sLimit
		";

	$rResult = $mysqli->query($sQuery);
	
	$sQuery = "
		SELECT FOUND_ROWS()
		";

	$rResultFilterTotal = $mysqli->query($sQuery);
	$aResultFilterTotal = $rResultFilterTotal->fetch_array();
	$iFilteredTotal = $aResultFilterTotal[0];
	
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTabla
		";

	$rResultTotal = $mysqli->query($sQuery);
	$aResultTotal = $rResultTotal->fetch_array();
	$iTotal = $aResultTotal[0];
	
	$output = array(

		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ($aRow = $rResult->fetch_array()){

		$row = array();

		for ($i=0 ; $i<count($aColumnas) ; $i++){

			if ($aColumnas[$i] == "version"){

				$row[] = ($aRow[ $aColumnas[$i] ]=="0") ? '-' : $aRow[ $aColumnas[$i] ];
			}

			else if ($aColumnas[$i] != ' '){

				$row[] = $aRow[ $aColumnas[$i] ];
			}
		}
		
		$row[] = "<td><a href='modificar.php?id=".$aRow['id']."'><span class='glyphicon glyphicon-pencil'></span></a></td>";
		$row[] = "<td><a href='#' data-href='eliminar.php?id=".$aRow['id']."' data-toggle='modal' data-target='#confirm-delete'><span class='glyphicon glyphicon-trash'></span></a></td>";
		
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>