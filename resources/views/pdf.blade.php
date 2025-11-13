<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&family=Zen+Kaku+Gothic+Antique&display=swap" rel="stylesheet">
    <title>{{$pdfs->titulo}} </title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
        }
        .page-break {
            page-break-after: always;
        }
    </style>

</head>
<body>
        <div style="position:relative;width:100%;height:auto;">
            <div style="position:relative;width:100%;height:1100px;display:block">
                <img src="https://oberlu.com/image/catalogo/{{$pdfs->id}}/portada.jpg" alt="" style="position:relative;display:block;width:100%;">
            </div>
            @php
            $count = 0;
            $cate = 0;
             @endphp
             @while ($cate<count($t))

            @while ($count<count($t[$cate]))
            <div style="position:relative;width:100%;display:block;height:1100px;background-image:url('https://oberlu.com/image/catalogo/{{$pdfs->id}}/trama.jpg'); background-size: cover;" class="page-break">
                <img src="https://oberlu.com/image/catalogo/{{$pdfs->id}}/portada{{$cate}}.jpg" alt="" style="position:relative;display:inline-block;width:100%;">
                <div style="position: relative;width:100%;height:auto;display:block;margin-top:50px;max-width:900px;">
                    <div style="position:relative;display:block;width:85%;margin:auto;">
                    @foreach ($t[$cate][$count] as $keep)
                        <div style="position:relative;width:400px;float:left;height:600px" >
                            <img src="https://www.oberlu.com/images/{{$keep->image}}" alt="" style="width:70%;inline-block;margin:0;position:relative;">
                            @if (100-(($keep->precio*100)/$keep->preciof) > 20 )
                                <img src="https://www.oberlu.com/image/catalogo/{{$pdfs->id}}/oferta.png" style="position:absolute;width:70px;top:-60px;right:95px;" >
                            @endif
                            <h5 style="font-size:15px;color:black;width:80%;font-family: 'Roboto', sans-serif;margin-top:-30px;display:block;position:relative;">{{$keep->name}} </h5>
                            <h5 style="position:absolute; top:200px;right:110px;font-size:20px;color:white;width:100px;text-align:center; font-family:sans-serif;padding:5px 10px;border:3px solid white; border-radius:5px;background:#967746">S/. {{$keep->precio}} </h5>
                            <textarea name="" id="" style="width:300px;height:400px;font-size:12px;border:none;margin-top:15px;font-family: sans-serif;display:block;position:relative;">{{$keep->description}}</textarea>
                        </div>

                    @endforeach
                    </div>

                </div>

            </div>
            @php
                $count = $count+1;
             @endphp
            @endwhile
            @php
                $cate = $cate+1;
                $count = 0;
             @endphp
            @endwhile
        </div>
</body>
</html>
