<?php
namespace App\Api\ApiUser;

use Curl\Curl;

class ApiCompany
{
    /**
     * 个人资料数据接口
     */

    /**
     * 获取公司列表
     */
    public static function getCompanyList($limit=null,$pageCurr=1,$genre=0)
    {
        $redisKey = 'companyList';
        //判断缓存有没有该数据
        if ($redisResult = ApiBase::getRedis($redisKey)) {
            return array('code' => 0, 'data' => unserialize($redisResult));
        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl,array(
            'limit' =>  $limit,
            'page'  =>  $pageCurr,
            'genre' =>  $genre,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
        );
    }

    /**
     * 由 uid 获取一条公司数据
     */
    public static function getOneCompany($uid)
    {
//        $redisKey = 'companyByUid';
//        //判断缓存有没有该数据
//        if ($redisResult = ApiBase::getRedis($redisKey)) {
//            return array('code' => 0, 'data' => unserialize($redisResult));
//        }
        //没有，接口读取
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company/one';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'uid' => $uid
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
        );
    }

    /**
     * 通过 cname 获取一条公司数据
     */
    public static function getOneByCname($cname)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company/onebycid';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'cname' => $cname,
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
        );
    }

    /**
     * 新增公司记录
     */
    public static function add($data)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company/add';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, $data);
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response->error->msg);
        }
        return array('code' => 0, 'msg' => $response->error->msg);
    }

    /**
     * 通过 cid 获取一条记录
     */
    public static function show($id)
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company/show';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
            'id' => $id
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'data' => ApiBase::objToArr($response->data),
        );
    }

    /**
     * 获取 model
     */
    public static function getModel()
    {
        $apiUrl = ApiBase::getApiCurl() . '/api/v1/company/getmodel';
        $curl = new Curl();
        $curl->setHeader('X-Authorization', ApiBase::getApiKey());
        $curl->post($apiUrl, array(
        ));
        $response = json_decode($curl->response);
        if ($response->error->code != 0) {
            return array('code' => -2, 'msg' => $response->error->msg);
        }
        return array(
            'code' => 0,
            'model' => ApiBase::objToArr($response->model),
        );
    }
}