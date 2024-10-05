@extends('apps.app', [
    'title' => 'BankStatement',
    'headerRoute' => 'statements.index',
])

@section('app')
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="card col-lg-7 col-md-9">
            <form action="{{ route('statements.compare.post') }}" method="POST">
               @csrf
               <div class="card-header">
                  <h5>Check balance difference</h5>
               </div>
               <div class="card-body text-end">
                  <div class="row">
                     <div class="col-6 w-50 input-group mb-3">
                        <span class="input-group-text">From: </span>
                        <input type="date" class="form-control" id="from_date" required>
                     </div>
                     <div class="col-6 w-50 input-group mb-3">
                        <span class="input-group-text">To: </span>
                        <input type="date" class="form-control" id="to_date" required>
                     </div>
                  </div>
                  <button type="button" class="m-auto btn btn-primary" onclick="checkDiff(this)">Check</button>
               </div>
               <div class="modal-footer" id="cmpr">
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection