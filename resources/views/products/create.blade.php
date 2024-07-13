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
                    <h5>Add New Products</h5>
                </div>
                <div class="card-body">
                    <form method="post"  id="prodform" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                          <label for="title" class="form-label">Title</label>
                          <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                          @error('title')
                          <span class="error-message">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" class="form-control" id="description" name="description" value="{{old('description')}}">
                            @error('description')
                            <span class="error-message">{{ $message }}</span>
                            @enderror
                          </div>
                         <div class="mb-3">
                            <label for="logo" class="form-label">Image</label>
                            <input type="file" class="form-control" id="logo"  name="logo" accept="image/*">
                            @error('logo')
                            <span class="error-message">{{ $message }}</span>
                            @enderror  
                        </div>
                        <h6><u>Product Variant</u></h6>
                        <div id="variants" class="mb-3">
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <select class="form-control" name="variants[0][name]">
                                        <option value="">--select--</option>
                                        <option value="size">Size</option>
                                        <option value="color">Color</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"  class="form-control" name="variants[0][value]" placeholder="variant value">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <select class="form-control" name="variants[1][name]">
                                        <option value="">--select--</option>
                                        <option value="size">Size</option>
                                        <option value="color">Color</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <input type="text"  class="form-control" name="variants[1][value]" placeholder="variant value">
                                </div>
                            </div>
                        </div>
                        
                       
                       <div class="mb-3">
                        <button type="submit" class="btn btn-primary btn-sm" >Submit</button>
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
                    required: true,
                    minlength: 2, 
                    maxlength:190,   
                },
               
            },
        



            });
        });
</script>
@endsection