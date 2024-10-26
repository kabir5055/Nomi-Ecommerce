@extends('front-end.master')

@section('meta_title')
Shipping Information
@endsection

@push('styles')
<style>
#login-area{padding:50px 0px}.card{border-radius: 0}.card-header{padding: 5px 18px;background: #e6f2ff}button.submit_btn{height: 40px;margin-left: 10px;width: 130px;border-radius: 20px;color: #fff !important;background: #007bff;font-size: 16px;font-weight: 600}button.submit_btn:hover{background: #0056b3}
</style>
@endpush

@section('content')

<div class="breadcrumb-area">
        <div class="container">

            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a href="{{ route('front.home') }}">Home</a></li>
                        <li class="active"><a href="">Shipping Address</a></li>
                </div>
            </div>
        </div>
    </div>

<section id="login-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="login-box">
                    <form action="{{ route('front.shipping.address.store') }}" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">
                                    <h4 class="card-title">Shipping Information</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                                    <!-- First Row: Division and District -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="division">Division <span class="text-danger">*</span></label>
                                            <select name="division_id" id="division" class="form-control">
                                                <option value="">Select Division</option>
                                                @foreach($divisions as $division)
                                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="district">District <span class="text-danger">*</span></label>
                                            <select name="district_id" id="district" class="form-control">
                                                <option value="">Select District</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <!-- Second Row: Thana and Union -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="thana">Thana <span class="text-danger">*</span></label>
                                            <select name="thana_id" id="thana" class="form-control">
                                                <option value="">Select Thana</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="union">Union</label>
                                            <select name="union_id" id="union" class="form-control">
                                                <option value="">Select Union</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="address">Address <span class="text-danger">*</span></label>
                                    <textarea name="address" placeholder="Address" class="form-control" rows="3">{{ $user->address ?? '' }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" placeholder="Name" class="form-control" value="{{ $user->name??'' }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Email</label>
                                    <input type="text" name="email" placeholder="Email" class="form-control" value="{{ $user->email??'' }}">
                                </div>

                                <div class="form-group mt-2">
                                    <label for="">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" placeholder="Phone" class="form-control" value="{{ $user->phone??'' }}">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-sm submit_btn">
                                    <i class="fa fa-paper-plane"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection

@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // When a division is selected, load districts
        $('#division').change(function() {
            var divisionId = $(this).val();
            if (divisionId) {
                $.ajax({
                    url: "{{ url('/get-districts') }}/" + divisionId,
                    type: "GET",
                    success: function(data) {
                        $('#district').html('<option value="">Select District</option>');
                        $.each(data, function(key, value) {
                            $('#district').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                        $('#thana').html('<option value="">Select Thana</option>'); // Reset thana dropdown
                        $('#union').html('<option value="">Select Union</option>'); // Reset union dropdown
                    }
                });
            } else {
                $('#district').html('<option value="">Select District</option>');
                $('#thana').html('<option value="">Select Thana</option>');
                $('#union').html('<option value="">Select Union</option>');
            }
        });

        // When a district is selected, load thanas
        $('#district').change(function() {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: "{{ url('/get-thanas') }}/" + districtId,
                    type: "GET",
                    success: function(data) {
                        $('#thana').html('<option value="">Select Thana</option>');
                        $.each(data, function(key, value) {
                            $('#thana').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                        $('#union').html('<option value="">Select Union</option>'); // Reset union dropdown
                    }
                });
            } else {
                $('#thana').html('<option value="">Select Thana</option>');
                $('#union').html('<option value="">Select Union</option>');
            }
        });

        // When a thana is selected, load unions
        $('#thana').change(function() {
            var thanaId = $(this).val();
            if (thanaId) {
                $.ajax({
                    url: "{{ url('/get-unions') }}/" + thanaId,
                    type: "GET",
                    success: function(data) {
                        $('#union').html('<option value="">Select Union</option>');
                        $.each(data, function(key, value) {
                            $('#union').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#union').html('<option value="">Select Union</option>');
            }
        });
    });
</script>

@endpush