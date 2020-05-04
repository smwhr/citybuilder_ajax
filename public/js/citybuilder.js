console.log("Coucou");

var cityForm = document.querySelector('#create-city');
var districtForm = document.querySelector('#create-district');
var $ = document.querySelector.bind(document);



var City = {}

cityForm.addEventListener("submit", function(evt){
  evt.preventDefault();
  evt.stopPropagation();

  var form = evt.target;
  var data = new FormData(form);

  for (var item of data.entries()) {
    console.log(item[0], item[1]); 
  }

  $('#city-section #create-city').classList.add("d-none");
  $('#city-section .loader').classList.remove("d-none");

  fetch('/city/create', {
    'method' : 'POST',
    'body': data
  })
  .then(function(response){
    return response.json();
  })
  .then(function(data){
    console.log(data)
    $('#city-section .loader').classList.add("d-none");

    $("#city-name").innerHTML = data.city;

    City.name = data.city;
    City.id   = data.id;
    City.districts = [];

    $('#district-section').classList.remove("d-none");

  })

})


districtForm.addEventListener("submit", function(evt){
  evt.preventDefault();
  evt.stopPropagation();

  var form = evt.target;
  var data = new FormData(form);
  data.append('city_id', City.id);

  $('#district-section #create-district').classList.add("d-none");
  $('#district-section .loader').classList.remove("d-none");

  fetch('/city/adddistrict', {
    'method' : 'POST',
    'body': data
  })
  .then(function(response){
    return response.json();
  })
  .then(function(data){
    var li = document.createElement("li");
        li.innerHTML = data.district;
        li.setAttribute("district_id", data.id);


    var d = {
      name: data.district,
      id: data.id,
    }
    City.districts.push(d);

    $('#district-list').appendChild(li);
    $('#district-section .loader').classList.add("d-none");
    $('#district-section #create-district').classList.remove("d-none");

  })

});
