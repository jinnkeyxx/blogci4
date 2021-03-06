<?= view('admin/templates/meta') ?>
<?= view('admin/templates/header') ?>
<?= view('admin/templates/navbar') ?>
<?= view('admin/templates/breadcrumb.php') ?>


<div class="row">
    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 mt-1">

        <form class="my-1 p-3" id="form_edit_post" enctype="multipart/form-data" action="<?= base_url() ?>/Posts/edit_post">
            <div class="input-append form-group">
                <a href="<?= base_url() ?>/public/admin/filemanager/dialog.php?type=1&amp;field_id=fieldID&amp;relative_url=0&amp;multiple=1"
                    class="btn iframe-btn btn-primary mb-2" type="button">Chọn ảnh đại diện cho bài viết</a>
                <input id="fieldID" type="text" value="<?= $post['image_title'] ?>" class="form-control" name="image_title">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
            </div>
            <div class="form-group">
                <label for="title_post">Tiêu đề bài viết</label>
                <input type="text" class="form-control" id="title_post" name="title_post" value="<?= $post['title_post'] ?>">
            </div>
            <div class="form-group">
                <div class="form-inline">
                    <div class="form-select mx-2">
                        <label for="danhmuc">Danh mục bài viết</label>
                        <select class="form-control" id="category" name="category">
                            <option value="<?= $category_name['id'] ?>" slected><?= $category_name['name'] ?></option>
                            <?php foreach($category as $value): ?>
                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-select mx-2">
                        <label for="sub_category_select">Danh mục con bài viết</label>
                        <select class="form-control" id="sub_category" name="sub_category_select">
                        <option value="<?= $sub_category_name['id'] ?>" selected><?= $sub_category_name['name'] ?></option>
                        <?php foreach($sub_category as $value): ?>
                            <option value="<?= $value['id']; ?>"><?= $value['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="meta_keywork">Meta keyword</label>
                <input type="text" class="form-control" id="meta_keywork" name="meta_keywork" value="<?= $post['meta_keywork'] ?>">
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <input type="text" class="form-control" id="meta_description" name="meta_description" value="<?= $post['meta_description'] ?>">
            </div>
            <textarea rows="15" class="tinymce" id="content" name="content" value=""><?= $post['content'] ?></textarea>
            <div class="form-group" id="btn">
                <button class="btn btn-warning form-control mt-4" type="submit" name="btnSend"> GỬI </button>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">
tinymce.init({
    selector: '.tinymce',
    document_base_url: '<?= base_url()?>',

    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons colorpicker textcolor responsivefilemanager',
    imagetools_cors_hosts: ['picsum.photos'],
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent | numlist bullist | forecolor | backcolor | removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl | ',
    toolbar_sticky: true,
    autosave_ask_before_unload: true,
    autosave_interval: "30s",
    autosave_prefix: "{path}{query}-{id}-",
    autosave_restore_when_empty: false,
    autosave_retention: "2m",
    image_advtab: true,
    relative_urls: false,
    remove_script_host: false,
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
    ],
    toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
    toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
    image_advtab: true,

    external_filemanager_path: "<?= base_url() ?>/public/admin/filemanager/",
    filemanager_title: "Responsive Filemanager",
    external_plugins: {
        "filemanager": "<?= base_url() ?>/public/admin/filemanager/plugin.min.js"
    },
    /*content_css: '//www.tiny.cloud/css/codepen.min.css',*/
    link_list: [{
        title: 'My page 1',
        value: 'https://www.codexworld.com'
    }, {
        title: 'My page 2',
        value: 'https://www.xwebtools.com'
    }],
    image_list: [{
        title: 'My page 1',
        value: 'https://www.codexworld.com'
    }, {
        title: 'My page 2',
        value: 'https://www.xwebtools.com'
    }],
    image_class_list: [{
        title: 'None',
        value: ''
    }, {
        title: 'Some class',
        value: 'class-name'
    }],
    importcss_append: true,
    file_picker_callback: function(callback, value, meta) {

    },

    templates: [{
        title: 'New Table',
        description: 'creates a new table',
        content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
    }, {
        title: 'Starting my story',
        description: 'A cure for writers block',
        content: 'Once upon a time...'
    }, {
        title: 'New list with dates',
        description: 'New List with dates',
        content: '<div class="mceTmpl"><span class="cdate">cdate</span><br /><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
    }],
    template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
    template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
    image_caption: true,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: 'sliding',
    contextmenu: "link image imagetools table",
});
</script>


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