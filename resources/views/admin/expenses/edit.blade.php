@extends('layouts.master')
@section('page_title', 'Edit Expenses')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Edit Expenses</h6>
                    <a href="{{route('expenses.index')}}" class="btn btn-info float-right">View Your Expenses</a>

                </div>

                <div class="card-body">

                    <div class="tab-content">

                        <form action="{{ route('expenses.update',$expense->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="entry_date">Entry Date</label>
                                    <input value="{{ $expense->entry_date }}" type="date" name="entry_date" class="form-control">
                                    @error('entry_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input value="{{ $expense->amount }}" type="number" name="amount" class="form-control" >
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-md-3">
                                <div class="form-group">
                                    <label for="currency_code">Curreny:  <span class="text-danger">*</span></label>
                                    <select class="select form-control select3" id="currency_code" name="currency_code"  data-fouc data-placeholder="Choose..">
                                        <option value="KHR" {{$expense->currency_code === 'KHR' ? 'selected':''}}>KHR</option>
                                        <option value="USD" {{$expense->currency_code === 'USD' ? 'selected':''}}>USD</option>
                                    </select>
                                    @error('currency_code')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="income_category_id">Expense Category: <span class="text-danger">*</span></label>
                                    <select class="select form-control select3" id="expense_category_id" name="expense_category_id"  data-fouc data-placeholder="Choose..">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id === $expense->expense_category_id ? 'selected' : '' }} >{{ $category->name }}</option>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('expense_category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            

                            </div>


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea value="{{ $expense->description }}" name="description" class="form-control" rows="3" placeholder="Enter ...">{{ $expense->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                      </div>
                                </div>
                            </div>


                            {{-- <div class="row"> --}}
                                <button type="submit" class="btn btn-primary">Update</button>
                            {{-- </div> --}}
                        </form>

                    </div>

                </div>

            </div>



        </div>
    </div>

</div>






@endsection
