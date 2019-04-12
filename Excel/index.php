<?php include('header.php'); ?>
<body>

    <div class="row-fluid">
        <div class="span12">




            <div class="container">


                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Excel Writer</strong>&nbsp;Click The Button to View th e Excel File
                </div>
                <?php
                
                $excel = mysql_query("select  * from General_information")or die(mysql_error());
                $row = mysql_fetch_array($excel);
                $id_excel = $row['Proj_code'];
                ?>

                <form method="POST" action="excel.php">
                    <input type="hidden" name="id_excel" value="<?php echo $id_excel; ?>">
                    <button id="save_voter" class="btn btn-success" name="save"> Download Excel File</button>
                </form>

              
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">


                    <thead>
                        <tr>
                            <th>code</th><th>Name</th><th>Proc_code</th><th>Proc_type</th><th>Funding</th><th>Inbussplan</th><th>Date of init</th><th>cost at init</th><th>implementer</th><th>manager</th><th>coordinator</th><th>purpose</th><th>scope</th><th>contr date</th><th>planed cost</th><th>curr cost</th><th>planned completion (days)</th><th>implstartdate</th><th>enddate</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = mysql_query("select * from General_information") or die(mysql_error());
                        while ($row = mysql_fetch_array($query)) {
                            ?>
                            <?php echo' <tr>
                                <td>'.$query['0'].'</td><td>'.$query['1'].'</td><td>'.$query['2'].'</td><td>'.$query['3'].'</td><td>'.$query['4'].'</td><td>'.$query['5'].'</td><td>'.$query['6'].'</td><td>'.$query['7'].'</td><td>'.$query['8'].'</td><td>'.$query['9'].'</td><td>'.$query['10'].'</td><td>'.$query['11'].'</td><td>'.$query['12'].'</td><td>'.$query['13'].'</td><td>'.$query['14'].'</td><td>'.$query['15'].'</td><td>'.$query['16'].'</td><td>'.$query['17'].'</td><td>'.$query['18'].'</td>
                            </tr>'; ?>
<?php } ?>

                    </tbody>
                </table>



            </div>
        </div>
    </div>
</div>



</body>
</html>


