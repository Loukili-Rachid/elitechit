<!DOCTYPE html>
<html>
<head>
  <title>Package Tracking</title>

</head>
<body>
  
    <h1>
        Test Fedex
    </h1>

<script >


//-------------------------Fedex Tracking -----------------------------------------------


async function fetchData() {
    try {
        const authResponse = await fetch('https://apis-sandbox.fedex.com/oauth/token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'grant_type=client_credentials&client_id=l796eb2b56d2fe43c18c44f4368fbd1485&client_secret=a6d4f9a948524510bd87cb4066c96acd'
        });

        const authData = await authResponse.json();
        const accessToken = authData.access_token;
        console.log(accessToken);
    // Use the access token in another authorized request
    const requestData = {
        includeDetailedScans: true,
        trackingInfo: [
          {
            trackingNumberInfo: {
              trackingNumber: "123456789012"
            }
          }
        ]
      };

    const requestResponse = await fetch('https://apis-sandbox.fedex.com/track/v1/trackingnumbers', {
      method: 'POST',
      mode: 'no-cors',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${accessToken}`
      },
      body: JSON.stringify(requestData)
    });

    const responseData = await requestResponse.json();

    // Process the received data from the authorized request
    console.log(responseData);
  } catch (error) {
    // Handle any errors
    console.error('Error:', error);
  }
}

fetchData();

</script>
</body>
</html>
    