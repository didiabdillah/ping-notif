    @extends('layouts.apphome')
    @section('content')
    <style type="text/css">
        .saldo,.tagihan,.wa_aktif {
        float: right;
        font-size: 20px;
        } 
    </style>
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Billing</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Billing</h4>
                    </div>
                </div>
            </div>

    <div class="row" >
        <div class="col-lg-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    @if(\Session::has('alert'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" >{{\Session::get('alert')}}<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                    @endif
                  
                        <div class="row  mb-10">
                            <div class="col-md-4">
                                <div class="card text-white bg-dark">
                                    <div class="card-body min-height-155">
                                    <h3>Saldo</h3>
                                    <div class="saldo"></div>
                                      <!--   <a href="#" class="btn btn-success" id="btn_beli_saldo">Beli Saldo</a> -->
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-md-4">
                                 <div class="card text-white bg-primary">
                                    <div class="card-body min-height-155">
                                    <h3>Tagihan</h3>
                                   <div class="tagihan"></div>
                                        <!-- <a href="#" class="btn btn-success" id="btn_beli">Pilih Masa Aktif</a> -->
                                    </div> 
                                </div>
                            </div>
                             <div class="col-md-4">
                                 <div class="card text-white badge-warning">
                                    <div class="card-body min-height-155">
                                    <h3>Whatsapp Aktif</h3>
                                   <div class="wa_aktif"></div>
                                        <!-- <a href="#" class="btn btn-success" id="btn_beli">Pilih Masa Aktif</a> -->
                                    </div> 
                                </div>
                            </div>
                        </div>

                         <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>No WA</th>
                                            <th>Debit</th>
                                            <th>Kredit</th>
                                            <th>Status</th>
                                            <th colspan="2" class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="list-biling"></tbody>
                                </table>
                    
                </div>
            </div>
        </div>   
    </div>

     <!-- Saldo -->
     <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="ModalTambahSaldo">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center mt-0" >Tambahkan Saldo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="msg_alert_saldo">
                        </div>
                        <form id="form_tambah_saldo" name="form_tambah_saldo">
                            <div class="input-group">
                                <input type="text" name="nominal" class="form-control" required="required">   
                                <span class="input-group-append"><button type="submit" class="btn btn-success">Tambahkan Saldo</button>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Saldo -->


 <!-- konfirmasi manual -->
     <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="ModalKonfirmasiManual">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center mt-0" >Konfirmasi Manual</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="msg_alert_transfer">
                        </div>
                        <form id="form_konfirmasimanual" name="form_konfirmasimanual">
                            <input type="hidden" name="id_history" value="">
                            <div class="form-group">
                                <label>Bank Pembayaran</label>
                                <select class="form-control" name="bank" required="">
                                    <option value="">--Pilih bank pembayaran--</option>
                                    <option value="mandiri">Mandiri</option>
                                    <option value="bri">Bri</option>
                                    <option value="bni">Bni</option>
                                    <option value="bca">Bca</option>

                                </select>
                              <!--  <input type="text" name="keterangan" class="form-control" > -->
                            </div>
                            <div class="form-group">
                                <label>Tanggal Transfer </label>
                               <input type="date" name="tanggal_transfer" class="form-control" >
                            </div>
                             <div class="form-group">
                                <label>Bukti transfer </label>
                               <input type="file" id="input-file-now-custom-1" class="dropify" name="file" data-default-file="">
                            </div>
                            <button type="submit" class="btn btn-success">Kirim Konfirmasi</button>
                        </form>
                       
                    </div>
                </div>
            </div>
        </div>
        <!-- Saldo -->
