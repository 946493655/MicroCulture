<?php
namespace App\Models;

use App\Models\Base\AreaModel;
use App\Models\Base\PicModel;
use App\Models\Company\ComMainModel;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = false;

    //支持 DesignModel
    //类型：房产，效果图，平面，漫游
    protected $cates1 = [
        1=>'房产漫游','效果图','平面设计',
    ];

    //支持 IdeasModel、StoryBoardModel、GoodsModel、WorksModel
    //样片类型：1电视剧，2电影，3微电影，4广告，5宣传片，6专题片，7汇报片，8主题片，9纪录片，10晚会，11淘宝视频，12婚纱摄影，13个人短片，
    protected $cates2 = [
        1=>'电视剧','电影','微电影','广告','宣传片','专题片','汇报片','主题片','纪录片','晚会','淘宝视频','婚纱摄影','个人短片',
    ];

    /**
     * 创建时间转换
     */
    public function createTime()
    {
        return $this->created_at ? date("Y年m月d日 H:i", $this->created_at) : '';
    }

    /**
     * 更新时间转换
     */
    public function updateTime()
    {
        return $this->updated_at ? date("Y年m月d日 H:i", $this->updated_at) : '未更新';
    }

    /**
     * 拼接地区名称字符串
     */
    public function getAreaName($area=null)
    {
        $areaid = $this->area ? $this->area : 0;
        if (!$areaid && $area) { $areaid = $area; }
        $areaModel = AreaModel::find($areaid);
        $areaName = '';
        //本级
        if ($areaModel) {
            $areaName = $areaName ? $areaName.','.$areaModel->cityname : $areaModel->cityname;
        }
        //上一级
        if ($areaModel&&$areaModel->parentid) {
            $areaModel2 = AreaModel::find($areaModel->parentid);
            $areaName = $areaModel2 ? $areaName.','.$areaModel2->cityname : $areaName;
        }
        //上上级
        if (isset($areaModel2)&&$areaModel2->parentid) {
            $areaModel3 = AreaModel::find($areaModel2->parentid);
            $areaName = $areaModel3 ? $areaName.','.$areaModel3->cityname : $areaName;
        }
        return $areaName;
    }

    public function isshow()
    {
        return $this->isshow==1 ? '前台显示' : '前台不显示';
    }

    /**
     * 发布方名称：bs_order，bs_order_pro，bs_order_firm
     */
    public function getSellName()
    {
        $userModel = $this->getUser($this->seller);
        return $userModel ? $userModel->username : '';
    }

    /**
     * 申请方名称：bs_order，bs_order_pro，bs_order_firm
     */
    public function getBuyName()
    {
        $userModel = $this->getUser($this->buyer);
        return $userModel ? $userModel->username : '';
    }

    /**
     * 由uid得到 用户信息
     */
    public function getUser($uid=null)
    {
        $userInfo = UserModel::find($uid);
        return $userInfo ? $userInfo : '';
    }

    public function getUserName($uid=null)
    {
        $userid = $uid ? $uid : $this->uid;
       return $this->getUser($userid) ? $this->getUser($userid)->username : '';
    }

    /**
     * 由uid得到 公司信息
     */
    public function getCompany($uid=null)
    {
        $companyInfo = CompanyModel::where('uid',$uid)->first();
        return $companyInfo ? $companyInfo : '';
    }

    public function getCompanyMain($uid=null)
    {
        $comMainInfo = ComMainModel::where('uid',$uid)->first();
        return $comMainInfo ? $comMainInfo : '';
    }

    public function getCompanyName($uid=null)
    {
        return $this->getCompany($uid) ? $this->getCompany($uid)->name : '';
    }

    /**
     * 价格：bs_storyboard，bs_designs，bs_goods，bs_ideas，bs_rents，bs_staffs，
     */
    public function money()
    {
        return $this->money ? $this->money.'元' : '';
    }

    /**
     * 获得某个会员的所有图片
     */
    public function getUserPics($uid=null)
    {
        if ($uid) {
            $datas = PicModel::where('uid',$uid)->get();
        } else {
            $datas = PicModel::all();
        }
        return $datas;
    }

    /**
     * 获取用户图片尺寸：高度$w，确定宽度$h
     */
    public function getUserPicSize($picModel,$w,$h)
    {
        $pic = $picModel;
        if ($pic && $pic->width && $pic->height) {
//            $ratio_h = $h / $pic->height;
//            //确定高度 $h，计算$w
//            $width=$ratio_h*$pic->width;
//            if ($width>$w) { $size = $width; } else  { $size = $w; }
            $ratio1 = $w / $h;
            $ratio2 = $pic->width / $pic->height;
            if ($ratio1>$ratio2) {
                $size['w'] = $w;
                $size['h'] = $pic->width / $ratio1;
            } else {
                $size['w'] = $h * $ratio2;
                $size['h'] = $h;
            }
        }
        return (isset($size)&&$size) ? $size : [];
    }
}