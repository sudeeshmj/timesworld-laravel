@extends('layouts.master')
@section('content')
    
<style>
  
</style>
<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12">
            <div id="response_message"></div>
            <div class="card">
                <div class="card-header">
                    <h5>Update Products</h5>
                </div>
                <div class="card-body">
                    <form  method="POST"  id="prodform" action="{{route('products.update',encrypt($product->id))}}" enctype="multipart/form-data">
                       @csrf
                    
                        <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{$product->title }}">
                          @error('title')
                          <span class="error-message">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{$product->description}}">
                            @error('description')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                          </div>
                          <div class="mb-3">
                            <label for="logo">Image</label>
                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*>
                            @if($product->image)
                                <img src="{{ asset('storage/logos/' . $product->image) }}" alt="logo" width="50px" height="50px">
                            @endif
                            @error('logo')
                            <span class="error-message">{{ $message }}</span>
                            @enderror 
                        </div>
                        <h6><u>Product Variants</u></h6>
                        <div id="variants" class="mb-3">
                            @foreach($product->variants as $index => $variant)
                                <div class="row mb-2 variant-row" data-index="{{ $index }}">
                                    <div class="col-md-6">
                                        <select class="form-control" name="variants[{{ $index }}][name]">
                                            <option value="">--select--</option>
                                            <option value="size" {{ $variant->variant_name == 'size' ? 'selected' : '' }}>Size</option>
                                            <option value="color" {{ $variant->variant_name == 'color' ? 'selected' : '' }}>Color</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="variants[{{ $index }}][value]" value="{{ $variant->variant_value }}" placeholder="Variant Value">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                       <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm" >Update</button>
                     </div>
                     
                      </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    $("#prodform").validate({
        rules: {
            title: {
                    required: true,
                    minlength: 2,
                    maxlength:50,
                },
                description: {
                    minlength: 2, 
                    maxlength:50,   
                },
               
            },
          



            });
        });
</script>
@endsection