<!-- konfirmasi manual -->
     <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="alert_masaaktif">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center mt-0" >Billing Masa Aktif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="msg_alert_masaaktif">
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Saldo -->
    <script type="text/javascript">
        $(document).ready(function(e)
        {
           // const btn_beli_saldo    = document.getElementById('btn_beli_saldo');
           // const form_tambah_saldo = document.forms.namedItem('form_tambah_saldo');
            const form_konfirmasimanual= document.forms.namedItem('form_konfirmasimanual');

            // const handlebtnsaldo = (e) => 
            // {
            //     e.preventDefault();
            //     $('.msg_alert_saldo').empty();
            //     $('#ModalTambahSaldo').modal({backdrop: 'static',keyboard: false});
            // }
           // btn_beli_saldo.addEventListener('click', handlebtnsaldo);

    


            // $('input[name="nominal"]').keyup(function(e)
            // {
            //      e.preventDefault();
            //     $(this).val(formatRupiah($(this).val(), 'Rp. '));
            //     return;
            // });

            // function formatRupiah(angka, prefix){
            //     var number_string = angka.replace(/[^,\d]/g, '').toString(),
            //     split           = number_string.split(','),
            //     sisa            = split[0].length % 3,
            //     rupiah          = split[0].substr(0, sisa),
            //     ribuan          = split[0].substr(sisa).match(/\d{3}/gi);
            //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
            //     if(ribuan){
            //         separator = sisa ? '.' : '';
            //         rupiah += separator + ribuan.join('.');
            //     }
            //     rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            //     return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
            // }

            // const handlesimpansaldo = (e) => 
            // {
               
            //     e.preventDefault();
            //     const Form     = new FormData(form_tambah_saldo);
            //     Form.append('_token', '{{csrf_token()}}');
            //     $('input[name="nominal"]').attr('disabled','disabled');
            //     $('#form_tambah_saldo button').attr('disabled','disabled');
            //     $('#form_tambah_saldo').find('button').html('Tambah Saldo <i class="fa fa-spin fa-circle-o-notch"></i>');
            //     fetch('{{route('simpan_saldo')}}', { method: 'POST',body:Form}).then(res => res.json()).then(data => 
            //     {
            //         $('input[name="nominal"]').removeAttr('disabled','disabled');
            //         $('#form_tambah_saldo button').removeAttr('disabled','disabled');
            //         $('#form_tambah_saldo').find('button').html('Tambah Saldo');
            //         if(!data.error)
            //         {
            //             $('.msg_alert_saldo').html('<div class="alert alert-success text-center">'+data.alert+'</div>');
            //             page_list_his();

            //         }
            //         else
            //         {
            //             $('.msg_alert_saldo').html('<div class="alert alert-danger text-center">'+data.alert+'</div>');
            //         }
            //     });
               
            // }
            // form_tambah_saldo.addEventListener('submit', handlesimpansaldo);
page_list_his();
function page_list_his()
{
        const Form_data     = new FormData();
       
        Form_data.append('_token', '{{csrf_token()}}');
        fetch('{{route('load_history')}}', { method: 'POST',body:Form_data}).then(res => res.json()).then(data => 
        {
            var jmlh=data.jmlh;
            if(jmlh==0)
            {
                $('#list-biling').html('<tr><td colspan="8" align="center">Belum Data Report </td></tr>');
               
            }
            else
            {
                var list='';
                $.each(data.data_hist,function(k,v)
                {
                    var aksi_kon='-';
                    if(v.status_akses=='debit')
                    {
                        var st_sp=`<span class="badge badge-danger"><i class="dripicons-wrong"></i>  Batal</span>`;
                        switch(v.status)
                        {
                        case 'pending':
                        st_sp    =`<span class="badge badge-warning"><i class="dripicons-warning"></i> Belum bayar</span>`;
                        aksi_kon =`<span class="konfirmasimanual btn btn-success btn-sm"><i class="ti-pencil-alt"></i> Konfirm Manual</span>`;
                        break;
                        case 'konfirmasi':
                        st_sp=`<span class="badge badge-success"><i class="ti-timer"></i> Konfirmasi</span>`;
                        break;
                        case 'lunas':
                        st_sp=`<span class="badge badge-primary"><i class="ti-check-box"></i> Sudah dibayar</span>`;
                        break;
                        }
                    }
                    else
                    {
                        if(data.status_bayar==true)
                        {
                            aksi_kon='<span class="perpanjang btn btn-success btn-sm"><i class="ti-pencil-alt"></i> Perpanjang</span>';
                        }else
                        {

                            aksi_kon='<span class="konfirmasimanual btn btn-success btn-sm"><i class="ti-pencil-alt"></i> Konfirm Manual</span>';
                        }
                        var st_sp=`<span class="badge badge-warning"><i class="dripicons-warning"></i> Belum bayar</span>`;
                        switch(v.status)
                        {
                        case 'konfirmasi':
                        aksi_kon='';
                        st_sp=`<span class="badge badge-success"><i class="ti-timer"></i> Konfirmasi</span>`;
                        break;    
                        case 'lunas':
                        aksi_kon='';
                        st_sp=`<span class="badge badge-primary"><i class="ti-check-box"></i> Sudah dibayar </span>`;
                        break;
                        }
                    }
                   

                    var debit=v.status_akses=='debit'?v.nominal:'-';
                    var kredit=v.status_akses=='kredit'?v.nominal:'-';
                    var no_wa=v.no_wa?v.no_wa:'-';
                    list +=`<tr data-id="`+v.id_his_bill+`">
                            <td>`+v.created_at+`</td>
                            <td>`+v.id_invoice+`</td>
                            <td>`+no_wa+`</td>
                            <td>`+debit+`</td>
                            <td>`+kredit+`</td>
                            <td>`+st_sp+`</td>
                            <td>`+aksi_kon+`</td>
                            <td><a href="{{url('billing')}}/`+v.id_invoice+`" class="btn btn-secondary btn-sm" title="Detail"><i class="typcn typcn-clipboard"></i></a></td>
                        </tr>`;
                });  
            }
            
            $('.saldo').html(data.saldo);
            $('.wa_aktif').html(data.wa_aktif);
            
             $('.tagihan').html(data.tagihan);
            //$('.masak_aktif').html(data.masak_aktif.hari+' Hari');
            $('#list-biling').html(list);
        });
}

    $('body').delegate('.konfirmasimanual','click',function(e)
    {
        var id_history=$(this).closest('tr').data('id');
        $('#ModalKonfirmasiManual').find('input[name="id_history"]').val(id_history);
        $('#ModalKonfirmasiManual').modal({backdrop: 'static',keyboard: false});

    });
    $(".dropify").dropify();

const handlesimpantransfer = (e) => 
        {
           
            e.preventDefault();
            const Form     = new FormData(form_konfirmasimanual);
            Form.append('_token', '{{csrf_token()}}');
            $('#form_konfirmasimanual').find('input[name="keterangan"]').attr('disabled','disabled');
            $('#form_konfirmasimanual').find('input[name="tanggal_transfer"]').attr('disabled','disabled');
            $('#form_konfirmasimanual').find('button').html('Kirim Konfirmasi <i class="fa fa-spin fa-circle-o-notch"></i>');

            fetch('{{route('simpan_konfirmasi')}}', { method: 'POST',body:Form}).then(res => res.json()).then(data => 
            {
                $('#form_konfirmasimanual').find('input[name="keterangan"]').removeAttr('disabled','disabled');
                $('#form_konfirmasimanual').find('input[name="tanggal_transfer"]').removeAttr('disabled','disabled');
                $('#form_konfirmasimanual').find('button').html('Kirim Konfirmasi');

                if(!data.error)
                {
                    $('.msg_alert_transfer').html('<div class="alert alert-success text-center">'+data.alert+'</div>');
                    page_list_his();
                }
                else
                {

                    $('.msg_alert_transfer').html('<div class="alert alert-danger text-center">'+data.alert+'</div>');
                }

            });
           
        }

        form_konfirmasimanual.addEventListener('submit', handlesimpantransfer);

        $('body').delegate('.perpanjang','click',function(e)
        {
            e.preventDefault();
            $(this).html('<i class="fa fa-spin fa-circle-o-notch"></i> Perpanjang');
            var id_perpanjang   =$(this).closest('tr').data('id');
            const Form          = new FormData();
            Form.append('_token', '{{csrf_token()}}');
            Form.append('id_perpanjang', id_perpanjang);

            fetch('{{route('perpanjang_konfirmasi')}}', { method: 'POST',body:Form}).then(res => res.json()).then(data => 
            {
                $(this).html('Perpanjang');

                if(!data.error)
                {
                    $('#alert_masaaktif').modal('show');
                    $('.msg_alert_masaaktif').html('<div class="alert alert-success">'+data.alert+'</div>');
                }else
                {

                    $('#alert_masaaktif').modal('show');
                    $('.msg_alert_masaaktif').html('<div class="alert alert-warning">'+data.alert+'</div>');
                }
                 page_list_his();
            });

        });
        });
    </script>

    @endsection