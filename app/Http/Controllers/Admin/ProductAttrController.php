<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ProductAttrModel;

class ProductAttrController extends BaseController
{
    /**
     * 系统后台内部产品属性管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ProductAttrModel();
        $this->crumb['']['name'] = '动画属性列表';
        $this->crumb['category']['name'] = '动画属性';
        $this->crumb['category']['url'] = 'productattr';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/productattr',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.productAttr.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
       return view('admin.productAttr.create', $result);
    }

    public function store(){}

    public function edit(){}

    public function update(){}





    /**
     * =================
     * 一下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $productAttr = [
            'name'=> $request->name,
            'layerid'=> $request->layerid,
            'val'=> $request->val,
            'intro'=> $request->intro,
        ];
        return $productAttr;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return ProductAttrModel::paginate($this->limit);
    }
}