<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 系统后台设计管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new DesignModel();
        $this->crumb['']['name'] = '设计列表';
        $this->crumb['category']['name'] = '设计管理';
        $this->crumb['category']['url'] = 'design';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'admin/design',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'admin/design/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.index', $result);
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
        return view('admin.design.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        DesignModel::create($data);
        return redirect(DOMAIN.'admin/design');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> DesignModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        DesignModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/design');
    }

    public function show($id)
    {
        $data = DesignModel::find($id);
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> $data,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.show', $result);
    }





    /**
     * ===================
     * 以下是公用方法
     * ===================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //由用户名称得到用户ID
        if (!$data['uname']) { $data['uid'] = 0; }
        $design = [
            'name'=> $data['name'],
            'genre'=> $data['genre'],
            'type_id'=> $data['type_id'],
            'uid'=> $data['uid'],
            'intro'=> $data['intro'],
            'price'=> $data['price'],
        ];
        return $design;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $datas = DesignModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}