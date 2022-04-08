<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.84.0">
    <title>Mini Translator</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <!-- Bootstrap core CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">
  </head>
  <body class="d-flex h-100 text-center text-white bg-primary">
  <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
    <header class="mb-auto">
      <div>
        <nav class="nav nav-masthead justify-content-center">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </nav>
      </div>
    </header>
    <main class="px-3">
      <h1>Mini Translator</h1>
      <form action="" method="post" enctype="multipart/form-data">
        <div class="form-floating mt-3 mb-1">
          <textarea class="form-control" name="text" id="floatingTextarea2" style="height: 100px"></textarea>
          <label class="text-dark" for="floatingTextarea2">Input Text for Translate or Upload .txt</label>
        </div>
        <input class="form-control" type="file" id="formFile" name="formFile">
          <p class="lead mt-3">select a language</p>
        <div class="col-md-12 d-flex justify-content-center">
                <!-- Default dropstart button -->
          <select name="language" class="form-select form-select-lg mx-3" aria-label=".form-select-lg example">
            <option selected>Language</option>
            <option value="id">Indonesia</option>
            <option value="en">English</option>
            <option value="ar">Arrabic</option>
            <option value="es">Espanyol</option>
          </select>
            <h2 class="mx-10">to</h2>
          <select name="tolanguage" class="form-select form-select-lg mx-3" aria-label=".form-select-lg example">
            <option selected>Language</option>
            <option value="id">Indonesia</option>
            <option value="en">English</option>
            <option value="ar">Arrabic</option>
            <option value="es">Espanyol</option>
          </select>
        </div>
        <p class="lead mt-3">
          <button type="submit" name="submit" class="btn btn-lg btn-warning fw-bold border-white bg-white">Translate</button>
        </p>
        <?php
          require_once('googleTranslate.php');

            if(isset($_POST['submit'])) {
              $language = $_POST['language'];
              $toLanguage = $_POST['tolanguage'];
              $upload = $_FILES['formFile']['name'];
              $text = $_POST['text'];
            if ($upload != NULL) {
              $uploadText = file_get_contents("$upload");
              $translate = new GoogleTranslate();
              $result = $translate->translate($language, $toLanguage, $uploadText);
              $file = fopen("resultfileupload.txt","w");  
              fwrite($file,$result);  
              fclose($file); 
              echo '
              <div class="alert alert-primary text-dark" role="alert">
              Translate success ! check result on directory file
              </div>
              ';
            } else if ($text != "") {
              $newTranslate = new GoogleTranslate();
              $newResult = $newTranslate->translate($language, $toLanguage, $text);
              $newFile = fopen("resultinputtext.txt","w+");  
              fwrite($newFile,$newResult);  
              fclose($newFile); 
              echo '
              <div class="alert alert-light text-dark" role="alert">
              Translate success ! check result on directory file
              </div>';
              // echo $newResult;
            }
            echo '
            <div class="alert alert-danger" role="alert" id="success-alert">
              Please input data or the file has been overwritten
            </div>';
          }
        ?>
      </form>
    </main>
    <footer class="mt-auto text-white-50">
      <p>Build with &#10084; by Hanhan Hanafi</p>
    </footer>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>
