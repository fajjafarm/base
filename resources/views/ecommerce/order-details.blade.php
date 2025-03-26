@extends('layouts.vertical', ['title' => 'Order Details'])



@section('content')
    @include('layouts.partials.page-title', ['subtitle' => 'eCommerce', 'title' => 'Order  Details'])


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start justify-content-between">
                        <div class="col-lg-5">
                            <p class="text-dark fw-medium fs-15 d-flex align-items-center gap-1 mb-2">
                                <iconify-icon icon="solar:box-bold-duotone" class="text-danger"></iconify-icon>
                                Order
                                <i class="ti ti-arrow-right"></i>
                                <span class="badge bg-light-subtle rounded-pill text-dark border fs-12 py-1 px-2">
                                    #OC3142-EN
                                </span>
                            </p>

                            <h3 class="mb-1 text-dark fw-semibold">Order ID : #OC3142-EN <span
                                    class="badge bg-warning-subtle rounded-pill text-warning border border-warning fs-11 py-1 px-2 my-2">Shipping</span>
                                <span
                                    class="badge bg-success-subtle rounded-pill text-success border border-success fs-11 py-1 px-2  my-2">
                                    No Action Needed</span></h3>

                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <p class="mb-0 fs-15">Order Date : 2 July 2024</p>
                                <div>|</div>
                                <div>
                                    <p class="mb-0 fs-15 text-success fw-medium  d-flex align-items-center gap-1"><i
                                            class="ti ti-plane-tilt"></i>Estimated delivery: July 9, 2024</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 text-end">
                            <div class="d-flex gap-2 flex-wrap justify-content-end my-2">
                                <a href="#!" class="btn btn-soft-primary">Invoice</a>
                                <a href="#!" class="btn btn-primary">Edit Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="avatar-lg bg-light d-flex align-items-center justify-content-center rounded">
                            <iconify-icon icon="solar:delivery-bold-duotone" class="fs-32 text-primary"></iconify-icon>
                        </div>
                        <a href="#!" class="btn btn-primary btn-sm">Track Order</a>
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between mt-5 pt-1">
                        <div>
                            <p class="fs-15 fw-medium mb-0 text-muted mb-1">Estimated Arrival</p>
                            <p class="text-dark fw-semibold mb-0 fs-16">9 July 2024</p>
                        </div>
                        <div>
                            <p class="fs-15 fw-medium mb-0 text-muted mb-1">Tracker ID</p>
                            <p class="text-dark fw-semibold mb-0 fs-16">#TR73647</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                        <div
                            class="avatar-lg bg-light d-flex align-items-center justify-content-center rounded  flex-shrink-0">
                            <img src="/images/cards/mastercard.svg" alt="Card Img" class="img-fluid">
                        </div>
                        <div>
                            <p class="text-dark fw-medium fs-16 mb-1">Master Card</p>
                            <p class="mb-0">**** **** **** 3541 </p>
                        </div>
                        <div class="ms-auto">
                            <span
                                class="badge bg-success-subtle rounded-pill text-success border border-success fs-11 py-1 px-2  my-2">Paid</span>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap align-items-center justify-content-between mt-5 pt-1">
                        <div>
                            <p class="fs-15 fw-medium mb-0 text-muted mb-1">Transaction ID</p>
                            <p class="text-dark fw-semibold mb-0 fs-16">TR626788-MR</p>
                        </div>
                        <div>
                            <p class="fs-15 fw-medium mb-0 text-muted mb-1">Payment Method</p>
                            <p class="text-dark fw-semibold mb-0 fs-16">Master Card</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="avatar-lg bg-light d-flex align-items-center justify-content-center rounded">
                        <iconify-icon icon="solar:scooter-bold-duotone" class="fs-32 text-primary"></iconify-icon>
                    </div>
                    <p class="my-3 text-dark fs-20 text-dark fw-medium">Be patient, package on deliver!</p>
                    <div class="d-flex flex-wrap align-items-center mt-3 mb-2 justify-content-between gap-2">
                        <div>
                            <span
                                class="badge bg-light-subtle rounded-pill text-dark border fs-13 fw-medium py-1 px-2 d-flex align-items-center gap-1"><i
                                    class="ti ti-plane-tilt text-warning"></i> 613 Kuhl Avenue</span>
                        </div>
                        <i class="ti ti-arrow-narrow-right fs-18 text-muted"></i>
                        <div>
                            <span
                                class="badge bg-light-subtle rounded-pill text-dark border fs-13 fw-medium py-1 px-2 d-flex align-items-center gap-1"><iconify-icon
                                    icon="solar:map-point-bold-duotone" class="fs-18 text-warning"></iconify-icon> 1890
                                Uitsig St Grahamstad USA</span>
                        </div>
                    </div>
                    <div class="progress flex-grow-1" role="progressbar" aria-label="Basic example" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="height: 10px">
                        <div class="progress-bar bg-warning rounded progress-bar-striped progress-bar-animated"
                            style="width: 90%"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless mb-0">
                            <tbody>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-1 fs-14 fw-medium">4 July (Now)</p>
                                        <p class="mb-0 fs-14 fw-medium">06:00</p>
                                    </td>
                                    <td class="fs-14 fw-medium">
                                        <p class="mb-1 fs-14 fw-medium">Your package is packed by the courier</p>
                                        <p class="mb-0 fs-14 fw-medium text-muted">613 Kuhl Avenue Jennifer Lane</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-1 fs-14 fw-medium text-muted">2 July</p>
                                        <p class="mb-0 fs-14 fw-medium text-muted">10:00</p>
                                    </td>
                                    <td>
                                        <p class="mb-1 fs-14 fw-medium text-muted">Shipment has been created</p>
                                        <p class="mb-0 fs-14 fw-medium text-muted">613 Kuhl Avenue</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-1 fs-14 fw-medium text-muted">2 July</p>
                                        <p class="mb-0 fs-14 fw-medium text-muted">04:00</p>
                                    </td>
                                    <td>
                                        <p class="mb-1 fs-14 fw-medium text-muted">Order Placed</p>
                                        <p class="mb-0 fs-14 fw-medium text-muted">Coderthemes <iconify-icon
                                                icon="solar:verified-check-bold"
                                                class="align-middle text-success"></iconify-icon></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Shipment & Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2">
                        <div class="avatar-lg bg-light d-flex align-items-center justify-content-center rounded">
                            <img src="/images/brands/digital-ocean.svg" alt="" class="avatar-md">
                        </div>

                        <div>
                            <p class="text-dark fw-medium fs-16 mb-1">American Franklin Simon</p>
                            <p class="mb-0">dhanookapns142@armyspy.com </p>
                        </div>
                    </div>
                    <div class="row justify-content-between my-3">
                        <div class="col-lg-5">
                            <p class="fs-15 mb-1">Recipient</p>
                            <p class="fw-semibold text-dark fs-15 mb-0">Dhanoo K.</p>
                        </div>
                        <div class="col-lg-7">
                            <p class="fs-15 mb-1">Delivery Address</p>
                            <p class="fw-semibold text-dark fs-15 mb-0">1890 Uitsig Grahamstad USA</p>
                        </div>
                    </div>
                    <div class="row justify-content-between mt-4">
                        <div class="col-lg-5">
                            <p class="fs-15 mb-1">Phone Number</p>
                            <p class="fw-semibold text-dark fs-15 mb-0">+ 727-456-6512</p>
                        </div>
                        <div class="col-lg-7">
                            <p class="fs-15 mb-1">Payment ID</p>
                            <span
                                class="badge bg-light-subtle rounded-pill text-dark border fs-13 fw-medium py-1 px-2 ">#PY26356-NT
                                <a href="#!" class="ms-1"><i class="ti ti-copy"></i></a></span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="mapouter">
                        <div class="gmap_canvas"><iframe class="gmap_iframe rounded" width="100%"
                                style="height: 264px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                                src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8 col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="mb-0 card-title">Order Items</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center border border-dashed rounded p-2 gap-3">
                                <div class="rounded bg-light avatar-xl d-flex align-items-center justify-content-center">
                                    <img src="/images/products/p-3.png" alt="" class="avatar-xl">
                                </div>
                                <div>
                                    <a href="#!" class="text-dark fw-medium fs-15">Minetta Rattan Swivel Luxury Green
                                        Lounge Chair</a>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Price : </span>
                                        $300.00</p>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Size : </span>56L X
                                        63D X 102H CM</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center border border-dashed rounded p-2 gap-3">
                                <div class="rounded bg-light avatar-xl d-flex align-items-center justify-content-center">
                                    <img src="/images/products/p-6.png" alt="" class="avatar-xl">
                                </div>
                                <div>
                                    <a href="#!" class="text-dark fw-medium fs-15">Jordan Jumpman MVP Men's Shoes
                                        Size</a>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Price : </span>
                                        $400.00</p>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Size : </span> 8
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center border border-dashed rounded p-2 gap-3">
                                <div class="rounded bg-light avatar-xl d-flex align-items-center justify-content-center">
                                    <img src="/images/products/p-1.png" alt="" class="avatar-xl">
                                </div>
                                <div>
                                    <a href="#!" class="text-dark fw-medium fs-15">Men White Slim Fit T-shirt</a>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Price : </span>
                                        $70.90</p>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Size : </span> M
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex align-items-center border border-dashed rounded p-2 gap-3">
                                <div class="rounded bg-light avatar-xl d-flex align-items-center justify-content-center">
                                    <img src="/images/products/p-4.png" alt="" class="avatar-xl">
                                </div>
                                <div>
                                    <a href="#!" class="text-dark fw-medium fs-15">HYPERX Cloud Gaming Headphone</a>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Price : </span>
                                        $230.90</p>
                                    <p class="text-muted fw-medium fs-14 my-1"><span class="text-dark">Size : </span> M
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-12">
            <div class="card">
                <div class="card-header border-bottom">
                    <h5 class="card-title mb-0">Purchase Summary</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0 table-borderless">
                            <tbody>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-0 fs-15 fw-medium"> Sub Total : </p>
                                    </td>
                                    <td class="text-end text-dark fs-14 fw-medium px-0">$1001.8</td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-0 fs-15 fw-medium">Discount : </p>
                                    </td>
                                    <td class="text-end text-dark fs-14 fw-medium px-0">-$120.00</td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-0 fs-15 fw-medium">Delivery Charge : </p>
                                    </td>
                                    <td class="text-end text-success fs-14 fw-medium px-0">Free</td>
                                </tr>
                                <tr>
                                    <td class="px-0">
                                        <p class="mb-0 fs-15 fw-medium">Estimated Tax (18.5%) : </p>
                                    </td>
                                    <td class="text-end text-dark fs-14 fw-medium px-0">$30.00</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between border-top">
                    <div>
                        <p class="fw-medium text-dark mb-0 fs-15">Grand Amount</p>
                    </div>
                    <div>
                        <p class="fw-medium fs-14 text-dark mb-0">$911.8</p>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2 text-end mb-3">
        <a href="#!" class="btn btn-primary">Contact To Seller</a>
        <a href="#!" class="btn btn-outline-primary">Invoice</a>
    </div>
@endsection
