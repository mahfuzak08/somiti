@extends('layout.master')

@push('plugin-styles')
  <link rel="stylesheet" href="{{ asset('assets/plugins/plugin.css')}}">
@endpush

@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">{{$type}} Brand</h4>
          @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <form action="{{route('brand.save') }}" method="POST" class="forms-sample row" id="">
            @csrf
            <input type="hidden" name="id" value="{{ $type === 'add' ? '' : $brands[0]->id}}">
            <input type="hidden" name="post_type" value="{{ $type }}">
            <div class="col-12 col-md-8">
              <div class="form-group">
                <label for="exampleInputName1">Brand Name</label>
                <input type="text" name="brand_name" value="{{$type!=='add' ? $brands[0]->brand_name : ''}}" class="form-control" id="exampleInputName1" placeholder="Name">
              </div>
            </div>
            <div class="col-12 col-md-4">
              
            </div>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
            <a href="{{ url('inventory/brands') }}" class="btn btn-light">Cancel</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}" defer></script>
  <script src="{{ asset('assets/plugins/jquery-sparkline/jquery.sparkline.min.js') }}" defer></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/dashboard.js') }}" defer></script>
@endpush