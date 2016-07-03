<?php
namespace App\Http\Controllers\Home;

use App\Models\CategoryModel;
use App\Models\IdeasClickModel;
use App\Models\IdeasCollectModel;
use App\Models\IdeasModel;
use App\Models\IdeasReadModel;
use App\Models\OrderModel;
use App\Tools;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 前台创意管理
     */

    protected $curr = 'idea';

    public function islogin()
    {
        if (!\Session::has('user.uid')) { echo "<script>alert('您还没有登录，请先登录！');window.location.href='/login';</script>";exit; }
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'cates'=> Tools::getChild(CategoryModel::all()),
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'userid'=> $this->userid,
        ];
        return view('home.idea.index', $result);
    }

    /**
     * 浏览权限控制
     */
    public function show($id)
    {
        $this->islogin();
        $data = IdeasModel::find($id);
        if ($data->uid!=$this->userid) {
            $create = ['ideaid'=>$id,'uid'=>$this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
            IdeasReadModel::create($create);
        }
        //内容查看权限开关
        $data->iscon = 0;
        $orderModels = OrderModel::whereIn('genre',[1,2])
            ->where('fromid',$id)
            ->where('seller',$data->uid)
            ->where('buyer',\Session::get('user.uid'))
            ->get();
        if (count($orderModels)) { $data->iscon = 1; }
        return view('home.idea.show',compact('data'));
    }

    /**
     * 点赞自增
     */
    public function click($id,$click)
    {
        $this->islogin();
        if (!$click) {        //增加
            $create = ['ideaid'=> $id,'uid'=> $this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
            IdeasClickModel::create($create);
        } else {        //减少
            IdeasClickModel::where('ideaid',$id)->delete();
        }
        return redirect('/idea');
    }

    /**
     * 收藏自增
     */
    public function collect($id,$collect)
    {
        $this->islogin();
        if (!$collect) {      //增加
            $create = ['ideaid'=> $id,'uid'=> $this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
            IdeasCollectModel::create($create);
        } else {        //减少
            IdeasCollectModel::where('ideaid',$id)->delete();
        }
        return redirect('/idea');
    }


    public function query()
    {
        return IdeasModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}