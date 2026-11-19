@extends('layouts.app')

@section('content')

<h1 class="text-danger">
    TEST PAGE
</h1>

<div class="container-fluid">

<div class="d-sm-flex align-items-center justify-content-between mb-4">

<h1 class="h3 mb-0 text-gray-800">

Search Result

</h1>

</div>

<div class="card shadow mb-4">

<div class="card-header py-3">

<h6 class="m-0 font-weight-bold text-primary">

Search Keyword :

<strong>{{ $keyword }}</strong>

</h6>

</div>

<div class="card-body">

@if($books->count())

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead class="thead-light">

<tr>

<th>Photo</th>

<th>Title</th>

<th>Author</th>

<th>Genre</th>

<th>Edition</th>

<th>Available</th>

<th>Status</th>

<th width="120">Action</th>

</tr>

</thead>

<tbody>

@foreach($books as $book)

<tr>

<td width="90">

@if($book->photo)

<img src="{{ asset('storage/'.$book->photo) }}"

width="60"

height="80"

style="object-fit:cover;">

@else

<img src="https://via.placeholder.com/60x80">

@endif

</td>

<td>

{{ $book->title }}

</td>

<td>

{{ $book->author }}

</td>

<td>

{{ $book->genre }}

</td>

<td>

{{ $book->edition }}

</td>

<td>

{{ $book->available_quantity }}

</td>

<td>

@if($book->available_quantity>0)

<span class="badge badge-success">

Available

</span>

@else

<span class="badge badge-danger">

Out of Stock

</span>

@endif

</td>

<td>

<a href="{{ route('books.edit',$book->id) }}"

class="btn btn-primary btn-sm">

<i class="fas fa-edit"></i>

Edit

</a>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@else

<div class="alert alert-danger">

No Books Found.

</div>

@endif

</div>

</div>

</div>

@endsection