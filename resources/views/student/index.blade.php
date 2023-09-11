@extends('apps.attendance')

@section('content')
   <div class="row py-3">
      <p class="text-center"><small>&copy; Copyright <em>Rifat Hossain Rhidoy</em></small></p>
      @if (session()->has('success'))
         <div class="alert alert-success text-center">
            {{ session()->get('success') }} Attendance SL: <a
               href="#att_{{ session()->get('id') }}">{{ session()->get('id') }}</a>
         </div>
      @endif
      @if (session()->has('fail'))
         <div class="alert alert-danger text-center">
            {{ session()->get('fail') }}
         </div>
      @endif
      <h1 class="text-center">Input form</h1>
      <div class="col-9 col-md-6 col-lg-4 mx-auto">
         <form action="{{ route('attendances.store') }}" method="post">
            @csrf
            <div class="form-group">
               <label for="">Name:</label>
               <select class="form-control std_name" name="name" placeholder="Student name here" required>
                  <option value="">&nbsp;</option>
                  @foreach ($stds as $std)
                     <option value="{{ $std }}">{{ $std }}</option>
                  @endforeach
               </select>
            </div>
            <div class="form-group">
               <label for="">Date:</label>
               <input class="form-control" type="date" name="att_date" required>
            </div>
            <div class="form-group">
               <label for="">Payment:</label>
               <input class="form-control" type="text" name="payment" placeholder="if applicable" autocomplete="off">
            </div>
            <div class="form-group">
               <label for="">Validation:</label>
               <input class="form-control" type="text" name="validation" placeholder="validate identity"
                  autocomplete="off">
            </div>
            <div class="form-group mt-2">
               <button type="submit" class="btn btn-success">Submit</button>
            </div>
         </form>
      </div>
   </div>
   <div class="container my-4">
      <div class="row m-1">
         <h1 class="text-center">Attendance sheet</h1>
         <table class="table">
            <tr>
               <th scope="col">Name of the Student</th>
               <th scope="col">Attendance</th>
               <th scope="col">Payment</th>
            </tr>
            @foreach ($atts as $att)
               <tr id="att_{{ $att->id }}">
                  <td><a href="{{ route('attendances.show', $att->name) }}" class="link">{{ $att->name }}</a></td>
                  <td>{{ Carbon::parse($att->att_date)->format('d/m/Y') }}</td>
                  <td><span class="status">{{ $att->payment }}</span></td>
               </tr>
            @endforeach
         </table>
      </div>
   </div>
@endsection
