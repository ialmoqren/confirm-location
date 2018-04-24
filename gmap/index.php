<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBWsEmMd7In3hJUlY3CmfKzGyiRMVIeogw&language=ar&libraries=places&callback=myMap" async defer></script>

    <script>
        var map;

        function myMap() {
            var mapProp = {
                center: new google.maps.LatLng(24.7344055, 46.7071711),
                zoom: 10,
            };
            map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
            var marker = new google.maps.Marker({
                map: map
            });

            google.maps.event.addListener(map, 'click', function(event) {
                var latlng = new google.maps.LatLng(event.latLng.lat(), event.latLng.lng());
                marker.setPosition(latlng);
                document.getElementById('lat').value = event.latLng.lat();
                document.getElementById('lng').value = event.latLng.lng();
            });
        }

        function saveCountryShortName() {

            var place = document.getElementById("countryText").value;
            var mapRequest = new XMLHttpRequest();
            mapRequest.open('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' + place + '&key=AIzaSyCf5Bci0EX_JeN0lCDW-WCYuMeqQgz-rPI');

            mapRequest.onload = function() {

                console.log("1");
                var tmp = JSON.parse(mapRequest.responseText).results[0].address_components[0].short_name;
                var options = {
                    types: ['(cities)'],
                    componentRestrictions: {
                        country: tmp
                    }
                }
                console.log("2");
                var input = document.getElementById('cityText');
                var autocomplete = new google.maps.places.Autocomplete(input, options);

                var north = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.northeast.lat;
                var east = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.northeast.lng;
                var south = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.southwest.lat;
                var west = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.southwest.lng;
                var myBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(south, west),
                    new google.maps.LatLng(north, east));


                map.panTo(JSON.parse(mapRequest.responseText).results[0].geometry.location);
                map.fitBounds(myBounds);
                map.setZoom(1 + map.getZoom())
            }
            mapRequest.send();

        }

        function saveCityShortName() {



            var place = document.getElementById("cityText").value;
            var mapRequest = new XMLHttpRequest();
            mapRequest.open('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' + place + '&key=AIzaSyCf5Bci0EX_JeN0lCDW-WCYuMeqQgz-rPI');
            mapRequest.onload = function() {
                console.log("1");

                var north = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.northeast.lat;
                var east = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.northeast.lng;
                var south = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.southwest.lat;
                var west = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.southwest.lng;
                var myBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(south, west),
                    new google.maps.LatLng(north, east));

                var options = {
                    bounds: myBounds,
                    strictBounds: true,
                    types: ['(regions)']
                }

                console.log("2");
                var input = document.getElementById("nbrhdText");
                var autocomplete = new google.maps.places.Autocomplete(input, options);


                map.panTo(JSON.parse(mapRequest.responseText).results[0].geometry.location);
                map.fitBounds(myBounds);
                map.setZoom(1 + map.getZoom())
            }
            mapRequest.send();
        }

        function saveNbrLatLng() {
            var place = document.getElementById("nbrhdText").value;
            var mapRequest = new XMLHttpRequest();
            mapRequest.open('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address=' + place + '&key=AIzaSyCf5Bci0EX_JeN0lCDW-WCYuMeqQgz-rPI');
            mapRequest.onload = function() {
                console.log("1");
                var north = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.northeast.lat;
                var east = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.northeast.lng;
                var south = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.southwest.lat;
                var west = JSON.parse(mapRequest.responseText).results[0].geometry.bounds.southwest.lng;
                var myBounds = new google.maps.LatLngBounds(
                    new google.maps.LatLng(south, west),
                    new google.maps.LatLng(north, east));


                map.panTo(JSON.parse(mapRequest.responseText).results[0].geometry.location);
                map.fitBounds(myBounds);
                map.setZoom(1 + map.getZoom())
            }
            mapRequest.send();
        }

        function IsEmpty() {
            if (document.getElementById("lat").value === "") {
                alert("فضلاً حدد موقعك");
                return false;
            }
            return true;
        }

    </script>

</head>

