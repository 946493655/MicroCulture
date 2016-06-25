<?php
namespace App\Models;

class IdeasShowModel extends BaseModel
{
    /**
     * 这是创意查看权限表 model
     */

    protected $table = 'bs_ideas_show';
    protected $fillable = [
        'id','ideaid','uid','isauth','remark','created_at','updated_at',
    ];

    public function user()
    {
        $uid = $this->uid ? $this->uid : 0;
        $userModel = UserModel::find($uid);
        return $userModel ? $userModel->username : '无';
    }
}