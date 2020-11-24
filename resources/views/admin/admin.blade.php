@extends('layouts.apphome')
@section('content')
<style type="text/css">
    .count_data {
    position: absolute;
    right: 0px;
    background: rgb(212 22 22);
    padding: 5px;
    min-width: 97px;
    min-height: 99px;
    text-align: right;
}

.card-body-user{
    position: relative;
    overflow: hidden;
}
.card.text-white.bg-dark {
    margin: 5px;
}
.bg-tbl {
    width: 100%;
    margin-bottom: 1rem;
    background-color: #fff;
    color: #000;
}
.modal-content img{
    width: 100%;
    height: auto;
}
</style>
<div class="card">

    <div class="card-body">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item"><a href="{{route('super_admin')}}" class="nav-link active" >User</a></li>
            <li class="nav-item"><a href="{{route('super_admin_billing')}}" class="nav-link" >Billing</a></li>
            <li class="nav-item"><a href="{{route('super_admin_konfirmasi')}}" class="nav-link" >Konfirmasi</a></li>
        </ul>
        
            <div class="col-sm-12">
                <div class="page-title-box">
                    <div class="float-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">Data User</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Data User</h4>
                </div>
            </div>
            <form action="{{route('super_admin')}}" method="get">
                <div class="row justify-content-end">
                    <div class="col-md-3">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="cari" value="{{$cari}}" placeholder="Cari" aria-label="Cari"> 
                            <span class="input-group-append">
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        <div class="table-responsive">

            <table class="table table-bordered mp-10 list_user">
                <thead>
                    <tr>
                        <td>name</td>
                        <td>email</td>
                        <td>created_at</td>
                        <td>cek data</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $key)
                <tr>
                    <td>{!!$key->name!!}</td>
                    <td>{!!$key->email!!}</td>
                    <td>{!!Helpers::keIndonesia($key->created_at)!!}</td>
                    <td><a href="#" class="btn btn-success" data-nama_user="{{$key->name}}" data-id="{{$key->id}}">cek
                        {!!$key->konf!=0?'<span class="badge badge-danger">'.$key->konf.'</span>':''!!}</a></td>
                </tr>
                @endforeach
                </tbody>
            </table>
           
        </div>
         {{@$paginator->links()}}
    </div>
</div>

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modellihatuser">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center mt-0" >Detail<span></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card text-white bg-dark">
                                    <div class="card-body min-height-155 card-body-user">
                                        <h3 class="wd-10">Saldo</h3> 
                                            <div class="count_data saldo"></div>
                                        </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card text-white bg-dark">
                                    <div class="card-body min-height-155 card-body-user">
                                        <h3 class="wd-10">Tagihan</h3> 
                                            <div class="count_data tagihan"></div>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card text-white bg-dark">
                                    <div class="card-body min-height-155 card-body-user">
                                        <h3 class="wd-10">No WA</h3> 
                                            <div class="count_data datawa"></div>
                                        </div>
                                </div>
                            </div>
                             <div class="col-md-12">
                                <hr>
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-toggle="tab" href="#konfirmasi" role="tab">Konfirmasi</a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-toggle="tab" href="#nowalist" role="tab">No Wa</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="konfirmasi" role="tabpanel">
                                        <div class="card text-white bg-dark">
                                            <div class="card-body min-height-155 card-body-user">
                                                    <div class="table-responsive">
                                                        <table class="table bg-tbl">
                                                            <tr>
                                                                <td>Konfirm</td>
                                                                 <td>Tgl</td>
                                                                  <td>Tgl Trans</td>
                                                                  <td>Bukti</td>
                                                                  <td>Aksi</td>
                                                            </tr>
                                                            <tbody id="Konfirmasiuser">
                                                            </tbody>
                                                        </table>
                                                    </div> 
                                                </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nowalist" role="tabpanel">
                                        <div class="card text-white bg-dark">
                                            <div class="card-body min-height-155 card-body-user">
                                        <div class="table-responsive">
                                            <table class="table bg-tbl">
                                                <tr>
                                                    <td>No Wa</td>
                                                     <td>Masa Aktif</td>
                                                      <td>Status Langganan</td>
                                                </tr>
                                                <tbody id="list_wa_user">
                                                </tbody>
                                            </table>
                                        </div> 
                                         </div> 
                                          </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="Showimg">
    <div class="modal-dialog modal-dialog-centered">
       
        <div class="modal-content" >
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="img_detail"></div>
        </div>
    </div>
