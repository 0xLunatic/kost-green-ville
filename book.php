<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="book.css" />
</head>
<?php
session_start();
if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
  echo '<div class="my-warning-box"><span class="my-close-icon">&times;</span> <h2>Notification</h2>' . $_SESSION['message'] . '</div>';
  $_SESSION['message'] = null;
}
?>

<body>
  <div class="booking-form">
    <h1>Book your room now!</h1>
    <form method="post" action="administrator/code.php">
      <label for="nameInput">Name : <span>*</span></label>
      <input type="text" name="name" id="name" required />

      <label for="addressInput">Address : <span>*</span></label>
      <input type="text" name="address" id="address" required />

      <label for="idCardInput">ID Card : <span>*</span></label>
      <input type="text" name="idCard" id="idCard" required />

      <label for="emailInput">Email : <span>*</span></label>
      <input type="text" name="email" id="email" required />

      <label for="phoneNumberInput">Phone Number : <span>*</span></label>
      <input type="text" name="phoneNumber" id="phoneNumber" required />

      <label for="roomType">Room Type <span>*</span></label>
      <select name="roomType" id="roomType">
        <option value="Normal Room">Normal Room (IDR 500.000)</option>
        <option value="Premium Room">Premium Room (IDR 1.000.000)</option>
        <option value="Exclusive Room">Exclusive Room (IDR 2.000.000)</option>
      </select>

      <label for="facilitiesText" id="facilitiesTextLabel">Facilities:</label>
      <ul id="facilitiesList"></ul>

      <input type="submit" id="submitBook" name="submitBook" value="Book Now" />
    </form>
  </div>
</body>

</html>
<script>
  const roomTypeSelect = document.getElementById("roomType");
  const facilitiesTextLabel = document.getElementById(
    "facilitiesTextLabel"
  );
  const facilitiesList = document.getElementById("facilitiesList");

  roomTypeSelect.addEventListener("change", function() {
    const selectedOption = roomTypeSelect.value;
    const facilities = getFacilities(selectedOption);

    if (facilities) {
      facilitiesTextLabel.style.display = "block";
      populateFacilitiesList(facilities);
      facilitiesList.style.display = "block";
    } else {
      facilitiesTextLabel.style.display = "none";
      facilitiesList.style.display = "none";
      facilitiesList.innerHTML = "";
    }
  });

  function getFacilities(roomType) {
    switch (roomType) {
      case "normalRoom":
        return ["Bed", "Wi-Fi", "Vehicle Park", "Kitchen"];
      case "premiumRoom":
        return [
          "Bed",
          "TV",
          "Wi-Fi",
          "Vehicle Park",
          "Kitchen",
          "Refrigerator",
          "Laundry",
        ];
      case "exclusiveRoom":
        return [
          "Bed",
          "TV",
          "Wi-Fi",
          "Vehicle Park",
          "Kitchen",
          "Refrigerator",
          "Laundry",
          "Air Conditioner",
          "Inside Bathroom",
        ];
      default:
        return null;
    }
  }

  function populateFacilitiesList(facilities) {
    facilitiesList.innerHTML = "";
    facilities.forEach(function(facility) {
      const listItem = document.createElement("li");
      listItem.textContent = facility;
      facilitiesList.appendChild(listItem);
    });
  }

  const event = new Event("change");
  roomTypeSelect.dispatchEvent(event);
</script>