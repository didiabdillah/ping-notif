            @extends('layouts.apphome')

            @section('content')
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Whatsapp</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Whatsapp</h4>
                    </div> 
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                        

                        <div class="col-lg-12 col-sm-12">
                            <button class="btn btn-info btn-round mb-10" type="button" id="tambahNOwa"><i class="fa fa-whatsapp"></i> Tambah</button>

                            @if(\Session::has('error-report'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button> 
                                {{\Session::get('error-report')}}.
                            </div>
                            @endif
                            <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nomor WA</th>
                                    <th>Masa Aktif</th>
                                    <th>API Key</th>
                                     <th>Status Pengguna</th>
                                     <th>Tanggal Expired</th>
                                     <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($whatsapp) > 0)
                                <?php 
                                $skipped = $whatsapp->currentPage() * $whatsapp->perPage();
                                foreach($whatsapp as $wa)
                                {
                                    $encrypt = $wa->number; 
                                    $clss='success';
                                    if($wa->masa_aktif<=8)
                                    {
                                        $clss='warning';
                                    }
                                    if($wa->masa_aktif<=0)
                                    {
                                        $clss='danger';
                                    }
                                ?>
                                <tr>
                                    <td>{{$wa->number}}</td>
                                    <td><center><span class="badge badge-{{$clss}}">{{$wa->masa_aktif}}</span></center></td>
                                    <td><center>{!!$wa->token?'<input  class="form-control" value="'.$wa->token.'">':'Belum di konfigurasi'!!}</center></td>
                                    <td><center>{{$wa->trial}}</center></td>
                                    <td><center>{{$wa->tgl_expired}}</center></td>
                                    <td>
                                        <a class="btn btn-success btn-sm" title="konfigurasi" href="{{url('whatsapp/configurasi/'.$encrypt)}}" style="color: white;"><i class="fa fa-gear"></i></a>
                                         <a class="btn btn-warning btn-sm" title="history" href="{{url('whatsapp/detail/'.$encrypt)}}"  style="color: white;"><i class="mdi mdi-clock-fast"></i></a>
                                        <a class="btn btn-danger btn-sm setujui_hapus"  title="Hapus No hp" href="#" data-id="{{$encrypt}}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                }?>@else
                                <tr>
                                    <td colspan="6">
                                        <center><b>Belum ada data yang ditambahkan</b></center>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {!!$whatsapp->links()!!}
                        </div>
                
                </div>
            </div>
                <!-- konfirmasi manual -->
            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalTambahnoHp">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center mt-0">Tambah  No HP</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="msg_alert">

                            </div>
                            <form name="simpanWa" id="simpanWa">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="msgalert"></div>
                                    </div> 
                                    <div class="col-lg-12 col-sm-12">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="no_whatsapp" placeholder="628xxx" minlength="12" maxlength="15"> <span class="input-group-append"><button class="btn btn-primary" type="submit">Tambah <i class="fa fa-whatsapp"></i></button></span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Saldo -->    
            <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="Modalhapus">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center mt-0">Perhatian!!!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form name="HapusData" id="hapusData">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12  text-center">
                                    <div class="alert alert-danger"><center>Anda yakin untuk menghapus no WA ini</center>
                                   </div>
                                        <button class="btn btn-danger" type="submit">Hapus <i class="fa fa-trash-o"></i></button>
                                        <button class="btn btn-success backdelete" type="button">Batal <i class="fa fa-rotate-left"></i></button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        <script type="text/javascript">
        $(document).ready(function(e)
        {
            const idsimpanWa        =document.getElementById('simpanWa');
            const formsimpanWa      = document.forms.namedItem('simpanWa');
            const hapusData      = document.forms.namedItem('hapusData');
            @if(count($whatsapp) <=0)
            $('#modalTambahnoHp').modal('show');
            @endif
            $('body').delegate('#tambahNOwa','click',function(e)
            {
                e.preventDefault();
                $('#modalTambahnoHp').modal('show');
            });

            const handlebsimpan = (e) => 
            {
                e.preventDefault();
                $('#simpanWa').find('button').html('Tambah <i class="fa fa-spin fa-circle-o-notch"></i>');
                const Form_Data         = new FormData(formsimpanWa);
                Form_Data.append('_token','{{csrf_token()}}');
                var no_whatsapp         =$('input[name="no_whatsapp"]').val(); 
                fetch('{{route('save_no_wa')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
                { 
                    if(data.error)
                    {
                        $('.msgalert').html(`
                             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button> `+data.alert+`
                            </div>`);
                    }else
                    {
                        location.href='{{url('whatsapp/configurasi')}}/'+no_whatsapp;
                        //location.reload();
                    }
                    $('#simpanWa').find('button').html('Tambah <i class="fa fa-whatsapp"></i>');
               
                });
            } 
            formsimpanWa.addEventListener('submit', handlebsimpan);

            $('body').delegate('.setujui_hapus','click',function(e)
            {
                e.preventDefault();
                window.id_delete=$(this).data('id');
                $('#Modalhapus').modal('show');

            });
             $('body').delegate('.backdelete','click',function(e)
            {
                e.preventDefault();
                $('#Modalhapus').modal('hide');

            });
        const hendhapusData = (e) => 
            {
                e.preventDefault();
                $('#HapusData').find('button[type="submit"]').html('Hapus <i class="fa fa-spin fa-circle-o-notch"></i>');
                const Form_Data     = new FormData();
                var id_delete       = window.id_delete;
                Form_Data.append('_token','{{csrf_token()}}');
                Form_Data.append('id_delete',id_delete); 
                fetch('{{route('delete_no_wa')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
                { 
                   location.reload();
                });
            }  

            hapusData.addEventListener('submit', hendhapusData);
        });
        </script>
                @endsection