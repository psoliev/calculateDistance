<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" value="{{ csrf_token() }}"/>

    <title>Тестовое задание</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">

</head>
<body>
<div class="container py-3">
    <header>
        <div class="pricing-header p-3 pb-md-4 mx-auto text-center">
            <h1 class="display-4 fw-normal">Рассчитать расстояние</h1>
            <p class="fs-5 text-muted">
                Чтобы узнать расстояние между двумя местами, введите адрес этого места в поле ввода ниже.
            </p>
        </div>
    </header>

    <main>
        <div class="row row-cols-1 row-cols-md-1 mb-1">
            <div class="col">
                <form autocomplete="off" action="{{url('/distance')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="address1" class="form-label">Адрес 1</label>
                        <input type="text" class="form-control" id="address1" name="address1" value="Москва, Проспект Вернадского, 105" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="address2" class="form-label">Адрес 2</label>
                        <input type="text" class="form-control autocomplete" id="address2" name="address2" value="{{$address2}}">
                    </div>
                    <button type="submit" class="btn btn-primary">Рассчитать</button>
                </form>
            </div>
            @if(isset($dist))
                <div class="col mt-3">
                    <div class="alert alert-primary" role="alert">
                        Расстояние между адресами: {{$dist}} м
                    </div>
                </div>
            @endif
        </div>

    </main>

    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <small class="d-block mb-3 text-muted">&copy; 2022</small>
            </div>
        </div>
    </footer>
</div>
<script src="jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
<script>
    var countries = ["Afghanistan","Albania","Algeria","Andorra","Angola","Anguilla","Antigua &amp; Barbuda","Argentina","Armenia","Aruba","Australia","Austria","Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium","Belize","Benin","Bermuda","Bhutan","Bolivia","Bosnia &amp; Herzegovina","Botswana","Brazil","British Virgin Islands","Brunei","Bulgaria","Burkina Faso","Burundi","Cambodia","Cameroon","Canada","Cape Verde","Cayman Islands","Central Arfrican Republic","Chad","Chile","China","Colombia","Congo","Cook Islands","Costa Rica","Cote D Ivoire","Croatia","Cuba","Curacao","Cyprus","Czech Republic","Denmark","Djibouti","Dominica","Dominican Republic","Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Ethiopia","Falkland Islands","Faroe Islands","Fiji","Finland","France","French Polynesia","French West Indies","Gabon","Gambia","Georgia","Germany","Ghana","Gibraltar","Greece","Greenland","Grenada","Guam","Guatemala","Guernsey","Guinea","Guinea Bissau","Guyana","Haiti","Honduras","Hong Kong","Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Isle of Man","Israel","Italy","Jamaica","Japan","Jersey","Jordan","Kazakhstan","Kenya","Kiribati","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia","Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg","Macau","Macedonia","Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands","Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia","Montenegro","Montserrat","Morocco","Mozambique","Myanmar","Namibia","Nauro","Nepal","Netherlands","Netherlands Antilles","New Caledonia","New Zealand","Nicaragua","Niger","Nigeria","North Korea","Norway","Oman","Pakistan","Palau","Palestine","Panama","Papua New Guinea","Paraguay","Peru","Philippines","Poland","Portugal","Puerto Rico","Qatar","Reunion","Romania","Russia","Rwanda","Saint Pierre &amp; Miquelon","Samoa","San Marino","Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone","Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Korea","South Sudan","Spain","Sri Lanka","St Kitts &amp; Nevis","St Lucia","St Vincent","Sudan","Suriname","Swaziland","Sweden","Switzerland","Syria","Taiwan","Tajikistan","Tanzania","Thailand","Timor L'Este","Togo","Tonga","Trinidad &amp; Tobago","Tunisia","Turkey","Turkmenistan","Turks &amp; Caicos","Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States of America","Uruguay","Uzbekistan","Vanuatu","Vatican City","Venezuela","Vietnam","Virgin Islands (US)","Yemen","Zambia","Zimbabwe"];

    $("input#address2").keypress(function(){
        var location_name = $(this).val();
        $.ajax({
            method: "get",
            url: "{{url('/api/getaddress')}}",
            data: { _location: location_name, _token: "{{csrf_token()}}" }
        }).done(function( arr ) {
            var aa = document.getElementsByClassName("autocomplete-items");
            var a = aa[0];

            for (i = 0; i < arr.length; i++) {
                b = document.createElement("DIV");
                b.innerHTML = arr[i];
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                b.addEventListener("click", function(e) {
                    document.getElementById("address2").value = this.getElementsByTagName("input")[0].value;
                    var x = document.getElementsByClassName("autocomplete-items");
                    x[0].parentNode.removeChild(x[0]);
                });
                a.appendChild(b);
            }

        });
    });

    autocomplete(document.getElementById("address2"));

</script>
</body>
</html>