<body>
    <div class="container">
        <div class="mapAndForms">
            <img class="rounded-circle img2" src="gmap.svg" alt="Generic placeholder image" width="80" height="80">

            <form class="form-signin">
                <div class="forms">
                    <div class="input-group">
                        <input class="form-control" placeholder="1. الدولة" id="countryText" name="country" list="countries" onfocusout="saveCountryShortName()">
                        <datalist id="countries">
          <option value="" selected>إختر</option>
  <option value="أفغانستان">أفغانستان</option>
  <option value="ألبانيا">ألبانيا</option>
  <option value="الجزائر">الجزائر</option>
  <option value="أندورا">أندورا</option>
  <option value="أنغولا">أنغولا</option>
  <option value="أنتيغوا وباربودا">أنتيغوا وباربودا</option>
  <option value="الأرجنتين">الأرجنتين</option>
  <option value="أرمينيا">أرمينيا</option>
  <option value="أستراليا">أستراليا</option>
  <option value="النمسا">النمسا</option>
  <option value="أذربيجان">أذربيجان</option>
  <option value="البهاما">البهاما</option>
  <option value="البحرين">البحرين</option>
  <option value="بنغلاديش">بنغلاديش</option>
  <option value="باربادوس">باربادوس</option>
  <option value="بيلاروسيا">بيلاروسيا</option>
  <option value="بلجيكا">بلجيكا</option>
  <option value="بليز">بليز</option>
  <option value="بنين">بنين</option>
  <option value="بوتان">بوتان</option>
  <option value="بوليفيا">بوليفيا</option>
  <option value="البوسنة والهرسك ">البوسنة والهرسك </option>
  <option value="بوتسوانا">بوتسوانا</option>
  <option value="البرازيل">البرازيل</option>
  <option value="بروناي">بروناي</option>
  <option value="بلغاريا">بلغاريا</option>
  <option value="بوركينا فاسو ">بوركينا فاسو </option>
  <option value="بوروندي">بوروندي</option>
  <option value="كمبوديا">كمبوديا</option>
  <option value="الكاميرون">الكاميرون</option>
  <option value="كندا">كندا</option>
  <option value="الرأس الأخضر">الرأس الأخضر</option>
  <option value="جمهورية أفريقيا الوسطى ">جمهورية أفريقيا الوسطى </option>
  <option value="تشاد">تشاد</option>
  <option value="تشيلي">تشيلي</option>
  <option value="الصين">الصين</option>
  <option value="كولومبيا">كولومبيا</option>
  <option value="جزر القمر">جزر القمر</option>
  <option value="كوستاريكا">كوستاريكا</option>
  <option value="ساحل العاج">ساحل العاج</option>
  <option value="كرواتيا">كرواتيا</option>
  <option value="كوبا">كوبا</option>
  <option value="قبرص">قبرص</option>
  <option value="التشيك">التشيك</option>
  <option value="جمهورية الكونغو الديمقراطية">جمهورية الكونغو الديمقراطية</option>
  <option value="الدنمارك">الدنمارك</option>
  <option value="جيبوتي">جيبوتي</option>
  <option value="دومينيكا">دومينيكا</option>
  <option value="جمهورية الدومينيكان">جمهورية الدومينيكان</option>
  <option value="تيمور الشرقية ">تيمور الشرقية </option>
  <option value="الإكوادور">الإكوادور</option>
  <option value="مصر">مصر</option>
  <option value="السلفادور">السلفادور</option>
  <option value="غينيا الاستوائية">غينيا الاستوائية</option>
  <option value="إريتريا">إريتريا</option>
  <option value="إستونيا">إستونيا</option>
  <option value="إثيوبيا">إثيوبيا</option>
  <option value="فيجي">فيجي</option>
  <option value="فنلندا">فنلندا</option>
  <option value="فرنسا">فرنسا</option>
  <option value="الغابون">الغابون</option>
  <option value="غامبيا">غامبيا</option>
  <option value="جورجيا">جورجيا</option>
  <option value="ألمانيا">ألمانيا</option>
  <option value="غانا">غانا</option>
  <option value="اليونان">اليونان</option>
  <option value="جرينادا">جرينادا</option>
  <option value="غواتيمالا">غواتيمالا</option>
  <option value="غينيا">غينيا</option>
  <option value="غينيا بيساو">غينيا بيساو</option>
  <option value="غويانا">غويانا</option>
  <option value="هايتي">هايتي</option>
  <option value="هندوراس">هندوراس</option>
  <option value="المجر">المجر</option>
  <option value="آيسلندا">آيسلندا</option>
  <option value="الهند">الهند</option>
  <option value="إندونيسيا">إندونيسيا</option>
  <option value="إيران">إيران</option>
  <option value="العراق">العراق</option>
  <option value="جمهورية أيرلندا ">جمهورية أيرلندا </option>
  <option value="فلسطين">فلسطين</option>
  <option value="إيطاليا">إيطاليا</option>
  <option value="جامايكا">جامايكا</option>
  <option value="اليابان">اليابان</option>
  <option value="الأردن">الأردن</option>
  <option value="كازاخستان">كازاخستان</option>
  <option value="كينيا">كينيا</option>
  <option value="كيريباتي">كيريباتي</option>
  <option value="الكويت">الكويت</option>
  <option value="قرغيزستان">قرغيزستان</option>
  <option value="لاوس">لاوس</option>
  <option value="لاوس">لاوس</option>
  <option value="لاتفيا">لاتفيا</option>
  <option value="لبنان">لبنان</option>
  <option value="ليسوتو">ليسوتو</option>
  <option value="ليبيريا">ليبيريا</option>
  <option value="ليبيا">ليبيا</option>
  <option value="ليختنشتاين">ليختنشتاين</option>
  <option value="ليتوانيا">ليتوانيا</option>
  <option value="لوكسمبورغ">لوكسمبورغ</option>
  <option value="مدغشقر">مدغشقر</option>
  <option value="مالاوي">مالاوي</option>
  <option value="ماليزيا">ماليزيا</option>
  <option value="جزر المالديف">جزر المالديف</option>
  <option value="مالي">مالي</option>
  <option value="مالطا">مالطا</option>
  <option value="جزر مارشال">جزر مارشال</option>
  <option value="موريتانيا">موريتانيا</option>
  <option value="موريشيوس">موريشيوس</option>
  <option value="المكسيك">المكسيك</option>
  <option value="مايكرونيزيا">مايكرونيزيا</option>
  <option value="مولدوفا">مولدوفا</option>
  <option value="موناكو">موناكو</option>
  <option value="منغوليا">منغوليا</option>
  <option value="الجبل الأسود">الجبل الأسود</option>
  <option value="المغرب">المغرب</option>
  <option value="موزمبيق">موزمبيق</option>
  <option value="بورما">بورما</option>
  <option value="ناميبيا">ناميبيا</option>
  <option value="ناورو">ناورو</option>
  <option value="نيبال">نيبال</option>
  <option value="هولندا">هولندا</option>
  <option value="نيوزيلندا">نيوزيلندا</option>
  <option value="نيكاراجوا">نيكاراجوا</option>
  <option value="النيجر">النيجر</option>
  <option value="نيجيريا">نيجيريا</option>
  <option value="كوريا الشمالية ">كوريا الشمالية </option>
  <option value="النرويج">النرويج</option>
  <option value="سلطنة عمان">سلطنة عمان</option>
  <option value="باكستان">باكستان</option>
  <option value="بالاو">بالاو</option>
  <option value="بنما">بنما</option>
  <option value="بابوا غينيا الجديدة">بابوا غينيا الجديدة</option>
  <option value="باراغواي">باراغواي</option>
  <option value="بيرو">بيرو</option>
  <option value="الفلبين">الفلبين</option>
  <option value="بولندا">بولندا</option>
  <option value="البرتغال">البرتغال</option>
  <option value="قطر">قطر</option>
  <option value="جمهورية الكونغو">جمهورية الكونغو</option>
  <option value="جمهورية مقدونيا">جمهورية مقدونيا</option>
  <option value="رومانيا">رومانيا</option>
  <option value="روسيا">روسيا</option>
  <option value="رواندا">رواندا</option>
  <option value="سانت كيتس ونيفيس">سانت كيتس ونيفيس</option>
  <option value="سانت لوسيا">سانت لوسيا</option>
  <option value="سانت فنسينت والجرينادينز">سانت فنسينت والجرينادينز</option>
  <option value="ساموا">ساموا</option>
  <option value="سان مارينو">سان مارينو</option>
  <option value="ساو تومي وبرينسيب">ساو تومي وبرينسيب</option>
  <option value="السعودية">السعودية</option>
  <option value="السنغال">السنغال</option>
  <option value="صربيا">صربيا</option>
  <option value="سيشيل">سيشيل</option>
  <option value="سيراليون">سيراليون</option>
  <option value="سنغافورة">سنغافورة</option>
  <option value="سلوفاكيا">سلوفاكيا</option>
  <option value="سلوفينيا">سلوفينيا</option>
  <option value="جزر سليمان">جزر سليمان</option>
  <option value="الصومال">الصومال</option>
  <option value="جنوب أفريقيا">جنوب أفريقيا</option>
  <option value="كوريا الجنوبية">كوريا الجنوبية</option>
  <option value="جنوب السودان">جنوب السودان</option>
  <option value="إسبانيا">إسبانيا</option>
  <option value="سريلانكا">سريلانكا</option>
  <option value="السودان">السودان</option>
  <option value="سورينام">سورينام</option>
  <option value="سوازيلاند">سوازيلاند</option>
  <option value="السويد">السويد</option>
  <option value="سويسرا">سويسرا</option>
  <option value="سوريا">سوريا</option>
  <option value="طاجيكستان">طاجيكستان</option>
  <option value="تنزانيا">تنزانيا</option>
  <option value="تايلاند">تايلاند</option>
  <option value="توغو">توغو</option>
  <option value="تونجا">تونجا</option>
  <option value="ترينيداد وتوباغو">ترينيداد وتوباغو</option>
  <option value="تونس">تونس</option>
  <option value="تركيا">تركيا</option>
  <option value="تركمانستان">تركمانستان</option>
  <option value="توفالو">توفالو</option>
  <option value="أوغندا">أوغندا</option>
  <option value="أوكرانيا">أوكرانيا</option>
  <option value="الإمارات العربية المتحدة">الإمارات العربية المتحدة</option>
  <option value="المملكة المتحدة">المملكة المتحدة</option>
  <option value="الولايات المتحدة">الولايات المتحدة</option>
  <option value="أوروغواي">أوروغواي</option>
  <option value="أوزبكستان">أوزبكستان</option>
  <option value="فانواتو">فانواتو</option>
  <option value="فنزويلا">فنزويلا</option>
  <option value="فيتنام">فيتنام</option>
  <option value="اليمن">اليمن</option>
  <option value="زامبيا">زامبيا</option>
  <option value="زيمبابوي">زيمبابوي</option>
