<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).on("keydown", "input", function(e) {
            if (e.which == 13) e.preventDefault();
        });

        function IsEmpty() {
            console.log("1. IsEmpty started");
            var r = false;
            var myBuilding = document.getElementById("building");
            var myZip = document.getElementById("zip");
            var myAdditional = document.getElementById("additional");
            var username = document.getElementById("userName");

            if (myBuilding.value != "") {
                myBuilding.classList.remove("is-invalid");
            } else {
                myBuilding.classList.add("is-invalid");
            }
            if (myZip.value != "") {
                myZip.classList.remove("is-invalid");
            } else {
                myZip.classList.add("is-invalid");
            }
            if (myAdditional.value != "") {
                myAdditional.classList.remove("is-invalid");
            } else {
                myAdditional.classList.add("is-invalid");
            }
            if (username.value != "") {
                username.classList.remove("is-invalid");
            } else {
                username.classList.add("is-invalid");
            }
            if (myBuilding.value != "" && myZip.value != "" && myAdditional.value != "" && username.value != "") {
                console.log("2. If all not Empty entered");

                $(function() {
                    console.log("3. Function entered");
                    var params = {
                        "buildingnumber": myBuilding.value,
                        "zipcode": myZip.value,
                        "additionalnumber": myAdditional.value,
                        "encode": "utf8",
                    };
                    $.ajax({
                            url: "https://apina.address.gov.sa/NationalAddress/v3.1/Address/address-verify?" + $.param(params),
                            beforeSend: function(xhrObj) {
                                // Request headers
                                xhrObj.setRequestHeader("api_key", "8e7993b464964cc5b5cd472a77201499");
                            },
                            type: "GET",
                            // Request body
                            data: "{body}",
                        })
                        .done(function(data) {
                            console.log("4. done entered");
                            if (data.addressfound) {
                                console.log("5. address found entered");
                                document.getElementById("myClick").click();
                                r = true;
                            } else {
                                console.log("5. address not found entered");
                                alert("يرجى التأكد من العنوان المدخل");
                                r = false;
                            }
                        })
                        .fail(function() {
                            console.log("7. fail entered");
                            r = false;
                        });
                    console.log("8. Function finished");
                });
            } else {
                console.log("10. If all Empty finished")
                return false;
            }
            console.log("11. Function finished");
            return r;
        }

    </script>

</head>

<body>
    <div class="container">
        <img class="rounded-circle" src="natAdrs.png" alt="Generic placeholder image" width="140" height="140">
        <div class="myforms">
            <div class="blc">
                <form class="form-signin myform-right" action="addrow.php" method="post" id="hideform">
                    <div class="input-group">
                        <input type="text" id="building" name="buildingnumber" class="form-control right-items" placeholder="رقم المبنى">
                    </div>
                    <div class="input-group">
                        <input type="text" id="zip" name="zipcode" class="form-control right-items" placeholder="الرمز البريدي">
                    </div>
                    <div class="input-group">
                        <input type="text" id="additional" name="additionalnumber" class="form-control right-items" placeholder="الرقم الإضافي">
                    </div>
                    <div class="input-group">
                        <input type="text" id="userName" class="form-control right-items" placeholder="رقم الجوال" name="username">
                    </div>
                    <div class="input-group">
                        <input type="submit" value="تأكيد" class="btn btn-lg btn-primary btn-block right-items collapse" name="add" id="myClick">
                    </div>
                </form>

                <form class="form-signin myform-right">
                    <div class="input-group">
                        <input type="button" onclick="return IsEmpty();" value="تأكيد" class="btn btn-lg btn-primary btn-block right-items" name="add">
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
