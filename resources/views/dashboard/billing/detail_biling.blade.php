    @extends('layouts.apphome')
    @section('content')
   <div class="col-lg-12" bis_skin_checked="1">

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="float-right">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('billing')}}">Billing</a></li>
                    <li class="breadcrumb-item active">{{$dt_inv->id_invoice}}</li>
                </ol>
            </div>
            <h4 class="page-title">Billing</h4>
        </div>
    </div>
</div>



    <table class="body-wrap" style="width: 100%;">
        <tbody>
            <tr>
                <td valign="top"></td>
                <td class="container" width="600" style="display: block !important; max-width: 600px !important; clear: both !important;" valign="top">
                    <div class="content" style="padding: 20px;" bis_skin_checked="1">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style="border: 3px solid #44a2d2;">
                            <tbody>
                                <tr>
                                    <td class="content-wrap aligncenter" style="padding: 20px; background-color: #fff;" align="center" valign="top">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tbody>
                                                <tr >
                                                    <td colspan="4"  >
                                                        <a href="#"><img src="{{url('images\logo.png')}}" alt="" style="height: 60px; margin-left: auto; margin-right: auto; display: block;" /></a>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td  class="content-block aligncenter" style="padding: 20px 0 20px;" align="center" colspan="4"  valign="top">
                                                        <table class="invoice" style="width: 95%;">
                                                            <tbody>
                                                                <tr style="border-top: 2px solid #000;">
                                                                    <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; padding: 5px 0;" valign="top">
                                                                        No invoice : <b>{{$dt_inv->id_invoice}}</b>
                                                                       
                                                                    </td>
                                                                    <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; padding: 5px 0; text-align: right;" valign="top">
                                                                          Tanggal : <b>{{Helpers::keIndonesia($dt_inv->created_at,true,false)}}</b>
                                                                    </td>
                                                                </tr>
                                                                 <tr>
                                                                    <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; padding: 5px 0;" valign="top" {{$dt_inv->id_wa?'':'colspan="2"'}}>
                                                                       Status : <b>

                                                                        <span style="    
                                                                       display: inline-block;
                                                                        padding: .25em .4em;
                                                                        font-size: 75%;
                                                                        font-weight: 700;
                                                                        line-height: 1;
                                                                        text-align: center;
                                                                        white-space: nowrap;
                                                                        vertical-align: baseline;
                                                                        border-radius: .25rem;
                                                                        color: #fff;
                                                                        @if($dt_inv->status=='lunas')
                                                                        background-color: #007bff;
                                                                        @elseif($dt_inv->status=='pending')
                                                                        background-color: #c59519;
                                                                        @elseif($dt_inv->status=='konfirmasi')
                                                                        background-color: #218838;
                                                                        @elseif($dt_inv->status=='batal')
                                                                        background-color: #ef1e0e;
                                                                        @endif
                                                                        ">
                                                                        @if($dt_inv->status=='lunas')
                                                                        Sudah dibayar 
                                                                        @elseif($dt_inv->status=='pending')
                                                                        Belum bayar
                                                                        @elseif($dt_inv->status=='konfirmasi')
                                                                        Konfirmasi
                                                                        @else
                                                                        Batal
                                                                        @endif
                                                                    </span></b>
                                                                    </td>
                                                                    @if($dt_inv->id_wa)
                                                                     <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; padding: 5px 0; text-align: right;" valign="top">
                                                                        No Wa : <b>{{$dt_inv->number}}</b>
                                                                     </td>
                                                                    @endif
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <td style="padding: 5px 0;" valign="top" colspan="2">
                                                                        <table class="invoice-items" cellpadding="0" cellspacing="0" style="width: 100%;">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td
                                                                                        style="
                                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                                            font-size: 14px;
                                                                                            vertical-align: top;
                                                                                            border-top-width: 1px;
                                                                                            border-top-color: #eee;
                                                                                            border-top-style: solid;
                                                                                            margin: 0;
                                                                                            padding: 10px 0;
                                                                                        "
                                                                                        valign="top"
                                                                                    >
                                                                                        {{$dt_inv->ket_detail}}
                                                                                    </td>
                                                                                    <td
                                                                                        class="alignright"
                                                                                        style="
                                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                                            font-size: 14px;
                                                                                            vertical-align: top;
                                                                                            text-align: right;
                                                                                            border-top-width: 1px;
                                                                                            border-top-color: #eee;
                                                                                            border-top-style: solid;
                                                                                            margin: 0;
                                                                                            padding: 10px 0;
                                                                                        "
                                                                                        align="right"
                                                                                        valign="top"
                                                                                    >
                                                                                       {{$dt_inv->nominal}}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td
                                                                                        style="
                                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                                            font-size: 14px;
                                                                                            vertical-align: top;
                                                                                            border-top-width: 1px;
                                                                                            border-top-color: #eee;
                                                                                            border-top-style: solid;
                                                                                            margin: 0;
                                                                                            padding: 10px 0;
                                                                                        " 
                                                                                        valign="top"
                                                                                    >
                                                                                        Kode Unik
                                                                                    </td>
                                                                                    <td
                                                                                        class="alignright"
                                                                                        style="
                                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                                            font-size: 14px;
                                                                                            vertical-align: top;
                                                                                            text-align: right;
                                                                                            border-top-width: 1px;
                                                                                            border-top-color: #eee;
                                                                                            border-top-style: solid;
                                                                                            margin: 0;
                                                                                            padding: 10px 0;
                                                                                        "
                                                                                        align="right"
                                                                                        valign="top"
                                                                                    >
                                                                                        {{$dt_inv->no_unik}}
                                                                                    </td>
                                                                                </tr>
                                                                               
                                                                                <tr>
                                                                                    <td
                                                                                        class="alignright"
                                                                                        width="60%"
                                                                                        style="
                                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                                            font-size: 14px;
                                                                                            vertical-align: top;
                                                                                            text-align: right;
                                                                                            border-top-width: 2px;
                                                                                            border-top-color: #212529;
                                                                                            border-top-style: solid;
                                                                                            border-bottom-color: #212529;
                                                                                            border-bottom-width: 2px;
                                                                                            border-bottom-style: solid;
                                                                                            font-weight: 700;
                                                                                            margin: 0;
                                                                                            padding: 10px 0;
                                                                                        "
                                                                                        align="right"
                                                                                        valign="top"
                                                                                    >
                                                                                        Total
                                                                                    </td>
                                                                                    <td
                                                                                        class="alignright"
                                                                                        style="
                                                                                            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
                                                                                            font-size: 14px;
                                                                                            vertical-align: top;
                                                                                            text-align: right;
                                                                                            border-top-width: 2px;
                                                                                            border-top-color: #212529;
                                                                                            border-top-style: solid;
                                                                                            border-bottom-color: #212529;
                                                                                            border-bottom-width: 2px;
                                                                                            border-bottom-style: solid;
                                                                                            font-weight: 700;
                                                                                            margin: 0;
                                                                                            padding: 10px 0;
                                                                                        "
                                                                                        align="right"
                                                                                        valign="top"
                                                                                    >
                                                                                       {{$dt_inv->nominal_ttl}}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                               <tr>
                                                   <td style="text-align: center;" colspan="4">Pembayaran ke rekening tujuan</td>
                                               </tr>
                                                <tr>
                                                      <td style="text-align: center; font-size: 12px; padding: 15px;" >
                                                        <img src="{{asset('images/bank_logo/logo_mandiri.png')}}" width="100px" style="align-self: center;width: 75px;"><br>
                                                          <b>1380013642702</b> <br>
                                                          an. CV Billion Technology
                                                       </td>
                                                      <td style="text-align: center; font-size: 12px; padding: 15px;" >
                                                         <img src="{{asset('images/bank_logo/logo_BRI.png')}}"  width="100px" style="align-self: center;width: 75px;"><br>
                                                        <b>002901124296507</b> <br> 
                                                        an. Erna Kurniati
                                                       </td>
                                                      <td style="text-align: center; font-size: 12px; padding: 15px;" >
                                                        <img src="{{asset('images/bank_logo/logo_bni.png')}}"  width="100px" style="align-self: center;width: 75px;"><br>
                                                        <b>0495227030</b> <br>
                                                        an. Erna Kurniati
                                                      </td>
                                                      <td style="text-align: center; font-size: 12px; padding: 15px;" >
                                                         <img src="{{asset('images/bank_logo/logo_bca.png')}}" width="100px" style="align-self: center;width: 75px;"><br>
                                                        <b>0372543386</b> <br>
                                                        an. Erna Kurniati
                                                      </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="4" 
                                                        class="content-block aligncenter"
                                                        style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; vertical-align: top; text-align: center; margin: 0; padding: 20px 0 0px;"
                                                        align="center"
                                                        valign="top"
                                                    >
                                                        Terimakasih Telah menggunakan Ping<span style="color: #44a2d2; font-weight: 700;">Notif</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
                <td style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; font-size: 14px; vertical-align: top; margin: 0;" valign="top"></td>
            </tr>
        </tbody>
    </table>
</div>

    @endsection