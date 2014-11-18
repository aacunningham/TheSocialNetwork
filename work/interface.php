
<?php require_once "../Layout/header.php"; ?>
    
<title>Works</title>
</head>

<body style="padding-top:70px">
<?php nav_bar(); ?>
    <h1>Work History</h1>
        
    <!-- Create New -->
    <div class="icon_container">
        <a href="new.php" target="_self"><img class="new icon" src="../assets/icons/create_new_doc.png"></a>
        <span class="caption">Add New Workplace</span>
    </div>
    
    <?php $workplaces = $work->listWorks();
        if (!empty($workplaces)) :
            foreach ($workplaces as $w) : ?>
               <div class="icon_container"> 
                   <a href="edit.php?w=<?php echo $w['wid']; ?>" target="_self"><img class="work icon" src="../assets/icons/work.jpg"></a>
                   <span class='caption'><?php echo $w["company"]; ?><br><?php echo $w["position"]; ?></span>
               </div>
            <?php endforeach; 
        endif; ?>
</body>
</html>











































