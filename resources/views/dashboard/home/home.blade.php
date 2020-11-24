@extends('layouts.apphome')

@section('content')
<style type="text/css">
    .wd-10 {
    margin-right: 89px;
}
.count_data {
    position: absolute;
    font-size: 22px;
    right: 14px;
    bottom: 0;
    text-align: right;
}
.count_data a {
    color: #fff;
    font-size: 12px;
}
</style>
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <!-- <li class="breadcrumb-item"><a href="javascript:void(0);">Amezia</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li> -->
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
            <h4 class="page-title">Dashboard</h4></div>
        </div>
    </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-dark">
                            <div class="card-body min-height-155">
                                <h3 class="wd-10">No Whatsapp</h3> 
                                <div class="count_data"><h2>{{$datawa}}</h2><a href="/whatsapp">Detail</a></div>

                            </div>
                            
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body min-height-155">
                                <h3 class="wd-10">Saldo</h3> 
                                <div class="count_data"><h2>{{$saldo}}</h2><a href="/billing">Detail</a></div>

                            </div>
                            
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body min-height-155">
                                <h3 class="wd-10">Tagihan</h3> 
                                <div class="count_data"><h2>{{$tagihan}}</h2><a href="/billing">Detail</a></div>

                            </div>
                            
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>
    
</div>
@endsection