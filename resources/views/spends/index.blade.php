@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center mt-4">KT Collection Expenses Tracking System</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success m-2" href="{{ route('spends.create') }}"> Create New</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Status</th>
            <th>Details</th>
            <th>Amount</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($spends as $spend)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $spend->status }}</td>
                <td>{{ $spend->detail }}</td>
                <td>{{ $spend->amount }}</td>
                <td>
                    <form action="{{ route('spends.destroy',$spend->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('spends.show',$spend->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('spends.edit',$spend->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $spends->links() !!}

@endsection
