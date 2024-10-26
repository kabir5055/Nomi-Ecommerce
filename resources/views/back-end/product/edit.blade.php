@extends('back-end.backend-master')

@section('admin-title')
 {{ $edit }}
@endsection

@push('admin-styles')
<style>
  .form-area{
    padding:30px 0px;
    background: #fff;
  }
  .image-container img {
  height: 50px;
  width: 112px;
}
</style>
@endpush

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form action="{{ route('product.update') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                      Product Information
                      <a href="{{ route('product.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Product
                        </a>
                    </h4>

                    <input type="hidden" name="id" value="{{ $info->id }}">

                     <div class="form-group row">
                    <label class="col-md-3 mt-3">Category <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                      <select name="category_id" id="category_id"
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px"
                      >
                          <option>Select</option>
                          @foreach($categories as $key=>$category)
                          <option value="{{ $category->id }}" {{ ($category->id==$info->category_id) ? 'selected' :'' }}>{{ $category->cat_name }}</option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                    <div class="form-group row">
                      <label for="name" class="col-sm-3 control-label col-form-label">
                         Subcategory
                      </label>
                      <div class="col-sm-9">
                        <select name="subcategory_id" id="subcategory_id" class="select2 form-select shadow-none" style="width: 100%; height: 36px">

                      </select>
                      </div>
                    </div>

                       <div class="form-group row">
                    <label class="col-md-3 mt-3">Brand <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                      <select name="brand_id" id="brand_id"
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                          <option>Select</option>
                           @foreach($brands as $brandInfo)
                          <option value="{{ $brandInfo->id }}" {{ $brandInfo->id==$info->brand_id?'selected':'' }}>
                            {{ $brandInfo->brand_name }}
                          </option>
                          @endforeach
                        
                      </select>
                    </div>
                  </div>

                     <div class="form-group row">
                    <label class="col-md-3 mt-3">Unit <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                      <select name="unit_id" id="unit_id"
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                          <option value="">Select</option>
                           @foreach($units as $unitInfo)
                          <option value="{{ $unitInfo->id }}" {{ $unitInfo->id==$info->unit_id?'selected':'' }}>
                            {{ $unitInfo->unit_name }}
                          </option>
                          @endforeach
                        
                      </select>
                    </div>
                  </div>

                      <div class="form-group row">
                        <label class="col-md-3 mt-3">Size</label>
                        <div class="col-md-9">
                            @php
                                $all_sizes = json_decode($info->size);
                            @endphp
                            
                            <select name="size[]" id="size_id" class="select2-multiple form-control" multiple="multiple" style="width: 100%; height: 36px">
                                <option value="">Select Size</option>
                                @foreach($sizes as $size1)
                                    <option value="{{ $size1->size_name }}" {{ is_array($all_sizes) && in_array($size1->size_name, $all_sizes) ? 'selected' : '' }}>
                                        {{ $size1->size_name }}
                                    </option>                      
                                @endforeach
                            </select>
                            
                            @error('size')
                                <p class="help-block text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                      <div class="form-group row">
                    <label class="col-md-3 mt-3">Color</label>
                    <div class="col-md-9">

                      <?php
                        $all_colors = json_decode($info->color);
                      ?>
                      <select name="color[]" id="color_id"
                        class="select2-multiple shadow-none" multiple="multiple" 
                        style="width: 100%; height: 36px"
                      >
                          <option value="">Select</option>
                          @foreach($colors as $key=>$info1)
                          <option value="{{ $info1->color_name }}" {{ is_array($all_colors) && in_array($info1->color_name,$all_colors)?'selected':'' }}>
                            {{ $info1->color_name }}
                          </option>
                          @endforeach
                      </select>
                    </div>
                  </div>

                       <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Product Name <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input type="text" name="product_name" class="form-control" id="product_name" value="{{ $info->product_name }}"/>
                        @error('product_name')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                       <div class="form-group row">
                      <label for="name" class="col-sm-3 control-label col-form-label">
                        Sale Price <span class="text-danger">*</span>
                      </label>
                      <div class="col-sm-9">
                        <input
                          type="text" name="sale_price"
                          class="form-control"
                          id="name" value="{{ $info->sale_price }}"
                        />
                         @error('sale_price')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>
                    
                  <div class="form-group row">
                      <label class="col-md-3 mt-3">Discount Type</label>
                      <div class="col-md-9">
                          <select name="discount_type" id="discount_type" class="select2 form-select shadow-none mt-3" style="height: 36px; width: 100%">
                              <option selected>Select Type</option>
                              <option value="flat" {{ $info->discount_type=="flat"?'selected':'' }}>Flat</option>
                              <option value="percent" {{ $info->discount_type=="percent"?'selected':'' }}>
                                Percent
                              </option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group row" id="discount_price">
                      <label for="discount_price" class="col-sm-3 control-label col-form-label">
                          Discount Price
                      </label>
                      <div class="col-sm-9">
                          <input type="text" name="discount_price" class="form-control" id="discount_price" value="{{ $info->discount_price }}" />
                      </div>
                  </div>

                      <div class="form-group row">
                      <label
                        for="quantity"
                        class="col-sm-3 control-label col-form-label"
                        >Quantity<span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="quantity"
                          class="form-control"
                          id="quantity"
                          value="{{ $info->quantity }}" 
                        />
                         @error('quantity')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>

                     <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Product Description <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <textarea name="product_description" class="form-control" placeholder="Product Description" id="sinan">
                          {!! $info->product_description !!}
                        </textarea>
                         @error('product_description')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      </div>
                    </div>


                      <div class="form-group row">
                    <label class="col-md-3">Product Image <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <input
                          type="file" name="product_image"
                          class="custom-file-input"
                          id="singleImage"
                          
                        />
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Choose file...</label
                        >
                        <div class="invalid-feedback">
                          Example invalid custom file feedback
                        </div>
                         
                      </div>
                       <img style="max-height:100px;margin-top:20px" id="viewer" src="{{ asset('back-end/product/product/'.$info->product_image) }}"/>
                      @error('product_image')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      <img id="viewer" src="#" alt="Image Viewer" style="display: none;width:100px;height:100px;">
                    </div>
                  </div>

                      <div class="form-group row">
                    <label class="col-md-3">Product Gallery</label>
                    <div class="col-md-9">
                      <div class="custom-file">
                        <input
                          type="file" name="product_gallery[]"
                          class="custom-file-input"
                          id="multipleImage"
                           multiple
                        />
                        <label
                          class="custom-file-label"
                          for="validatedCustomFile"
                          >Choose file...</label
                        >
                        <div class="invalid-feedback">
                          Example invalid custom file feedback
                        </div>

                      </div>
                            <?php
                               $items = json_decode($info->product_gallery);
                            ?>
                         @if(!empty($items))
                          @foreach($items as $index => $gallery_image)
                              <div style="display: inline-block; margin-right: 10px; margin-top: 20px;">
                                  <img src="{{ asset('/') }}back-end/product/gallery/{{ $gallery_image }}" alt="" style="height:50px;">
                                  
                                      <a href="{{ route('product.delete.gallery', ['id' => $info->id, 'index' => $index]) }}" style="background:none; border:none; color:red; cursor:pointer;">Delete</a>
                                  
                              </div>
                          @endforeach
                      @else
                          <h3>No Image</h3>
                      @endif

                       @error('product_gallery')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror

                      <div id="imageContainer" class="image-container mt-3" >
                        <!-- Uploaded images will be displayed here -->
                    </div>

                    </div>
                  </div>

                  </div>
                  <div class="border-top">
                    <div class="card-body">
                      <button type="submit" class="btn btn-primary float-end">
                        <i class="fa fa-paper-plane"></i> Submit
                      </button>
                    </div>
                  </div>
                </form>
              </div>
             
              
            </div>
      </div>
    </div>
