<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class InoutController extends Controller
{
    public $folder = 'inout/';

    public function index()
    {
        return view($this->folder . 'index');
    }

    public function add()
    {
        $modelProduct = new Product;
        $data['products'] = $modelProduct->orderBy('nama_produk')->get();
        return view($this->folder . 'add')->with($data);
    }
}
