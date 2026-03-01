<!-- filepath: resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMPAT - data management system</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container py-5">

        <div class="text-center mb-5">
            <h1 class="display-3 fw-bold">EMPAT</h1>
            <p class="lead text-muted">
                System management of products, categories and reviews
            </p>

            <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
                <a href="{{ route('categories.index') }}" class="btn btn-primary">
                    Categories
                </a>
                <a href="{{ route('products.index') }}" class="btn btn-success">
                    Products
                </a>
                <a href="{{ route('tags.index') }}" class="btn btn-warning">
                    Tags
                </a>
                <a href="{{ route('reviews.index') }}" class="btn btn-danger">
                    Reviews
                </a>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row text-center">

                    <div class="col-md-3 mb-3">
                        <h2 class="fw-bold text-primary">
                            {{ \App\Models\Category::count() }}
                        </h2>
                        <p class="text-muted mb-0">Categories</p>
                    </div>

                    <div class="col-md-3 mb-3">
                        <h2 class="fw-bold text-success">
                            {{ \App\Models\Product::count() }}
                        </h2>
                        <p class="text-muted mb-0">Products</p>
                    </div>

                    <div class="col-md-3 mb-3">
                        <h2 class="fw-bold text-warning">
                            {{ \App\Models\Tag::count() }}
                        </h2>
                        <p class="text-muted mb-0">Tags</p>
                    </div>

                    <div class="col-md-3 mb-3">
                        <h2 class="fw-bold text-danger">
                            {{ \App\Models\Review::count() }}
                        </h2>
                        <p class="text-muted mb-0">Reviews</p>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
