// Handle country selection change
$(document).on('change', '#countrySelect', function() {
    let countryId = $(this).val();

    $.ajax({
        type: 'GET',
        url: 'index.php?controller=City&action=getCitiesByCountry&param=' + countryId,
        success: function (response) {
            // Clear existing options
            $('#citySelect').empty();

            // Add default option
            $('#citySelect').append('<option value="" disabled selected>Please choose a city</option>');

            // Handle the response from the server
            // Parse the JSON response
            let cities = JSON.parse(response);

            for (let key in cities) {
                if (cities.hasOwnProperty(key)) {
                    let city = cities[key];
                    $('#citySelect').append('<option value="' + city.id + '">' + city.name + '</option>');
                }
            }
        },
        error: function (error) {
            // Handle errors
            console.error('Error:', error);
        }
    });
});


$(document).on('click', '.delete-icon', function(event) {
    event.preventDefault();

    let cityName = $(this).data("cityname");
    let cronId = $(this).data("cronid");

    // Display a confirmation popup
    let isConfirmed = window.confirm("Are you sure to delete - " + cityName + "?");

    // Check if the user clicked "Yes"
    if (isConfirmed) {
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=Cron&action=deleteCron&param=' + cronId,
            success: function (response) {
                alert("Cron deleted");
                $("#row_" + cronId).remove();
            },
            error: function (error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }

});


$(document).on('click', '.collectData', function(event) {
    event.preventDefault();

    let cron = $(this).data("cron");

    $.ajax({
        type: 'GET',
        url: cron,
        success: function (response) {
            alert("Cron successfully run");
        },
        error: function (error) {
            // Handle errors
            alert("Cron run error");
        }
    });
});

$(document).on('click', '#showData', function(event) {
    event.preventDefault();

    let cityId = $("#citySelect").val();

    if(cityId != null){
        $.ajax({
            type: 'GET',
            url: 'index.php?controller=Weather&action=ajaxGetCollectedDataForCity&param=' + cityId,
            success: function (response) {
                let parsedData = JSON.parse(response);
                if(parsedData.error == 1){
                    alert(parsedData.msg);
                } else {                      
                      // Reference to the div with class "collected-data-content"
                      let collectedDataContent = $('.collected-data-content');

                      collectedDataContent.empty();
                      
                      // Create a table element with jQuery
                      let table = $('<table>').addClass('data-table');
                      
                      // Create a table header with jQuery
                      let thead = $('<thead>');
                      let headerRow = $('<tr>').html('<th>Temperature</th><th>Timestamp</th>');
                      thead.append(headerRow);
                      table.append(thead);
                      
                      // Create a table body with jQuery
                      let tbody = $('<tbody>');
                      
                      // Populate the table with data using jQuery
                      $.each(parsedData, function (index, data) {
                        let row = $('<tr>').html(`<td>${data.temperature}</td><td>${data.timestamp}</td>`);
                        tbody.append(row);
                      });
                      
                      table.append(tbody);
                      
                      // Append the table to the "collected-data-content" div using jQuery
                      collectedDataContent.append(table);
                      
                }
            },
            error: function (error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    } else {
        alert("Please select a city!");
    }

    
    

});