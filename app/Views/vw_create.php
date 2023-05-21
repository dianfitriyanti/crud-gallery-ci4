<?= $this->extend('vw_main') ?>

<?= $this->section('content') ?>
<br/><br/>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <img src="<?= base_url('img/icon.png') ?>" width="50px" height="50px"> Upload New Image
                    <a href="<?php echo base_url('image'); ?>" class="btn btn-link btn-sm float-right">
                        Back
                    </a>
                </div>
                <div class="card-body">
                    <?php if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <?php if (session()->getFlashdata('error')) { ?>
                        <div class="alert alert-danger">
                            <?php foreach (session()->getFlashdata('error') as $field => $error) : ?>
                                <p><?= $error ?></p>
                            <?php endforeach ?>
                        </div>

                    <?php } ?>

                    <?= form_open_multipart('image'); //masuk ke Routes Grup?>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" name="image" class="form-control" required>
                        <input type="hidden" name="owner" value="<?= session()->get('username'); ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="caption">Caption</label>
                        <textarea name="caption" id="" cols="10" rows="3" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-sm">Upload</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>