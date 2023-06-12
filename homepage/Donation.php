
<!DOCTYPE html>
<html>
<head>
  <title>Donation Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    /* CSS styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
    }

    .donation-form {
      margin-top: 20px;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group select {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }

    .donate-button {
      display: block;
      width: 100%;
      padding: 10px;
      font-size: 16px;
      font-weight: bold;
      color: #ffffff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .donate-button:hover {
      background-color: #0056b3;
    }

    .icon {
      margin-right: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Donate</h1>
    <form class="donation-form" action="process_donation.php" method="POST">
      <div class="form-group">
        <label for="amount">Donation Amount</label>
        <input type="text" id="amount" name="amount" placeholder="Enter amount">
      </div>
      <div class="form-group">
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your name">
      </div>
      <div class="form-group">
        <label for="email">Your Email</label>
        <input type="email" id="email" name="email" placeholder="Enter your email">
      </div>
      <div class="form-group">
        <label for="payment-gateway">Select Payment Gateway</label>
        <select id="payment-gateway" name="payment_gateway">
          <option value="bksh"><i class="fab fa-bkash icon"></i> BKASH</option>
          <option value="ssl"><i class="fab fa-cc-visa icon"></i> SSL Gateway</option>
        </select>
      </div>
      <button class="donate-button" type="submit">Donate</button>
    </form>
  </div>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
  <script>