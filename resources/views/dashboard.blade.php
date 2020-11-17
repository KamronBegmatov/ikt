<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Админ панель') }}
        </h2>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
            }
            input {
                border: 1px solid black;
                border-collapse: collapse;
                margin: 2px;
                border-radius: 3px;
            }
        </style>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <form action="/dashboard/store" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="color">Color: </label>
                        <input type="text" name="color" required>
                        <input type="submit" value=" Generate random amount of apples ">

                    </form>

                    <h2>Apples</h2>

                    <table style="width: 100%;">
                        <tr>
                            <th>Id</th>
                            <th>Color</th>
                            <th>Date_of_creation</th>
                            <th>Date_of_falling</th>
                            <th>Status</th>
                            <th>Percentage (eaten)</th>
                            <th>Fall</th>
                            <th>Eat (%)</th>
                            <th>Delete</th>
                        </tr>
                        @foreach($apples as $apple)
                        <tr>
                            <td>{{$apple->id}}</td>
                            <td>{{$apple->color}}</td>
                            <td>{{$apple->created_at}}</td>
                            <td>{{$apple->date_of_falling}}</td>
                            @if($apple->status == 0)
                            <td>On the tree</td>
                            @endif
                            @if($apple->status == 1)
                                <td>On the ground</td>
                            @endif
                            @if($apple->status == 2)
                                <td>Rotten</td>
                            @endif
                            <td>{{$apple->percentage}}%</td>
                            <td>
                                <form action="/dashboard/fall" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <input type="hidden" name="id" value="{{$apple->id}}">
                                <input type="submit" value=" Fall ">
                                </form>
                            </td>
                            <td>
                                <form action="/dashboard/eat" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <input type="hidden" name="id" value="{{$apple->id}}">
                                <input type="text"  name="percent">
                                <input type="submit" value=" Eat ">
                                </form>
                            </td>
                            <td>
                                <form action="/dashboard/delete" method="POST" enctype="multipart/form-data">
                                    @csrf
                                <input type="hidden" name="id" value="{{$apple->id}}">
                                <input type="submit" value=" Delete ">
                                </form>
                            </td>
                        </tr>
                            @endforeach
                    </table>
            </div>
        </div>
    </div>
</x-app-layout>

