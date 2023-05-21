<?= $this->extend('vw_main') ?>

<?= $this->section('content') ?>

        <div class="starter-template text-center py-5 px-3">
            <br/><br/><img src="<?= base_url('img/icon.png') ?>" width="50px" height="50px"><br/>
            <h1>Hai ! <?= session()->get('name'); ?></h1>
            <p class="lead">Selamat Datang di My Gallery</p>
            <a href="<?php echo base_url('image/create'); ?>" class="btn btn-warning btn-sm my-2">
                Upload New Image
            </a>
        </div>

<section class="gallery py-5 bg-light">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">

                <?php if (session()->getFlashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php } ?>

                <?php if (session()->getFlashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php } ?>

            </div>

            <?php if (!empty($images) && is_array($images)) { ?>
                <?php foreach ($images as $row) { ?>
                    <div class="col-md-4">
                        <div class="card mb-4 shadow">
                            <img src="<?php echo base_url('uploads/' . $row['path']); ?>" class="card-img-top" style="height: 300px; width:100%; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">
                                    <?php echo $row['caption']; ?>
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-<?= $row['id'] ?>">
                                             Edit</button>
                                        <a href="<?= base_url('image/delete/'.$row['id']) ?>" class="btn btn-danger" onclick="return confirm('Are You Sure ?')">Delete</a>
                                    </div>
                                    <small class="text-muted">
                                        <?php echo $row['created_at']; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="editModal-<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><img src="<?= base_url('img/icon.png') ?>" width="50px" height="50px">Edit Caption Image</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="<?= base_url('image/edit/'.$row['id']) ?>" method="post">
                                    <?= csrf_field(); ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="name">Caption</label>
                                            <input type="text" name="caption" class="form-control" id="name" value="<?= $row['caption'] ?>" placeholder="Your Caption" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="text-muted text-center">
                                No image found
                            </h2>
                            <p class="text-center">
                                <a href="<?php echo base_url('image/create'); ?>" class="btn btn-secondary btn-sm my-2">
                                    Ready to add some images?
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

            <?php } ?>
            <div class="col-md-12">
                <?= $pager->links(); ?>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>

<?= $this->section('extra-js') ?>
<script>
    $(document).ready(function() {
        $('.pagination li').addClass('page-item');
        $('.pagination li a').addClass('page-link');
    })
</script>
<?= $this->endSection() ?>