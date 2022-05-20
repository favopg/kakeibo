<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTimeImmutable;
use App\Kakeibo\KakeiboBusiness;

class KakeiboController extends Controller
{
    public function index() {
    	     // 1ヶ月の支出合計金額取得
    $kakeibos = DB::select('select sum(money) as money from kakeibo where year_month_date>="2022-04-01" and year_month_date<="2022-04-30"');  
     // 1ヶ月の種類
     $kakeibo_kind = DB::select('select kinds, sum(money) as money from kakeibo where year_month_date>="2022-04-01" and year_month_date <="2022-04-30"  group by kinds');   
     return view('kakeibo', ['kakeibos' => $kakeibos, 'kakeibo_kind' => $kakeibo_kind, 'default_year_month' => '2022-04']);
         	
    	//return view('welcome');
    }
 public function search(Request $request) {
 	    $input_year_month = $request->input('year_month');
    $param_year_month_start = $request->input('year_month')."-01";   
     // 検索用の月末日を取得
    $search_year_month = 'last day of '.$request->input('year_month');
     $month_matubi= (new DateTimeImmutable)->modify($search_year_month)->format('Y-m-d');
     
     // 1ヶ月の支出合計金額取得
    $kakeibos = DB::select('select sum(money) as money from kakeibo where year_month_date>=:start_year_month_date and year_month_date<=:end_year_month_date',['start_year_month_date'=>$param_year_month_start, 'end_year_month_date'=> $month_matubi ]  );  
     // 1ヶ月の種類
     $kakeibo_kind = DB::select('select kinds, sum(money) as money from kakeibo where year_month_date>=:start_year_month_date and year_month_date <=:end_year_month_date group by kinds', ['start_year_month_date' => $param_year_month_start, 'end_year_month_date' => $month_matubi ]);   
     
 	     return view('kakeibo', ['kakeibos' => $kakeibos, 'kakeibo_kind' => $kakeibo_kind, 'default_year_month' => $input_year_month]);

 }
}
