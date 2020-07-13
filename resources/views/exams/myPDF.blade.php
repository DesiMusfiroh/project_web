<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>Download Hasil Ujian</title>
</head>
<body>          <p align="right"> Waktu Ujian :{{$peserta->ujian->waktu_mulai}} </span>
    <center><h3>Review Hasil<br> {{$peserta->ujian->nama_ujian}} </h3></center>
  
<center>
<hr>
<table >
<tr >
<td> Nama </td>
<td> : {{ $peserta->user->name }}</td>
</tr>
<tr>
@if ($institusi  !== null)
<td>Institusi </td>
<td>: {{$institusi}}</td>
@else
<td>Institusi </td>
<td>: -</td>
</tr>
@endif
@if ($no_hp  !== null)
<tr>
<td>No. Hp </td>
<td>: {{$no_hp}}</td>
@else
<tr>
<td>No. Hp </td>
<td>: - </td>
</tr>
@endif
<tr>
<td>Nilai  </td>
<td>: {{$nilai_akhir}} </td>
</tr>
</table>
<hr>
<table>



	<tr>
        <td><b>NO</b></td>
		<td ><b>Soal Pilihan Ganda</b></td>
	</tr>
    <tr>

		<td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
    <?php $i = 0; ?>
	@foreach($pilgan_jawab as $item)
	<tr>

		<td><?php   $i++;  echo $i; ?></td>
        <td>{{$item->pilgan->pertanyaan}}</td>
       
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
    <tr>

		<td>&nbsp;</td>
        <td>Jawaban Anda : {{$item->jawab}} @if ($item->status == 'T') (Benar) <b> (Poin : {{$item->score}}) </b> @elseif($item->status == 'F') (Salah) <b>(Poin : {{$item->score}})  Kunci {{$item->pilgan->kunci}} </b> @endif</td>
	</tr>
    <tr>

<td>&nbsp;</td>
<td>
   &nbsp;
</td>
</tr>
    @endforeach 
  </table>
<hr>
  <table>
	<tr>
        <td><b>NO</b></td>
		<td ><b>Soal Essay</b></td>
	</tr>
    <tr>

		<td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
    <?php $i = 0; ?>
	@foreach($essay_jawab as $item)
	<tr>

		<td><?php   $i++;  echo $i; ?></td>
        <td>{{$item->essay->pertanyaan}}</td>
        <td>&nbsp; </td>
    </tr>
    <tr>

		<td>&nbsp;</td>
        <td>Jawaban Anda : {{$item->jawab}} <b>(poin :  {{$item->score}}) <b></td>
	</tr>
    <tr>

		<td>&nbsp;</td>
        <td><b>Kunci :  {{$item->essay->jawaban}} </b></td>
	</tr>
    <tr>

		<td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
    @endforeach 
    
</table>
</center>

</body>
</html>

