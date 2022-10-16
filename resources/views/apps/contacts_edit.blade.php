@extends('apps.app', [
    'title' => 'Contacts',
    'headerRoute' => 'contacts.index',
])

@section('app')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="card col-lg-7 col-md-9">
                <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h5>Edit contact - {{ $contact->name }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-4 mb-3">
                                <input type="text" class="form-control" name="name" placeholder="Contact name" required
                                    value="{{ $contact->name }}">
                            </div>
                            <div class="col-8 mb-3">
                                <input type="text" class="form-control" name="f_name" value="{{ $contact->f_name }}"
                                    placeholder="Full name or Recognition">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="number" class="form-control" name="priority" step="1" min="1"
                                    placeholder="Priority" value="{{ $contact->priority }}">
                            </div>
                            <div class="col-5 mb-3">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                    value="{{ $contact->email }}">
                            </div>
                            <div class="row col-12 mb-3 input-group" id="numbers">
                                <label for="number" class="mb-1">Number(s)</label>
                                @foreach ($contact->contactItems as $item)
                                    <div class="col-4 mb-2">
                                        <input type="text" class="form-control" name="number[]" required
                                            placeholder="01xxxxxxxxx" value="{{ $item->number }}">
                                    </div>
                                    <div class="col-2 mb-2">
                                        <select class="custom-select" name="avb[]">
                                            <option value="1" {{ $item->av ? 'selected' : '' }}>On</option>
                                            <option value="0" {{ $item->av ? '' : 'selected' }}>Unavailable</option>
                                        </select>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button type="button" onclick="addMore()" class="btn btn-info">+</button>
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
            $("#numbers").append(`<div class="col-4 mb-2">
                            <input type="text" class="form-control" name="number[]"
                                required placeholder="01xxxxxxxxx">
                        </div>
                        <div class="col-2 mb-2">
                            <select class="custom-select" name="avb[]">
                                <option value="1">On</option>
                                <option value="0">Unavailable</option>
                            </select>
                        </div>`);
        }
    </script>
@endsection
