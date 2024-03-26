<center><h2>ORDER OF PAYMENT</h2></center>
<p style="float: right;">Date: <strong>{{date("F j, Y", strtotime($appDet[0][0]->t_date))}}</strong></p>
<p>Name of Hospital: <strong>{{$appDet[0][0]->facilityname}}</strong></p>
<p>Facility Address: <strong>{{$appDet[0][0]->rgn_desc}}, {{$appDet[0][0]->provname}}, {{$appDet[0][0]->cmname}}, {{$appDet[0][0]->brgyname}}, {{$appDet[0][0]->street_name}}</strong></p>
<p>Charge amount of: <strong>{{strtoupper($totalWord[1])}} ONLY</strong></p>
<p>PHP: <strong>&#8369;&nbsp;{{number_format($totalWord[0], 2)}}</strong></p>
<br>
<table style="border: 1px dashed black; border-collapse: collapse; width: 100%;">
	<thead style="border: 1px dashed black;">
		<tr style="border: 1px dashed black;">
			<th style="border: 1px dashed black;">Date</th>
			<th style="border: 1px dashed black;">Description</th>
			<th style="border: 1px dashed black;">Amount</th>
		</tr>
	</thead>
	<tbody style="border: 1px dashed black;">
		@if(count($appDet[1]) > 0) @foreach($appDet[1] AS $each)
		<tr style="border: 1px dashed black;">
			<td style="text-align: center; border: 1px dashed black;">{{date("F j, Y", strtotime($each->t_date))}}</td>
			<td style="text-align: center; border: 1px dashed black;">{{$each->reference}}</td>
			<td style="text-align: center; border: 1px dashed black;">&#8369;&nbsp;{{number_format($each->amount, 2)}}</td>
		</tr>
		@endforeach @else
		<tr style="border: 1px dashed black;">
			<td style="border: 1px dashed black;" colspan="3">No charge(s).</td>
		</tr>
		@endif
	</tbody>
</table>