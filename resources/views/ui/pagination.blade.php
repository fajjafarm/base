@extends('layouts.vertical', ['title' => 'Pagination'])

@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'Base UI', 'title' => 'Pagination'])


    <div class="row">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Default Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Simple pagination inspired by Rdio, great for apps and search results.</p>

                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Disabled and active states</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Pagination links are customizable for different circumstances. Use
                        <code>.disabled</code> for links that appear un-clickable and <code>.active</code> to indicate the
                        current page.</p>

                    <nav aria-label="...">
                        <ul class="pagination mb-0">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Alignment</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Change the alignment of pagination components with flexbox utilities.</p>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript: void(0);" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);">Next</a>
                            </li>
                        </ul>
                    </nav>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item disabled">
                                <a class="page-link" href="javascript: void(0);" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);">Next</a>
                            </li>
                        </ul>
                    </nav>

                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Custom Icon Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-boxed</code> for rounded pagination.</p>

                    <nav>
                        <ul class="pagination pagination-boxed">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i class="ti ti-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i class="ti ti-chevron-right align-middle"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-boxed">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i data-lucide="arrow-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i data-lucide="arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-boxed mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <iconify-icon icon="solar:arrow-left-line-duotone" class="fs-18"></iconify-icon>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <iconify-icon icon="solar:arrow-right-line-duotone" class="fs-18"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Custom Color Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-boxed</code> for rounded pagination.</p>
                    <nav>
                        <ul class="pagination pagination-boxed pagination-info">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i class="ti ti-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i class="ti ti-chevron-right align-middle"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-boxed pagination-secondary">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i data-lucide="arrow-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i data-lucide="arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-boxed pagination-dark mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <iconify-icon icon="solar:arrow-left-line-duotone" class="fs-18"></iconify-icon>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <iconify-icon icon="solar:arrow-right-line-duotone" class="fs-18"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

        </div> <!-- end col -->

        <div class="col-xl-6">
            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Sizing</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-lg</code> or <code> .pagination-sm</code> for additional
                        sizes.</p>

                    <nav>
                        <ul class="pagination pagination-lg">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Boxed Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-boxed</code> for rounded pagination.</p>

                    <nav>
                        <ul class="pagination pagination-boxed">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="pagination pagination-lg pagination-boxed">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>

                        <ul class="pagination pagination-sm pagination-boxed mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Rounded Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-rounded</code> for rounded pagination.</p>

                    <nav>
                        <ul class="pagination pagination-rounded pagination-boxed mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>

                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Soft Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-rounded</code> for rounded pagination.</p>

                    <nav>
                        <ul class="pagination pagination-soft-danger pagination-boxed mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i class="ti ti-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i class="ti ti-chevron-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- end card-body -->
            </div> <!-- end card-->

            <div class="card">
                <div class="card-header border-bottom border-dashed d-flex align-items-center">
                    <h4 class="header-title">Gradient Color Pagination</h4>
                </div>

                <div class="card-body">
                    <p class="text-muted">Add <code> .pagination-boxed</code> for rounded pagination.</p>

                    <nav>
                        <ul class="pagination pagination-boxed pagination-gradient pagination-info">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i class="ti ti-chevron-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i class="ti ti-chevron-right align-middle"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-boxed pagination-secondary pagination-gradient">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <i data-lucide="arrow-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <i data-lucide="arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>

                    <nav>
                        <ul class="pagination pagination-boxed pagination-dark pagination-gradient mb-0">
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                                    <iconify-icon icon="solar:arrow-left-line-duotone" class="fs-18"></iconify-icon>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript: void(0);">5</a></li>
                            <li class="page-item">
                                <a class="page-link" href="javascript: void(0);" aria-label="Next">
                                    <iconify-icon icon="solar:arrow-right-line-duotone" class="fs-18"></iconify-icon>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
