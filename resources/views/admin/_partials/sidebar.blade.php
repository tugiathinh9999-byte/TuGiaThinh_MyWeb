<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="admin-sidebar bg-dark text-white p-3 vh-100">

        <h4 class="mb-4">

            <i class="bi bi-speedometer2"></i>
            Admin

        </h4>

        <ul class="nav flex-column">

            <li class="nav-item">

                <a class="nav-link text-white" href="#">

                    <i class="bi bi-house-door"></i>
                    Dashboard

                </a>

            </li>

            {{-- Menu expand --}}
            <li class="nav-item">
                <a class="nav-link text-white" data-bs-toggle="collapse" href="#categoryMenu">

                    <i class="bi bi-tags"></i>
                    Quản lý

                    <i class="bi bi-chevron-down float-end"></i>
                </a>

                <div class="collapse" id="categoryMenu">
                    <ul class="nav flex-column ms-3">

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.categories.index') }}">
                                Loại Sản phẩm
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.brands.index') }}">
                                Thương hiệu
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.users.index') }}">
                                Người dùng
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.products.index') }}">
                                Sản phẩm
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('admin.posts.index') }}">
                                Bài viết
                            </a>
                        </li>


                    </ul>
                </div>
            </li>

        </ul>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>