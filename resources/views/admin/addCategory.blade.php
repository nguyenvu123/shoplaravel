@extends('admin_layout')
@section('admin_content')

    <!-- page start-->
    <!-- page start-->
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                   Thêm danh mục sản phẩm
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
                        <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="category_product_name"
                                       placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả danh mục sản phẩm</label>
                                <textarea name="category_product_desc"  class="form-control" id="exampleInputPassword1"
                                          placeholder="Mô tả danh mục sản phẩm"> </textarea>
                            </div>


                            <div class="form-group">
                               <select name="category_product_status" class="form-control input-sm m-bot15">
                                   <option value="0">Ân</option>
                                   <option value="1">Hiển thị</option>

                               </select>
                            </div>
                            <button type="submit" name="add_category" class="btn btn-info">Thêm</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    @endsection
