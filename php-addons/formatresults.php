<?php
	if ($resultscount==0) {
			echo '<h4>No results for '.$params[0].' = '.$params[1].'.  Please try again.</h4>';
		}
		else {
		$table=document.createElement('resulttable');
		$tableBody=document.createElement('tablebody');
		$rownum=0;
		$results.forEach(function(rowData) {
			$row = document.createElement('tr');
			row.setAttribute('id',$results[rownum]['EDITION_ID']);
			rowData.forEach(function(cellData) {
				$cell=document.createElement('th');
				cell.appendChild(document.createTextNode(cellData));
				row.appendChild($cell);
			});
			tableBody.appendChild(row);
	});
			table.appendChild(tableBody);
			document.body.appendChild(table);
			row++;
		}

;?>
