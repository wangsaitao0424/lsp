<?php

namespace App\Http\Middleware;

use App\Model\Admin_login;
use Closure;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userData = $this->checkToken($request);
        $mid_params = ['userData'=>$userData];
        $request->attributes->add($mid_params);  //添加参数
        return $next($request);
    }

    public function checkToken($request)
    {
        $token = $request->input("token");
        // $token="18530116e9406b18f08d146077facd05";
        // dd($token);
        if(empty($token)){
            return json_encode(['code'=>203,'msg'=>'token空值']);
        }
        $data = Admin_login::where(['token'=>$token])->first();
        if (!$data) {
            return json_encode(['code'=>201,'msg'=>'用户名和密码不对']);
        }
        if(time()>$data['user_time']){
            return json_encode(['code'=>202,'msg'=>'请重新登']);
        }
        //更新token有效期(业物)
        $data->user_time=time()+7200;
        $data->save();
        return $data;
    }
}
