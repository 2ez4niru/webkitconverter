<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Webkit Converter</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
<style>
  body {
    background-color: #121212; /* Dark background */
    color: #e0e0e0; /* Light text */
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 20px;
  }
  .center-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    flex-direction: column;
    box-sizing: border-box;
  }
  #webkitForm {
    box-shadow: 0 4px 8px rgba(0,0,0,0.5); /* Darker shadow for contrast */
    padding: 20px;
    border-radius: 8px;
    background: #1e1e1e; /* Darker element background */
    width: 100%;
    max-width: 600px;
  }
 .center-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  flex-direction: column;
  box-sizing: border-box;
}

#result {
  cursor: pointer;
  margin-top: 20px;
  background-color: #1e1e1e; /* Darker element background */
  border: none;
  padding: 15px;
  color: #e0e0e0; /* Light text */
  max-height: 150px; /* Maximum height */
  overflow: auto; /* Enable scrolling */
  text-align: left; /* Align text to the left */
}
  pre {
    white-space: pre-wrap;
    word-wrap: break-word;
    margin: 0;
    color: #e0e0e0; /* Light text */
  }
textarea, button {
  width: calc(95% - 1.5rem);
  padding: 0.75rem;
  margin-top: 0.75rem;
  border: 1px solid #424242;
  background-color: #121212;
  color: #e0e0e0;
  border-radius: 8px;
  box-sizing: border-box;
}
  textarea {
    min-height: 150px;
    resize: none;
  }
  button {
    font-weight: 700;
    background-color: #2962ff; /* Brighter button color for contrast */
    border: none;
    cursor: pointer;
  }
  button:hover {
    background-color: #448aff; /* Lighter button hover color */
  }
  #webkitForm {
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 4px 8px rgba(0,0,0,0.5);
  padding: 20px;
  border-radius: 8px;
  background: #1e1e1e;
  width: 100%;
  max-width: 600px;
  box-sizing: border-box;
}
</style>
</head>
<body>
<div class="center-container">
  <form id="webkitForm" method="post">
    <h2 style="text-align: center; color: #e0e0e0;">WEBKIT CONVERTER</h2> <!-- Light text color -->
    <textarea id="webkitData" name="webkitData" placeholder="Enter your data here"></textarea>
    <button type="submit">Convert</button>
    <div id="result" onclick="copyResultText()"></div>
  </form>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#webkitForm').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                type: 'POST',
                url: 'process.php',
                data: formData,
                success: function(response) {
                    $('#result').html('<pre>' + response + '</pre>');
                }
            });
        });
    });
    function copyResultText() {
        var text = document.getElementById('result').innerText;
        navigator.clipboard.writeText(text).then(function() {
            console.log('Async: Copying to clipboard was successful!');
        }, function(err) {
            console.error('Async: Could not copy text: ', err);
        });
    }
</script>
</body>
</html>