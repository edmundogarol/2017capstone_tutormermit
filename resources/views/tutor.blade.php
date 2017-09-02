@extends('layouts.app')

@section('content')
	<span class="leftcol">
		<p align="center">Welcome tutor (name)!</p>
    </span>
	Students requiring tutoring:
	
	<section>
	<div class="table-wrapper">
							<table>
								<thead>
									<tr>
										<th>Name</th>
										<th>Description</th>
										<th>View Students</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Prashay</td>
										<td>Need help with Java.</td>
										<td align="center"><input type="submit" value="View"></td>
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
@endsection
