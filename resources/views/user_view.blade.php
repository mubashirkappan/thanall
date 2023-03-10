@extends('welcome')
@section('title','list')
@section('style')

@endsection
@section('content')
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8 mt-5">
            <div>
                {{--  <h1>  --}}
                    <center>
                            passbook
                    </center>
                {{--  </h1>  --}}
                <table class="m-5" style=" width: 100%;  border: 1px solid;
                border-collapse: collapse;text-align: center">
                    <tr style="  border: 1px solid;">
                        <th style="border: 1px solid;">Date</th>
                        <th style="border: 1px solid;background-color:red;color:white" >Debit</th>
                        <th style="border: 1px solid;background-color: green;color:white">Credit</th>
                        <th style="border: 1px solid;">Description</th>
                    </tr>
                    <tr style="border: 1px solid;">
                        <td style="border: 1px solid;">2</td>
                        <td style="border: 1px solid;background-color:rgba(255, 0, 0, 0.3)";>1</td>
                        <td style="border: 1px solid;background-color:rgba(0, 255, 0, 0.3);">1</td>
                        <td style="border: 1px solid;">1</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
