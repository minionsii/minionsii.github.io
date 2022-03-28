<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Export HTML Table to Excel, CSV, JSON, PDF, PNG using jQuery</title>
  <!-- jquery plugin to support -->
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript" src="tableExport.js"></script>
  <script type="text/javascript" src="jquery.base64.js"></script>
  
  <!-- PNG format -->
  <script type="text/javascript" src="html2canvas.js"></script>
  
  <!-- PDF format -->
  <script type="text/javascript" src="jspdf/libs/sprintf.js"></script>
  <script type="text/javascript" src="jspdf/jspdf.js"></script>
  <script type="text/javascript" src="jspdf/libs/base64.js"></script>
  <style>
  table td{
  padding:10px 15px;
  }
  a{
  margin:10px;
  }
  </style>
</head>
<body>
<h1>Export HTML Table to Excel, CSV, JSON, PDF, PNG using jQuery</h1>

Export to: 
<a href="#" onClick ="$('#tableID').tableExport({type:'json',escape:'false'});">JSON</a>
<a href="#" onClick ="$('#tableID').tableExport({type:'excel',escape:'false'});">XLS</a>
<a href="#" onClick ="$('#tableID').tableExport({type:'csv',escape:'false'});">CSV</a>
<a href="#" onClick ="$('#tableID').tableExport({type:'pdf',escape:'false'});">PDF</a>
	
<table class="table table-striped" id="tableID">
	<thead>			
		<tr>
			<th>Country</th>
			<th>Population</th>
			<th>Date</th>
			<th>%ge</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Chinna</td>
			<td>1,363,480,000</td>
			<td>March 24, 2014</td>
			<td>19.1</td>
		</tr>
		<tr>
			<td>India</td>
			<td>1,241,900,000</td>
			<td>March 24, 2014</td>
			<td>17.4</td>
		</tr>
		<tr>
			<td>United States</td>
			<td>317,746,000</td>
			<td>March 24, 2014</td>
			<td>4.44</td>
		</tr>
		<tr>
			<td>Indonesia</td>
			<td>249,866,000</td>
			<td>July 1, 2013</td>
			<td>3.49</td>
		</tr>
		<tr>
			<td>Brazil</td>
			<td>201,032,714</td>
			<td>July 1, 2013</td>
			<td>2.81</td>
		</tr>
	</tbody>
</table>


</body>
</html>