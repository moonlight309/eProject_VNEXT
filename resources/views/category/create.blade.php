@extends('layout.master')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title">
                    <h2>Add Category</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-pane show active" id="form-row-preview">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="inputCode" class="col-form-label">Code Category</label>
                                <input type="text" class="form-control" id="inputCode" placeholder="Code Category" name="code">
                            </div>

                            <div class="form-group">
                                <label for="inputCategory" class="col-form-label">Name Category</label>
                                <input type="text" class="form-control" id="inputCategory" placeholder="Name Category" name="name">
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputParent" class="col-form-label">Parent Category</label>
                                    <select id="inputParent" class="form-control" name="parent_id">
                                        <option value="0">Choose Parent Category</option>
                                        @foreach($category as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @if($item->chils)
                                                @foreach($item->chils as $item)
                                                    <option value="{{ $item->id }}">-- {{ $item->name }}</option>
                                                    @if($item->chils)
                                                        @foreach($item->chils as $item)
                                                            <option value="{{ $item->id }}">---- {{ $item->name }}</option>
                                                            @if($item->chils)
                                                                @foreach($item->chils as $item)
                                                                    <option value="{{ $item->id }}">------ {{ $item->name }}</option>
                                                                    @if($item->chils)
                                                                        @foreach($item->chils as $item)
                                                                            <option value="{{ $item->id }}">------ {{ $item->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add New</button>
                        </form>
                    </div>
                </div>
            </div>
            <a href="{{ route('categories.index') }}">Back To Index Category</a>
        </div>
    </div>
@endsection
