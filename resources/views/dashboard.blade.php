<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Welcome back ... {{ Auth::user()->name }}
           <b style="float:right">Total Registered Users:
        <span class="badge bg-warning">{{count($users)}}</span></b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <table class="table">
            <thead>
                <tr>
                <th scope="col">Sequence #</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Registration Date</th>
                </tr>
            </thead>
            <tbody>
                @php($id=0)
                @foreach($users as $user)
                <tr>
                <th scope="row">{{++$id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{Carbon\Carbon::parse($user->created_at)->diffforHumans()}}</td>
                {{--<td>{{$user->created_at->diffforHumans()}}</td>--}}
                </tr>
                @endforeach
            </tbody>
            </table>
            </div>
        
    </div>
</x-app-layout>
