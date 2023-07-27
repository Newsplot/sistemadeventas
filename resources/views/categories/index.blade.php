<!DOCTYPE html>
<html>
<head>
    <title>Category List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" >
</head>
<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <div><a href="/" class="btn btn-primary">Home</a></div>
            <div><a href="{{ route('categories.create')}}" class="btn btn-successs">New Category</a></div>
        </div>

        @if(session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>No.</td>
                        <td>Name</td>
                        <td>Description</td>
                        <td>Timestap</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $key => $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $key }}.</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>{{ $category->created_at->format('F d, Y') }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category) }}">Edit</a>
                            <form action="{{ route('categories.delete', $category) }}" method="post">
                                @csrf
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan=""5>No data found in table</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

