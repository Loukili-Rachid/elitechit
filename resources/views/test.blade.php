<!DOCTYPE html>
<html>
<head>
  <title>Package Tracking</title>
  <style>

.container {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  text-align: center;
}

h1 {
  color: #333;
}

input[type="text"] {
  padding: 10px;
  width: 100%;
  margin-bottom: 10px;
}

button {
  padding: 10px 20px;
  background-color: #007bff;
  color: #fff;
  border: none;
  cursor: pointer;
}

#trackingResult {
  margin-top: 20px;
  font-weight: bold;
}

/* All Shipment Updates Styles */
#allUpdates {
  margin-top: 20px;
}

#allUpdates h2 {
  font-size: 20px;
  margin-bottom: 10px;
}

#updatesList {
  list-style-type: none;
  padding: 0;
}

#updatesList li {
  margin-bottom: 5px;
}

</style>
</head>
<body>
  <div class="container">
    <h1>Package Tracking</h1>
    <form id="trackingForm">
      <input type="text" id="trackingNumber" placeholder="Enter Tracking Number" required>
      <button type="submit">Track</button>
    </form>
    <div id="trackingResult"></div>
    <div id="allUpdates" style="display: none;">
        <h2>All Shipment Updates</h2>
        <ul id="updatesList"></ul>
    </div>
  </div>

  <script >
// Function to fetch and display package tracking information
function trackPackage(event) {
  event.preventDefault();
  
  const apiKey = 'demo-key';
  const trackingNumber = document.getElementById('trackingNumber').value;
  const apiUrl = `https://api-test.dhl.com/track/shipments?trackingNumber=${trackingNumber}`;
  
  // Make the API request
  fetch(apiUrl, {
    headers: {
      'DHL-API-Key': apiKey
    }
  })
    .then(response => response.json())
    .then(data => {
       
      const trackingResult = document.getElementById('trackingResult');
      // Process the response data
      if (data.shipments && data.shipments.length > 0) {
        const trackingInfo = data.shipments[0];
        console.log(trackingInfo)
        
        // Display the tracking information on your website
        trackingResult.innerHTML = `
            <p>Status: ${trackingInfo.status.status}</p>
            <p>Location: ${trackingInfo.status.location.address.addressLocality}</p>
            <p>Origin: ${trackingInfo.origin.address.addressLocality}</p>
            <p>Destination: ${trackingInfo.destination.address.addressLocality}</p>
            <p><a href="#" onclick="showAllUpdates(event)">All Shipment Updates</a></p>
        `;
      // Display simulated shipment updates
      const updates = trackingInfo.events;
        updatesList.innerHTML = '';
        updates.forEach(update => {
          const listItem = document.createElement('li');
          listItem.textContent = update.status;
          updatesList.appendChild(listItem);
        });
        
        allUpdates.style.display = 'none';
      } else {
        trackingResult.innerHTML = '<p>No tracking information found.</p>';
        allUpdates.style.display = 'none';
      }
    })
    .catch(error => {
      console.error('Error fetching tracking information:', error);
    });
}

// Function to show all shipment updates
function showAllUpdates(event) {
  event.preventDefault();
  
  const allUpdates = document.getElementById('allUpdates');
  allUpdates.style.display = 'block';
}

// Attach event listener to the form submission
const trackingForm = document.getElementById('trackingForm');
trackingForm.addEventListener('submit', trackPackage);

</script>
</body>
</html>
