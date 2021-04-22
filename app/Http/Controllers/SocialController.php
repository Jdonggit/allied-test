<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SocialController extends Controller
{
    //
    /**
     * 將用戶重定向到第三方身份驗證頁面。
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * 從第三方獲取用戶信息。
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();
// dd($user);
        //first()只需要從數據庫表中檢索一行，比對資料表與獲取的$user訊息
        $account = User::where('email',$user->email)->first();
        
        //如果用戶為空，則新增資料到資料表中，取決於你需要哪些使用者訊息
        if(!$account){
            $new_user = new User;
            $new_user->email = $user->email;
            $new_user->name = $user->name;
            $new_user->google_token = $user->token;
            $new_user->password = bcrypt('githubtest');
            $new_user->save();
            Auth::login($new_user);
        }else{

            // 登入並且「記住」使用者...
            Auth::login($account);
        }
    
        
        //回到首頁
        return redirect('/');
    }
}
