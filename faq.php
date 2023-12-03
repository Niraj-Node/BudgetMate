<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>FAQ</title>
    <!--CSS-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <?php include './php/functions/navigation.php'; ?>
            <a class="navbar-brand" href="<?php echo $baseUrl; ?>">
                <img src="./favicon.png" width="30" height="30" class="d-inline-block align-top" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href=".">BudgetMate<span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link" href="./php/pages/home.php">Home</a>
                    <a class="nav-item nav-link" href="./about.php">About</a>
                    <a class="nav-item nav-link active" href="./faq.php">FAQ</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="container p-5 text-center">
      <h1 class="pb-3">FREQUENTLY ASKED QUESTIONS</h1>
      <img src="./img/FAQ.jpg" alt="FAQ Image" class="img-fluid" style="max-width: 100%; height: auto;"/>
    </div>

    <div class="container p-3">
      <ol type="1" class="list-group">
        <li class="pb-3 list-group-item">
          <b>How do I create an account in BudgetMate?</b><br />
          To create an account, click on the "Sign Up" button on the homepage.
          You'll be directed to the registration page. Fill in your details and
          submit the form to create your BudgetMate account.
        </li>
        <li class="pb-3 list-group-item">
          <b>Is BudgetMate secure?</b> <br />
          Yes, BudgetMate ensures security by allowing access only with your
          unique username and password. Remember, it's crucial to keep your
          password confidential and not share it with anyone.
        </li>
        <li class="pb-3 list-group-item">
          <b>How can I enter my transaction details?</b> <br />
          Navigate to the Dashboard and click the "+" icon. Fill in the
          transaction details in the pop-up form, then click "Save" to record
          your transaction in BudgetMate.
        </li>
        <li class="pb-3 list-group-item">
          <b>Where can I view my transaction history in BudgetMate?</b> <br />
          Simply click on the "History" option in the menu to access your
          transaction history. There, you can review all your past transactions
          conveniently.
        </li>
        <li class="pb-3 list-group-item">
          <b>Can I edit or delete my transaction history in BudgetMate?</b>
          <br />
          Yes, you can edit your transaction details by clicking the edit icon
          near the description. To delete a transaction, click the corresponding
          delete icon. For clearing all transaction history, access the
          "Settings" page and select the "Reset Data" option.
        </li>
        <li class="pb-3 list-group-item">
          <b>How do I delete my BudgetMate account?</b> <br />
          To delete your BudgetMate account, go to "Settings" in the menu.
          Choose "Delete Account," and your profile will be permanently removed
          from our database, erasing all associated data.
        </li>
      </ol>
    </div>

    <!--Footer-->
    <footer id="footer">
      <div class="container">
        <div class="text-center copyright">
          &copy; Copyright
          <strong
            ><a href="https://niraj-node.github.io/" target="_blank"
              >Niraj Aghera</a
            ></strong
          >
        </div>
        <div class="text-center credits">
          Designed by
          <a href="https://niraj-node.github.io/" target="_blank"
            >Niraj Aghera</a
          >
        </div>
      </div>
    </footer>

    <!--JS-->
    <script
      src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
