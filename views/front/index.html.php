<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>CityBuilder</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


  
</head>
<body>
  <h1 id="city-name">CityBuilder</h1>

  <section id="city-section">
    <form id="create-city">
      <input type="text" name="city_name">
      <button type="submit">Créer</button>
    </form>
    
    <div class="loader spinner-border text-primary d-none" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </section>

  <section id="district-section" class="d-none">
    <h2>Les districts de ma ville</h2>
    <ul id="district-list">
    </ul>
    
    <form id="create-district">
      <input type="text" name="district_name">
      <button type="submit">Créer</button>
    </form>

    <div class="loader spinner-border text-primary d-none" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    
  </section>

  <script src="/js/citybuilder.js" defer></script>
</body>
</html>