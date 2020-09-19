@extends('admin_layout')
@section('admin_content')

    <!-- page start-->
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Thêm sản phẩm
                </header>
                <div class="panel-body">
                    <?php
                    $mg = Session::get('messge');
                    if($mg){
                        echo "$mg";
                        Session::put('messge',null);
                    }

                    ?>
                    <div class="position-center">
                        <form role="form" action="{{URL::to('/save-product')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="product_name"
                                       placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea name="product_desc"  class="form-control" id="exampleInputPassword1"
                                          placeholder="Mô tả danh mục sản phẩm"> </textarea>
                            </div>


                            <div class="form-group">
                               <select name="product_status" class="form-control input-sm m-bot15">
                                   <option value="0">Ân</option>
                                   <option value="1">Hiển thị</option>

                               </select>
                            </div>
                            <button type="submit" name="add_product" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    @endsection