@endsection


@push('admin-scripts')
<script type="text/javascript">
  $(function(){

    // $('#district').hide();
    // $('#thana').hide();
    // $('#union').hide();

  //  $(document).on('change','#category_id',function(){
  //   var category_id = $(this).val();
  //   $.ajax({
  //     url:'{{ route("get.subcategory") }}',
  //     method:'GET',
  //     dataType:'json',
  //     data:{category_id:category_id},
  //     success:function(response){
  //       $('#subcategory_id').empty();
  //       // $('#subcategory_id').append('<option>Select here</option>');
  //       response.forEach(function(res){
  //         $('#subcategory_id').append('<option value="'+res.id+'">'+res.subcat_name+'</option>');
  //      })
  //     }
  //   });
  // });

   // $('#discount_price').hide();

   // $(window).on('load', function() {
    
   //    var discountTypeValue = $('#discount_type').val();

   //    alert(discountTypeValue);
     
   //    if (discountTypeValue === 'flat' || discountTypeValue === 'percent') {
   //        $('#discount_price').show();
   //    } else {
   //        $('#discount_price').hide();
   //    }

   // });

 });
</script>

<script>
  $(document).ready(function() {
    function toggleDiscountPrice() {
        var discountTypeValue = $('#discount_type').val();
        if (discountTypeValue === 'flat' || discountTypeValue === 'percent') {
            $('#discount_price').show();
        } else {
            $('#discount_price').hide();
        }
    }

    // Initial check
    toggleDiscountPrice();

    // On change event of discount type select
    $('#discount_type').on('change', function() {
        toggleDiscountPrice();
    });
});
</script>


<script>
  $(window).on('load', function() {
    var category_id = $('#category_id').val();
    var selected_subcategory_id = '{{ $info->subcategory_id }}'; // Assuming $info->area_id is the ID of the selected area

    if (category_id) {
        fetchSubcategoriesAndDataEntries(category_id, selected_subcategory_id);
    }

    $('#category_id').on('change', function() {
        var category_id = $(this).val();
        fetchSubcategoriesAndDataEntries(category_id);
    });

    function fetchSubcategoriesAndDataEntries(category_id, selected_subcategory_id = null) {
        $.ajax({
            url: '{{ route("get.subcategory") }}',
            method: 'GET',
            dataType: 'json',
            data: { category_id: category_id },
            success: function(response) {
                $('#subcategory_id').empty();
                // $('#subcategory_id').append('<option>Select Area</option>');
                response.forEach(function(res) {
                    var selected = res.id == selected_subcategory_id ? 'selected' : '';
                    $('#subcategory_id').append('<option value="'+ res.id +'" '+ selected +'>'+ res.subcat_name +'</option>');
                });
            },
            error: function(xhr) {
                console.error('Error fetching areas:', xhr.responseText);
            }
        });
    }
});
</script>


@endpush