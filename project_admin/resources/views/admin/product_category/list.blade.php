@extends('layouts.admin')
@section('content')
    @if (session("alert"))
        <div class="alert alert-success form-control alertStatus">
            <i class="fas fa-check-circle"></i>{{ session("alert") }}
        </div>
    @endif
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card" style="margin-bottom: 20px">
                    <div class="card-header font-weight-bold">
                        ADD PRODUCT CATEGORY
                    </div>
                    <div class="card-body" style="margin-bottom: 20px">
                        <form action="{{ route("product_category.store") }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Product Category Title</label>
                                <input class="form-control" type="text" name="title" id="name" class="@error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" name="btnAddCategory" class="btn btn-primary">ADD</button>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header font-weight-bold">
                        EDIT product CATEGORY
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Product Category Title</label>
                            @foreach ($product_category as $item)
                                @if ($item->id == Session::get("id"))
                                    <form action="{{ route("product_category.update", $item->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                        <input class="form-control" type="text" name="title" id="name" value="{{ $item->title_category_clothing }}" class="@error('title') is-invalid @enderror">
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        <br><button type="submit" name="btnUpdateCategory" class="btn btn-primary">SAVE</button>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Product Category
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Index</th>
                                    <th scope="col">Category</th>
                                    <th scope="col" style="float:right; margin-right: 35px">Action</th>
                                </tr>
                            </thead>
                            @php $count = 0; @endphp
                            @foreach ($product_category as $item)
                                @php ++$count; @endphp
                                <tbody>
                                    <tr>
                                        <th scope="row">{{ $count }}</th>
                                        <td>{{ $item->title_category_clothing }}</td>
                                        <td style="display: flex; float:right">
                                            <a href="{{ route("product_category.edit", $item->id) }}" class="btn btn-success btn-sm rounded-0" data-toggle="tooltip" data-placement="top" title="Edit" style="margin-right:5px">EDIT</a>
                                            <form action="{{ route("product_category.destroy", $item->id) }}" method="POST">
                                              @csrf
                                                @method("delete")
                                                <input type="submit" class="btn btn-danger btn-sm rounded-0" value="DELETE" data-toggle="tooltip" data-placement="top" title="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection