<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Device Control</title>
    <style>
        label { display: block; margin-top: 10px; }
        #status { margin-top: 20px; }
    </style>
</head>
<body>

<h2>Control the Bulb</h2>
<form id="controlForm">
    <label>
        <input type="radio" name="control_mode" value="on"> On
    </label>
    <label>
        <input type="radio" name="control_mode" value="off"> Off
    </label>
    <label>
        <input type="radio" name="control_mode" value="auto"> Auto
    </label>
    <button type="submit">Submit</button>
</form>

<div id="status">
    <h3>Device Status</h3>
    <p>Mode: <span id="mode"></span></p>
    <p>LDR Value: <span id="ldrValue"></span></p>
</div>

<script>
document.getElementById('controlForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);

    fetch('update_control.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Control mode updated successfully');
            getStatus();
        } else {
            alert('Failed to update control mode');
        }
    })
    .catch(error => console.error('Error:', error));
});

function getStatus() {
    fetch('get_data.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('mode').textContent = data.data.control_mode;
            document.getElementById('ldrValue').textContent = data.data.ldr_value ?? "N/A";
        } else {
            alert('Failed to fetch data');
        }
    })
    .catch(error => console.error('Error:', error));
}

// Fetch status on page load
getStatus();
</script>

</body>
</html>
