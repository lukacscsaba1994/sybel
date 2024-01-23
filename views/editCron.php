<?php
require_once('header.php');
?>

<div class="container text-center">
<form action="index.php?controller=Cron&action=updateCron" method="POST">
    <input class="form-control" id="cronId" name="cronId" type="hidden" value="<?php echo $cron["id"]; ?>" require>

    <div class="row">
        <div class="col-md-12 text-center">     
            <h2>Edit Cron scheduling</h2>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 text-center">
            <label for="cronString">Cron string</label>

            <input class="form-control" id="cronString" name="cronString" type="text" value="<?php echo $cron["cronString"]; ?>" require>
        </div>

        <div class="col-md-2 d-flex align-items-end justify-content-end">
            <button type="submit" id="updateCron" name="updateCron" class="btn btn-primary">Update</button>
        </div>
    </div>
    </form>
<?php
    ?>
</div>

<?php
require_once('footer.php');
?>