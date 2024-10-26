@extends('back-end.backend-master')

@section('admin-title')
 {{ $create }}
@endsection

@push('admin-styles')
<style>
  .form-area{
    padding:30px 0px;
    background: #fff;
  }
    .image-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .image-container img {
            max-width: 100px;
            max-height: 100px;
            border: 1px solid #ccc;
            padding: 5px;
            border-radius: 5px;
        }

        .image-container {
            display: inline-block;
            position: relative;
            margin: 10px;
        }
       
        .delete-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
        }
</style>
@endpush

@section('admin-content')
<div class="row">
      <div class="col-12 form-area">
         <div class="col-md-8">
              <div class="card">
                <form class="form-horizontal" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="card-body">
                    <h4 class="card-title">
                      {{ $create }}
                      <a href="{{ route('product.index') }}" class="btn btn-sm btn-info float-end">
                        <i class="fa fa-eye"></i> All Product
                        </a>
                    </h4>

                     <div class="form-group row">
                    <label class="col-md-3 mt-3">Category <span class="text-danger">*</span></label>
                    <div class="col-md-9">
                      <select name="category_id" id="category_id"
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px">
                          <option>Select</option>
                          @foreach($categories as $category)
                          <option value="{{ $category->id }}">
                            {{ $category->cat_name }}
                          </option>
                          @endforeach
                         
                      </select>
                      @error('category_id')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                    <div class="form-group row">
                      <label
                        for="name"
                        class="col-sm-3 control-label col-form-label"
                        >Subcategory</label
                      >
                      <div class="col-sm-9">
                        <select name="subcategory_id" id="subcategory_id"
                        class="select2 form-select shadow-none"
                        style="width: 100%; height: 36px"
                      >
                       
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
                          <option value="{{ $brandInfo->id }}">
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
                         <!--  <option>Select</option> -->
                           @foreach($units as $unitInfo)
                          <option value="{{ $unitInfo->id }}">
                            {{ $unitInfo->unit_name }}
                          </option>
                          @endforeach
                        
                      </select>
                    </div>
                  </div>

                      <div class="form-group row">
                    <label class="col-md-3 mt-3">Size</label>
                    <div class="col-md-9">
                      <select name="size[]" id="size_id"
                        class="select2-multiple shadow-none" multiple="multiple"
                        style="width: 100%; height: 36px">
                          <option value="">Select</option>
                           @foreach($sizes as $sizeInfo)
                          <option value="{{ $sizeInfo->size_name }}">
                            {{ $sizeInfo->size_name }}
                          </option>
                          @endforeach
                        
                      </select>
                    </div>
                  </div>

                      <div class="form-group row">
                    <label class="col-md-3 mt-3">Color</label>
                    <div class="col-md-9">
                      <select name="color[]" id="color_id" class="select2-multiple  shadow-none mt-3" multiple="multiple" style="height: 36px; width: 100%">
                          <option value="">Select</option>
                           @foreach($colors as $colorsInfo)
                          <option value="{{ $colorsInfo->color_name }}">
                            {{ $colorsInfo->color_name }}
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
                        <input
                          type="text" name="product_name"
                          class="form-control"
                          id="name"
                          placeholder="Product Name"
                        />
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
                          id="name"
                          placeholder="Sale Price"
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
                              <option value="">Select Type</option>
                              <option value="flat">Flat</option>
                              <option value="percent">Percent</option>
                          </select>
                      </div>
                  </div>

                  <div class="form-group row" id="discount_price">
                      <label for="discount_price" class="col-sm-3 control-label col-form-label">
                          Discount Price
                      </label>
                      <div class="col-sm-9">
                          <input type="text" name="discount_price" class="form-control" id="discount_price" placeholder="Discount Price" />
                      </div>
                  </div>

                      <div class="form-group row">
                      <label
                        for="quantity"
                        class="col-sm-3 control-label col-form-label"
                        >Quantity <span class="text-danger">*</span></label
                      >
                      <div class="col-sm-9">
                        <input
                          type="text" name="quantity"
                          class="form-control"
                          id="quantity"
                          placeholder="Quantity"
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
                        <textarea name="product_description"
                          class="form-control"
                          placeholder="Product Description" id="sinan"
                        ></textarea>
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
                      @error('product_image')
                          <span class="text-danger">{{ $message }}</span>
                        @enderror
                      <img id="viewer" src="#" alt="Image Viewer" style="display: none;height:100px;width:100px;">
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

   $(document).on('change','#category_id',function(){
    var category_id = $(this).val();
    $.ajax({
      url:'{{ route("get.subcategory") }}',
      method:'GET',
      dataType:'json',
      data:{category_id:category_id},
      success:function(response){
        $('#subcategory_id').empty();
        // $('#subcategory_id').append('<option>Select here</option>');
        response.forEach(function(res){
          $('#subcategory_id').append('<option value="'+res.id+'">'+res.subcat_name+'</option>');
       })
      }
    });
  });

   $('#discount_price').hide();

    $(document).on('change','#discount_type',function(){
    
      var discountTypeValue = $('#discount_type').val();
     
      if (discountTypeValue === 'flat' || discountTypeValue === 'percent') {
          $('#discount_price').show();
      } else {
          $('#discount_price').hide();
      }

   });

 
 });
</script>


@endpush

