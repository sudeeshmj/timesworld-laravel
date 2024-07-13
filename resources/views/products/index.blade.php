@extends('layouts.master')
@section('content')

<div class="container-fluid p-4">
    <div class="row">
        <div class="col-md-12">
            <div id="response_message"></div>
            <div class="card">
                <div class="card-header">
                    <h5>
                        Products
                        <a class="btn btn-sm btn-success float-end" href="{{route('products.create')}}">Add New</a>
                    </h5>
                </div>
                <div class="card-body">
                    <div id="response_message"></div>
                    @if (session()->has('message'))
                        <script>
                            toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            positionClass: 'toast-bottom-right' 
                        }; 
                        toastr.success("{{session()->get('message')}}")</script>
                    @endif
                    @if (session()->has('error'))
                       <script> 
                       toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        positionClass: 'toast-bottom-right' 
                    }; toastr.error("{{session()->get('error')}}")</script>
                      @endif
                    <table class="table table-sm table-striped table-bordered hover" id="myDataTable">
                        <thead>
                          <tr>
                            <th scope="col" style="width: 5%;" >#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Variants</th>
                            <th scope="col" style="width: 15%;" >Action</th>
                          </tr>
                        </thead>
                        <tbody id="tbody">
                           @if ($products->isEmpty())
                               <tr><td colspan="6" class="text-center">No records found</td></tr>
                           @else
                               
                          
                         @foreach ($products as $product)
                         <tr>
                            <td class="align-middle">{{$loop->iteration}}</td>
                            <td class="align-middle">{{$product->title}}</td>
                            <td class="align-middle">{{$product->description}}</td>
                            <td class="align-middle">
                                @if($product->image)
                                <img src="{{asset('storage/logos/'.$product->image)}}" alt="logo" width="50px" height="50px"></td>
                                @endif
                                <td class="align-middle">
                                    @foreach($product->variants as $variant)
                                    <div>{{ ucfirst($variant->variant_name) }}: {{ $variant->variant_value }}</div>
                                @endforeach
                                </td>
                            <td class="align-middle">
                                <a class="btn btn-warning btn-sm" href="{{route('products.edit' , encrypt($product->id))}}">Edit</a>
                                <button class="btn btn-danger btn-sm" id="deletebtn" value="{{$product->id}}" >Delete</button>

                            </td>
                          </tr>
                         @endforeach
                         @endif
                       
                        </tbody>
                      </table>
                      <div class="paginate float-end">
                        {{-- {{$companies->links()}} --}}
                      </div>
                      
                </div>
            </div>
        </div>
    </div>
</div>
    @include('products.delete')
<script>
$(document).ready(function(){
toastr.options = {
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-bottom-right' 
            };  

    $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

$(document).on('click','#deletebtn',function(e){
            e.preventDefault();
            var comp_id = $(this).val();
            $('#delete_id').val(comp_id);
            $('#deleteModal').modal('show');
          
    });

//delete operation

        $(document).on('click','#delete_modal_btn',function(e){
        e.preventDefault();
        var delete_id = $('#delete_id').val();   
        $.ajax({
               type:'post',
               url:"products/delete/"+delete_id,
               dataType:'json',
               success:function(response) {
               if(response.status == 404){ 
                    $("#deleteModal").modal('hide');
                    toastr.error(response.message)
                  
                    location.reload();
                }
                else{
                    $("#deleteModal").modal('hide');
                    toastr.success(response.message)
                  
                    location.reload();
               }
                
               },
               error:function(err) {
                 console.log(err);
               }
            });


    });
});

</script>
@endsection