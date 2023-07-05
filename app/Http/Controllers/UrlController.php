<?php

namespace App\Http\Controllers;

use App\Models\Statistic;
use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class UrlController extends Controller
{


    public function index()
    {
        return view('home');
    }

    // redirect to the original url
    public function redirect(Request $request)
    {
        $url = Url::where('short_url','st'.$request->route()->parameter('short_url'))->get();
        $clicks =  Statistic::where('url_id',$url[0]->id)->pluck('clicks');
        Statistic::where('url_id',$url[0]->id)->update([
            'clicks'=> $clicks[0]+1
        ]);
        return redirect($url[0]->url);
    }


     // generate the short url function
    public function generate(Request $request)
    {
        //checking the input if it is a valid email
        $request->validate([
            'url' => 'required|url'
        ]);

        //generate a short link and make sure that is unique

        do {
            $short = Str::random(6);
        } while (Url::where('short_url', $short)->first());

        // store the url and the short one with user id
        $short_url = Url::create([
            'user_id' => Auth::user()->id,
            'url' => $request->url,
            'short_url' => 'st'.$short,
        ]);
       Statistic::create([
            'user_id' => Auth::user()->id,
            'url_id' => $short_url->id,
        ]);

        return response()->json(['message' => 'done', 'url'=>$short_url]);
    }

    // get all the user's urls statistics
    public function getStats(Request $request){
        $stats = DB::table('statistics')->select('statistics.*','urls.url','urls.short_url','urls.id')->where('urls.user_id',Auth::user()->id)->join('urls', 'statistics.url_id','urls.id')->get();
        return response()->json($stats);
    }

    // delete the url
    public function deleteUrl(Request $request){
        Url::where('id',$request->id)->delete();
        return response()->json("done");
    }

    public function filter(Request $request){
        switch ($request->option) {
            case 1:
                $stats = DB::table('statistics')->select('statistics.*','urls.url','urls.short_url','urls.id')->where('urls.user_id',Auth::user()->id)->join('urls', 'statistics.url_id','urls.id')->latest()->get();
                return response()->json($stats);
                break;
            case 2:
                $stats = DB::table('statistics')->select('statistics.*','urls.url','urls.short_url','urls.id')->where('urls.user_id',Auth::user()->id)->join('urls', 'statistics.url_id','urls.id')->orderBy('clicks','desc')->get();
                return response()->json($stats);
                break;
        }

    }

    
}
