@extends('layouts.app')

@section('content')
<html>	
<body>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
		<script>
			function goBack() {
				window.history.back();
			}
		</script>
	</head>
	<div>
		<table width="80%">
			<tr>
				<th align="left">Name:</th>
				<td align="right">Prashay</td>
			</tr>
			<tr>
				<th align="left">Student ID:</th>
				<td align="right">s3559688</td>
			</tr>
			<tr>
				<th align="left">Subject:</th>
				<td align="right">Java</td>
			</tr>
			<tr>
				<th align="left">Time:</th>
				<td align="right">As soon as possible</td>
			</tr>
			<tr>
				<th align="left">Details:</th>
			</tr>
		</table>
	<p>I am having troubles adding a java object into my array, I have tried so many things and cannot find the solution. I am also having trouble with my loops as they are in an infinite loop and won't find the object in the array I am looking for.
	</div>
	<div width="50%">
		<div style='float: left;'>
			<button onclick="goBack()">Back</button>
		</div>
		<div style='float: right;'>
			<button>Tutor</button>
		</div>
	</div>
</body>
</html>