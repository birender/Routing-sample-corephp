<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $page_meta['title']; ?></title>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td,
    th {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
    }

    tr:nth-child(even) {
      background-color: #dddddd;
    }
  </style>
  <script>
    var WWWROOT = '<?php echo WWWROOT; ?>';
    var ASSETS = '<?php echo ASSETS; ?>';
  </script>
  <script src="<?php echo ASSETS ?>js/jquery-1.10.2.min.js"></script>
  <script src="<?php echo ASSETS ?>js/library.js"></script>
</head>

<body>