@extends('apps.app', [
    'title' => 'BankStatement',
    'headerRoute' => 'statements.index',
])

@section('app')
   <div class="container mt-5">
      <div class="row justify-content-center">
         <div class="card col-lg-7 col-md-9">
            <form action="{{ route('statements.store') }}" method="POST">
               @csrf
               <div class="card-header">
                  <h5>Add to statement</h5>
               </div>
               <div class="card-body">
                  <div class="form-group row" id="stmt">
                     @foreach ($prevStatements as $prev)
                        <div class="col-7 mb-3">
                           <input type="text" class="form-control" name="reference[]" value="{{ $prev->reference }}"
                              placeholder="A benificiary name reference">
                        </div>
                        <div class="col-5 mb-3">
                           <input type="number" class="form-control" name="amount[]" value="{{ $prev->amount }}"
                              step="0.01" placeholder="Amount to be added">
                        </div>
                     @endforeach
                  </div>
                  <button type="button" onclick="addMore()" class="btn btn-info mt-2">+</button>
               </div>
               <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
@section('js')
   <script>
      function addMore() {
         $("#stmt").append(`<div class="col-7 mb-2">
                                <input type="text" class="form-control" name="reference[]" placeholder="A benificiary name reference">
                            </div>
                            <div class="col-5 mb-2">
                                <input type="number" class="form-control" name="amount[]" step="0.01" placeholder="Amount to be added">
                            </div>`);
      }
   </script>
@endsection
