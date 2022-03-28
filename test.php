<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style type="text/css">
        .classification {
          position: relative;
          width: 91px;
          height: 17px;
      }
      .classification .cover {
          position: absolute;
          background: transparent url(images/2.png) top left no-repeat;
          top: 0px;
          left: 0px;
          width: 91px;
          height: 17px;
          z-index: 101;
      }
      .classification .progress {
          position: absolute;
          background: transparent url(images/1.png) top left no-repeat;
          top: 0px;
          left: 0px;
          height: 17px;
          z-index: 102;
      }
  </style>
</head>
<body>
    <div class="classification">
      <div class="cover"></div>
      <div class="progress" style="width: 100%;"></div>
  </div>
</body>
</html>