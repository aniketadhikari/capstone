
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/pages.css?1">
    <link rel="stylesheet" href="styles/sidebar.css?1">
</head>

<body>
    <?php
    @include 'navigation.php';
    ?>

    <div id="stores" class="container">
        <div class="row row-cols-4 row-cols-md-3 g-4">
            <?php foreach ($stores as $store) : ?>
                <div class="col-md-4 ">
                    <div id="store" class="card store<?php echo $store['site_ID']; ?> text-white">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $store['site_ID']; ?></h5>
                            <p class="card-text"><?php echo $store['store_name']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>