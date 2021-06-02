@extends('voyager::master')

@section('page_title', 'Tambah Keluar Masuk Barang')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        Tambah Keluar Masuk Barang
    </h1>
@stop

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered">
                <div class="panel-body">


                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Catatan</label>
                                <input type="text" id="notes" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Tipe Transaksi</label>
                                <select class="form-control" id="type_inout">
                                    <option value="In"> In </option>
                                    <option value="Out"> Out </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">

                            <table id="table-detail" class="table">
                                <thead>
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Produk</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>
                                            <a href="javascript:void(0)" onclick="delete_baris_hehe(this)">
                                                <i class="voyager-trash"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <select name="products[]" class="form-control">
                                                @foreach ($products as $item)
                                                    <option value="{{ $item->id }} "> {{ $item->nama_produk }} </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" name="qty[]" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <a href="javascript:void(0)" onclick="copy_baris_wkwk()">
                                                <i class="voyager-plus"></i> tambah baris
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            <button id="simpan-data-trx" class="btn btn-success">
                                Simpan Data Transaksi
                            </button>

                        </div>
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

            $("#simpan-data-trx").click(function()
            {
                var details = [];
                var products = $("select[name='products[]']");
                var qtys = $("input[name='qty[]']");

                for(var el = 0; el < products.length; el++)
                {
                    details.push({
                        "id_produk": $(products[el]).val(),
                        "qty": $(qtys[el]).val()
                    });
                }

                $.ajax({
                    method: 'POST',
                    url: "{{ app('config')->get('app.nodejs_api_url') }}/api/inout/save",
                    dataType: 'json',
                    data: {
                        type_inout: $("#type_inout").val(),
                        notes: $("#notes").val(),
                        details: details
                    },
                    success: function(msg)
                    {
                        if(msg.success){
                            window.alert("Berhasil simpan data");
                            window.location.reload();
                        }else{
                            window.alert(msg.message);
                        }
                    },
                    error: function(err)
                    {
                        window.alert(err);
                    }
                })
            });
        });

        var tbl_dtl = $("#table-detail");
        function delete_baris_hehe(obj)
        {
            if(tbl_dtl.find("tbody tr").length > 1){
                $(obj).closest("tr").remove();
            }
        }

        function copy_baris_wkwk()
        {
            tbl_dtl.find("tbody").append("<tr>" + $(tbl_dtl.find("tbody").find("tr")[0]).html() + "</tr>");
        }
    </script>
@stop