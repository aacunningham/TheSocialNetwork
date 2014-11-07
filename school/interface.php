
<?php require_once "../Layout/header.php"; ?>
    
<title>Schools</title>
</head>

<body style="padding-top:70px">
<?php nav_bar(); ?>
    <h1>Schools</h1>
        
    <!-- Create New -->
    <div class="icon_container">
        <a href="new.php" target="_self"><img class="new icon" src="../assets/icons/create_new_doc.png"></a>
        <span class="caption">Add New School</span>
    </div>
    
    <?php $schools = $school->listSchools();
        foreach ($schools as $s) : ?>
           <div class="icon_container"> 
               <a href="edit.php?s=<?php echo $s['sid']; ?>" target="_self"><img class="school icon" src="../assets/icons/school.png"></a>
               <span class='caption'><?php echo $s["name"]; ?><br><?php echo $s["degree"]; ?></span>
           </div>
        <?php endforeach; ?>
</body>
</html>

