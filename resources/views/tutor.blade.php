@extends('layouts.app')

@section('content')

{{ $requests}}

	<head>
		<link rel="stylesheet" type="text/css" href="../assets/css/main.css">
	</head>
		<p align="center">Welcome mentor {{ Auth::user()->name }}!</p>
	You are mentoring now:
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>
					<th align="left">Name</th>
					<th align="left">Description</th>
					<th align="left">View Session Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Jimmy</td>
					<td>Problem with for loop in a array using Java</td>
					<td align="center"><input type="button" onclick="location.href='jimmy.blade.php';" value="View"></td>
				</tr>
			</tbody>
		</table>
	</div>
	<br>
	Student requests:
	<section>
	<div class="table-wrapper">
		<table>
			<thead>
				<tr>
					<th align="left">Name</th>
					<th align="left">Description</th>
					<th align="left">View Students</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Prashay</td>
					<td>Need help with Java.</td>
					<td align="center"><input type="button" onclick="location.href='prashay.blade.php';"
                        value="View"/></td>
				</tr>
				<tr>
					<td>Ken</td>
					<td>Need help with C#</td>
					<td align="center"><input type="submit" value="View"></td>
				</tr>
				<tr>
					<td>Bill</td>
					<td>Need help with AI</td>
					<td align="center"><input type="submit" value="View"></td>
				</tr>
			</tbody>
		</table>
	</section>
	</div>
	<br>
@endsection
