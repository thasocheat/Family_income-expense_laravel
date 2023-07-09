@extends('layouts.master')
@section('page_title', 'Manage Incomes')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">

            @if(Session::has('msg'))
                <p class="alert alert-info">{{ Session::get('msg') }}</p>
            @endif

            <div class="card">
                <div class="card-header header-elements-inline">
                    <h6 class="card-title">Manage Incomes</h6>
                    <a href="{{route('incomes.index')}}" class="btn btn-info float-right">View Your Incomes</a>

                </div>


                <div class="card-body">

                    <div class="tab-content">

                        <form action="{{ route('incomes.store') }}" method="POST">
                            @csrf

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="entry_date">Entry Date</label>
                                    <input type="date" name="entry_date" class="form-control">
                                    @error('entry_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" >
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                  </div>
                               
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="income_category_id">Income Category:  <span class="text-danger">*</span></label>
                                    <select class="select form-control" id="income_category_id" name="income_category_id"  data-fouc data-placeholder="Choose..">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('income_category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                               
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>

                    </div>

                </div>

            </div>

            

        </div>
    </div>

</div>




    

@endsection