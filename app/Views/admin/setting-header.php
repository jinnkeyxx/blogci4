<?= view('admin/templates/meta') ?>
<?= view('admin/templates/header') ?>
<?= view('admin/templates/navbar') ?>
<?= view('admin/templates/breadcrumb.php') ?>
<form id="setting_header">
    <div class="row">
    <div id="error"></div>
        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="header-title mb-4">Logo </h4>
                <input type="file" class="dropify" data-default-file="<?= $header['logo'] ?>" id='logo'>
                <div class="form-group my-2">
                    <label for="title_logo">Title Logo</label>
                    <input type="text" value="<?= $header['title_logo'] ?>" class="form-control" id="title_logo" >
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="header-title mb-4">Logo </h4>
                <input type="file" class="dropify" data-default-file="<?= $header['banner'] ?>" id='banner'>
                <div class="form-group my-2">
                    <label for="title_logo">Title banner</label>
                    <input type="text" value="<?= $header['title_banner'] ?>" class="form-control" id="title_banner">
                </div>
            </div>
        </div>
    </div>
    <button class="form-control btn btn-primary">Luư lại</button>
</form>








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