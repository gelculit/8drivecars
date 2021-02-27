<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script> 
	
</head>
<body>
	<center>
		<h1>Search Between 2 Dates</h1>
		<h3>JQuery Calendar</h3>
		<hr/>
		<table>
			<tr>
				<td>
					From Date:
				</td>
				<td>
					<input type="text" id="txtFrom" name="fromdate"/>
				</td>
				<td>
					To Date:
				</td>
				<td>
					<input type="text" id="txtTo" name="todate"/>
				</td>
			</tr>
				<input type="submit" id="search" name="Search"/>
		</table>
	</center>
	<script type="text/javascript">
	$(function() {
		$("#txtFrom).datepicker({
			dateFormat:'yy/mm/dd',
			onSelect:function(dateselected)
			{
				var dt=new Date(dateselected);
				dt.setDate(dt.getDate());
				$("#txtTo").datepicker("option","minDate",dt);
			}
		});
	
	});
	</script>
</body>
</html>