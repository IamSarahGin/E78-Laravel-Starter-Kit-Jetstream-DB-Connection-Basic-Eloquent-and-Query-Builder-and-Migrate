<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           ALL CATEGORIES
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            
            {{--insert form--}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Edit Category</div>
                    <div class="card-body">
                        <form action="{{url('category/update/'.$categories->id)}}" method="POST">
                            @csrf 
                            <div class="mb-3">
                                <label for="category_name" class="form-label"> Update Category</label>
                                <input type="text" name="category_name" class="form-control" id="category_name" aria-describedby="addCategory" value="{{$categories->category_name}}">     
                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            
            
         

            </div>
        </div>












        
    </div>
</x-app-layout>
