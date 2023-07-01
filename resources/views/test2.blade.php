<!DOCTYPE html>
<html>
<head>
  <title>Package Tracking</title>

</head>
<body>
  
<h1>
    Test USPS
</h1>

<script >

//-------------------------USPS OAuth-----------------------------------------------

async function fetchData() {
    try {
        const requestData = {
        grant_type: 'ClientCredentials',
        client_id: 'epZUmmzMA5v20A1EmbFMZDPdGAVPfkJv',
        client_secret: 'AC7P4p4IUI934KWb'
        };
      const response = await fetch('https://api.usps.com/oauth2/v1/token', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(requestData)
      });
      
      const data = await response.json();
      
      // Process the received data
      console.log(data.access_token);
    } catch (error) {
      // Handle any errors
      console.error('Error:', error);
    }
}



fetchData();

</script>
</body>
</html>
    