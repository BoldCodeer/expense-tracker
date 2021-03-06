@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center mt-4">KT Collection Expenses Monitoring System</h2>
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
        <div>
            <br>
            <h5 style="text-align: center">INCOME TOTAL AMOUNT: </h5>
            <div style="text-align: center" >
                <input style="text-align: center" type="number" value="{{ $income }}" disabled>
            </div>
            <br>

            <h5 style="text-align: center">EXPENSE TOTAL AMOUNT: </h5>
            <div style="text-align: center">
                <input style="text-align: center" type="number" value="{{ $expense }}" disabled>
            </div>
            <br>

            <h5 style="text-align: center">TOTAL AMOUNT: </h5>
            <div style="text-align: center">
                <input style="text-align: center" type="number" value="{{ $total }}" disabled>
            </div>
            <br>
            <h5 style="text-align: center">TOTAL PROFIT: </h5>
            <div style="text-align: center">
                <input style="text-align: center" type="number" value="{{ $profit }}" disabled>
            </div>
            <br>
        </div>

    <table class="table table-bordered">
        <tr>
            <th>Status</th>
            <th>Details</th>
            <th>Amount</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($spends as $spend)
            <tr>
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

{{--    {!! $spends->links() !!}--}}

@endsection
