<?= view('admin/templates/meta') ?>
<?= view('admin/templates/header') ?>
<?= view('admin/templates/navbar') ?>
<?= view('admin/templates/breadcrumb.php') ?>


<div class="card-box">


    <h4 class="header-title">Setting Meta </h4>
    

    <div class="row">
        <div class="col-sm-12 mr-auto ml-auto">
        <div class="" id="error"></div>
            <div class="mt-4">
                <form id="setting_meta">
               
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" rows="3"><?= $meta['description'] ?></textarea>

                    </div>
                    <div class="form-group ">
                        <label for="Copyright">Copyright</label>
                        <textarea class="form-control" id="copyright" rows="3"><?= $meta['copyright'] ?></textarea>

                    </div>
                    <div class="form-group ">
                        <label for="author">Author</label>
                        <textarea class="form-control" id="author" rows="3"><?= $meta['author'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="region">Region</label>
                        <textarea class="form-control" id="region" rows="3"><?= $meta['region'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="position">Position</label>
                        <textarea class="form-control" id="position" rows="3"><?= $meta['position'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="ICBM">ICBM</label>
                        <textarea class="form-control" id="ICBM" rows="3"><?= $meta['ICBM'] ?></textarea>
                    </div>
                    <button class="btn btn-primary form-control" type="submit" id="submit">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="row">

    <!-- end col-->

</div>
<!-- end row -->

</div>
<!-- end container-fluid -->

</div>
<!-- end content -->



<!-- Footer Start -->
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