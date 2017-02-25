<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;
use App\Models\BaseModel;
use App\Models\Admin\User;
use App\Models\Constant;

class AdminController extends BaseController
{
	public function index(\Illuminate\Routing\Route $route)
	{
	    //echo Route::getFacadeRoot()->current()->uri();
	    //echo $route->getUri();
// 	    echo $route->getActionName();
		//return view("admin.index");
	}
	
	public function doLogin()
	{
	    $inputParams = $this->getInputParams("username,password");
	    BaseModel::Factory()->md5('password', $inputParams);
	    $params = $this->packJson(url('menu/getlist'), 200, Constant::$zhLoginSuc);
	    if (!User::login($inputParams)) {
	        $params = $this->packJson(url('admin/login'), 500, Constant::$zhLoginFai);
	    }
	    return \Redirect::route('admin/info', array('msg'=>base64_encode($params)));
	}
	
	public function doRegister()
	{
	    $inputParams = $this->getInputParams("username,password");
	    BaseModel::Factory()->md5('password', $inputParams);
	    $params = $this->packJson(url('admin/login'), 200, Constant::$zhRegisterSuc);
	    if (!User::doRegister($inputParams)) {
	        $params = $this->packJson(url('admin/register'), 500, Constant::$zhRegisterFail);
	    }
	    return \Redirect::route('admin/info', array('msg'=>base64_encode($params)));
	}
	
}