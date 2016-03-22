<?php
namespace App\Http\Controllers\Member;

//use App\Http\Requests\Request;
use App\Models\CategoryModel;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
//use App\Models\CategoryModel;

class CompanyDController extends BaseGoodsController
{
    /**
     * 企业需求
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 3;

    public function __construct()
    {
        $this->list['func']['name'] = '企业需求';
        $this->list['func']['url'] = 'companyD';
        $this->list['create']['name'] = '发布需求';
        $this->model = new GoodsModel();
    }

    public function index($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$this->type,$cate_id),
            'prefix_url'=> '/member/companyD',
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.companySD.index', $result);
    }

    public function trash($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$this->type,$cate_id),
            'prefix_url'=> '/member/companyD/trash',
            'menus'=> $this->list,
            'curr'=> 'trash',
        ];
        return view('member.companySD.index', $result);
    }

    public function create()
    {
        $result = [
            'categorys'=> $this->model->categorys(),
            'menus'=> $this->list,
            'curr'=> 'create',
        ];
        return view('member.companySD.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request,$this->type);
        $data['created_at'] = date('Y-m-d', time());
        GoodsModel::create($data);
        return redirect('/member/companyD');
    }

    public function edit($id)
    {
        $result = [
            'data'=> GoodsModel::find($id),
            'categorys'=> $this->model->categorys(),
            'menus'=> $this->list,
            'curr'=> 'edit',
        ];
        return view('member.companySD.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request,$this->type);
        $data['updated_at'] = date('Y-m-d', time());
        GoodsModel::where('id',$id)->update($data);
        return redirect('/member/companyD');
    }

    public function show($id)
    {
        $data = GoodsModel::find($id);
        $data->catename = CategoryModel::find($data->cate_id)->name;
        $result = [
            'data'=> $data,
            'types'=> $this->model['types'],
            'menus'=> $this->list,
            'curr'=> 'show',
        ];
        return view('member.companySD.show', $result);
    }

    public function destroy($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/companyD');
    }

    public function restore($id)
    {
        GoodsModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/companyD/trash');
    }

    public function forceDelete($id)
    {
        GoodsModel::where('id',$id)->delete();
        return redirect('/member/companyD/trash');
    }
}