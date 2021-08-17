<?php
    function recipe($data) {
        $str="";
        foreach ($data['medicines'] as $medicine) {
            $str .='<li class="list-group-item">'.$medicine['name'].'</li>';
        }
        return $str;
    }

    $mpdf = new \Mpdf\Mpdf();
    $location = BASE_URL.'/pdf/recipes/';

    $mpdf -> WriteHTML ('
    <center class="mt-3">
        <p>Klinik Online Sejahtera</p>
        <p>JL. Blambangan 35 Dampit, Kab.Malang</p>
        <p>Tel. 081357333886</p>
    </center>
    <hr>
    <center class="mt-3">Apograph</center>
    <p class="d-flex justify-content-end">'. date('d/m/Y') .'</p>
    <pre>No. Resep    : '. $data['registration']['id_reg'] .'</pre>
    <pre>Nama Dokter  : Dr. '. $data['dokter']['name'] .'</pre>
    <pre>Tgl Resep    : '. date('d/m/Y') .'</pre>
    <pre>Nama Pasien  : '. $data['registration']['name'] .'</pre>
    <pre>Obat         :</pre>
    <div class="row">
        <div class="col-sm-3 offset-sm-1">
            <ul class="list-group list-group-flush">
                '.recipe($data).'
            </ul>
        </div>
    </div>
    <div>Total Price : '.$data['registration']['total_price'].'</div>

    <div class="row justify-content-end mt-5">
        <div class="col-sm-3">
            <p>TTD</p>
            <p class="mt-5">Dr. '. $data['dokter']['name'] .'</p>
        </div>
    </div>');
    
    $mpdf->Output(time().'.pdf', \Mpdf\Output\Destination::FILE);

    $_SESSION['id_reg'] = $data['registration']['id_reg'];
    $_SESSION['tgl_create_recipe'] = time();

    header('Location:'. BASE_URL.'/dokter/updatedataregistration');
?>

