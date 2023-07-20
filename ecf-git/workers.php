<!DOCTYPE html>
<html>
<head>
  <title>Page d'administration</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <link rel="stylesheet" type="text/css" href="style/style.css">
  <style>
    body{
      margin-top: 70px;
    }
    #avis-container {
      margin: 20px;
      display: flex;
      flex-direction: row;
    }
    .avis {
      background-color: #f5f5f5;
      padding: 10px;
      margin-bottom: 10px;
    }
    h2{
      text-transform: uppercase;
      text-align: center;
      font-size: 20px;
    }
    .avis h3 {
      margin-top: 5px;
      text-align: center;
    }
    .avis p {
      margin-bottom: 5px;
    } 
    .avis form {
      display: inline-block;
    }
    .avis button {
      padding: 5px 10px;
      background-color: #ea1f33;
      color: white;
      border: none;
      cursor: pointer;
      width: 10em;
      margin: auto;
    }
    .avis button:hover {
      background-color: #000;
    }
  </style>
</head>
<body>
  <!-- header -->
  <?php include 'components/header.php'; ?>
  <h2>Avis en attente de modération..</h2>
  <div id="avis-container">
    <?php include 'fetch_unapproved_reviews.php'; ?>
  </div>
   <!-- Link to JS -->
   <script src="js/jquery-3.6.4.min.js"></script>
    <script src="js/scripts.js"> </script>
</body>
</html>

