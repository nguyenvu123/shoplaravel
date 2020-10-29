
@extends('layout')
@section('content')


    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Trang chủ</a></li>
                    <li class="active">Thanh toán giỏ hàng</li>
                </ol>
            </div><!--/breadcrums-->

           <h4 style="margin-bottom: 30px;">Chọn hình thức thanh toán!!</h4>
            <form action="{{URL::to('/order_place')}}" method="POST">
                {{csrf_field() }}
            <div class="payment-options">
					<span>
						<label><input name="payment_option" value="1" type="checkbox"> Trả bằng ATM</label>
					</span>
                <span>
						<label><input name="payment_option" value="2" type="checkbox"> Nhận hàng trả tiền</label>
					</span>
                <input type="submit" value="Đặc hàng">

            </div>
            </form>
        </div>
    </section> <!--/#cart_items-->

@endsection