@extends('layouts.app')

@section('content')
    <users search_path="{{route('usersSearch')}}" activation_path="{{route('usersActive', [''])}}" edit_path="{{route('usersEdit', [''])}}" delete_path="{{route('usersDelete', [''])}}" inline-template>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-10">
                    <div class="card">
                        <div class="card-header">Users</div>

                        <div class="card-body">
                            <div class="row">
                                <a class="btn btn-primary small m-1" href="{{route('usersCreate')}}">Add User</a>
                                <table class="table" v-if="pagination.total > 0">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="item in items">
                                            <th>@{{ item.id }}</th>
                                            <td data-toggle="tooltip" data-placement="top" :title="item.name">@{{ cut(item.name, 25) }}</td>
                                            <td>@{{ item.email }}</td>
                                            <td>@{{ item.role }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                        <button class="dropdown-item" @click.prevent="edit(item)">Edit</button>
                                                        <button class="dropdown-item" @click.prevent="active(item)" v-if="item.name != 'admin' && item.active">Deactivate</button>
                                                        <button class="dropdown-item" @click.prevent="active(item)" v-if="item.name != 'admin' && !item.active">Activate</button>
                                                        <button class="dropdown-item" @click.prevent="deleteItem(item)" v-if="item.name != 'admin'">Delete</button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination :pagination="pagination" :offset="3"></pagination>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </users>
@endsection
