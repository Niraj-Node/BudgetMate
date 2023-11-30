<!DOCTYPE html>
<html lang="en">
<head>
    <!--Meta Tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Web Appearance-->
    <link rel="icon" type="image/png" sizes="32x32" href="./favicon.png">
    <meta name="theme-color" content="#ffffff">
    <title>About</title>
    <!--CSS-->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/fontawesome.all.min.css">
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
                    <a class="nav-item nav-link active" href="./about.php">About</a>
                    <a class="nav-item nav-link" href="./faq.php">FAQ</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
      <div class="container p-4">
        <div class="d-flex justify-content-center">
          <h1 class="mb-4">ABOUT</h1>
        </div>

        <div class="row align-items-center">
          <div class="col-md-6 col-sm-12">
            <img src="./img/about.jpg" class="img-fluid" alt="banner" />
          </div>
          <div class="col-md-6 col-sm-12 pt-5">
            <h2 class="mb-4">The Genesis of BudgetMate</h2>
            <p>
              Living in a bustling PG, tracking expenses became a headache. But
              amid shared frustrations came an idea: a tool tailored for our
              needs. BudgetMate was born. It simplified expense tracking, from
              groceries to bills, offering transparency and ease. It transformed
              scattered receipts into a shared digital ledger, fostering harmony
              and understanding among residents. From chaos to cohesion, it
              reshaped our PG living.
            </p>
          </div>
        </div>

        <div class="row">
          <div class="col-12 text-center pt-4">
            <h3>Benefits of BudgetMate</h3>
            <ul class="list-unstyled">
              <li>Minimizes the possibility of errors in expense tracking.</li>
              <li>
                Offers detailed analytics for both Cash and Bank expenditures.
              </li>
              <li>
                Eliminates the need for maintaining physical expenditure
                records.
              </li>
              <li>Enhances security measures for financial data.</li>
              <li>
                Relieves the user from the burden of memorizing expense details.
              </li>
              <li>Provides easy access to transaction history at any time.</li>
              <li>
                Encourages better control and management of spending habits.
              </li>
              <li>
                Ensures a user-friendly interface for seamless navigation.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </main>

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
