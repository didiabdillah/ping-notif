            @extends('layouts.apphome')

            @section('content')
            
   <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="float-right">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('whatsapp')}}">WhatsApp</a></li>
                        <li class="breadcrumb-item active">Domain</li>
                    </ol>
                </div>
                <h4 class="page-title">Domain</h4>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="modal-title align-self-center mt-0">Authentifikasi Domain</h5>
                    <form name="simpandomain" id="simpandomain">
                        <div class="row">
                            <div class="col-lg-12 col-sm-12">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="domain" placeholder="domain.com" maxlength="50"> <span class="input-group-append"><button class="btn btn-primary" type="submit"><i class="fa fa-globe"></i></button></span>
                                </div>
                             </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="msgalert"></div>
                            </div>
                        </div> 
                    </form>

                    <div class="row">
                        <div class="col-lg-12 col-sm-12">
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
                                    <th>Domain</th>
                                     <th>Tanggal Buat</th>
                                     <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($domain) > 0)
                                <?php 
                                foreach($domain as $dom)
                                {
                                   
                                ?>
                                <tr>
                                    <td>{{$dom->domain}}</td>
                                    <td>{{$dom->created_at}}</td>
                                    <td>
                                        <a class="btn btn-danger btn-sm setujui_hapus"  title="Hapus No hp" href="#" data-id="{{$dom->id_domain}}">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                }?>@else
                                <tr>
                                    <td colspan="5">
                                        <center><b>Belum ada data yang ditambahkan</b></center>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {!!$domain->links()!!}
                        </div>
                
                </div>
            </div>
        </div>
    </div>
    </div>
         <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="page-title">History Wa</h4>
                           <div class="table-responsive">
                        <table id="datatable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                     <th>No Tujuan</th>
                                     <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($domain) > 0)
                                <?php 
                                foreach($dt_history as $history)
                                {
                                   
                                ?>
                                <tr>
                                    <td>{{Helpers::keIndonesia($history->created_at,true,false)}}</td>
                                    <td>{{$history->no_tujuan}}</td>
                                    <td>{{$history->isi_pesan}}</td>
                                </tr>
                                <?php 
                                }?>@else
                                <tr>
                                    <td colspan="5">
                                        <center><b>Belum ada data</b></center>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                        {!!$dt_history->links()!!}
                    </div>
                </div>
            </div> 
    </div>  
        
         <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="TambahDomain">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center mt-0">Authentifikasi Domain</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="msg_alert">

                            </div>
                                <form name="simpandomain1" id="simpandomain1">
                                <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" name="domain" placeholder="domain.com" maxlength="50"> <span class="input-group-append"><button class="btn btn-primary" type="submit"><i class="fa fa-globe"></i></button></span>
                                </div>
                                </div>
                                <div class="col-lg-12 col-sm-12">
                                <div class="msgalert"></div>
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

            const idsimpansimpandomain        =document.getElementById('simpandomain');
            const formsimpansimpandomain      = document.forms.namedItem('simpandomain');
            const formsimpansimpandomain1      = document.forms.namedItem('simpandomain1');

            const handlebsimpan = (e) => 
            {
                e.preventDefault();
                const Form_Data         = new FormData(formsimpansimpandomain);
                Form_Data.append('_token','{{csrf_token()}}');
                Form_Data.append('no_hp','{{Request::segment('3')}}');
                fetch('{{route('simpandomain')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
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
                        location.reload();
                    }

               
                });
            } 

            formsimpansimpandomain.addEventListener('submit', handlebsimpan);

             @if(count($domain) <= 0)
                $('#TambahDomain').modal('show');
                    const handlebsimpan1 = (e) => 
                    {
                    e.preventDefault();
                    const Form_Data         = new FormData(formsimpansimpandomain1);
                    Form_Data.append('_token','{{csrf_token()}}');
                    Form_Data.append('no_hp','{{Request::segment('3')}}');
                    fetch('{{route('simpandomain')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
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
                            location.reload();
                        }


                    });
                    } 
                  formsimpansimpandomain1.addEventListener('submit', handlebsimpan1);
            @endif
            $('body').delegate('.setujui_hapus','click',function(e)
            {
                    e.preventDefault();
                    var dataid=$(this).data('id');
                    const Form_Data         = new FormData();
                    Form_Data.append('_token','{{csrf_token()}}');
                     Form_Data.append('dataid',dataid);
                    fetch('{{route('deleteDomain')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
                    { 
                       location.reload();
                    });

            });
            
        });
        </script>
                @endsection