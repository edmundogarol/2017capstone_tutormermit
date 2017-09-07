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
				<td align="right">Jimmy</td>
			</tr>
			<tr>
				<th align="left">Student ID:</th>
				<td align="right">s1234567</td>
			</tr>
			<tr>
				<th align="left">Subject:</th>
				<td align="right">Java</td>
			</tr>
			<tr>
				<th align="left">Time:</th>
				<td align="right"></td>
			</tr>
			<tr>
				<th align="left">Details:</th>
			</tr>
		</table>
	<p>I am having trouble with a for loop in Java, I am trying to loop through an array and I am not sure why. I have the for int, the int < array.length() and everything! Any help would be greatly appreciated!
	</div>
	<div width="50%">
		<div style='float: left;'>
			<button onclick="goBack()">Back</button>
		</div>
		<div style='float: right;'>
			<button>End Session</button>
		</div>
	</div>
</body>
</html>