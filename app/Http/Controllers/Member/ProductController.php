<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductModel;
use App\Models\UserModel;
//use Illuminate\Support\Facades\Request;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * 会员后台在线视频动画产品管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '在线创作';
        $this->lists['func']['url'] = 'product';
//        $this->lists['create']['name'] = '开始创作';
        $this->lists['create']['name'] = '添加产品';
        $this->model = new ProductModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/product',
            'curr'=> $curr,
        ];
        return view('member.product.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/product/trash',
            'curr'=> $curr,
        ];
        return view('member.product.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ProductModel::create($data);
        return redirect('/member/product');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> ProductModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('U-m-d H:i:s', time());
        ProductModel::where('id',$id)->update($data);
        return redirect('/member/product');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ProductModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.product.show', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        //用户类型：0非会员，1个人消费者，2普通企业，3设计师，4广告公司，5影视公司，6租赁公司
        //genre：1个人发布，2企业发布
        $userModel = UserModel::find($this->userid);
        if ($userModel->isuser==3) { $genre = 1; }
        if (in_array($userModel->isuser,[4,5])) { $genre = 2; }
        $data = [
            'name'=> $request->name,
            'uid'=> $this->userid,
            'uname'=> $userModel->username,
            'genre'=> isset($genre) ? $genre : 0,
            'width'=> $request->width,
            'height'=> $request->height,
            'intro'=> $request->intro,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
    }
}