</datalist> </div>
                    <div class="input-group">
                        <input class="form-control" placeholder="2. المدينة" id="cityText" type="text" onfocusout="saveCityShortName()">
                    </div>
                    <div class="input-group">
                        <input class="form-control" placeholder="3. الحي" id="nbrhdText" type="text" onfocusout="saveNbrLatLng()">
                    </div>
                </div>
            </form>
            <img class="rounded-circle img1" src="gmap.svg" alt="Generic placeholder image" width="80" height="80">

            <form class="form-signin" action="addrow.php" method="post" id="hideform">
                <div class="input-group">
                    <input class="collapse" type="text" name="latitude" id="lat">
                </div>
                <div class="input-group">
                    <input class="collapse" type="text" name="longitude" id="lng">
                </div>

                <div class="input-group">
                    <input type="text" id="userName" class="form-control" placeholder="رقم الجوال" required="" autofocus="" name="username">
                </div>
                <div class="input-group">
                    <input onclick="return IsEmpty();" type="submit" value="تأكيد" class="btn btn-lg btn-primary btn-block form-control" name="add">
                </div>
            </form>


        </div>
        <div id="googleMap" class="border border-primary rounded"></div>

        <!--to make the countries list be shown in Safari and old browsers-->
        <script src="datalist.polyfill.js"></script>
    </div>

</body>

</html>
