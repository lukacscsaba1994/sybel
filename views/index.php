<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Stat</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<form>
    <label for="countrySelect">Select a Country:</label>
    <select id="countrySelect" name="country">
        <?php
        // Fetch countries from the controller and populate the dropdown
        foreach ($countries as $country) {
            ?>
            <option value="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>';
            <?php
        }
        ?>
    </select>

    <label for="citySelect">Select a City:</label>
    <select id="citySelect" name="city">
        <option value="" disabled selected>Please choose a country</option>
    </select>
</form>

<script>
    // Handle country selection change
    $(document).on('change', '#countrySelect', function() {
        let countryId = $(this).val();
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=City&action=getCitiesByCountry&param=6',
            success: function (response) {
                // Clear existing options
                $('#citySelect').empty();

                // Add default option
                $('#citySelect').append('<option value="" disabled selected>Please choose a city</option>');

                // Handle the response from the server
                // Parse the JSON response
                let cities = JSON.parse(response);

                for (var key in cities) {
                    if (cities.hasOwnProperty(key)) {
                        var city = cities[key];
                        $('#citySelect').append('<option value="' + city.id + '">' + city.name + '</option>');
                    }
                }
            },
            error: function (error) {
                // Handle errors
                console.error('Error:', error);
            }
        });

        

        // Add retrieved cities to the city select
        
    });
</script>

</body>
</html>
