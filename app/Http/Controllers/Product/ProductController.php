<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;

class ProductController extends BaseController
{
	public function index(\Illuminate\Routing\Route $route)
	{
	   return view("product.index.list");
	}
	
}