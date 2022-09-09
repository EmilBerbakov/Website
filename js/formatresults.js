function formatResults(
	if ($resultscount==0) {
			echo '<h4>No results for '.$params[0].' = '.$params[1].'.  Please try again.</h4>';
		}
		else {
		var table=document.createElement('resulttable');
		var tableBody=document.createElement('tablebody');
		var rownum=0;
		$results.forEach(function(rowData) {
			var cell=0;
			var row = document.createElement('tr');
			row.setAttribute('id',$results[rownum]['EDITION_ID']);
			rowData.forEach(function(cellData) {
				var cell=document.createElement('th');
				cell.appendChild(document.createTextNode(cellData));
				row.appendChild(cell);
			});
			tableBody.appendChild(row);
	});
			table.appendChild(tableBody);
			document.body.appendChild(table);
			row++;
		}

