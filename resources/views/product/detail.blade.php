@extends('layout.master')
@section('content')
    @if (session('sucess'))
        <div class="alert alert-success">
            {{ session('sucess') }}
        </div>
    @endif
    <table class="table table-bordered table-centered mb-0">
        <thead>
            <tr>
                <th>User</th>
                <th style="width: 100px"><input type="submit" value="Process" class="btn btn-primary"></th>
                <th style="width: 100px" class="text-center">
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                        @method('delete')
                        @csrf
                        <input class="btn btn-danger" type="submit" onclick="return window.confirm('Are you sure?');"
                            value="Delete" />
                    </form>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3">
                </td>
            </tr>
        </tbody>
    </table>
@endsection
