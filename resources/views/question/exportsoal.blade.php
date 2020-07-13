<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Download Hasil Ujian</title>
</head>
<body>          
    <p align="right"> Dibuat pada {{date('d M Y',strtotime($paket_soal->created_at))}} </p>
    <center><h3>Naskah Soal <br/>{{$paket_soal->judul}} </h3></center>

<center>
<hr>
<table >
<tr >
<td> Nama </td>
<td> : </td>
</tr>
<tr>
<td>Institusi </td>
<td>: </td>
<tr>
<td>Tanggal Ujian </td>
<td>: </td>
<tr>
</table>
<hr>
<table>
	<tr>
        <td><b>No.</b></td>
        <td ><b>Soal Pilihan Ganda</b></td>
        <td>&nbsp;</td>
	</tr>
    <?php $i = 0; ?>
	@foreach($soal_pilgan as $item)
	<tr>

		<td><?php   $i++;  echo $i; ?></td>
        <td>{!!$item->pilgan->pertanyaan!!}</td>
        <td align="right">{{$item->poin}} Poin</td>

    </tr>
    <tr>

		<td>&nbsp;</td>
        <td>
            A. {{$item->pilgan->pil_a}}<br/>
            B. {{$item->pilgan->pil_b}} <br/>
            C. {{$item->pilgan->pil_c}}<br/>
            D. {{$item->pilgan->pil_d}} <br/>
            E. {{$item->pilgan->pil_e}}<br/>
        </td>
	</tr>
   
    @endforeach
  </table>
  @if($soal_essay != null)
<hr>
  <table width="600px">
	<tr>
        <td></td>
		<td ><b>Soal Essay</b></td>
	</tr>
    <tr>

		<td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
    <?php $i = 0; ?>
	@foreach($soal_essay as $item)
	<tr>

		<td><?php   $i++;  echo $i; ?></td>
        <td>{!!$item->essay->pertanyaan!!}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td align="right">{{$item->poin}} Poin</td>
    </tr>
    <tr>

		<td>&nbsp;</td>
        <td>Jawab : </td>
	</tr>
    <tr>

		<td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
    @endforeach

</table>
@else
<table>
</table>
@endif
</center>

</body>
</html>
