<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           ALL CATEGORIES
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <div class="card p-0 col-md-8 overflow-hidden">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong> 
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <table class="table">
            <thead class="table-light">
                <tr>
                <th scope="col">List #</th>
                <th scope="col">Category</th>
                <th scope="col">User</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
             {{--   @php($i=1)--}}
                @foreach($categories as $category)
                <tr>
                <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                <td>{{$category->category_name}}</td>
                <td>{{$category->name}}</td>
                {{--<td>{{$category->user_id}}</td>--}}
                <td>
                @if($category->created_at==NULL)
                    <span class="text-danger">Date not Set...</span>
                @else    
                {{Carbon\Carbon::parse($category->created_at)->diffforHumans()}}
                @endif    
            </td>
            <td>
                <a href="{{url("category/edit/".$category->id)}}" class="btn btn-info">Edit</a>
                <a href="{{url("softdelete/category/".$category->id)}}" class="btn btn-danger">Trash</a>
            </td>
                
                </tr>
                @endforeach
            </tbody>
            </table>
            <div class="p-1">
            {{$categories->links()}}
            </div>
            
            </div>
            {{--insert form--}}
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        <form action="{{route('store.category')}}" method="POST">
                            @csrf 
                            <div class="mb-3">
                                <label for="category_name" class="form-label">Category</label>
                                <input type="text" name="category_name" class="form-control" id="category_name" aria-describedby="addCategory">     
                                @error('category_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            {{--TRASHED LIST--}}
            <div class="card p-0 col-md-8 overflow-hidden">
            <div class="card-header">Trash List</div>
            <table class="table">
            <thead class="table-light">
                <tr>
                <th scope="col">List #</th>
                <th scope="col">Category</th>
                <th scope="col">User</th>
                <th scope="col">Created</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
             {{--   @php($i=1)--}}
                @foreach($trashes as $category)
                <tr>
                <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                <td>{{$category->category_name}}</td>
                <td>{{$category->user->name}}</td>
                {{--<td>{{$category->user_id}}</td>--}}
                <td>
                @if($category->created_at==NULL)
                    <span class="text-danger">Date not Set...</span>
                @else    
                {{Carbon\Carbon::parse($category->created_at)->diffforHumans()}}
                @endif    
            </td>
            <td>
                <a href="{{url("category/restore/".$category->id)}}" class="btn btn-info">Restore</a>
                <a href="{{url("delete/category/".$category->id)}}" class="btn btn-danger">Delete</a>
            </td>
                
                </tr>
                @endforeach
            </tbody>
            </table>
            <div class="p-1">
            {{$trashes->links()}}
            </div>    
            </div>
            </div>
        </div>












        
    </div>
</x-app-layout>
