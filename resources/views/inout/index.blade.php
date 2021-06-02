@extends('voyager::master')

@section('page_title', 'Data Keluar Masuk Barang')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        Data Keluar Masuk Barang

        <a href="{{ url('admin/inout/add') }}" class="btn btn-success btn-add-new">
            <i class="voyager-plus"></i> <span>{{ __('voyager::generic.add_new') }}</span>
        </a>
    </h1>
@stop

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">



                    <div class="table-responsive">
                        <table id="dataTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tgl Transaksi</th>
                                    <th>Tipe Transaksi</th>
                                    <th>Catatan</th>
                                </tr>
                            </thead>
                
                            <tbody>
                
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
    <script>
        $(document).ready(function(){
            $('#dataTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ app('config')->get('app.nodejs_api_url') . '/api/inout/data' }}"
            });
        });
    </script>
@stop