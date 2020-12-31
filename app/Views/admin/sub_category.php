<?= view('admin/templates/meta') ?>
<?= view('admin/templates/header') ?>
<?= view('admin/templates/navbar') ?>
<?= view('admin/templates/breadcrumb.php') ?>
<div class="row">
    <div class="col-12">
        <div class="card-box">
            <h4 class="header-title">Danh mục bài viết</h4>
            <p class="sub-header">

            </p>
            <div class="text-center my-2">
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#add_category">
                    Thêm mới danh mục
                </button>
            </div>
            <div class="modal fade" id="add_category" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới danh mục</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="add_sub_category" method="post">
                            <div class="modal-body">
                            <div class="form-group">
                                <label for="list_category">Danh sách danh mục hiện có</label>
                                <select name="" id="id_sub_category" class="form-control">
                                <?php foreach($category as $key => $value):?>
                                    <option value="<?= $value['id'] ?>"><?= $value['name']; ?></option>
                                <?php endforeach; ?>
                                </select>
                            </div>
                                <div class="form-group">
                                    <label for="name">Tên danh mục</label>
                                    <input type="text" class="form-control" placeholder="Tên danh mục" id="name">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            <div class="col-6 mr-auto ml-auto">
                                <div id="error" class="my-2 "></div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <form  id="form_category" enctype='multipart/form-data'>
                <div id="datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="action my-2">
                                <div class="form-group">
                                    <label for="list_category">Danh sách danh mục hiện có</label>
                                    <select name="" id="id_category" class="form-control">
                                    <?php foreach($category as $key => $value):?>
                                        <option value="<?= $value['id'] ?>" selected><?= $value['name']; ?></option>
                                    <?php endforeach; ?>
                                    </select>
                                </div>
                                <button class=" btn btn-danger" id="delete_sub_category" type="button">Delete</button>
                                <button class=" btn btn-primary" id="update_sub_category" type="button">Cập nhật</button>
                            </div>
                            <form  id="form_category" enctype='multipart/form-data'>
                                <table id="datatable"
                                    class=" text-center table table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                    style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                    aria-describedby="datatable_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 155px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">stt</th>
                                            <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1"
                                                colspan="1" style="width: 155px;" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending">Name</th>


                                        </tr>
                                    </thead>
                                    
                                    <tbody id="load_sub_categoty">
                                        
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                2016 - 2019 &copy; Uplon theme by <a href="">Coderthemes</a>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>
<?= view('admin/templates/footer') ?>