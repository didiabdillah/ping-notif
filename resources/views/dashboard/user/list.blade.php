            @extends('layouts.apphome')

            @section('content')
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="float-right">
                            <ol class="breadcrumb">
                                <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Amezia</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li> -->
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>
                        <h4 class="page-title">User</h4></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pb-3 mt-0">List User</h5>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <a href="{{route('tambahuser')}}" class="btn btn-info">Tambah User</a>
                                </div>
                            </div>
                            <br>
                            @if (\Session::has('berhasil'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> <i class="mdi mdi-check-circle mr-2"></i>{{ Session::get('berhasil')}}
                            </div>
                            @endif
                            <div class="table-responsive">
                                <table id="datatable" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Akses WhatsApp</th>
                                            <th>Akses SMS</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($user) > 0)
                                            <?php $no = 1; $skipped = $user->currentPage() * $user->perPage(); ?>
                                            @foreach($user as $us)
                                            <?php
                                                $encrypt = base64_encode('user_'.$us->id);
                                            ?>
                                            <tr>
                                                <td>{{ $skipped + $no - 10 }}</td>
                                                <td>{{$us->name}}</td>
                                                <td>{{$us->email}}</td>
                                                <td>
                                                    <ul>
                                                        <?php
                                                        $hak_akses = unserialize($us->hak_akses_wa);
                                                        $akses = DB::table('wa_account')->whereIn('id',$hak_akses)->get();
                                                        foreach ($akses as $key) {
                                                            echo "<li>".$key->number."</li>";
                                                        }

                                                        ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <?php
                                                        $hak_akses = unserialize($us->hak_akses_sms);
                                                        $akses = DB::table('sms_account')->whereIn('id',$hak_akses)->get();
                                                        foreach ($akses as $key) {
                                                            echo "<li>".$key->number."</li>";
                                                        }

                                                        ?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" href="{{url('user/edit/'.$encrypt)}}" style="color: white;">
                                                            Edit
                                                    </a>
                                                    <a class="btn btn-danger btn-sm setujui" href="#" data-id="{{$encrypt}}" data-target="#modalperingatanhapus" data-toggle="modal" type="button" style="color: white;" data-backdrop="static" data-keyboard="false">
                                                            Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5" ><center><b>Belum ada data yang ditambahkan</b></center></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                {!!$user->links()!!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- peringatan hapus -->
                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalperingatanhapus">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center mt-0" id="exampleModalLabel">Peringatan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <p>Apakah anda yakin ingin menghapus user ini?</p>
                                <center>
                                    <!-- <input type="hidden" name="dataabsen" id="dataabsenlembursetujui" value=""> -->
                                    <button type="button" id="hapussetujui" class="btn btn-info">Yakin</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
                                </center>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Berhasil hapus -->
                <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="berhasilhapus">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title align-self-center mt-0" id="exampleModalLabel">Pemberitahuan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="tutuphapus"><span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <center>
                                    <p style="color: #0acf97!important; font-size:40px!important;"><i class="mdi mdi-check-circle mr-2"></i></p>
                                    <p style="font-size:18px!important;">Berhasil Mengahapus User<p>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(window).on('load',function() {
                        $('body').delegate('.setujui','click',function(e)
                        {   
                            var id = $(this).data('id');
                            $('#hapussetujui').data('id', id);
                            e.preventDefault();;
                        });
                        $('body').delegate('#hapussetujui','click',function(e)
                        {
                            var id=$(this).data('id');
                            var _token='{{csrf_token()}}';
                            $.ajax({
                                    url : '{{route('hapususer')}}',
                                    type : "post",
                                    async: false,
                                    data:{id:id,_token:_token},
                                    cache: true,
                                    dataType: 'json',
                                    success : function(data) {
                                         $('#modalperingatanhapus').modal('hide');
                                         $("#berhasilhapus").modal({backdrop: 'static', keyboard: false});
                                        }
                                    });
                            e.preventDefault();
                        });
                        $('body').delegate('#tutuphapus','click',function(e)
                        {
                            location.reload();
                        });
                    });
                </script>
                @endsection