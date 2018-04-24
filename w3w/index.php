<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
    <script src="W3W.Geocoder.min.js" type="text/javascript"></script>

    <script>
        console.log("Start script");
        var IsValid3Words = false;
        var w3w;
        var options = {
            key: 'RXWYEREE',
            lang: 'ar',
            display: 'minimal'
        };
        w3w = new W3W.Geocoder(options);

        function updateLatLng() {
            console.log("entered function");
            var element = document.getElementById("countryText");
            var callback = {
                onSuccess: function(data) {
                    // sometimes its considered onSuccess even though it returns null values
                    if (data.geometry != null) {
                        document.getElementById('lat').value = data.geometry.lat;
                        document.getElementById('lng').value = data.geometry.lng;
                        var theLat = document.getElementById("lat").value;
                        // sometimes its considered onSuccess even though it returns empty latitude
                        if (theLat != "") {
                            element.classList.remove("is-invalid");
                            element.classList.add("is-valid");
                            console.log("entered success");
                            IsValid3Words = true;
                        } else {
                            notValid()
                        }
                    } else {
                        notValid()
                    }
                },
                onFailure: function(data) {
                    notValid()
                }
            };

            function notValid() {
                element.classList.remove("is-valid");
                element.classList.add("is-invalid");
                console.log("entered failure");
                IsValid3Words = false;
         }
            var the3words = document.getElementById("countryText").value;
            var params = {
                addr: the3words,
                lang: 'ar'
            };
            w3w.forward(params, callback);
            console.log("end function");
        }

        function IsEmpty() {
            console.log("entered isempty");
            if (!IsValid3Words || theLat === "") {
                console.log("entered if");
                alert("فضلاً أدخل قيمة صحيحة كـ عنوان3كلمات");
                return false;
            }
            console.log("jumped if");

            return true;
        }

    </script>

</head>

<body>
    <div class="container">
        <img class="rounded-circle" src="what3words.png" alt="Generic placeholder image" width="140" height="140">
        <div class="myforms">
            <form class="form-signin myform-right" action="addrow.php" method="post" id="hideform">
                <div class="input-group">
                    <input type="text" id="countryText" class="form-control right-items" placeholder="عنوان3كلمات" name="country" onfocusout="updateLatLng()">
                </div>
                <div class="input-group">
                    <input class="collapse" type="text" name="latitude" id="lat">
                </div>
                <div class="input-group">
                    <input class="collapse" type="text" name="longitude" id="lng">
                </div>
                <div class="input-group">
                    <input type="text" id="userName" class="form-control right-items" placeholder="رقم الجوال"  required="" name="username">
                </div>
                <div class="input-group">
                    <input onclick="return IsEmpty();" type="submit" value="تأكيد" class="btn btn-lg btn-primary btn-block right-items" name="add">
                </div>
            </form>
        </div>
    </div>

</body>

</html>
