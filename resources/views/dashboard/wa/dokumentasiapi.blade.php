            @extends('layouts.apphome')
            @section('content')
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Documentasi API</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Documentasi API</h4>
                    </div>
                </div>
            </div>

             <div class="row" >
                <div class="col-lg-8 col-sm-8">
                    <div class="card">
                        <div class="card-body">
                        <div class="code_crl m_tp">
                        <h2>Script API dengan PHP</h2>
                        <textarea rows="20px" readonly="readonly" class="form-control">
                        <?= htmlspecialchars('<?php
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "'.url('').'/api-whatsapp",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "number_phone=628XXX&message=Test Pesan Wa",
                        CURLOPT_HTTPHEADER => array(
                            "key: 3412c74f30b5d3d747b20bda15a47752",
                            "Content-Type: application/x-www-form-urlencoded"
                          ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        echo $response;
                        ?>
                        ')?>
                            
                        </textarea>
                        </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-4 col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h4>Coba Kirim Pesan WA</h4>
                            <form id="kirimwa" name="kirimwa">
                                <div class="msg_alert"></div>
                                <div class="form-group">
                                    <label>API Key</label>
                                    <input type="text" name="apikey" class="form-control">
                                    <a href="#"  class="badge badge-info float-right" id="lht_api">lihat api</a>
                                </div>
                                <div class="form-group">
                                    <label>Nomor WA tujuan</label>
                                    <input type="text" name="nomor_hp" class="form-control" placeholder="628xxx">
                                </div>
                                <div class="form-group">
                                    <label>Pesan</label>
                                    <textarea class="form-control" name="pesan" id="editor1"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="Kirimpesan" class="btn btn-success" value="Kirim Pesan">Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
                       <!-- lihatapi -->
     <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="ModallihatApi">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title align-self-center mt-0" >List ApiKey</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive">
                            <table class="table">
                            <thead>
                                <tr>
                                    <td>Nomor HP</td>
                                    <td>Api Key</td>
                                    <td>Pilih</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($wa_account as $key)
                                <tr>
                                    <td>{{$key->number}}</td>
                                    <td>{{$key->token}}</td>
                                    <td><a href="#" data-id="{{$key->number}}" data-key="{{$key->token}}">Gunakan</a></td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Saldo -->
        
            <script type="text/javascript">
                $(document).ready(function(e)
                {
                   
                    const kirimwa   =document.forms.namedItem('kirimwa');
                    const lht_api   =document.getElementById('lht_api');
                    const handlebtn = (e) => 
                    {
                        e.preventDefault();
                        $('.msg_alert').empty();
                        $('#ModallihatApi').modal({backdrop: 'static',keyboard: false});
                    }
                    lht_api.addEventListener('click', handlebtn);
                    $('body').delegate('#ModallihatApi td a','click',function(e)
                    {
                        $('input[name="apikey"]').val($(this).data('key'));
                        $('#ModallihatApi').modal('hide');
                        var isi         =$('.code_crl textarea').text();
                        var keyapi      =window.keyapi==undefined?'key: 3412c74f30b5d3d747b20bda15a47752':window.keyapi;
                        var isi_2       =isi.replace(keyapi,'key: '+$(this).data('key'));
                        window.keyapi   ='key: '+$(this).data('key');
                        $('.code_crl textarea').text(isi_2);
                        e.preventDefault();
                    });

                     const handlesimpan = (e) => 
                    {

                        e.preventDefault();
                        const Form     = new FormData(kirimwa);
                        Form.append('_token', '{{csrf_token()}}');
                        $('input[name="apikey"]').attr('disabled','disabled');
                        $('input[name="nomor_hp"]').attr('disabled','disabled');
                        $('textarea[name="pesan"]').attr('disabled','disabled');
                        $('#kirimwa').find('button').attr('disabled','disabled');
                        $('#kirimwa').find('button').html('Kirim <i class="fa fa-spin fa-circle-o-notch"></i>');
                        fetch('{{route('kirim_wa_manual')}}', { method: 'POST',body:Form}).then(res => res.json()).then(data => 
                        {

                            $('input[name="apikey"]').removeAttr('disabled','disabled');
                            $('input[name="nomor_hp"]').removeAttr('disabled','disabled');
                            $('textarea[name="pesan"]').removeAttr('disabled','disabled');
                            $('#kirimwa').find('button').removeAttr('disabled','disabled');
                            $('#kirimwa').find('button').html('Pilih Paket');
                            if(!data.error)
                            {
                                $('.msg_alert').html('<div class="alert alert-success text-center">'+data.status+'</div>');
                            }
                            else
                            {

                                $('.msg_alert').html('<div class="alert alert-danger text-center">'+data.status+'</div>');
                            }

                        });

                    }
                    kirimwa.addEventListener('submit', handlesimpan);

                    $('body').delegate('input[name="nomor_hp"]','keyup',function(e)
                    {
                        e.preventDefault();
                        var no_hp   =$(this).val();
                        var isi     =$('.code_crl textarea').text();
                        var windhp  =window.no_hp==undefined||window.no_hp==""?'628XXX':window.no_hp;
                        no_hp       =no_hp==""?'628XXX':no_hp;
                        var isi_2   =isi.replace('number_phone='+windhp,'number_phone='+no_hp);
                        $('.code_crl textarea').text(isi_2);
                         window.no_hp=no_hp;

                    });

                    $('body').delegate('textarea[name="pesan"]','keyup',function(e)
                    {
                        e.preventDefault();
                        var text_   =$(this).val();
                        var isi     =$('.code_crl textarea').text();
                        var wintext  =window.wintext==undefined||window.wintext==""?'Test Pesan Wa':window.wintext;
                        text_       =text_==""?'Test Pesan Wa':text_;
                        var isi_2   =isi.replace('&message='+wintext,'&message='+text_);
                        $('.code_crl textarea').text(isi_2);
                        window.wintext=text_;

                    });
                });
            </script>
            @endsection