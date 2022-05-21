@extends('layouts.common')

@section('content')
{{-- 外部cssが効かないので直書き --}}
<style>
  header {
   display:flex;
   margin-left:10px;
   background-color:aqua;

  }
  
  header h1 {
   padding-left:20px;
  }

  main {
   display:flex;
   margin-left:10px;
  }

  .kind {
   flex:1;
   background-color:orange;
  }

  .wariai {
   flex:1;
  // background-color:green;
  }

</style>
<script>
  var data = {
    datasets:[{
      data:[10,20,30] 

    }],
    labels: [
      'Red',
      'Yellow',
      'Blue'
    ]

  }
 
  window.onload = function() {
    // canvas取得 
    var ctx = document.getElementById("myChart");
    // 種類
    var kinds = [];
    // 種類毎の金額
　　var moneys = [];
    // 種類数
    var kind_count = document.getElementById("kakeibo_count").textContent;
    // 総支出
    var sisyutu = document.getElementById("sisyutu").textContent;
    var wariai = [];
    for (var i=1; i<=kind_count; i++) {
      var syurui = "syurui" + i; 
　　　var money = "money" + i; 
      kinds.push(document.getElementById(syurui).textContent);
      moneys.push(document.getElementById(money).textContent); 
      wariai.push(Math.ceil(parseInt(document.getElementById(money).textContent) / sisyutu * 100));
    }
    // 種類配列
    console.log(kinds);
    // 金額配列 
    console.log(moneys);
    // 割合
    console.log(wariai);
    console.log(sisyutu);
    var pieChart = new Chart(ctx, {
      type: 'pie',
      data: {
        datasets:[{
          data:wariai,
          backgroundColor: [
           'red', //クレジットカード
           'blue', // 交通費
           'khaki', // 光熱費
           'yellow', // 奨学金
           'gold', // 家賃
           'orange', // 携帯電話
           'pink', // 日用品
           'indigo', // 通販
           'green', // 遊び
           'aqua', // 食費
          ],
        }],
        labels:kinds 
      },
       plugins: ['ChartDataLabels',],
     options : {
       title: {
        display:true,
        text:'割合'
       },
       plugins: {
         labels: {
	   render:'percentage',
           fontColor: ['white','white','white','white','white','white','white', 'white', 'white', 'white'],
           fontSize:20
        }     
       }
     }
    });
  };

</script>

<header> 
  <img src="https://placehold.jp/80x80.png" alt="ロゴ">
  <h1>家計簿アプリ</h1>
</header>
<main>
 <div class="kind">
   <form name="kikan" action="/laravel/public/kakeibo/search"  method="get">
   @csrf
     <select name="year_month">
      @if($default_year_month === '2022-04')
        <option value="2022-04" selected>2022-04</option>
        <option value="2022-05">2022-05</option>
      @else
        <option value="2022-04">2022-04</option>
        <option vakue="2022-05" selected>2022-05</option>
      @endif
     </select>
     <input type="submit" value="検索">
   </form>
   <table>
     <tr>
       <th>{{$default_year_month}}月種類別合計支出額</th>
     </tr>
     @foreach($kakeibo_kind as $kind)
     <tr>
       <td>{{$kind->kinds}} </td>
       <td>{{number_format($kind->money)}}円 </td>
       <div hidden id="syurui{{$loop->iteration}}">{{$kind->kinds}}</div>
       <div hidden id="money{{$loop->iteration}}">{{$kind->money}}</div>
       <div hidden id="kakeibo_count">{{$loop->count}}</div>
     </tr>
     @endforeach
     <tr>
       <td>{{$default_year_month}}月合計支出額</td>
       @foreach($kakeibos as $kakeibo)
       <td>{{number_format($kakeibo->money)}}円</td>
       <div hidden id="sisyutu">{{$kakeibo->money}}</div>
       @endforeach
     </tr>
   </table>
 </div>
 <div class="wariai">
   <p>割合</p>
   <canvas id="myChart" width="400" height="400"></canvas>
 </div>
</main>


@endsection
