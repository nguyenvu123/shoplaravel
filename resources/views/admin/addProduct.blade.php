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
                        <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="product_name"
                                       placeholder="Tên danh mục">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Giá sản phẩm</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="product_price"
                                       placeholder="Nhập giá">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                <input type="file" class="form-control" id="exampleInputEmail1" name="product_img">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                <textarea name="product_des"  class="form-control" id="exampleInputPassword1"
                                          placeholder="Mô tả danh mục sản phẩm"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                <textarea name="product_content"  class="form-control" id="exampleInputPassword1"
                                          placeholder="Mô tả danh mục sản phẩm"> </textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                                <select name="category_product" class="form-control input-sm m-bot15">
                                    <?php foreach ($cates as $cate): ?>
                                    <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                  <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Thương hiệu</label>
                                <select name="brand_product" class="form-control input-sm m-bot15">
                                    <?php foreach ($brands as $brand): ?>
                                    <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    <?php endforeach; ?>

                                </select>
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
