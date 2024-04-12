function updateUIEditor() {
  let id = document.getElementById('place-id').value;
  switch(document.querySelector('input[name="home-edit"]:checked').value) {
    case "title":
      var url = 'manage-home-edit-title.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
    case "property_type":
      var url = 'manage-home-edit-property-type.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
    case "description":
      var url = 'manage-home-edit-description-summary.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
    case "location":
      var url = 'manage-home-edit-location.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
    case "amenities":
      var url = 'manage-home-edit-amenities.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
    case "price":
      var url = 'manage-home-edit-price.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
    case "beds":
      var url = 'manage-home-edit-beds.php?id=' + id;
      document.getElementById('edit-container').src = url;
      break;
  }
}

function loadPage() {
  let id = document.getElementById('place-id').value;
  var url = 'manage-home-edit-title.php?id=' + id;
  document.getElementById('edit-container').src = url;
}
