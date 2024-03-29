<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Sederhana</title>
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css" integrity="sha512-KRrxEp/6rgIme11XXeYvYRYY/x6XPGwk0RsIC6PyMRc072vj2tcjBzFmn939xzjeDhj0aDO7TDMd7Rbz3OEuBQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdn.tailwindcss.com"></script>
    // <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    
    {{ $slot }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @livewireScripts

    @stack('scripts')

    {{--  <script>
        $(document).ready(function(){
          $("#jabatan").on('change',function(){
            var jabatan = $(this).val();
            $.ajax({
              url:"{{ route('employee') }}",
              type:"GET",
              data:{'jabatan':jabatan},
              success:function(data){
                var employees = data.employees;
                var html = '';
                if (employees.length > 0){
                  for(let i = 0; i<employees.length;i++){
                    html += '<tr>\
                      <td>'+(i+1)+'</td>\
                      <td>'+employees[i]['nama']+'</td>\
                      <td>'+employees[i]['usia']+'</td>\
                      <td>'+employees[i]['tanggal_lahir']+'</td>\
                      <td>'+employees+jabatan[i]['jabatan']+'</td>\
                      </tr>';
                  }
                }else{
                  html += '<tr>\
                    <td>Data Tidak Ditemukan</td>\
                    </tr>';
                }
    
                $("#tbody").html(html);
              }
            });
          });
        });
      </script>  --}}

    @include('sweetalert::alert')
</body>
</html>