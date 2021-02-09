<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use App\ProfileHistory;
use Carbon\Carbon;


class ProfileController extends Controller
{
    public function add(){
        return view('admin.profile.create');
    }
    
    public function create(Request $request)
    {
        //varidationを行う
     $this->validate($request, Profile::$rules);
      $news = new Profile;
      $form = $request->all();
      unset($form['_token']);
      unset($form['image']);
      //データベースに保存
      $news->fill($form);
      $news->save();
        
        return redirect('admin/profile/create');
    }
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
          $posts = Profile::where('title', $cond_title)->get();
        }else{
            $post = Profile::all();
        }
        return view('admin.profile.index',['posts'=>$posts,'cond_title'=>$cond_title]);
        }
    public function edit(Request $request)
    {
        $news = Profile::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
        return view('admin.profile.edit',['news_form'=>$news]);
    }
    public function update(Request $request)
    {
        $this->validate($request,Profile::$rules);
        $news = Profile::find($request->id);
        $news_form = $request->all();
    unset($form['_token']);
    $news->fill($news_form)->save();
     $history = new ProfileHistory;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();
    return redirect('admin/profile/create');
    }
}
