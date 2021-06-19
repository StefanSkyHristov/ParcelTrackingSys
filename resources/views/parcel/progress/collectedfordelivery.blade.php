<x-admin-master>
    @section('content')
    <div class="col-md-12">
        <div class="card card-primary card-outline border-none">
            <ul class="bs4-order-tracking">
                <li class="step active">
                    <div><i class="fas fa-user"></i></div> Order Placed
                </li>
                <li class="step active">
                    <div><i class="fas fa-bread-slice"></i></div> Collected for Delivery
                </li>
                <li class="step">
                    <div><i class="fas fa-truck"></i></div> Shipped to Destination
                </li>
                <li class="step ">
                    <div><i class="fas fa-birthday-cake"></i></div> Collected
                </li>
            </ul>
            <h5 class="text-center"><b>Collected by Courrier</b>. The order has been collected by a courrier
            and is in transit.</h5>
        </div>
    </div>
    @endsection
</x-admin-master>

<style>
    .bs4-order-tracking {
    margin-bottom: 30px;
    overflow: hidden;
    color: #878788;
    padding-left: 0px;
    margin-top: 30px
}

.bs4-order-tracking li {
    list-style-type: none;
    font-size: 13px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400;
    color: #878788;
    text-align: center
}

.bs4-order-tracking li:first-child:before {
    margin-left: 15px !important;
    padding-left: 11px !important;
    text-align: left !important
}

.bs4-order-tracking li:last-child:before {
    margin-right: 5px !important;
    padding-right: 11px !important;
    text-align: right !important
}

.bs4-order-tracking li>div {
    color: #fff;
    width: 29px;
    text-align: center;
    line-height: 29px;
    display: block;
    font-size: 12px;
    background: #878788;
    border-radius: 50%;
    margin: auto;
    padding: 8px
}

.bs4-order-tracking li:after {
    content: '';
    width: 150%;
    height: 2px;
    background: #878788;
    position: absolute;
    left: 0%;
    right: 0%;
    top: 15px;
    z-index: -1
}

.bs4-order-tracking li:first-child:after {
    left: 50%
}

.bs4-order-tracking li:last-child:after {
    left: 0% !important;
    width: 0% !important
}

.bs4-order-tracking li.active {
    font-weight: bold;
    color: #dc3545
}

.bs4-order-tracking li.active>div {
    background: #dc3545
}

.bs4-order-tracking li.active:after {
    background: #dc3545
}

.card-outline {
    background-color: #fff;
    z-index: 0
}
</style>