</div>


        <script type="text/javascript">
            $(document).ready(function(e)
            {
                $('body').delegate('.list_user a','click',function(e)
                {
                    e.preventDefault();
                    window.id_user=$(this).data('id');
                    window.nama_user=$(this).data('nama_user');
                        $('.modal-title span').empty();
                        $('.ms_aktif').empty();
                        $('.saldo').empty();
                        $('.tagihan').empty();
                        $('.datawa').empty();
                        $('#Konfirmasiuser').empty();
                    $('#modellihatuser').modal('show');


                });

                $('#modellihatuser').on('shown.bs.modal', function (e) 
                { 
                    var id_usr=window.id_user;
                       loaddatadetail(id_usr);
                });
             
                $('body').delegate('.show_img','click',function(e)
                {
                    e.preventDefault();
                    window.src      =$(this).data('src');
                    $('#Showimg').find('.img_detail').empty();
                    $('#Showimg').modal({backdrop: 'static',keyboard: false});
                });
                $('#Showimg').on('shown.bs.modal', function (e) 
                {
                    $(this).find('.img_detail').html('<img src="'+window.src+'" />');
                });
                $('#Konfirmasiuser').delegate('a','click',function(e)
                {
                    e.preventDefault();
                    var id_konfirmasi=$(this).closest('td').data('id_konfirmasi');
                    var aksi=$(this).text();
                    var sts_aksi;
                     switch(aksi)
                     {
                        case 'Batalkan':
                        sts_aksi='Batalkan';
                        break;
                        case 'Masukan':
                        sts_aksi='Masukan';
                        break;
                     }
                        const Form     = new FormData();
                        Form.append('_token', '{{csrf_token()}}');
                        Form.append('id_konfirmasi', id_konfirmasi);
                        Form.append('sts_aksi', sts_aksi);
                        fetch('{{route('konfirmasi_manual')}}', { method: 'POST',body:Form}).then(res => res.json()).then(data => 
                        {
                            loaddatadetail(data.id_user);
                            alert(data.alert);
                        });

                });

                function loaddatadetail(id_usr)
                  {
                           
                            const Form     = new FormData();
                            Form.append('_token', '{{csrf_token()}}');
                            Form.append('id_user', id_usr);
                            fetch('{{route('detail_user')}}', { method: 'POST',body:Form}).then(res => res.json()).then(data => 
                            {
                                $('.modal-title span').html(' '+window.nama_user);
                                $('.saldo').html('<h4>'+data.saldo+'</h4>');
                                $('.tagihan').html('<h4>'+data.tagihan+'</h4>');
                                $('.datawa').html('<h4>'+data.datawa+'</h4>');
                                var list="";
                                $.each(data.tb_konfirmasi,function(k,l)
                                {
                                   list += `<tr>
                                        <td>`+l.keterangan+`</td>
                                         <td>`+l.created_at+`</td>
                                          <td>`+l.tanggal_transfer+`</td>
                                          <td ><a data-src="`+l.bukti+`" href="#" class="show_img" >cek bukti</a></td>
                                          <td data-id_konfirmasi="`+l.id_konfirmasi+`"><a href="#" class="badge badge-danger">Batalkan</a><a href="#" class="badge badge-success">Masukan</a></td>
                                    </tr>`;
                                });
                                $('#Konfirmasiuser').html(list);
                                var list='';
                                $.each(data.wa_account,function(k,l)
                                {
var langganan=l.status_langganan==true?'<span class="badge badge-success">ya</span>':'<span class="badge badge-danger">tidak</span>';
                                        list +=`<tr>
                                                    <td>`+l.number+`</td>
                                                     <td>`+l.masa_aktif+` Hari</td>
                                                      <td>`+langganan+`</td>
                                                </tr>`;
                                });
                                $('#list_wa_user').html(list);


                            });
                  }  
            });
        </script>
@endsection
