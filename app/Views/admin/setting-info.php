<?= view('admin/templates/meta') ?>
<?= view('admin/templates/header') ?>
<?= view('admin/templates/navbar') ?>
<?= view('admin/templates/breadcrumb.php') ?>


<div class="card-box">


    <h4 class="header-title">Setting Info </h4>
    

    <div class="row">
        <div class="col-sm-12 mr-auto ml-auto">
        <div class="" id="error"></div>
            <div class="mt-4">
                <form id="setting_info">
               
                    <div class="form-group">
                        <label for="facebook">Địa chỉ facebook</label>
                        <textarea class="form-control" id="facebook" rows="3"><?= $info['facebook'] ?></textarea>

                    </div>
                    <div class="form-group ">
                        <label for="gmail">Địa chỉ Gmail</label>
                        <textarea class="form-control" id="gmail" rows="3"><?= $info['gmail'] ?></textarea>

                    </div>
                    <div class="form-group ">
                        <label for="youtube">Link Youtube</label>
                        <textarea class="form-control" id="youtube" rows="3"><?= $info['youtube'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="appid_fb">Appid Facebook</label>
                        <textarea class="form-control" id="appid_fb" rows="3"><?= $info['appid_fb'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="appsecret_fb">App secret Facebook </label>
                        <textarea class="form-control" id="appsecret_fb" rows="3"><?= $info['appsecret_fb'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="appid_gg">App id Google</label>
                        <textarea class="form-control" id="appid_gg" rows="3"><?= $info['appid_gg'] ?></textarea>
                    </div>
                    <div class="form-group ">
                        <label for="appsecret_gg">App Secret Google</label>
                        <textarea class="form-control" id="appsecret_gg" rows="3"><?= $info['appsecret_gg'] ?></textarea>
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