$(document).ready(function() {
    $('.Jazzcash_btn').click(function(e) {
        e.preventDefault();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email').val();
        var pnumber = $('.pnumber').val();
        var address1 = $('.address1').val();
        var address2 = $('.address2').val();
        var city = $('.city').val();
        var state = $('.state').val();
        var country = $('.country').val();
        var pcode = $('.pcode').val();

        if (!fname) {
            fname_err = "First Name is required";
            $('#fname_err').html('');
            $('#fname_err').html(fname_err);
        } else {
            fname_err = "";
            $('#fname_err').html('');
        }
        if (!lname) {
            lname_err = "Last Name is required";
            $('#lname_err').html('');
            $('#lname_err').html(lname_err);
        } else {
            lname_err = "";
            $('#lname_err').html('');
        }
        if (!email) {
            email_err = "Email is required";
            $('#email_err').html('');
            $('#email_err').html(email_err);
        } else {
            email_err = "";
            $('#email_err').html('');
        }
        if (!pnumber) {
            pnumber_err = "Phone Number is required";
            $('#pnumber_err').html('');
            $('#pnumber_err').html(pnumber_err);
        } else {
            pnumber_err = "";
            $('#pnumber_err').html('');
        }
        if (!address1) {
            address1_err = "Address1 is required";
            $('#address1_err').html('');
            $('#address1_err').html(address1_err);
        } else {
            address1_err = "";
            $('#address1_err').html('');
        }
        if (!address2) {
            address2_err = "Address2 is required";
            $('#address2_err').html('');
            $('#address2_err').html(address2_err);
        } else {
            address2_err = "";
            $('#address2_err').html('');
        }
        if (!city) {
            city_err = "City name  is required";
            $('#city_err').html('');
            $('#city_err').html(city_err);
        } else {
            city_err = "";
            $('#city_err').html('');
        }
        if (!state) {
            state_err = "State name is required";
            $('#state_err').html('');
            $('#state_err').html(state_err);
        } else {
            state_err = "";
            $('#state_err').html('');
        }
        if (!pcode) {
            pcode_err = "Pin Code is required";
            $('#pcode_err').html('');
            $('#pcode_err').html(pcode_err);
        } else {
            pcode_err = "";
            $('#pcode_err').html('');
        }
        if (!country) {
            country_err = "Country name is required";
            $('#country_err').html('');
            $('#country_err').html(country_err);
        } else {
            country_err = "";
            $('#country_err').html('');
        }

        if (fname_err != '' || lname_err != '' || email_err != '' || pnumber_err != '' || address1_err != '' || address2_err != '' || city_err != '' || state_err != '' || country_err != '' || pcode_err != '') {
            return false;
        } else {
            var data = {
                'fname': fname,
                'lname': lname,
                'email': email,
                'pnumber': pnumber,
                'address1': address1,
                'address2': address2,
                'city': city,
                'state': state,
                'country': country,
                'pcode': pcode,
            }
            $.ajax({
                method: "POST",
                url: "/docheckout",
                data: data,
                success: function(response) {
                    //console.log(response);
                    $("html").html(response);
                }
            });

        }
    });
});