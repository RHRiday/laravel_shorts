@extends('apps.app', [
    'title' => 'TuitionAttendance',
    'headerRoute' => 'attendances.index',
])
@section('styles')
   <style>
      .th {
         background-color: #2122290d;
         padding: 15px 0.3rem;
         border-radius: 5%;
         line-height: 1.5;
      }

      .link,
      .link:hover {
         text-decoration: none;
         padding: 8px;
         border-radius: 7%;
      }

      .link {
         color: #007bff;
         background-color: #f8f9fa;
      }

      .link:hover {
         color: #f8f9fa;
         background-color: #007bff;
      }

      .status {
         border-radius: 6%;
         padding: 8px 20px;
         text-align: center;
      }
   </style>
@endsection

@section('js')
   <script>
      $(document).ready(function() {
         let status = document.querySelectorAll('.status');
         status.forEach(function(item) {
            if (item.innerHTML === "ok") {
               item.setAttribute("style", "background-color:#a8ffb3");
            } else if (item.innerHTML === "start") {
               item.setAttribute("style", "background-color:#d1ffe5");
            }
         });
         $('.std_name').select2({
            tags: true,
            theme: "classic",
            placeholder: "Ex: Sanvi",
            maximumSelectionLength: -1,
            width: '100%'
         });
      });
   </script>
@endsection
@section('app')
   @yield('content')
@endsection
