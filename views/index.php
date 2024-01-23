<?php
require_once('header.php');
?>


<div class="container text-center">
    <div class="insert-form">
        <form action="index.php?controller=Cron&action=insertNewCron" method="POST">
            <div class="row">
                <div class="col-md-3">
                    <label for="countrySelect">Select a Country:</label>

                    <select class="form-select" id="countrySelect" name="country">
                        <option value="" disabled selected>Please choose a country</option>
                        <?php
                        // Fetch countries from the controller and populate the dropdown
                        foreach ($countries as $country) {
                            ?>
                            <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>';
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="citySelect">Select a City:</label>

                    <select class="form-select" id="citySelect" name="city" required>
                        <option value="" disabled selected>Please choose a city</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="cronString">Cron string</label>

                    <input class="form-control" id="cronString" name="cronString" type="text" placeholder="Example: */5 * * * *" required>
                </div>

                <div class="col-md-3 d-flex align-items-end justify-content-between">
                    <button type="submit" id="scheduleCron" name="scheduleCron" class="btn btn-primary">Schedule</button>
                    <button type="submit" id="showData" name="showData" class="btn btn-primary">Show data</button>
                </div>
            </div>
        </form>
    </div>

    <br>
    <br>
    <br>
    
    <div class="cron-list">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-md-4">
                <?php
                if(isset($_GET['alert']) && $_GET['alert'] == "success"){
                    ?>
                    <div class="alert alert-success" role="alert">
                        Művelet sikeresen végrehajtva!
                    </div>
                    <?php
                }
                ?>
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">City </th>
                            <th scope="col">Endpoint</th>
                            <th scope="col">Cron string</th>
                            <th scope="col">Created</th>
                            <th scope="col">Last modified</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        // List existing cron jobs
                        foreach ($cronList as $cron) {
                            ?>
                            <tr id="row_<?php echo $cron['id']; ?>">
                                <td><?php echo $cron['id']; ?></td>
                                <td><?php echo $cron['cityName']; ?></td>
                                <td><?php echo htmlentities($cron['endpoint']); ?></td>
                                <td><?php echo $cron['cronString']; ?></td>
                                <td><?php echo $cron['createdAt']; ?></td>
                                <td><?php echo $cron['lastModifiedAt']; ?></td>
                                <td>
                                    <button type="button" data-cron="<?php echo htmlentities($cron['endpoint']); ?>" class="btn btn-primary collectData">Collect data</button>
                                </td>
                                <td>
                                    <a href="#" class="delete-icon" data-cityid="<?php echo $cron['cityId']; ?>" data-cityname="<?php echo $cron['cityName']; ?>" data-cronid="<?php echo $cron['id']; ?>"><i class="fas fa-trash-alt"></i></a>
                                    <a href="index.php?controller=Cron&action=editCron&param=<?php echo $cron['id']; ?>" class="edit-icon"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="collected-data">
        <div class="row d-flex align-items-center justify-content-center">
            <div class="collected-data-content">

            </div>
        </div>
    </div>

    
</div>


<?php
require_once('footer.php');
?>