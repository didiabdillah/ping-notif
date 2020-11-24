            @extends('layouts.apphome')

            @section('content')
             <style type="text/css">
				.no_tujuan {
				border: 1px solid #ccc;
				border-radius: 6px;
				min-height: 37px;
				padding: 5px;
				}

				input#essai {
				        border: unset;
    height: 29px;
    margin: -1px -3px;
    font-size: 14px;
    background: transparent;
    width: 60%!important;
				}
				.no_tujuan span {
				border: 1px solid #ccc;
				text-align: center;
				padding: 4px;
				line-height: 1px;
				border-radius: 5px;
				}
             </style>
            
             <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Pesan Otomatis</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Pesan Otomatis</h4>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                		<button class="btn btn-info btn-round mb-10" type="button" id="tambahscedule"><i class="fa fa-paper-plane"></i> Tambah</button>
                </div>
                <div class="table-responsive">
                	<table class="table"> 
                		<thead>
                			<tr>
                				<td>Nomor Wa</td>
                				<td>Pesan</td>
                				<td>Tanggal terbit</td>
                				<td>Jam terbit</td>
        								<td>Berulang</td>
        								<td>Status</td>
                        <td>Aksi</td>
                    	</tr>
                		</thead>
                		<tbody>
                			@if(count($dt_list) > 0)
                			@foreach($dt_list as $key)
                			<tr>
								<td>{{$key->nomor}}</td>
								<td>{{$key->pesan}}</td>
								<td>{{$key->tgl_terbit}}</td>
								<td>{{$key->jam_terbit}}</td>
								<td>{{$key->setiap_waktu=='ya'?'Pesan Berulang':'Tidak Berulang'}}</td>
								<td>{{$key->status}}</td>
                <td>
                  <a  class="btn btn-success btn-sm edit" title="edit" href="#" 

                      data-no_tujuan="{{json_encode($key->nomor_kirim_wa)}}" 
                      data-id="{{$key->id_otomatis}}"
                      data-pesan="{{$key->pesanori}}"
                      data-id_wa="{{$key->id_wa}}"
                      data-tgl_terbit="{{$key->tanggal_terbit}}"
                      data-waktu="{{$key->waktu}}"
                      data-status="{{$key->status}}"
                      data-setiap_waktu="{{$key->setiap_waktu}}"

                      style="color: white;">
                  <i class="fa fa-gear"></i>
                </a>
                <a class="btn btn-danger btn-sm Hapus" title="Hapus data" href="#"  style="color: white;">
                  <i class="fa fa-trash-o"></i></a></td>
							</tr>
							@endforeach
							@else
							<tr>
							<td colspan="6">
							    <center><b>Belum ada data yang ditambahkan</b></center>
							</td>
							</tr>
							@endif
                		</tbody>
                	</table>
                </div>
                {!!$dt_list->links()!!}
            </div>


             <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalTambahotomatis">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title align-self-center mt-0">Tambah Pesan otomatis</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <div class="msg_alert">

                            </div>
                            <form name="simpanpesan" id="simpanpesan">
                                <div class="msgalert"></div>
                              	<div class="form-group row">
                              		<div class="col-md-12">
                              			<label>Pesan</label>
                              			<textarea class="form-control" name="pesan"></textarea>
                              		</div>
                                </div>
                                <div class="form-group row">
                              		<div class="col-md-6">
                              			<label>Nomor WA Pengirim</label>
                              			<select class="form-control" name="id_wa">
                              				<option>--Pilih No WA--</option>
                              				<?
                              				$dt=DB::table('wa_account')->select('id','number')->where('user_id',Auth::user()->id)->where('status','aktif')->get();
                              				foreach ($dt as $key) {
                              					echo '<option value="'.$key->id.'">'.$key->number.'</option>';
                              				}
                              				?>
                              			</select>
                              		</div>
                              		<div class="col-md-6">
                              			<label>Nomor WA Penerima</label>
                              			<div class="no_tujuan">
                              				<input type="text" name="no_penerima" id="essai" maxlength="15" minlength="10" >
                              			</div>
                              			
                              		</div>
                                </div>
                                <div class="form-group row">
                                	<div class="col-md-6">
                                		<label>Tanggal Terbit</label>
                                		<input type="date" name="tanggal_terbit" class="form-control"  >
                                	</div>
                                	
                                	<div class="col-md-6">
                                	<?$jam='';for($i=0;$i<=59;$i++){if($i<=23){$ij=strlen($i)==1?'0'.$i:$i;$jam.='<option value="'.$ij.'">'.$ij.'</option>';}}?>
                                		<label>Tanggal Terbit</label>
                                		<div class="input-group">

                                            <select class="form-control" name="jam">
                                            	<?=$jam;?>
                                            </select>
                                             <select class="form-control" name="menit">
                                            	<option value="00">00</option>
                                            	<option value="30">30</option>
                                            </select>
                                        </div> 
                                	</div>
                                </div>
                								<div class="form-group row">
                								    <label class="col-md-3 my-2 control-label">Kontrol</label>
                								    <div class="col-md-9" >
                								        <div class="checkbox my-2" >
                								            <div class="custom-control custom-checkbox" >
                								                <input name="setiap_waktu" type="checkbox" class="custom-control-input"  checked=""  id="customCheck02" data-parsley-multiple="groups" data-parsley-mincheck="2">
                								                <label class="custom-control-label" for="customCheck02">Kirim Berulang</label>
                								            </div>
                								        </div>
                								        <div class="checkbox my-2" >
                								            <div class="custom-control custom-checkbox" >
                								                <input name="status" type="checkbox" class="custom-control-input" checked="" id="customCheck3" data-parsley-multiple="groups" data-parsley-mincheck="2">
                								                <label class="custom-control-label" for="customCheck3">Aktifkan</label>
                								            </div>
                								        </div> 
                								       
                								    </div>
                								</div>



                                <div class="form-group"> 
	                            	<button class="btn btn-primary" type="submit">
	                            		Simpan <i class="mdi mdi-alarm-plus"></i>
	                            	</button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- tambah --> 
            <script type="text/javascript">
            	 $(document).ready(function(e)
		        {
		            const idsimpanpesan    =document.getElementById('simpanpesan');
		            const simpanpesan      = document.forms.namedItem('simpanpesan');
		         
		            $('body').delegate('#tambahscedule','click',function(e)
		            {
		                e.preventDefault();
		                $('.msg_alert').empty();
                    $('textarea[name="pesan"]').val('');
                    $('input[name="no_penerima"').val('');
                    $('.no_tujuan span').remove();
                    $('input[name="tanggal_terbit"]').val('');
		                $('#modalTambahotomatis').modal('show');
                    window.id_oto=undefined;
		            });

                $('body').delegate('.edit','click',function(e)
                {
                  $('.msg_alert').empty();
                  $('textarea[name="pesan"]').val(''); 
                  $('input[name="no_penerima"').val('');
                  $('.no_tujuan span').remove();
                  $('input[name="tanggal_terbit"]').val('');
                  window.id_oto     =undefined;
                  var dat_no        =$(this).data('no_tujuan');
                  var pesan         =$(this).data('pesan');
                  var  id_wa        =$(this).data('id_wa');
                  var  tgl_terbit   =$(this).data('tgl_terbit');
                  var  waktu        =$(this).data('waktu');
                  var  status       =$(this).data('status');
                  var  setiap_waktu =$(this).data('setiap_waktu');
                  var jam           =waktu.split(':')[0];
                  var menit         =waktu.split(':')[1];
                  window.id_oto     =$(this).data('id');
                  $.each(dat_no,function(k,l)
                  {
                      $('.no_tujuan').prepend('<span>'+l+'<i class=" typcn typcn-delete"></i></span>');
                  });
                  $('textarea[name="pesan"]').val(pesan);
                  console.log('select[name="jam"] option[value="'+jam+'"]');
                  $('select[name="id_wa"] option[value="'+id_wa+'"]').attr('selected','selected');
                  $('select[name="jam"] option[value="'+jam+'"]').attr('selected','selected');
                  $('select[name="menit"] option[value="'+menit+'"]').attr('selected','selected');
                  $('input[name="tanggal_terbit"]').val(tgl_terbit);
                  if(status=='non_aktif')
                  {
                    $('input[name="status"]').prop('checked',false);
                  }
                  if(setiap_waktu=='tidak')
                  {
                    $('input[name="setiap_waktu"]').prop('checked',false);
                  }
                    
                  $('#modalTambahotomatis').modal('show');
                });






		            const handlebsimpan = (e) => 
		            {
		                e.preventDefault();
		                 $('.msg_alert').empty();
		                $('#simpanpesan').find('button').html('Simpan <i class="fa fa-spin fa-circle-o-notch"></i>');
		                const Form_Data         = new FormData(simpanpesan);
		                Form_Data.append('_token','{{csrf_token()}}');
		                $('.no_tujuan span').each(function(r,v)
		                {
 							        Form_Data.append('no_tujuan[]',$(v).text());
		                });
                    if(window.id_oto!=undefined)
                    {
                      Form_Data.append('id_otomatis',window.id_oto);
                    }
		                fetch('{{route('simpan_pesan_otomatis')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
		                { 
			                $('#simpanpesan').find('button').html('Simpan <i class="mdi mdi-alarm-plus"></i>');
			                if(data.error)
			                {
			                	  $('.msg_alert').html('<div class="alert alert-danger">'+data.alert+'</div>');
			                }
			                else
			                {
									       $('.msg_alert').html('<div class="alert alert-success">'+data.alert+'</div>');
                          setInterval(function(){ location.reload();},1000);
									
			                }
			                
		                });
		            } 
		          $('body').delegate('#essai','keyup',function(e)
		          {
		          	e.preventDefault();
		          	var value_=$(this).val();
        					if (e.which === 32)  
        					{
        						$(this).val('');
        						$(this).closest('div').prepend('<span>'+value_+'<i class=" typcn typcn-delete"></i></span>');
        					}
		          	
		          });
		          $('body').delegate('.no_tujuan .typcn-delete','click',function(e)
		          {
		          	e.preventDefault();
		          	$(this).closest('span').remove();
		          });
		           idsimpanpesan.addEventListener('submit', handlebsimpan);
		        });
            </script>   
            @endsection