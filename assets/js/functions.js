// Javascript functions

function registrationForm(element, event) {

    var errorContainer = document.getElementById('registerErrors');
    errorContainer.innerHTML = '';
    errorContainer.style.display = 'none';

    $.ajax({
        type: 'POST',
        url: 'api/Account.php?action=create',
        data: $(element).serialize(),
        beforeSend: function() {
            console.log('send');
            $(element).next().fadeIn(200);
        },
        success: function(data) {
            var obj = JSON.parse(data);

            if(obj.status === 'success') {

                var form = document.getElementById('registerForm');

                // Display success message
                $(form).slideUp(200);
                $('#setFirstName').text(' ' + obj.data.firstName);
                $('#registrationSuccess').slideDown(200);

                // Empty form
                form.reset();

            } else if(obj.status === 'error') {
                // Write user errors to screen
                for(var key in obj.errors) {
                    errorContainer.innerHTML += obj.errors[key] + '<br>';
                }
                // Write sql errors to console
                for(var key in obj.sqlErrors) {
                    console.log(obj.sqlErrors[key]);
                }

                // Show error container
                errorContainer.style.display = 'block';
            }

            $(element).next().fadeOut(200);
        }
    }, errorContainer);

    event.preventDefault();

}

function updateAccountForm(element, event) {

    var errorContainer = document.getElementById('updateAccountErrors');
    errorContainer.innerHTML = '';
    errorContainer.style.display = 'none';

    $.ajax({
        type: 'POST',
        url: '/api/Account.php?action=update',
        data: $(element).serialize(),
        success: function(data) {
            console.log(data)
            var obj = JSON.parse(data);

            if(obj.status === 'success') {

                var form = document.getElementById('accountForm');

                // Display success message
                $(form).slideUp(200);
                $('#setFirstName').text(' ' + obj.data.firstName);
                $('#registrationSuccess').slideDown(200);

                // Empty form
                form.reset();

            } else if(obj.status === 'error') {
                // Write user errors to screen
                for(var key in obj.errors) {
                    errorContainer.innerHTML += obj.errors[key] + '<br>';
                }
                // Write sql errors to console
                for(var key in obj.sqlErrors) {
                    console.log(obj.sqlErrors[key]);
                }

                // Show error container
                errorContainer.style.display = 'block';
            }
        }
    }, errorContainer);

    event.preventDefault();

}

function productForm(element, event) {

    var errorContainer = document.getElementById('productErrors');
    errorContainer.innerHTML = '';
    errorContainer.style.display = 'none';

    $.ajax({
        type: 'POST',
        url: '/api/product.php?action=update',
        data: $(element).serialize(),
        success: function(data) {
            console.log(data)
            var obj = JSON.parse(data);

            if(obj.status === 'success') {

                var form = document.getElementById('updateProductForm');

                // Display success message
                $('#setFirstName').text(' ' + obj.data.firstName);
                $('#registrationSuccess').slideDown(200);

            } else if(obj.status === 'error') {
                // Write user errors to screen
                for(var key in obj.errors) {
                    errorContainer.innerHTML += obj.errors[key] + '<br>';
                }
                // Write sql errors to console
                for(var key in obj.sqlErrors) {
                    console.log(obj.sqlErrors[key]);
                }

                // Show error container
                errorContainer.style.display = 'block';
            }
        }
    }, errorContainer);

    event.preventDefault();
}

function loginForm(element, event) {

    $.ajax({
        type: 'POST',
        url: 'api/Account.php?action=login',
        data: $(element).serialize(),
        beforeSend: function() {
            $(element).next().fadeIn(200);
        },
        success: function(data) {
            var obj = JSON.parse(data);

            if(obj.status === 'success') {

                // User is logged in, redirect user to redirect url.
                window.location.href = obj.redirect;

            } else if(obj.status === 'error') {

                // User is not logged in.

            }

            $(element).next().fadeOut(200);
        }
    });

    event.preventDefault();

}

$(document).ready( function () {
    $('#productTable').DataTable();
} );