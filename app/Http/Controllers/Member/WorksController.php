<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\GoodsModel;

class WorksController extends BaseGoodsController
{
    /**
     * 个人作品管理
     * goods 商品、货物，代表文化类产品
     */

    public function __construct()
    {
        $this->list['func']['name'] = '个人作品';
        $this->list['func']['url'] = 'works';
        $this->model = new GoodsModel();
    }

    public function index($type=0,$cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$type,$cate_id),
            'menus'=> $this->list,
            'prefix_url'=> '/member/works',
            'curr'=> '',
        ];
        return view('member.works.index', $result);
    }

    public function trash($type=0,$cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=1,$type,$cate_id),
            'menus'=> $this->list,
            'prefix_url'=> '/member/works/trash',
            'curr'=> 'trash',
        ];
        return view('member.works.index', $result);
    }

    public function create()
    {
        $result = [
            'menus'=> $this->list,
            'cates'=> $this->model->cates(),
        ];
        return view('member.works.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->model['types'][1]);
        $data['created_at'] = date('Y-m-d', time());
        GoodsModel::create($data);
        return redirect('/member/works');
    }

    public function show($id)
    {
        $data = GoodsModel::find($id);
        $result = [
            'data'=> $data,
            'menus'=> $this->list,
        ];
        return view('member.works.show', $result);
    }

    public function edit($id)
    {
        $data = GoodsModel::find($id);
        $result = [
            'data'=> $data,
            'menus'=> $this->list,
            'cates'=> $this->model->cates(),
        ];
        return view('member.works.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$id);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        GoodsModel::where('id',$id)->update($data);
        return redirect('/member/works');
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/works');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/works/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('/member/works/trash');
    }
}